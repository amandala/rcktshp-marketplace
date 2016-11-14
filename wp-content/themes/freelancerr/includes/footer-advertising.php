	
<?php /*if home page*/ if ( is_front_page() ) { ?>
<?php if (get_option('adv_footer')=='Home page only') : ?>
<div class="footer-as">
    <div id="footer-a"  style="float:
        <?php echo stripslashes(get_option('ad_footer_float'))  ?> ;width:<?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important ; overflow: hidden;">
        <?php echo stripslashes(get_option('ad_footer-spot')); ?>
    </div>
</div>
<?php endif; ?>
<?php if (get_option('adv_footer')=='Entire site') : ?>
<div class="footer-as">
    <div id="footer-a"  style="float:
        <?php echo stripslashes(get_option('ad_footer_float'))  ?> ;width: <?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important ; overflow: hidden;">
        <?php echo stripslashes(get_option('ad_footer-spot')); ?>
    </div>
</div>
<?php endif; ?>
<?php  /*if not home page*/ } else { ?>
<?php if (get_option('adv_footer')=='Entire site') : ?>
<div class="footer-as">
    <div id="footer-a"  style="float:
        <?php echo stripslashes(get_option('ad_footer_float'))  ?> ;width: <?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important ; overflow: hidden;">
        <?php echo stripslashes(get_option('ad_footer-spot')); ?>
    </div>
</div>
<?php endif; ?>
<?php if (get_option('adv_footer')=='Inner pages only') : ?>
<div class="footer-as">
    <div id="footer-a"  style="float:
        <?php echo stripslashes(get_option('ad_footer_float'))  ?> ;width:  <?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important ; overflow: hidden;">
        <?php echo stripslashes(get_option('ad_footer-spot')); ?>
    </div>
</div>
<?php endif; ?>
<?php } ?>