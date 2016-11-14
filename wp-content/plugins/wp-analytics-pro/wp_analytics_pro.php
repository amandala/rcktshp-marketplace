<?php
/*
Plugin Name: WP Analytics Pro
Plugin URI: http://aheadzen.com/
Description: Displays various statistical informations in graphical chart for User Registration,New Posts,Comments,Buddypress Activity,New Updates,Birth Chart,Forum Post,Topic,New Group Joined,Profile Photo,Profile Update,Media Upload,Message,Friend Request,Notification,Gift,Login,Logout,Password,Posts Update/Trash,Comment Trash/Spam,User Delete,Voter Plugin etc...  <br />See <a href="options-general.php?page=wordpress-analytics" target="_blank"><b>Plugin Settings >></b></a>
Author: Aheadzen Team  | <a href="options-general.php?page=wordpress-analytics" target="_blank">Manage Plugin Settings</a>
Version: 1.2.2
Author URI: http://aheadzen.com/

Copyright: © 2014-2015 AHEADZEN.COM
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

$wp_analytics_plugin_dir_path = dirname(__FILE__);
$wp_analytics_plugin_dir_url = plugins_url('', __FILE__);

$wp_stdt = date('Y-m-01');
$wp_enddt = date('Y-m-t');
if($_REQUEST['stdt']){$wp_stdt=$_REQUEST['stdt'];}
if($_REQUEST['enddt']){$wp_enddt=$_REQUEST['enddt'];}
$wp_cmp_data = 0;
if($_REQUEST['cmp_data'])
{
	$wp_cmp_data=1;
	$wp_stdt_str  = strtotime($wp_stdt);
	$wp_enddt_str = strtotime($wp_enddt);
	$differenceInSeconds = $wp_enddt_str - $wp_stdt_str; // Time difference in seconds
	$wp_days_dirrerence = number_format($differenceInSeconds / (24 * 60 * 60),0)+1;
	$start_date_time = mktime(0, 0, 0, date('m',$wp_stdt_str), date('d',$wp_stdt_str)-$wp_days_dirrerence, date('Y',$wp_stdt_str));
	$end_date_time = mktime(0, 0, 0, date('m',$wp_stdt_str), date('d',$wp_stdt_str)-1, date('Y',$wp_stdt_str));
	$wp_newstdt = date('Y-m-d',$start_date_time);
	$wp_newenddt = date('Y-m-d',$end_date_time);
}


/*************************************************
Plugin init function
*************************************************/
add_action('init', 'aheadzen_wp_analytics_init');
function aheadzen_wp_analytics_init()
{
	load_plugin_textdomain('aheadzen', false, basename( dirname( __FILE__ ) ) . '/languages');
} 


/*************************************************
A PHP Class to generate reports from WordPress
*************************************************/
class Aheadzen_Wp_Analytics_Report {

    private $_db;
    private $_prefix;
    private $_timestamp;
    private $_days_in_month;

    function __construct() {
        global $wpdb;

        $this->_db = $wpdb;
        $this->_prefix = $wpdb->prefix;
        $this->set_timestamp( time() );

        $this->enqueue();
        $this->actions();
    }

    function actions() {
        add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue') );
        add_action( 'admin_menu', array(&$this, 'admin_menu') );
    }

    function enqueue() {
        wp_enqueue_script( 'jqplot', plugins_url( '/js/jquery.flot.min.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'jqplottime', plugins_url( '/js/jquery.flot.time.js', __FILE__ ), array('jqplot') );
    }

    function set_timestamp( $timestamp ) {
        $this->_timestamp = gmdate( 'Y-m-d H:i:s', $timestamp );
        $this->_days_in_month = (int) date( 't', $timestamp );
    }

    /**
     * Adds the admin panel menu to the settings main menu
     */
    function admin_menu() {
        add_submenu_page( 'options-general.php', 'Wordpress Analytic', 'Wordpress Analytic', 'delete_posts', 'wordpress-analytics', array($this, 'admin_page') );
    }

    /**
     * Displays the statistics in the admin area
     */
    function admin_page() {
        include_once dirname( __FILE__ ) . '/report-admin.php';
    }
	
	function aheadzen_new_list($type,$num=5)
	{
		$return = '';
		if($type=='latest_users')
		{
			global $wpdb;
			$sql = "SELECT * FROM $wpdb->users order by user_registered desc limit 5";
			$users = $wpdb->get_results( $sql);
			if($users)
			{
				foreach($users as $user)
				{
					$post_author = $user->ID;
					$username = get_the_author_meta('display_name', $post_author);
					$thetime = human_time_diff(strtotime($user->user_registered), current_time('timestamp') ).' ago';
					$link = admin_url().'user-edit.php?user_id='.$post_author;
					$return .= '<li><a href="'.$link.'">' .$username.'</a> <small><em>'.$thetime.'</em></small> </li> ';
				}
			}
		}elseif($type=='latest_comments')
		{
			$comments=get_comments( array('status' => 'approve', 'number'=>'5') );
			if($comments)
			{
				foreach($comments as $comment)
				{
					$thetime = human_time_diff(strtotime($comment->comment_date_gmt), current_time('timestamp') ).' ago';
					$return .= '<li><a href="' . get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID . '">' .substr($comment->comment_content,0,30).' ...</a> by '. get_comment_author( $comment->comment_ID ).'  <small><em>'.$thetime.'</em></small> </li> ';
				}
			}
		}elseif($type=='latest_posts')
		{
			$args = array(
				'numberposts' => 5,
				'post_type' => 'post',
				'post_status' => 'publish',
				);
			$recent_posts = wp_get_recent_posts($args);
			if($recent_posts)
			{
				foreach( $recent_posts as $recent ){
					$thetime = human_time_diff(strtotime($recent['post_date']), current_time('timestamp') ).' ago';
					$post_author = $recent["post_author"];
					$username = get_the_author_meta('display_name', $recent["post_author"]);
					$return .=  '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> by '. $username.'  <small><em>'.$thetime.'</em></small> </li> ';
				}
			}
		}elseif($type=='latest_products')
		{
			$args = array(
				'numberposts' => 5,
				'post_type' => 'product',
				'post_status' => 'publish',
				);
			$recent_posts = wp_get_recent_posts($args);
			if($recent_posts)
			{
				foreach( $recent_posts as $recent ){
					$thetime = human_time_diff(strtotime($recent['post_date']), current_time('timestamp') ).' ago';
					$post_author = $recent["post_author"];
					$username = get_the_author_meta('display_name', $recent["post_author"]);
					$return .=  '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> by '. $username.'  <small><em>'.$thetime.'</em></small> </li> ';
				}
			}
		}elseif($type=='latest_orders')
		{
			$args = array(
				'numberposts' => 5,
				'post_type' => 'shop_order',
				'post_status' => 'publish',
				);
			$recent_posts = wp_get_recent_posts($args);
			if($recent_posts)
			{
				foreach( $recent_posts as $recent ){
					$thetime = human_time_diff(strtotime($recent['post_date']), current_time('timestamp') ).' ago';
					$post_author = $recent["post_author"];
					$username = get_the_author_meta('display_name', $recent["post_author"]);
					$return .=  '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> by '. $username.'  <small><em>'.$thetime.'</em></small> </li> ';
					$return .=  '<li><a href="' . admin_url() . '/post.php?post='.$recent["ID"].'&action=edit">#'.$recent["ID"].' by '.$username.'</a> <small><em>'.$thetime.'</em></small></li> ';
				}
			}
		}
		return $return;
	}
	
    function new_users($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
	    //$sql = "SELECT COUNT(ID) as count, user_registered as date FROM {$this->_db->users} WHERE YEAR(user_registered) = YEAR('$this->_timestamp') AND MONTH(user_registered) = MONTH('$this->_timestamp') GROUP BY cast(user_registered as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(ID) as count, user_registered as date FROM {$this->_db->users} where user_registered between \"$the_stdt\" and \"$the_enddt\"  GROUP BY cast(user_registered as date)";
		$users = $this->_db->get_results( $sql, ARRAY_A );
		return $users;
    }

    function new_posts( $post_type = 'post',$is_compare=0 ) {
        //$timestamp = ( $timestamp == false ) ? current_time( 'mysql' ) : gmdate( 'Y-m-d H:i:s', $timestamp );
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT count(ID) AS count, cast(post_date AS date) as date FROM {$this->_db->posts} p WHERE p.post_status = 'publish' AND p.post_type = '$post_type' AND YEAR(p.post_date) = YEAR('$this->_timestamp') AND MONTH(p.post_date) = MONTH('$this->_timestamp') group by cast(p.post_date as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT count(ID) AS count, cast(post_date AS date) as date FROM {$this->_db->posts} p WHERE p.post_status = 'publish' AND p.post_type = '$post_type' AND p.post_date between \"$the_stdt\" and \"$the_enddt\" group by cast(p.post_date as date)";
        $posts = $this->_db->get_results( $sql, ARRAY_A );
		return $posts;
    }

    function new_comments($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
	   //$sql = "SELECT COUNT(comment_ID) AS count, CAST(comment_date AS DATE) AS date FROM {$this->_db->comments} c WHERE YEAR(c.comment_date) = YEAR('$this->_timestamp') AND MONTH(c.comment_date) = MONTH('$this->_timestamp') group by cast(c.comment_date as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(comment_ID) AS count, CAST(comment_date AS DATE) AS date FROM {$this->_db->comments} WHERE comment_date between \"$the_stdt\" and \"$the_enddt\" group by cast(comment_date as date)"; 
		$comment = $this->_db->get_results( $sql, ARRAY_A );
		return $comment;
    }

    function bp_new_activity($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
	   //$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE YEAR(date_recorded) = YEAR('$this->_timestamp') AND MONTH(date_recorded) = MONTH('$this->_timestamp') group by cast(date_recorded as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE date_recorded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_recorded as date)";
		$activity = $this->_db->get_results( $sql, ARRAY_A );
		return $activity;
    }

    function bp_component( $name = '',$is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE YEAR(date_recorded) = YEAR('$this->_timestamp') AND MONTH(date_recorded) = MONTH('$this->_timestamp') AND component='$name' group by cast(date_recorded as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE component='$name' and date_recorded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_recorded as date)";
        $result = $this->_db->get_results( $sql, ARRAY_A );
		return $result;
    }

    function bp_type( $name = '',$is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE YEAR(date_recorded) = YEAR('$this->_timestamp') AND MONTH(date_recorded) = MONTH('$this->_timestamp') AND type='$name' group by cast(date_recorded as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		
		$subsql = "type='$name'";
		if($name=='new_forum_topic'){
			$subsql = "($subsql or type='bbp_topic_create')";
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM {$this->_prefix}bp_activity WHERE 1 and $subsql and date_recorded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_recorded as date)";
		
		$result = $this->_db->get_results( $sql, ARRAY_A );
		return $result;
    }

    function bp_friend_req($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_created AS date FROM {$this->_prefix}bp_friends WHERE YEAR(date_created) = YEAR('$this->_timestamp') AND MONTH(date_created) = MONTH('$this->_timestamp') AND is_confirmed=1 group by cast(date_created as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_created AS date FROM {$this->_prefix}bp_friends WHERE is_confirmed=1 and date_created between \"$the_stdt\" and \"$the_enddt\" group by cast(date_created as date)";
        $result = $this->_db->get_results( $sql, ARRAY_A );
		return $result;
    }

    function bp_messages($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_sent AS date FROM {$this->_prefix}bp_messages_messages WHERE YEAR(date_sent) = YEAR('$this->_timestamp') AND MONTH(date_sent) = MONTH('$this->_timestamp') group by cast(date_sent as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_sent AS date FROM {$this->_prefix}bp_messages_messages WHERE date_sent between \"$the_stdt\" and \"$the_enddt\" group by cast(date_sent as date)";
        $result = $this->_db->get_results( $sql, ARRAY_A );
	
        return $result;
    }

    /**
     * New photo uploaded by Buddypress album plugin
     *
     * @return array
     */
    function bp_photo_uploaded($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_uploaded AS date FROM {$this->_prefix}bp_album WHERE YEAR(date_uploaded) = YEAR('$this->_timestamp') AND MONTH(date_uploaded) = MONTH('$this->_timestamp') group by cast(date_uploaded as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_uploaded AS date FROM {$this->_prefix}bp_album WHERE date_uploaded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_uploaded as date)";
        $photo = $this->_db->get_results( $sql, ARRAY_A );
        return $photo;
    }

    function threewp_activity( $name,$is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(i_id) AS count, i_datetime AS date FROM {$this->_prefix}3wp_activity_monitor_index WHERE YEAR(i_datetime) = YEAR('$this->_timestamp') AND MONTH(i_datetime) = MONTH('$this->_timestamp') AND `activity_id`='$name' group by cast(i_datetime as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(i_id) AS count, i_datetime AS date FROM {$this->_prefix}3wp_activity_monitor_index WHERE `activity_id`='$name' and i_datetime between \"$the_stdt\" and \"$the_enddt\" group by cast(i_datetime as date)";
		$activity = $this->_db->get_results( $sql, ARRAY_A );

        return $activity;
    }

    function bp_notification($is_compare=0) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
        //$sql = "SELECT COUNT(id) AS count, date_notified AS date FROM {$this->_prefix}bp_notifications WHERE YEAR(date_notified) = YEAR('$this->_timestamp') AND MONTH(date_notified) = MONTH('$this->_timestamp') group by cast(date_notified as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_notified AS date FROM {$this->_prefix}bp_notifications WHERE date_notified between \"$the_stdt\" and \"$the_enddt\" group by cast(date_notified as date)";
        $notify = $this->_db->get_results( $sql, ARRAY_A );

        return $notify;
    }

    function votes( $action,$is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
		global $table_prefix;
		//$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM `".$table_prefix."ask_votes` WHERE YEAR(date_recorded) = YEAR('$this->_timestamp') AND MONTH(date_recorded) = MONTH('$this->_timestamp') AND action = \"$action\" group by cast(date_recorded as date)";
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM `".$table_prefix."ask_votes` WHERE action = \"$action\" and date_recorded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_recorded as date)";
		$votes = $this->_db->get_results( $sql, ARRAY_A );
		return $votes;
    }
	
	function email_log($is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
		global $table_prefix;
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM `ask_log` WHERE date_recorded between \"$the_stdt\" and \"$the_enddt\" group by cast(date_recorded as date)";
		$email_logs = $this->_db->get_results( $sql, ARRAY_A );
		return $email_logs;
    }
	
	function follow($is_compare=0 ) {
		global $wp_stdt,$wp_enddt,$wp_cmp_data,$wp_newstdt,$wp_newenddt;
		global $table_prefix;
		if($is_compare){
			$the_stdt = $wp_newstdt;
			$the_enddt = $wp_newenddt;
		}else{
			$the_stdt = $wp_stdt;
			$the_enddt = $wp_enddt;
		}
		$sql = "SELECT COUNT(id) AS count, date_recorded AS date FROM `ask_log` WHERE date_recorded between \"$the_stdt\" and \"$the_enddt\" and component='buddypress-followers' group by cast(date_recorded as date)";
		$email_logs = $this->_db->get_results( $sql, ARRAY_A );
		return $email_logs;
    }
	
	
	/*function fill_graph($array, $is_compare=0){
		foreach($array as $array_boj)
		{
			$newArray[] = array(
							'post'=> $array_boj->ID,
							'comments'=> $array_boj->comments_count,
							);
		}
		ksort( $newArray );
		return $newArray;
	}*/
	
	
    function fill_date( $array, $is_compare=0 ) {
        //array_unshift($array, '0'); //push the array one step from the begining
        $newArray = array();
		global $wp_stdt,$wp_enddt,$wp_newstdt,$wp_newenddt;
		$wp_stdt_date = date('d',strtotime($wp_stdt));
		$wp_stdt_month = date('m',strtotime($wp_stdt));
		$wp_stdt_year = date('Y',strtotime($wp_stdt));
		
		if($is_compare)
		{
			$wp_stdt_date = date('d',strtotime($wp_newstdt));
			$wp_stdt_month = date('m',strtotime($wp_newstdt));
			$wp_stdt_year = date('Y',strtotime($wp_newstdt));
		}
		
		$wp_stdt_str  = strtotime($wp_stdt);
		$wp_enddt_str = strtotime($wp_enddt);
		$differenceInSeconds = $wp_enddt_str - $wp_stdt_str; // Time difference in seconds
		$number_of_days = number_format($differenceInSeconds / (24 * 60 * 60),0);
		
		$start_date_time = mktime(0, 0, 0, $wp_stdt_month, $wp_stdt_date, $wp_stdt_year);
		$end_date_time = mktime(0, 0, 0, $wp_enddt_month, $wp_enddt_date, $wp_enddt_year);
		
		foreach ($array as $key => $val) {

            $index = strtotime(date( 'Y-m-d', strtotime( $val['date'] ) )); //date as index number
            $newArray1[$index] = $val;
        }
		for($d=0;$d<=$number_of_days;$d++)
		{
			$count = $d+1;
			//$start_date = date('Ymd',mktime(0, 0, 0, $wp_stdt_month, $wp_stdt_date+$d, $wp_stdt_year));
			$start_date = mktime(0, 0, 0, $wp_stdt_month, $wp_stdt_date+$d, $wp_stdt_year);
			$thecount = 0;
			if($newArray1[$start_date]['count'])
			{
				$thecount = $newArray1[$start_date]['count'];
			}
			$start_date = $start_date*1000;
			$newArray[] = array(
							'date'=> $start_date,
							'count'=> $thecount,
							);
		}
		ksort( $newArray );
		return $newArray;
    }

}

$report = new Aheadzen_Wp_Analytics_Report();

/**
 * Converts a PHP array to a JavaScript array
 *
 * Takes a PHP array, and returns a string formated as a JavaScript array
 * that exactly matches the PHP array.
 *
 * @param       array  $phpArray  The PHP array
 * @param       string $jsArrayName          The name for the JavaScript array
 * @return      string
 */
function aheadzen_get_javascript_array( $phpArray, $key1, $key2 ) {

    $count = 1;
	foreach ($phpArray as $val) {
        echo '[' . $val[$key1] . ', ' . $val[$key2] . '],';

        $count++;
    }
}

//$data = DataCollector::get_best_rank_posts('','2014-08-30','2015-01-10');
//print_r($data);
Class DataCollector
{
	function get_post_count($type='post',$status='publish')
	{
		global $wpdb;
		return $wpdb->get_var("select count(ID) from $wpdb->posts where post_type=\"$type\" and post_status=\"$status\"");
	}
	
	function get_post_list($type='',$status='')
	{
		global $wpdb;
		if($type){ $subsql = " and post_type=\"$type\" ";}
		if($status){ $subsql = " and post_status=\"$status\" ";}
		return $wpdb->get_col("select ID from $wpdb->posts where 1 $subsql");
	}
	
	function get_best_rank_posts($type='',$startdt='',$enddt='',$number=10)
	{
		global $wpdb;
		if($type==''){$type='post';}
		$subsql = '';
		$subsql .= " and comment_approved='1' ";
		if($startdt!='' && $enddt!=''){
			$subsql .= " and (date_format(c.comment_date,'%Y-%m-%d')>=\"$startdt\" and date_format(c.comment_date,'%Y-%m-%d')<=\"$enddt\") ";
		}elseif($startdt!='' && $enddt==''){
			$subsql .= " and date_format(c.comment_date,'%Y-%m-%d')>=\"$startdt\" ";
		}elseif($startdt=='' && $enddt!=''){
			$subsql .= " and date_format(c.comment_date,'%Y-%m-%d')<=\"$enddt\") ";
		}
		$post_rank_sql = "select p.ID,p.post_title, count(c.comment_post_ID)as comments_count from $wpdb->comments c join $wpdb->posts p on p.ID=c.comment_post_ID where p.post_type=\"$type\" and p.post_status='publish' $subsql group by c.comment_post_ID order by comment_count desc,p.post_title limit $number";
		return $wpdb->get_results($post_rank_sql);
	}
	
	function get_comment_count($post_id='',$startdt='',$enddt='',$comment_status=1)
	{
		global $wpdb;
		$post_id = intval($post_id);
		$subsql = '';
		if($post_id){$subsql = " and comment_post_ID=\"$post_id\" ";}
		if($comment_status){$subsql .= " and comment_approved=\"$comment_status\" ";}
		if($startdt!='' && $enddt!=''){
			$subsql .= " and (date_format(comment_date,'%Y-%m-%d')>=\"$startdt\" and date_format(comment_date,'%Y-%m-%d')<=\"$enddt\") ";
		}elseif($startdt!='' && $enddt==''){
			$subsql .= " and date_format(comment_date,'%Y-%m-%d')>=\"$startdt\" ";
		}elseif($startdt=='' && $enddt!=''){
			$subsql .= " and date_format(comment_date,'%Y-%m-%d')<=\"$enddt\") ";
		}
		return $wpdb->get_var("select count(comment_ID) from $wpdb->comments where 1 $subsql");
	}
	
	function get_google_page_views($post_id)
	{
		$default_arr = array('pageviews'=>0,'exits'=>0,'uniques'=>0);
		if(!class_exists('GALib')) {return $default_arr;}
		
		
		if ( get_option( 'gad_auth_token' ) == 'gad_see_oauth' ) {
			$ga = new GALib( 'oauth', NULL, get_option( 'gad_oauth_token' ), get_option( 'gad_oauth_secret' ), get_option( 'gad_account_id' ), get_option( 'gad_cache_timeout' ) !== false ? get_option( 'gad_cache_timeout' ) : 60 );
		} else {
			$ga = new GALib( 'client', get_option( 'gad_auth_token' ), NULL, NULL, get_option( 'gad_account_id' ), get_option( 'gad_cache_timeout' ) !== false ? get_option( 'gad_cache_timeout' ) : 60 );
		}
		$link_value = get_permalink( $post_id );
		$url_data   = parse_url( $link_value );
		$link_uri   = substr( $url_data['path'] . ( isset( $url_data['query'] ) ? ( '?' . $url_data['query'] ) : '' ), - 20 );

		$start_date = date( 'Y-m-d', time() - ( 60 * 60 * 24 * 30 ) );
		$end_date   = date( 'Y-m-d' );

		$data       = $ga->summary_by_partial_uri_for_date_period( $link_uri, $start_date, $end_date );
		if(!$data){ return $default_arr;}
		$error_type = gad_request_error_type( $ga );
		if ( $error_type == 'perm' ) {
			die( "Could not load data" );
		} else {
			if ( $error_type == 'retry' ) {
				$data = $ga->summary_by_partial_uri_for_date_period( $link_uri, $start_date, $end_date );
			}
		}

		$minvalue  = 999999999;
		$maxvalue  = 0;
		$pageviews = 0;
		$exits     = 0;
		$uniques   = 0;
		$count     = 0;
		foreach ( $data as $date => $value ) {
			if ( $minvalue > $value['ga:pageviews'] ) {
				$minvalue = $value['ga:pageviews'];
			}
			if ( $maxvalue < $value['ga:pageviews'] ) {
				$maxvalue = $value['ga:pageviews'];
			}
			$cvals .= $value['ga:pageviews'] . ( $count < sizeof( $data ) - 1 ? "," : "" );
			$count ++;

			$pageviews += $value['ga:pageviews'];
			$exits += $value['ga:exits'];
			$uniques += $value['ga:uniquePageviews'];
		}
		return array('pageviews'=>$pageviews,'exits'=>$exits,'uniques'=>$uniques);
	}
	
	function get_voting_count($post_id='')
	{
		if(!class_exists('VoterPluginClass')){return 0;}
		$type = get_post_type($post_id);
		if($type=='product'){
			$component = 'woocommerce';
		}elseif($type=='topic'){
			$component = 'forum';
		}else{
			$component = 'blog';
		}
		$params = array(
				'component' => $component,
				'type' 		=> $type,
				'secondary_item_id' => $post_id,
				);
		return VoterPluginClass::aheadzen_get_total_votes($params);
	}
	
}


class DataAnalyzer
{
	function normalizeScore( $rank )
	{
		$max = 5000;
		$min = 0;
		$rank = $rank*10/($max - $min);
		return $rank;
	}
}


class Ranker
{
	private static $weightComments = 10;
	private static $weightPageViews = 1;
	private static $weightVoteViews = 5;
	
	public function calculatePostRank ( $post_id )
	{
		$comment_count = DataCollector::get_comment_count( $post_id );
		$google_view_count_data = DataCollector::get_google_page_views($post_id);
		$voting_count = DataCollector::get_voting_count($post_id);
		$google_pageviews_count = $google_view_count_data['pageviews'];
		
		if($voting_count && is_array($voting_count)){
			$voting_count = $voting_count['total_up'];
		}
		
		$rank += self::$weightVoteViews*$voting_count;
		$rank += self::$weightComments*$comment_count;
		$rank += self::$weightPageViews*$google_pageviews_count;
		return  DataAnalyzer::normalizeScore( $rank );
	}

	public function SetAllPostRank($type='')
	{
		$all_posts = DataCollector::get_post_list($type);
		if($all_posts){
			for($i=0;$i<count($all_posts);$i++){
				$post_id = $all_posts[$i];
				$post_rank = self::calculatePostRank($post_id);
				update_post_meta($post_id,'_post_rank',$post_rank);
			}
		}
	}

}



class AheadzenAnalyticsAdminInterface
{
	function __construct() 
	{
		foreach( get_post_types() as $post_type ) {
			add_filter('manage_'.$post_type.'s_columns', array($this,'ranker_columns_head'),9999);
			add_action('manage_'.$post_type.'s_custom_column', array($this,'ranker_columns_content'),9999, 2);
			add_filter('manage_edit-'.$post_type.'_sortable_columns', array($this,'register_post_column_views_sortable') ,9999);
			//add_filter('manage_'.$post_type.'s_columns', array($this,'ranker_columns_head'),9999);
			//add_action('manage_'.$post_type.'s_custom_column', array($this,'ranker_columns_content'),9999, 2);
			//add_filter('manage_edit-'.$post_type.'_sortable_columns', array($this,'register_post_column_views_sortable') ,9999);
			
		 }
		 add_filter('request', array($this,'sort_views_column') );
	}
	
	// ADD NEW COLUMN
	function ranker_columns_head($defaults) {
		if(!$_GET['orderby'])
		{
			if($_GET['post_type']){$post_type = $_GET['post_type'];}else{$post_type = 'post';}
			Ranker::SetAllPostRank($post_type);
		}
		$defaults['post_rank'] = __('Rank','aheadzen');
		return $defaults;
	}
	 
	// SHOW THE FEATURED IMAGE
	function ranker_columns_content($column_name, $post_ID) {
		if ($column_name == 'post_rank') {
			echo get_post_meta($post_ID,'_post_rank',true);
		}
	}
	
	//Function: Register the 'Views' column as sortable in the WP dashboard.
	function register_post_column_views_sortable( $newcolumn ) {
		$newcolumn['post_rank'] = 'post_rank';
		return $newcolumn;
	}
	 
	//Function: Sort Post Views in WP dashboard based on the Number of Views (ASC or DESC).
	function sort_views_column( $vars )
	{
		if ( isset( $vars['orderby'] ) && 'post_rank' == $vars['orderby'] ) {
			$vars = array_merge( $vars, array(
				'meta_key' => '_post_rank', //Custom field key
				'orderby' => 'meta_value_num') //Custom field value (number)
			);
		}
		return $vars;
	}
	
}

add_action('init', 'aheadzen_post_rank_init',9999);
function aheadzen_post_rank_init()
{
	new AheadzenAnalyticsAdminInterface();
}

/*******************************
Cronjob The data
****************************/
$timeperiod='daily'; //hourly/twicedaily/daily
if (!wp_next_scheduled('aheadzen_set_post_rank_cronjob')) {
	wp_schedule_event( time(), $timeperiod,'aheadzen_set_post_rank_cronjob');
}
add_action( 'aheadzen_set_post_rank_cronjob', array('Ranker','SetAllPostRank'));
