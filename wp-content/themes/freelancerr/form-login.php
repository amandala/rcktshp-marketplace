<div class="large-10 push-1 columns">
	<div class="auth-div centered" id="login-form">
		<h5>Login to your account</h5>

			<?php require 'rcktshp-login.php'; ?>
			<?php //require APP_FRAMEWORK_DIR . '/templates/form-login.php'; ?>

	</div>

	<div class="auth-div white" id="forgot">
		<div class="forgot-link">
			<a href="<?php echo appthemes_get_password_recovery_url(); ?>"><?php _e( 'Forgot password?', APP_TD ); ?></a>
		</div>
		<div class="forgot-link" id="cta-register">
			<span>Don't have an account? </span><a href="<?php echo site_url(); ?>/register" >Register</a>
		</div>
	</div>

	<?php //wp_register( '<div class="form-field" id="register">', '</div>' ); ?>

</div>




