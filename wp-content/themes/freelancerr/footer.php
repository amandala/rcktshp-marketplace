

<div id="backtotop">
    <a href="#"></a>
</div>
<script>
jQuery(document).ready(function(){
		var pxShow = 300;//height on which the button will show
		var fadeInTime = 1000;//how slow/fast you want the button to show
		var fadeOutTime = 1000;//how slow/fast you want the button to hide
		var scrollSpeed = 1000;//how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'
		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() >= pxShow){
				jQuery("#backtotop").fadeIn(fadeInTime);
			}else{
				jQuery("#backtotop").fadeOut(fadeOutTime);
			}
		});

		jQuery('#backtotop a').click(function(){
			jQuery('html, body').animate({scrollTop:0}, scrollSpeed);
			return false;
		});
	});</script>
<?php
	// footer can be setup to a maximum of 3 columns

	$sidebars = (int) is_active_sidebar('hrb-footer') + (int) is_active_sidebar('hrb-footer2') + (int) is_active_sidebar('hrb-footer3');

	if ( ! $sidebars ) { $sidebars = 1;	}

	$columns = 12 / $sidebars;
?>

<div id="footer-anchor"></div>
    <!-- BEGIN: Sticky Footer -->
<div id="footer">
    <div class="footer-content">
        <div class='large-10 push-1 small-12 columns footer-nav'>
            <div class="large-3 small-12 columns">
              <div id="footer-border">
                  <h4 class='footer-headings'>Hire a Freelancer</h4>
                  <ul class="footer-list">
                      <li><a class="footer-link" href="<?php echo site_url() ?>/website-packages/">Get a Website</a></li>
                      <li><a class="footer-link" href="<?php echo site_url() ?>/social-media-packages/">Get Social Media</a></li>
                      <li><a class="footer-link" href="<?php echo site_url() ?>/post-a-project">Post a Custom Project</a></li>
                      <li><a class="footer-link" href="<?php echo site_url() ?>/freelancers">Browse our Freelancers</a></li>
                  </ul>
              </div>
            </div>
            <div class="large-3 small-12 columns pad">
                <h4 class='footer-headings'>SMALL BUSINESS RESOURCES</h4>
                <ul class="footer-list">
                    <li><a class="footer-link" href="<?php echo site_url() ?>/ebook-social-media/">The Complete Guide to Social Media</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/ebook-websites/">The Complete Guide to Websites</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/tutorials/">Articles & Tips</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/series/wordpress">Wordpress Tutorials</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/series/search-engines/">Search Engine Tutorials</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/series/email-newsletters">Email Marketing Tutorials</a></li>
                    <li><a class="footer-link" href="<?php echo site_url() ?>/resource-index">Resources Page</a></li>
                </ul>

            </div>
            <div class="large-3 small-12 columns pad">
              <h4 class='footer-headings'>FREELANCER RESOURCES</h4>
              <ul class="footer-list">
                  <li><a class="footer-link" href="<?php echo site_url() ?>/projects">Find Work</a></li>
                  <li><a class="footer-link" href="<?php echo site_url() ?>/freelancer-register">Freelancer Sign Up</a></li>

              </ul>
            </div>
            <div class="large-3  small-12 columns pad">
                 <h4 class='footer-headings'>HAVE A QUESTION?</h4>
                 <ul class="footer-list">
                     <li><a class="footer-link" href="<?php echo site_url() ?>/faq/">FAQ</a> </li>
                     <li><a class="footer-link" href="<?php echo site_url() ?>/how-it-works/">How it Works</a></li>
                     <li><a class="footer-link" href="<?php echo site_url() ?>/contact/">Contact Us</a></li>
                     <li><a class="footer-link" href="<?php echo site_url() ?>/terms/">Site Terms</a></li>
                     <li><a class="footer-link" href="<?php echo site_url() ?>/about-us/">About Us</a></li>
                     <li><a class="footer-link" href="<?php echo site_url() ?>/portfolio/">Case Studies</a></li>
                 </ul>
            </div>
        </div>
    </div>
    <div class="large-12 small-12 columns" id="footer-social">
        <div class="large-10 push-1 columns">
            <a href="https://www.facebook.com/rcktshp/" target="_blank"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/social/icon-facebook.png"></a>
            <a href="https://www.linkedin.com/company/rcktshp" target="_blank"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/social/icon-linkedin.png"></a>
            <a href="https://twitter.com/RCKTSHP" target="_blank"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/social/icon-twitter.png"></a>
            <a href="https://plus.google.com/+Rcktshp" target="_blank"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/social/icon-google.png"></a>
            <a href="http://localhost:8888/rcktshp-marketplace/index.php?feed=rss2" target="_blank"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/social/icon-rss.png"></a>
        </div>
    </div>

</div>
    <!-- END: Sticky Footer -->

<!-- Footer -->
<footer>

    <?php if($_SERVER['HTTP_HOST'] === 'www.rcktshp.com' ) {
    echo "<!-- Javascript for GOogle Analytics -->";
      echo "  <script>
             (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

             ga('create', 'UA-52809046-3', 'auto');
             ga('send', 'pageview');

        </script> ";
   }?>
    <script>
        //sticky side bar (Thanks Will Fowler!)
        jQuery(window).scroll(function () {
            if(jQuery('#sidebar-archive-tutorials').length >0 ){
                var window_top = jQuery(window).scrollTop();
                var div_top = jQuery('#sticky-anchor').offset().top;
                var footerToTopHeight = jQuery('#footer').offset().top;
                var containerHeight = jQuery('#sticky-container').outerHeight();
                var viewportWidth = jQuery(window).width();
                if (window_top >= div_top) {

                    if (footerToTopHeight - window_top <= containerHeight && viewportWidth > 770) {
                        jQuery('#sticky-container').removeClass('stick');
                        jQuery('#sticky-container').addClass('stickbottom');
                    }
                    else {
                        if( ! navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0){
                            console.log(viewportWidth);
                        }
                        else{
                            jQuery('#sticky-container').removeClass('stickbottom');
                            jQuery('#sticky-container').addClass('stick');
                        }
                    }
                }
                else {
                    jQuery('#sticky-container').removeClass('stick');
                    jQuery('#sticky-container').removeClass('stickbottom');
                }

            }
        });


    </script>

</footer>
    <?php
        wp_enqueue_script('jquery-ui-datepicker');
        get_template_part( 'includes/ft', 'st' ); ?>

    <?php wp_footer(); ?>

</div>
<!-- end #footer -->
