<?php
/**
 * Template Name: Projects & Freelancers Listings
 */
?>
<div id="main" class="large-6 push-1 columns">
    <?php

// display custom page content in home page

if (get_option('enable_contents') == 'true'):
	$import_page = get_page_by_title(get_option('home_page_import'));
	echo'
    <div class="homess article page">';
	echo apply_filters('the_content', $import_page->post_content);
	echo'</div>';
endif;?>
    <div class="clear"></div>
    <?php if (get_option('adv_home_banner')=='Yes') : ?>
    <!-- /* home banner spot-->
    <div class="home-banner">
        <div id="banner-s" style="float:
            <?php echo stripslashes(get_option('ad_home_float'))  ?> !important; overflow: hidden;">
            <?php echo stripslashes(get_option('home_banner')); ?>
        </div>
    </div>
    <!-- /* end of home spot-->
    <?php endif; ?>
    <?php do_action( 'hrb_front_loops' ); ?>
</div>
<!-- end #main -->
<div id="sidebar" class="large-4 pull-1 columns">
    <div class="sidebar-widget-wrap cf">
        <?php get_sidebar( app_template_base() ); ?>
    </div>
    <!-- end .sidebar-widget-wrap -->
</div>
<!-- end #sidebar -->
<?php

//switch the layout of the home page
//Since version 1.1
//get_template_part("nw-home");	
 
?>