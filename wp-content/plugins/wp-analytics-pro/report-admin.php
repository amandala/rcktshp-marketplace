<?php
// get year and month and set timestamp
$month = ( isset( $_GET['m'] ) ) ? intval( $_GET['m'] ) : intval( date( 'n' ) );
$year = ( isset( $_GET['y'] ) ) ? intval( $_GET['y'] ) : intval( date( 'Y' ) );

$timestamp = mktime( 1, 1, 1, $month, 1, $year );
$monthDays = (int) date( 't', $timestamp );

$this->set_timestamp( $timestamp );

//get the data
//$postrank = $this->fill_graph( DataCollector::get_best_rank_posts() );
$users = $this->fill_date( $this->new_users() );
$posts = $this->fill_date( $this->new_posts() );
$comments = $this->fill_date( $this->new_comments() );
global $woocommerce;
$woo_products = $this->fill_date( $this->new_posts('product') );
$shop_order = $this->fill_date( $this->new_posts('shop_order') );

$bp_activity = $this->fill_date( $this->bp_new_activity() );
$bp_birth_chart = $this->fill_date( $this->bp_component( 'birth_chart' ) );
$bp_forum_post = $this->fill_date( $this->bp_type( 'new_forum_post' ) );
$bp_forum_topic = $this->fill_date( $this->bp_type( 'new_forum_topic' ) );
$bp_group_joined = $this->fill_date( $this->bp_type( 'joined_group' ) );
$bp_profile_photo = $this->fill_date( $this->bp_type( 'new_avatar' ) );
$bp_activity_update = $this->fill_date( $this->bp_type( 'activity_update' ) );
$bp_profile_update = $this->fill_date( $this->bp_type( 'updated_profile' ) );
$gifts = $this->fill_date( $this->bp_type( 'new_gifts' ) );

$bp_photo_uploaded = $this->fill_date( $this->bp_photo_uploaded() );
$bp_message = $this->fill_date( $this->bp_messages() );
$bp_friend_req = $this->fill_date( $this->bp_friend_req() );
$bp_notification = $this->fill_date( $this->bp_notification() );

$login_success = $this->fill_date( $this->threewp_activity( 'wp_login' ) );
$login_fail = $this->fill_date( $this->threewp_activity( 'wp_login_failed' ) );
$logouts = $this->fill_date( $this->threewp_activity( 'wp_logout' ) );
$pass_retrieve = $this->fill_date( $this->threewp_activity( 'retrieve_password' ) );
$pass_reset = $this->fill_date( $this->threewp_activity( 'password_reset' ) );
$trashed_post = $this->fill_date( $this->threewp_activity( 'trashed_post' ) );
$post_updated = $this->fill_date( $this->threewp_activity( 'post_updated' ) );
$untrashed_post = $this->fill_date( $this->threewp_activity( 'untrashed_post' ) );
$deleted_post = $this->fill_date( $this->threewp_activity( 'deleted_post' ) );
$comment_trash = $this->fill_date( $this->threewp_activity( 'comment_trash' ) );
$comment_spam = $this->fill_date( $this->threewp_activity( 'comment_spam' ) );
$comment_approve = $this->fill_date( $this->threewp_activity( 'comment_approve' ) );
$delete_user = $this->fill_date( $this->threewp_activity( 'delete_user' ) );

$vote_up = $this->fill_date( $this->votes( 'up' ) );
$vote_down = $this->fill_date( $this->votes( 'down' ) );

$email_log_data = $this->email_log();
$email_log  = $this->fill_date($email_log_data);
$follow  = $this->fill_date( $this->follow() );

global $wp_cmp_data;
if($wp_cmp_data){
	$users_past = $this->fill_date( $this->new_users($is_compare=1),$is_compare=1 );
	$posts_past = $this->fill_date( $this->new_posts($is_compare=1),$is_compare=1 );
	$comments_past = $this->fill_date( $this->new_comments($is_compare=1),$is_compare=1 );
	$bp_activity_past = $this->fill_date( $this->bp_new_activity($is_compare=1),$is_compare=1 );
	$bp_birth_chart_past = $this->fill_date( $this->bp_component( 'birth_chart' ,$is_compare=1),$is_compare=1 );
	$bp_forum_post_past = $this->fill_date( $this->bp_type( 'new_forum_post' ,$is_compare=1),$is_compare=1 );
	$bp_forum_topic_past = $this->fill_date( $this->bp_type( 'new_forum_topic' ,$is_compare=1),$is_compare=1 );
	$bp_group_joined_past = $this->fill_date( $this->bp_type( 'joined_group' ,$is_compare=1),$is_compare=1 );
	$bp_profile_photo_past = $this->fill_date( $this->bp_type( 'new_avatar' ,$is_compare=1),$is_compare=1 );
	$bp_activity_update_past = $this->fill_date( $this->bp_type( 'activity_update' ,$is_compare=1),$is_compare=1);
	$bp_profile_update_past = $this->fill_date( $this->bp_type( 'updated_profile' ,$is_compare=1),$is_compare=1 );
	$gifts_past = $this->fill_date( $this->bp_type( 'new_gifts',$is_compare=1 ) ,$is_compare=1);
	$bp_photo_uploaded_past = $this->fill_date( $this->bp_photo_uploaded($is_compare=1),$is_compare=1 );
	$bp_message_past = $this->fill_date( $this->bp_messages($is_compare=1),$is_compare=1 );
	$bp_friend_req_past = $this->fill_date( $this->bp_friend_req($is_compare=1),$is_compare=1 );
	$bp_notification_past = $this->fill_date( $this->bp_notification($is_compare=1),$is_compare=1 );

	$login_success_past = $this->fill_date( $this->threewp_activity( 'wp_login',$is_compare=1 ),$is_compare=1 );
	$login_fail_past = $this->fill_date( $this->threewp_activity( 'wp_login_failed',$is_compare=1 ),$is_compare=1 );
	$logouts_past = $this->fill_date( $this->threewp_activity( 'wp_logout' ,$is_compare=1),$is_compare=1 );
	$pass_retrieve_past = $this->fill_date( $this->threewp_activity( 'retrieve_password' ,$is_compare=1),$is_compare=1 );
	$pass_reset_past = $this->fill_date( $this->threewp_activity( 'password_reset' ,$is_compare=1),$is_compare=1 );
	$trashed_post_past = $this->fill_date( $this->threewp_activity( 'trashed_post' ,$is_compare=1),$is_compare=1 );
	$post_updated_past = $this->fill_date( $this->threewp_activity( 'post_updated' ,$is_compare=1),$is_compare=1 );
	$untrashed_post_past = $this->fill_date( $this->threewp_activity( 'untrashed_post' ,$is_compare=1),$is_compare=1 );
	$deleted_post_past = $this->fill_date( $this->threewp_activity( 'deleted_post' ,$is_compare=1),$is_compare=1 );
	$comment_trash_past = $this->fill_date( $this->threewp_activity( 'comment_trash' ,$is_compare=1),$is_compare=1 );
	$comment_spam_past = $this->fill_date( $this->threewp_activity( 'comment_spam' ,$is_compare=1),$is_compare=1 );
	$comment_approve_past = $this->fill_date( $this->threewp_activity( 'comment_approve' ,$is_compare=1),$is_compare=1 );
	$delete_user_past = $this->fill_date( $this->threewp_activity( 'delete_user' ,$is_compare=1),$is_compare=1 );
	$vote_up_past = $this->fill_date( $this->votes( 'up' ,$is_compare=1),$is_compare=1 );
	$vote_down_past = $this->fill_date( $this->votes( 'down' ,$is_compare=1),$is_compare=1 );
	
	$email_log_past  = $this->fill_date( $this->email_log($is_compare=1),$is_compare=1 );
	$follow_past  = $this->fill_date( $this->follow($is_compare=1),$is_compare=1 );
	
	$woo_products_past = $this->fill_date( $this->new_posts('product' ,$is_compare=1) ,$is_compare=1 );
	$shop_order_past = $this->fill_date( $this->new_posts('shop_order',$is_compare=1),$is_compare=1 );
}

global $wp_analytics_plugin_dir_url,$wp_stdt,$wp_enddt;
?>
<style>
.chart_report{width:650px;height:250px;margin-bottom: 25px; float:left;}
.chart_wrap ul{float:left; margin-left:25px;width:300px;}
.chart_wrap ul li h3{ margin-top:0;}
</style>
<div class="wrap">
<link type="text/css" rel="stylesheet" href="<?php echo $wp_analytics_plugin_dir_url;?>/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" media="screen"></LINK>
<script>
var siteurl = '<?php echo $wp_analytics_plugin_dir_url;?>/';
</script>
<SCRIPT type="text/javascript" src="<?php echo $wp_analytics_plugin_dir_url;?>/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>

    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e('Wordpress Analytic Statistical','aheadzen')?></h2>
    <h3><?php _e('Showing data for','aheadzen');?> <strong><?php echo date( 'M, Y', $timestamp ); ?></strong></h3>
    <ul id="wr-menu">
        <?php /*?><li><a href="#wr-post-rank"><?php _e('Post Rank','aheadzen');?></a></li><?php */?>
		<li><a href="#wr-user-reg"><?php _e('User Registration','aheadzen');?></a></li>
        <li><a href="#wr-new-posts"><?php _e('New Posts','aheadzen');?></a></li>
        <li><a href="#wr-new-comments"><?php _e('New Comments','aheadzen');?></a></li>
       
	   <?php
		global $woocommerce;
		if($woocommerce){
		?>
		<li><a href="#wr-woo-products"><?php _e('Products','aheadzen');?></a></li>
		<li><a href="#wr-woo-orders"><?php _e('Orders','aheadzen');?></a></li>		
		<?php } ?>
	   <?php
		global $bp, $forum_id;
		if($bp){
		?>
		<li><a href="#wr-bp-activity"><?php _e('Buddypress Activity','aheadzen');?></a></li>
        <li><a href="#wr-bp-updates"><?php _e('New Updates','aheadzen');?></a></li>
		<li><a href="#wr-bp-birth-chart"><?php _e('Birth Chart','aheadzen');?></a></li>
        <li><a href="#wr-bp-forum-post"><?php _e('Forum Post','aheadzen');?></a></li>
        <li><a href="#wr-bp-forum-topic"><?php _e('Forum Topic','aheadzen');?></a></li>
        <li><a href="#wr-bp-group-joined"><?php _e('New Group Joined','aheadzen');?></a></li>
        <li><a href="#wr-bp-profile-photo"><?php _e('Profile Photo','aheadzen');?></a></li>
        <li><a href="#wr-bp-profile-update"><?php _e('Profile Update','aheadzen');?></a></li>
        <li><a href="#wr-bp-photo-upload"><?php _e('Media Upload','aheadzen');?></a></li>
        <li><a href="#wr-bp-message"><?php _e('Message','aheadzen');?></a></li>
        <li><a href="#wr-bp-friend-req"><?php _e('Friend Request','aheadzen');?></a></li>
        <li><a href="#wr-bp-notification"><?php _e('Notification','aheadzen');?></a></li>
		 <li><a href="#wr-gift"><?php _e('Gift','aheadzen')?></a></li>
		<?php }?>
        <li><a href="#wr-login"><?php _e('Login','aheadzen');?></a></li>
        <li><a href="#wr-logout"><?php _e('Logout','aheadzen');?></a></li>
        <li><a href="#wr-pass"><?php _e('Password','aheadzen');?></a></li>
        <li><a href="#wr-post-trash"><?php _e('Posts Update/Trash','aheadzen');?></a></li>
        <li><a href="#wr-comment"><?php _e('Comment Trash/Spam','aheadzen');?></a></li>
        <li><a href="#wr-del-user"><?php _e('User Delete','aheadzen');?></a></li>
		<?php
		global $aheadzen_voter_plugin_version;
		if($aheadzen_voter_plugin_version)
		{?>
	        <li><a href="#wr-vote"><?php _e('Voter Plugin','aheadzen')?></a></li>
       <?php }?>
	   <li><a href="#wr-email-log"><?php _e('Email Log','aheadzen')?></a></li>
	   <li><a href="#wr-follow"><?php _e('Following','aheadzen')?></a></li>
	   
    </ul>

    <div class="date">
        <form method="get" action="<?php echo admin_url( 'options-general.php' ); ?>">
            <input type="hidden" name="page" value="wordpress-analytics" />
			
			<table cellpadding="10">
			<tr>
			<td>
			<?php _e('Start Date','aheadzen');?> :<br />
			<input type="text" style="width:110px; float:left;" value="<?php echo $wp_stdt;?>" readonly name="stdt">
			<img style="width:30px;float:left; padding-left: 3px;" src="<?php echo $wp_analytics_plugin_dir_url;?>/images/cals.png" onclick="displayCalendar(document.forms[0].stdt,'yyyy-mm-dd',this)" alt="" />
			</td>
			<td>
			<?php _e('End Date','aheadzen');?> :<br />
			<input type="text" style="float:left; width:110px;" value="<?php echo $wp_enddt;?>" readonly name="enddt">
			<img style="width:30px;float:left; padding-left: 3px;" src="<?php echo $wp_analytics_plugin_dir_url;?>/images/cals.png" onclick="displayCalendar(document.forms[0].enddt,'yyyy-mm-dd',this)" alt="" />
			</td>
			<td>
			<input type="checkbox" <?php global $wp_cmp_data; if($wp_cmp_data){echo 'checked';}?> name="cmp_data" value="1" /> <small><?php _e('Compare Result?','aheadzen');?></small>
			<br />
			<small>
			<?php global $wp_newstdt,$wp_newenddt;
			if($wp_newstdt){echo __('comparing result for','aheadzen').' :<br /> '.$wp_newstdt.' - '.$wp_newenddt;}?>
			</small>
			</td>
			<td>
			<br />
			<input type="submit" value="<?php _e('Show Result','aheadzen');?>" />
			</td>
			</tr>
			<tr>
			</tr>
		</table>            
        </form>
    </div>
	<?php /*?><div id="wr-post-rank" class="chart_report"></div> <?php */?>
	<div class="chart_wrap">
    <div id="wr-user-reg" class="chart_report"></div> 
	<ul>
	<li><h3><?php _e('Latest User Registration','aheadzen');?></h3></li>
	<?php 
	/*$args = array(
			'orderby'       => 'registered', 
			'order'         => 'DESC', 
			'number'        => 5,
			 'hide_empty'    => false,
			);
	wp_list_authors( $args );
	*/
	?>
	<?php
		echo $this->aheadzen_new_list('latest_users');
		?>
	</ul>
	</div>
	
	<div class="chart_wrap">
		<div id="wr-new-posts" class="chart_report"></div>
		<ul>
		<li><h3><?php _e('Latest Posts','aheadzen');?></h3></li>
		<?php
		echo $this->aheadzen_new_list('latest_posts');
		?>
		</ul>
	</div>
	<div class="chart_wrap">
		<div id="wr-new-comments" class="chart_report"></div>
		<ul>
		<li><h3><?php _e('Latest Comments','aheadzen');?></h3></li>
		<?php 
		echo $this->aheadzen_new_list('latest_comments');
		?>
		</ul>
	</div>
	<?php
	global $woocommerce;
	if($woocommerce){
	?>
	<div class="chart_wrap">
		<div id="wr-woo-products" class="chart_report"></div>
		<ul>
		<li><h3><?php _e('Latest Products','aheadzen');?></h3></li>
		<?php
		echo $this->aheadzen_new_list('latest_products');
		?>
		</ul>
	</div>
	<div class="chart_wrap">
		<div id="wr-woo-orders" class="chart_report"></div>
		<ul>
		<li><h3><?php _e('Latest Orders','aheadzen');?></h3></li>
		<?php
		echo $this->aheadzen_new_list('latest_orders');
		?>
		</ul>
	</div>
	<?php } ?>
	<?php
	global $bp, $forum_id;
	if($bp){
	?>
	<div class="chart_wrap">
		<div id="wr-bp-activity" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-updates" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-birth-chart" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-forum-post" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-forum-topic" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-group-joined" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-profile-photo" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-profile-update" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-photo-upload" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-message" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-friend-req" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-bp-notification" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-gift" class="chart_report"></div>
	</div>
	<?php }?>
	<div class="chart_wrap">
		<div id="wr-login" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-logout" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-pass" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-post-trash" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-comment" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-del-user" class="chart_report"></div>
	</div>
	<?php
	global $aheadzen_voter_plugin_version;
	if($aheadzen_voter_plugin_version)
	{?>
    <div class="chart_wrap">
		<div id="wr-vote" class="chart_report"></div>
	</div>
	<?php }?>
	
	<div class="chart_wrap">
		<div id="wr-email-log" class="chart_report"></div>
	</div>
	<div class="chart_wrap">
		<div id="wr-follow" class="chart_report"></div>
	</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){

        var AheadzenReport = {
            month: '<?php echo date( 'M, Y', $timestamp ); ?>',
            options : {
                grid: {
                    show: true,
                    aboveData: false,
                    color: '#444',
                    backgroundColor: '#fff',
                    borderWidth: 2,
                    borderColor: '#ccc',
                    clickable: true,
                    hoverable: true
                },
                series: {
                    lines: {
                        show: true
                    },
                    points: {
                        show: true
                    },
                    colors: ["#a3bcd3", "#14568a"]
                },
                xaxes: [{mode: "time"},  { mode: "time",alignTicksWithAxis: 1, position: "top" }]
            },
            tooltip: function (x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y + 5,
                    left: x + 5,
                    padding: '5px 10px',
                    border: '3px solid #3da5d5',
                    background: '#288ab7',
                    color: '#fff'
                }).appendTo("body").fadeIn(200);
            },
            hover: function(event, pos, item) {
                if (item) {
                    //console.log(item);
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var y = item.datapoint[1];
						var date = new Date(item.datapoint[0]).toUTCString();
						var res = date.split(" "); 
						var year = res[3];
						var month = res[2];
						var day = res[1];
						var dtstr = day+' '+month+' '+year;
						/*
						var res = y.split("-"); 
						var res_count = res[0];
						var res_date = res[1];
						var date = res_date.toString();
						var year = date.substring(0, 4);
						var month = date.substring(4, 6);
						var day = date.substring(6, 9);
						var date_str = new Date(parseInt(year), parseInt(month)-1, parseInt(day)+1).toUTCString();
						var date_res = date_str.split(" ");
						*/
						/*var date = item.datapoint[0];
						var year = date.substring(0, 3);
						var month = date.substring(4, 2);
						var day = date.substring(6, 2);
						alert(date +' == '+day+' -- '+month+' -- '+year);
						var next_daily_date = new Date(parseInt(ddate_res[0]), parseInt(ddate_res[1])-1, parseInt(ddate_res[2])+2).toUTCString();
						 AheadzenReport.tooltip(item.pageX, item.pageY, item.series.label + ": " + y + '<br>' + (item.dataIndex+1) + ' ' + AheadzenReport.month);
						*/
                        //AheadzenReport.tooltip(item.pageX, item.pageY, item.series.label + ": " + y + '<br>' +date_res[1]+' '+date_res[2]+ ' ' + date_res[3]);
						AheadzenReport.tooltip(item.pageX, item.pageY, item.series.label + ": " + y + '<br>'+dtstr);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            },
			<?php /*?>
			postrank: {
                label: 'Post Rank',
                data: [<?php aheadzen_get_javascript_array( $postrank, 'post', 'comments' ); ?>]
            },
			<?php */?>
			user: {
                label: 'User Registration',
                data: [<?php aheadzen_get_javascript_array( $users, 'date', 'count' ); ?>]
            },
            post: {
                label: 'New Posts',
                data: [<?php aheadzen_get_javascript_array( $posts, 'date', 'count' ); ?>]
            },
            comment: {
                label: 'New Comments',
                data: [<?php aheadzen_get_javascript_array( $comments, 'date', 'count' ); ?>]
            },
			product: {
                label: 'Products',
                data: [<?php aheadzen_get_javascript_array( $woo_products, 'date', 'count' ); ?>]
            },
			order: {
                label: 'Orders',
                data: [<?php aheadzen_get_javascript_array( $shop_order, 'date', 'count' ); ?>]
            },
			bpActivity: {
                label: 'Buddypress Activity',
                data: [<?php aheadzen_get_javascript_array( $bp_activity, 'date', 'count' ); ?>]
            },
            bpActivityUpdate: {
                label: 'Buddypress Activity Update',
                data: [<?php aheadzen_get_javascript_array( $bp_activity_update, 'date', 'count' ); ?>]
            },
            bpBirthChart: {
                label: 'Buddypress Birth Chart',
                data: [<?php aheadzen_get_javascript_array( $bp_birth_chart, 'date', 'count' ); ?>]
            },
            bpForumPost: {
                label: 'Buddypress Forum Post',
                data: [<?php aheadzen_get_javascript_array( $bp_forum_post, 'date', 'count' ); ?>]
            },
            bpForumTopic: {
                label: 'Buddypress Forum Topic',
                data: [<?php aheadzen_get_javascript_array( $bp_forum_topic, 'date', 'count' ); ?>]
            },
            bpGroupJoin: {
                label: 'Buddypress Group Join',
                data: [<?php aheadzen_get_javascript_array( $bp_group_joined, 'date', 'count' ); ?>]
            },
            bpProfilePhoto: {
                label: 'Buddypress Profile Photo',
                data: [<?php aheadzen_get_javascript_array( $bp_profile_photo, 'date', 'count' ); ?>]
            },
            bpProfileUpdate: {
                label: 'Buddypress Profile Update',
                data: [<?php aheadzen_get_javascript_array( $bp_profile_update, 'date', 'count' ); ?>]
            },
            bpPhotoUpload: {
                label: 'Buddypress Album Upload',
                data: [<?php aheadzen_get_javascript_array( $bp_photo_uploaded, 'date', 'count' ); ?>]
            },
            bpMessage: {
                label: 'Buddypress Message',
                data: [<?php aheadzen_get_javascript_array( $bp_message, 'date', 'count' ); ?>]
            },
            bpFriendReq: {
                label: 'Buddypress Friend Request',
                data: [<?php aheadzen_get_javascript_array( $bp_friend_req, 'date', 'count' ); ?>]
            },
            bpNotification: {
                label: 'Buddypress Notification',
                data: [<?php aheadzen_get_javascript_array( $bp_notification, 'date', 'count' ); ?>]
            },
            loginSuccess: {
                label: 'Login Success',
                data: [<?php aheadzen_get_javascript_array( $login_success, 'date', 'count' ); ?>]
            },
            loginFail: {
                label: 'Login Fail',
                data: [<?php aheadzen_get_javascript_array( $login_fail, 'date', 'count' ); ?>]
            },
            logouts: {
                label: 'Logouts',
                data: [<?php aheadzen_get_javascript_array( $logouts, 'date', 'count' ); ?>]
            },
            passReset: {
                label: 'Password Reset',
                data: [<?php aheadzen_get_javascript_array( $pass_reset, 'date', 'count' ); ?>]
            },
            passRetrieve: {
                label: 'Password Retrieve',
                data: [<?php aheadzen_get_javascript_array( $pass_retrieve, 'date', 'count' ); ?>]
            },
            postTrash: {
                label: 'Post Trash',
                data: [<?php aheadzen_get_javascript_array( $trashed_post, 'date', 'count' ); ?>]
            },
            postUpdate: {
                label: 'Post Update',
                data: [<?php aheadzen_get_javascript_array( $post_updated, 'date', 'count' ); ?>]
            },
            postUnTrash: {
                label: 'Post Untrash',
                data: [<?php aheadzen_get_javascript_array( $untrashed_post, 'date', 'count' ); ?>]
            },
            postDel: {
                label: 'Post Deleted',
                data: [<?php aheadzen_get_javascript_array( $deleted_post, 'date', 'count' ); ?>]
            },
            commentTrash: {
                label: 'Comment Trash',
                data: [<?php aheadzen_get_javascript_array( $comment_trash, 'date', 'count' ); ?>]
            },
            commentSpam: {
                label: 'Comment Spam',
                data: [<?php aheadzen_get_javascript_array( $comment_spam, 'date', 'count' ); ?>]
            },
            commentApprove: {
                label: 'Comment Approve',
                data: [<?php aheadzen_get_javascript_array( $comment_approve, 'date', 'count' ); ?>]
            },
            userDel: {
                label: 'User Delete',
                data: [<?php aheadzen_get_javascript_array( $delete_user, 'date', 'count' ); ?>]
            },
            upVote: {
                label: 'Up Vote',
                data: [<?php aheadzen_get_javascript_array( $vote_up, 'date', 'count' ); ?>]
            },
            downVote: {
                label: 'Down Vote',
                data: [<?php aheadzen_get_javascript_array( $vote_down, 'date', 'count' ); ?>]
            },
			emailLog: {
                label: 'Email Log',
                data: [<?php aheadzen_get_javascript_array( $email_log, 'date', 'count' ); ?>]
            },
			follow: {
                label: 'Following',
                data: [<?php aheadzen_get_javascript_array( $follow, 'date', 'count' ); ?>]
            },

            gift: {
                label: 'Gifts',
                data: [<?php aheadzen_get_javascript_array( $gifts, 'date', 'count' ); ?>]
            }
			<?php global $wp_cmp_data;
			if($wp_cmp_data){
			echo ',';
			?>
			userPast: {
                label: 'Past User Registration',
                data: [<?php aheadzen_get_javascript_array( $users_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            postPast: {
                label: 'New Past Posts',
                data: [<?php aheadzen_get_javascript_array( $posts_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            commentPast: {
                label: 'New Past Comments',
                data: [<?php aheadzen_get_javascript_array( $comments_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
			productPast: {
                label: 'Past Products',
                data: [<?php aheadzen_get_javascript_array( $woo_products_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
			orderPast: {
                label: 'Past Orders',
                data: [<?php aheadzen_get_javascript_array( $shop_order_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
			bpActivityPast: {
                label: 'Buddypress Past Activity',
                data: [<?php aheadzen_get_javascript_array( $bp_activity_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpActivityUpdatePast: {
                label: 'Buddypress Past Activity Update',
                data: [<?php aheadzen_get_javascript_array( $bp_activity_update_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpBirthChartPast: {
                label: 'Buddypress Past Birth Chart',
                data: [<?php aheadzen_get_javascript_array( $bp_birth_chart_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpForumPostPast: {
                label: 'Buddypress Past Forum Post',
                data: [<?php aheadzen_get_javascript_array( $bp_forum_post_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpForumTopicPast: {
                label: 'Buddypress Past Forum Topic',
                data: [<?php aheadzen_get_javascript_array( $bp_forum_topic_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpGroupJoinPast: {
                label: 'Buddypress Past Group Join',
                data: [<?php aheadzen_get_javascript_array( $bp_group_joined_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpProfilePhotoPast: {
                label: 'Buddypress Past Profile Photo',
                data: [<?php aheadzen_get_javascript_array( $bp_profile_photo_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpProfileUpdatePast: {
                label: 'Buddypress Past Profile Update',
                data: [<?php aheadzen_get_javascript_array( $bp_profile_update_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpPhotoUploadPast: {
                label: 'Buddypress Past Album Upload',
                data: [<?php aheadzen_get_javascript_array( $bp_photo_uploaded_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpMessagePast: {
                label: 'Buddypress Past Message',
                data: [<?php aheadzen_get_javascript_array( $bp_message_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpFriendReqPast: {
                label: 'Buddypress Past Friend Request',
                data: [<?php aheadzen_get_javascript_array( $bp_friend_req_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            bpNotificationPast: {
                label: 'Buddypress Past Notification',
                data: [<?php aheadzen_get_javascript_array( $bp_notification_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            loginSuccessPast: {
                label: 'Past Login Success',
                data: [<?php aheadzen_get_javascript_array( $login_success_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            loginFailPast: {
                label: 'Login Past Fail',
                data: [<?php aheadzen_get_javascript_array( $login_fail_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            logoutsPast: {
                label: 'Past Logouts',
                data: [<?php aheadzen_get_javascript_array( $logouts_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            passResetPast: {
                label: 'Past Password Reset',
                data: [<?php aheadzen_get_javascript_array( $pass_reset_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            passRetrievePast: {
                label: 'Past Password Retrieve',
                data: [<?php aheadzen_get_javascript_array( $pass_retrieve_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            postTrashPast: {
                label: 'Past Post Trash',
                data: [<?php aheadzen_get_javascript_array( $trashed_post_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            postUpdatePast: {
                label: 'Past Post Update',
                data: [<?php aheadzen_get_javascript_array( $post_updated_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            postUnTrashPast: {
                label: 'Past Post Untrash',
                data: [<?php aheadzen_get_javascript_array( $untrashed_post_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            postDelPast: {
                label: 'Past Post Deleted',
                data: [<?php aheadzen_get_javascript_array( $deleted_post_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            commentTrashPast: {
                label: 'Past Comment Trash',
                data: [<?php aheadzen_get_javascript_array( $comment_trash_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            commentSpamPast: {
                label: 'Past Comment Spam',
                data: [<?php aheadzen_get_javascript_array( $comment_spam_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            commentApprovePast: {
                label: 'Past Comment Approve',
                data: [<?php aheadzen_get_javascript_array( $comment_approve_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            userDelPast: {
                label: 'Past User Delete',
                data: [<?php aheadzen_get_javascript_array( $delete_user_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            upVotePast: {
                label: 'Past Up Vote',
                data: [<?php aheadzen_get_javascript_array( $vote_up_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            downVotePast: {
                label: 'Past Down Vote',
                data: [<?php aheadzen_get_javascript_array( $vote_down_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
			emailLogPast: {
                label: 'Past Email Log',
                data: [<?php aheadzen_get_javascript_array( $email_log_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
			followPast: {
                label: 'Past Following',
                data: [<?php aheadzen_get_javascript_array( $follow_past, 'date', 'count' ); ?>],
				xaxis : 2
            },
            giftPast: {
                label: 'Past Gifts',
                data: [<?php aheadzen_get_javascript_array( $gifts_past, 'date', 'count' ); ?>],
				xaxis : 2
				
            }
			<?php }?>
        }

        console.log(AheadzenReport);
<?php global $wp_cmp_data;?>
       <?php /* ?> $.plot($("#wr-post-rank"), [AheadzenReport.postrank<?php if($wp_cmp_data){echo ',AheadzenReport.postrankPast';}?>], AheadzenReport.options);<?php */?>
		$.plot($("#wr-user-reg"), [AheadzenReport.user<?php if($wp_cmp_data){echo ',AheadzenReport.userPast';}?>], AheadzenReport.options);
        $.plot($("#wr-new-posts"), [AheadzenReport.post<?php if($wp_cmp_data){echo ',AheadzenReport.postPast';}?>], AheadzenReport.options);
        $.plot($("#wr-new-comments"), [AheadzenReport.comment<?php if($wp_cmp_data){echo ',AheadzenReport.commentPast';}?>], AheadzenReport.options);
		<?php global $woocommerce;
		if($woocommerce){
		?>
		$.plot($("#wr-woo-products"), [AheadzenReport.product<?php if($wp_cmp_data){echo ',AheadzenReport.productPast';}?>], AheadzenReport.options);
		$.plot($("#wr-woo-orders"), [AheadzenReport.order<?php if($wp_cmp_data){echo ',AheadzenReport.orderPast';}?>], AheadzenReport.options);
		<?php }?>
		
		<?php
		global $bp, $forum_id;
		if($bp){
		?>
        $.plot($("#wr-bp-activity"), [AheadzenReport.bpActivity<?php if($wp_cmp_data){echo ',AheadzenReport.bpActivityPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-updates"), [AheadzenReport.bpActivityUpdate<?php if($wp_cmp_data){echo ',AheadzenReport.bpActivityUpdatePast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-birth-chart"), [AheadzenReport.bpBirthChart<?php if($wp_cmp_data){echo ',AheadzenReport.bpBirthChartPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-forum-post"), [AheadzenReport.bpForumPost<?php if($wp_cmp_data){echo ',AheadzenReport.bpForumPostPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-forum-topic"), [AheadzenReport.bpForumTopic<?php if($wp_cmp_data){echo ',AheadzenReport.bpForumTopicPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-group-joined"), [AheadzenReport.bpGroupJoin<?php if($wp_cmp_data){echo ',AheadzenReport.bpGroupJoinPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-profile-photo"), [AheadzenReport.bpProfilePhoto<?php if($wp_cmp_data){echo ',AheadzenReport.bpProfilePhotoPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-profile-update"), [AheadzenReport.bpProfileUpdate<?php if($wp_cmp_data){echo ',AheadzenReport.bpProfileUpdatePast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-photo-upload"), [AheadzenReport.bpPhotoUpload<?php if($wp_cmp_data){echo ',AheadzenReport.bpPhotoUploadPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-message"), [AheadzenReport.bpMessage<?php if($wp_cmp_data){echo ',AheadzenReport.bpMessagePast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-friend-req"), [AheadzenReport.bpFriendReq<?php if($wp_cmp_data){echo ',AheadzenReport.bpFriendReqPast';}?>], AheadzenReport.options);
        $.plot($("#wr-bp-notification"), [AheadzenReport.bpNotification<?php if($wp_cmp_data){echo ',AheadzenReport.bpNotificationPast';}?>], AheadzenReport.options);
		$.plot($("#wr-gift"), [AheadzenReport.gift<?php if($wp_cmp_data){echo ',AheadzenReport.giftPast';}?>], AheadzenReport.options);
		<?php }?>
		
        $.plot($("#wr-login"), [AheadzenReport.loginSuccess, AheadzenReport.loginFail<?php if($wp_cmp_data){echo ',AheadzenReport.loginSuccessPast,AheadzenReport.loginFailPast';}?>], AheadzenReport.options);
        $.plot($("#wr-logout"), [AheadzenReport.logouts<?php if($wp_cmp_data){echo ',AheadzenReport.logoutsPast';}?>], AheadzenReport.options);
        $.plot($("#wr-pass"), [AheadzenReport.passReset, AheadzenReport.passRetrieve<?php if($wp_cmp_data){echo ',AheadzenReport.passResetPast,AheadzenReport.passRetrievePast';}?>], AheadzenReport.options);
        $.plot($("#wr-post-trash"), [AheadzenReport.postDel, AheadzenReport.postTrash, AheadzenReport.postUnTrash, AheadzenReport.postUpdate], AheadzenReport.options);
        $.plot($("#wr-comment"), [AheadzenReport.commentApprove, AheadzenReport.commentSpam, AheadzenReport.commentTrash], AheadzenReport.options);
        $.plot($("#wr-del-user"), [AheadzenReport.userDel<?php if($wp_cmp_data){echo ',AheadzenReport.userDelPast';}?>], AheadzenReport.options);
		
		$.plot($("#wr-del-user"), [AheadzenReport.userDel<?php if($wp_cmp_data){echo ',AheadzenReport.userDelPast';}?>], AheadzenReport.options);
		
		<?php
		global $aheadzen_voter_plugin_version;
		if($aheadzen_voter_plugin_version)
		{?>
        $.plot($("#wr-vote"), [AheadzenReport.upVote, AheadzenReport.downVote<?php if($wp_cmp_data){echo ',AheadzenReport.upVotePast,AheadzenReport.downVotePast';}?>], AheadzenReport.options);
		<?php }?>
		
		$.plot($("#wr-email-log"), [AheadzenReport.emailLog<?php if($wp_cmp_data){echo ',AheadzenReport.emailLogPast';}?>], AheadzenReport.options);
		$.plot($("#wr-follow"), [AheadzenReport.follow<?php if($wp_cmp_data){echo ',AheadzenReport.followPast';}?>], AheadzenReport.options);
		
        $("#wr-user-reg").bind("plothover", AheadzenReport.hover);
        $("#wr-new-posts").bind("plothover", AheadzenReport.hover);
        $("#wr-new-comments").bind("plothover", AheadzenReport.hover);
		$("#wr-woo-products").bind("plothover", AheadzenReport.hover);
		$("#wr-woo-orders").bind("plothover", AheadzenReport.hover);
		
        $("#wr-bp-activity").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-birth-chart").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-forum-post").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-forum-topic").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-group-joined").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-profile-photo").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-profile-update").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-photo-upload").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-message").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-friend-req").bind("plothover", AheadzenReport.hover);
        $("#wr-bp-notification").bind("plothover", AheadzenReport.hover);

        $("#wr-login").bind("plothover", AheadzenReport.hover);
        $("#wr-logout").bind("plothover", AheadzenReport.hover);
        $("#wr-pass").bind("plothover", AheadzenReport.hover);
        $("#wr-post-trash").bind("plothover", AheadzenReport.hover);
        $("#wr-comment").bind("plothover", AheadzenReport.hover);
        $("#wr-del-user").bind("plothover", AheadzenReport.hover);
        $("#wr-vote").bind("plothover", AheadzenReport.hover);
		$("#wr-email-log").bind("plothover", AheadzenReport.hover);
		$("#wr-follow").bind("plothover", AheadzenReport.hover);
        $("#wr-gift").bind("plothover", AheadzenReport.hover);
    });
</script>

<style>
    .legendLabel {
        font-size: 12px;
        font-weight: bold;
        color: #CC3535;
    }
    #wr-menu li{ display: inline-block;}
    #wr-menu a { text-decoration: none; background: #eee; padding: 2px 5px; border-radius: 5px; }
</style>