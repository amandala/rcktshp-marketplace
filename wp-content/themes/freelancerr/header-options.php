
<style>



	body {
    <?php if( !get_option('background_color') ) {} else {?>
	background-color: #<?php echo get_option('background_color')?> !important;
	background-image: none !important;
	
    <?php }?>
    <?php if( !get_option('background_image') ) {} else {?>
	background: url("<?php echo get_option('background_image')?>") <?php echo get_option('background_repeat')?>  !important;
	
    <?php }?>
    <?php if( !get_option('background_attach') ) {} else { ?>
	background-attachment: <?php echo get_option('background_attach')?> !important;
	
    <?php }?>	
	
	
	     }
		 
		 
		 
	<?php if( !get_option('color_featured_a') ) {} else { ?>
	.banner .budget-deadline .project-budget { background-color: #<?php echo get_option('color_featured_a')?> ;}
    <?php }?>
		 
		 
		 
		 	<?php if( !get_option('color_featured_b') ) {} else { ?>
	.banner .smally, .banner .budget-deadline .project-budget .budget-type { background-color: #<?php echo get_option('color_featured_b')?> ;}
    <?php }?>
		 
		 
		 
	  <?php  if (get_option('enable_slider') =='Enable') {} else { 	 ?>
	  .nw-header, .header-buttons {display: none;}
	<?php }?>
	 
    <?php if( !get_option('footer_font_color') ) {} else { ?>
	#footer-widget ul li a, #footer a { color: #<?php echo get_option('footer_font_color')?> ;}
	
    <?php }?>
    <?php if( !get_option('footer_font_color_hover') ) {} else {?>
	#footer-widget ul li a:hover, #footer a:hover { color: #<?php echo get_option('footer_font_color_hover')?> ;}
	
    <?php }?>
    <?php if (get_option('override_patern')=='Yes') : ?>
	 body {background: url(
    <?php bloginfo('stylesheet_directory'); ?>/img/<?php echo get_option('paterns')?>.png) repeat !important;}
	
    <?php endif; ?>
    <?php if ( !get_option('top_header_color')) {} else {?>
				.top-navigation , .top-navigation .top-bar , .primario { background-color: #<?php echo get_option('top_header_color')?> !important}
			

    <?php }?>
    <?php if ( !get_option('header_color')) {} else {?>
				.nw-header{ background-color: #<?php echo get_option('header_color')?> !important}
			

    <?php }?>
    <?php if ( !get_option('header_background_image')) {} else {?>
				.nw-header{ background-image: url('<?php echo get_option('header_background_image')?>') !important; background-repeat: no-repeat !important}
			

    <?php }?>
    <?php if (get_option('enable_menu') =='Hide') { ?>
		.nw-header { border-bottom: 3px solid #333}

    <?php } ?>
    <?php if ( !get_option('footer_background_color')) {} else {?>
				#footer { background-color: #<?php echo get_option('footer_background_color')?> !important}
			

    <?php }?>
    <?php if ( !get_option('bottom_footer_color')) {} else {?>
				.footer-extra { background-color: #<?php echo get_option('bottom_footer_color')?> !important}
			

    <?php }?>
    <?php if ( !get_option('footer_border_color')) {} else {?>
				.footer-extra  { border-color: #<?php echo get_option('footer_border_color')?> !important}
			

    <?php }?>
    <?php if ( !get_option('footer_background_image')) {} else {?>
				#footer { background-image: url('<?php echo get_option('footer_background_image')?>') !important}
			

    <?php }?>
    <?php if( !get_option('color_link') ) {} else {?>
	body a {color: #<?php echo get_option('color_link')?>}

    <?php }?>
    <?php if( !get_option('color_hover') ) {} else {?>
	body a:hover{color: #<?php echo get_option('color_hover')?>}

    <?php }?>
    <?php if( !get_option('menu_font_color') ) {} else {?>
	.top-head #topNav li a, .top-head .primario .left li a , .nw-right li a, .nw-right li a:not(.button), .nw-left li a, .nw-left li a:not(.button) {color: #<?php echo get_option('menu_font_color')?> !important}

    <?php }?>
    <?php if( !get_option('menu_font_color_hover') ) {} else {?>
	.top-head #topNav li a:hover, .top-head .primario .left li a:hover , .nw-right li a:hover, .nw-right li a:not(.button):hover, .nw-left li a:hover, .nw-left li a:not(.button):hover {color: #<?php echo get_option('menu_font_color_hover')?> !important}

    <?php }?>
    <?php if( !get_option('footer_font_color') ) {} else {?>
	#footer ul li a, #footer , #footer p , #footer  a {color: #<?php echo get_option('footer_font_color')?> }
	.widget_create_project_button .button { color: #fff !important}
	

    <?php }?>
    <?php if( !get_option('footer_font_color_hover') ) {} else {?>
	#footer ul li a:hover, #footer a:hover {color: #<?php echo get_option('footer_font_color_hover')?> }

    <?php }?>
    <?php if( !get_option('heading_footer_font') ) {} else {?>
	#footer .section-head h3 {color: #<?php echo get_option('heading_footer_font')?>}

    <?php }?>
    <?php if( !get_option('background_featured') ) {} else {?>
	#projects .featured .project-meta,#projects .featured .project-description, #projects .featured .project-author-meta ,#projects .featured .project-cat a,#projects .featured .project-meta-below-desc { background: #<?php echo get_option('background_featured')?>;}
	#projects .featured  div , #projects .featured span {border-color: #<?php echo get_option('background_featured')?> }
	#projects .featured > .project-meta-below-desc { border-color: #fff !important;}
	
    <?php }?>
    <?php if( !get_option('background_featured_top') ) {} else {?>
	#projects .featured > h2,#projects .featured > h2:hover { background: #<?php echo get_option('background_featured_top')?>;}

    <?php }?>
    <?php
	if (get_option('layout_type') == 'Boxed'): ?>
	
	.layouty {
    border: 1px solid #ddd;
    border-radius: 3px !important;-moz-border-radius: 3px !important;-webkit-border-radius: 3px !important;
	width: 72.4em;
	margin: 15px auto 15px;
	overflow: hidden;
  	}
	@media screen and (max-width: 1170px) {
     .layouty { width: 100% !important;}
}
	
	.full-width > .row {border: none !important;}

    <?php	endif; ?>
    <?php if( !get_option(custom_css ) ) {} else { echo stripslashes(get_option('custom_css')); }	?>
</style>