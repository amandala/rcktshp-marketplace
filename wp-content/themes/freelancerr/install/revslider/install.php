<?php
  
class revsliderInstall {

    static function isRevSliderInstalled(){
        require_once ABSPATH . 'wp-admin/includes/plugin.php' ;
        return is_plugin_active('revslider/revslider.php');
    }

    static function emptySliders(){
        if( ! revsliderInstall::isRevSliderInstalled() ){
            return;
        }

        global $wpdb;
        $prefix = $wpdb->prefix;

        $SQL = "TRUNCATE ".$prefix."revslider_sliders";
        @mysql_query( $SQL );
        
        $SQL = "TRUNCATE ".$prefix."revslider_slides";
        @mysql_query( $SQL );
    }

    static function addDefaultSliders(){
        if( ! revsliderInstall::isRevSliderInstalled() ){
            return;
        }

        global $wpdb;
        // Adding slides
        $prefix = $wpdb->prefix;

        // SLIDERS empty ?
        $sql = "SELECT COUNT(`id`) AS cnt FROM ".$prefix."revslider_sliders";
        if( false == ( $result = @mysql_query( $sql ) )) return;
        $row = mysql_fetch_array( $result );
        if( 0 != 1 * $row['cnt'] ) return;

        // SLIDES empty ?
        $sql = "SELECT COUNT(`id`) AS cnt FROM ".$prefix."revslider_slides";
        if( false == ( $result = @mysql_query( $sql ) )) return;
        $row = mysql_fetch_array( $result );
        if( 0 != 1 * $row['cnt'] ) return;

        $f = file( dirname(__FILE__).'/revslider.frs' );

        $sqlF = array();
        foreach ($f as $value) {
            $value = trim($value);
            if( '/' == substr($value, 0, 1) ) continue;
            if( empty($value) ) continue;

           // $tdu = get_template_directory_uri();
			$tdu = get_stylesheet_directory_uri();
            $tdu = str_replace("/","\\\\/",$tdu);

            $value = str_replace("%%%THEME-URL%%%", $tdu, $value);

            $value = str_replace("INSERT IGNORE INTO `wp_revslider_sliders` ", "INSERT IGNORE INTO `".$prefix."revslider_sliders`", $value);
            $value = str_replace("INSERT IGNORE INTO `wp_revslider_slides` ", "INSERT IGNORE INTO `".$prefix."revslider_slides`", $value);

            $sqlF[] = $value;
        }

        foreach ($sqlF as $sql) {
            mysql_query( $sql );
        }
        get_option('basicinstall', 'revslider_data', 'installed' );
        
    }

}