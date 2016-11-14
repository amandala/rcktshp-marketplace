

	<div class="row register">
		<div class="large-10 push-1 columns columns">
			<div class="large-8 columns ">

			<?php if ( get_option('users_can_register') ) : ?>

				<?php appthemes_load_template('form-registration-main.php'); ?>

			<?php else: ?>

				<h3><?php _e( 'User registration has been disabled.', APP_TD ); ?></h3>

			<?php endif; ?>
			</div>
			<div class="large-4 columns sidebar-howto">
				<div class="package-form-sidebar" id="help-sidebar-main">
					<p class="bold">Need help? <span>Send us a note at <a href="mailto:help@rctkshp.com?subject=Need help posting a project">help@rcktshp.com</a> and we'll help get you back on track.</span></p>
				</div>
			</div>
		</div>

	</div>




