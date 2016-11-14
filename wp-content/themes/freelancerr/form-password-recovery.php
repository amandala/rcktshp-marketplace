<div id="main-wrapper">
	<div id="main" class="large-8 columns">

		<div class="row form-wrapper recover-password">
			<div class="large-12 columns">

				<div class="section-head">
					<h3><?php _e( 'Password Recovery', APP_TD ); ?></h3>
				</div>

				<?php require APP_THEME_FRAMEWORK_DIR . '/templates/form-password-recovery.php'; ?>

			</div>
		</div>

	</div>

	<div id="sidebar" class="large-4 columns">

		<div class="sidebar-widget-wrap cf">
			<?php get_sidebar( app_template_base() ); ?>
		</div><!-- end .sidebar-widget-wrap -->

	</div>
</div>