


<div class="row auth-div " id="reg-form-wrapper">
	<div class="registration-form">

		<form action="<?php echo appthemes_get_registration_url( 'login_post' ); ?>" method="post" class="login-form register-form custom" name="registerform" id="login-form">
			<h3><?php _e( 'Please complete the fields below to register:', APP_TD ); ?></h3>
			<fieldset>
				<div class="row">
					<div class="large-6 columns form-field">
						<label><?php _e( 'Username:', APP_TD ); ?></label>
						<input tabindex="1" type="text" class="text required" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" />
					</div>
					<div class="large-6 columns form-field">
						<label><?php _e( 'Email:', APP_TD ); ?></label>
						<input tabindex="2" type="text" class="text required email" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" />
					</div>
				</div>

				<div class="row">
					<div class="large-6 columns form-field">
						<label><?php _e( 'Password:', APP_TD ); ?></label>
						<input tabindex="3" type="password" class="text required" name="pass1" id="pass1" value="" autocomplete="off" />
					</div>

					<div class="large-6 columns form-field">
						<label><?php _e( 'Password Again:', APP_TD ); ?></label>
						<input tabindex="4" type="password" class="text required" name="pass2" id="pass2" value="" autocomplete="off" />
					</div>
				</div>

				<div class="" >
					<h3><?php echo __( 'Are you a Small Business or Freelancer?', APP_TD ); ?></h3>


					<div class="row">
						<div class="large-4 small-12 columns form-field user-role-type">

							<select name="role">
								<option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Small Business', APP_TD ); ?></option>
								<option value="<?php echo esc_attr( HRB_ROLE_FREELANCER ); ?>"><?php echo __( 'Freelancer', APP_TD ); ?></option>
								<?php if ( $hrb_options->share_roles_caps ): ?>
									<option value="<?php echo esc_attr( HRB_ROLE_BOTH ); ?>"/> <?php echo __( 'Both', APP_TD ) ?></option>
								<?php endif; ?>
							</select>

						</div>
					</div>
				</div>


				<?php do_action( 'register_form' ); ?>

				<div class="white" id="forgot">
					<div class="forgot-link">
						<p class="small-text">By joining I agree to <a href="<?php echo site_url() ?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
					</div>
				</div>

				<div class="form-field centered" id="form-submit">
					<?php //echo HRB_Login_Registration::redirect_field(); ?>
					<input id="redirect-field" type="hidden" name="redirect_to" value="<?php echo site_url() ?>/welcome">
					<input  tabindex="30" type="submit" class="button orange" id="register" name="register" value="<?php _e( 'Register', APP_TD ); ?>" />
				</div>


			</fieldset>
			<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
			<!-- autofocus the field -->
			<script type="text/javascript">try{document.getElementById('user_login').focus();}catch(e){}</script>

		</form>
	</div>

</div>

<script>
	jQuery('select').change( function(){
		var selected  = jQuery('select option:selected').text();
		if(selected.indexOf('Freelancer') > -1){
			var url = '<input id="redirect-field" type="hidden" name="redirect_to" value="<?php echo site_url() ?>/welcome-freelancer">';
			console.log(url);
			jQuery('#redirect-field').remove();
			jQuery('#form-submit').append(url);
		}
	});



</script>
