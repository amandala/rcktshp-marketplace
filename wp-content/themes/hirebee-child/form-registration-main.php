
<h3><?php _e( 'Please complete the fields below to register:', APP_TD ); ?></h3>

<div class="row">
	<div class="large-12 columns">

		<form action="<?php echo appthemes_get_registration_url( 'login_post' ); ?>" method="post" class="login-form register-form custom" name="registerform" id="login-form">
			<fieldset>
				<div class="row">
					<div class="large-6 columns form-field">
						<label><?php _e( 'Username:', APP_TD ); ?></label>
						<input tabindex="1" type="text" class="text required" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" />
					</div>

					<div class="large-6 columns form-field">

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

				<div class="row">
					<div class="large-12 columns form-field">
						<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', APP_TD ); ?></div>
						<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?></p>
					</div>
				</div>

				<h4><?php echo __( 'What are you?', APP_TD ); ?></h4>

				<div class="row">
					<div class="large-4 small-12 columns form-field user-role-type">

						<select name="role">
							<option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Employer', APP_TD ); ?></option>
							<option value="<?php echo esc_attr( HRB_ROLE_FREELANCER ); ?>"><?php echo __( 'Freelancer', APP_TD ); ?></option>
							<?php if ( $hrb_options->share_roles_caps ): ?>
								<option value="<?php echo esc_attr( HRB_ROLE_BOTH ); ?>"/> <?php echo __( 'Both', APP_TD ) ?></option>
							<?php endif; ?>
						</select>

					</div>
				</div>

				<div class="terms">
					<input type="checkbox" id="terms" value="terms_agreed">I agree with the RCKTSHP <a href="http://projects.rcktshp.com/terms">Terms and Conditions</a>
				</div>

				<?php do_action( 'register_form' ); ?>

				<div class="form-field">
					<?php echo HRB_Login_Registration::redirect_field(); ?>
					<input  tabindex="30" type="submit" class="btn reg" id="register" name="register" value="<?php _e( 'Register', APP_TD ); ?>" />
				</div>

			</fieldset>
			<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
			<!-- autofocus the field -->
			<script type="text/javascript">try{document.getElementById('user_login').focus();}catch(e){}</script>

			<script type="text/javascript">
			$(document).ready(function(){
				$('#register').attr('disabled', 'disabled');
				$('#social_login_frame').hide();
    			$('#terms').click(function() {
			        if ($(this).is(':checked')) {
			            $('#register').removeAttr('disabled');
			            $('#social_login_frame').show();
			        } else {
			            alert("You must agree to the RCKTSHP Terms and Conditions before registering");
			            $('#register').attr('disabled', 'disabled');
			            $('#social_login_frame').hide();
			        }
    			})
			});
			</script>
		</form>

	</div>
</div>
