<?php
if (!function_exists('jobthemes_admin_head')) {

    function jobthemes_admin_head() {
        ?>
        <link href='//fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>css/jobthemes_css.css" />
        <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>css/colorpicker.css" />
        <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>css/custom_style.css" />

        <script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>js/colorpicker.js"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>js/ajaxupload.js"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>js/mainJs.js"></script> 
		<script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory')."/admin/"; ?>js/layout.js"></script> 
        <?php
    }

}
?>