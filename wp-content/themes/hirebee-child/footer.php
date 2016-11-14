<?php
	// footer can be setup to a maximum of 3 columns

	$sidebars = (int) is_active_sidebar('hrb-footer') + (int) is_active_sidebar('hrb-footer2') + (int) is_active_sidebar('hrb-footer3');

	if ( ! $sidebars ) { $sidebars = 1;	}

	$columns = 12 / $sidebars;
?>

<!-- Footer Widgets -->
<div id="footer">
	<div class="row widgets-footer">
		<div class="large-12 columns wrap">

			<div id="footer-widget1" class="f-widget <?php echo "large-{$columns}"; ?> columns">
				<?php dynamic_sidebar('hrb-footer'); ?>
			</div>

			<?php if ( is_active_sidebar('hrb-footer2') ) : ?>
				<div id="footer-widget2" class="f-widget <?php echo "large-{$columns}"; ?> columns">
					<?php dynamic_sidebar('hrb-footer2'); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar('hrb-footer3') ) : ?>
				<div id="footer-widget3" class="f-widget <?php echo "large-{$columns}"; ?> columns">
					<?php dynamic_sidebar('hrb-footer3'); ?>
				</div>
			<?php endif; ?>


		</div>
	</div>

	<!-- End footer Widgets -->

	<!-- Footer -->
	<footer class="row footer">
		<div class="large-12 columns">

			<div id="theme-info" class="footer-info large-7 columns">
				<div class="footer-credits">&copy; 2015 RCKTSHP</div>
			</div>


			<!-- Javascript for GOogle Analytics -->

			<script>

 				 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  				 ga('create', 'UA-52809046-3', 'auto');
 				   ga('send', 'pageview');

			</script>

		</div>
	</footer>
	<?php
	wp_enqueue_script('jquery-ui-datepicker');
	//wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');


	?>

	<?php wp_footer(); ?>

</div><!-- end #footer -->
