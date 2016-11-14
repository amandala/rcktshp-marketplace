<?php
/**
 * Template Name: Transfer Funds
 */
?>

<div id="main-wrapper">
	<div class="large-10 push-1 columns">
		<div id="main" class="large-8 columns order-checkout transfer-funds">
			<div class="form-wrapper">
				<?php appthemes_display_checkout(); ?>
			</div>
		</div>

		<div id="sidebar-how-to" class="large-4 columns add-margin">

			<div class="sidebar-widget-wrap cf">
				<!-- dynamic sidebar -->
				<?php dynamic_sidebar('hrb-transfer-funds'); ?>
			</div><!-- end .sidebar-widget-wrap -->

		</div><!-- end #sidebar -->
	</div>

</div>
