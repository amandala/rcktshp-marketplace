<?php global $wp_version; ?>

<div class="row">
	<div class="large-12 columns">

		<form action="<?php echo appthemes_get_password_reset_url( 'login_post' ); ?>" method="post" class="login-form password-reset-form" name="resetpassform" id="login-form">
			<p><?php _e( 'Enter your new password below.', APP_TD ); ?></p>

			<fieldset>
				<input type="hidden" id="user_login" value="<?php echo esc_attr( $_GET['login'] ); ?>" autocomplete="off" />

				<?php if ( $wp_version < 4.3 ) : ?>

					<div class="row">
						<div class="large-6 columns form-field">
							<label for="pass1">
								<?php _e( 'New password', APP_TD ); ?>
								<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
							</label>
						</div>
						<div class="large-6 columns form-field">
							<label><?php _e( 'Confirm new password', APP_TD ); ?>
							<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
						</div>
					<</div>

				<?php else: ?>

					<div class="row user-pass1-wrap manage-password">
						<div class="large-6 columns form-field">
							<label for="pass1"><?php _e( 'New Password', APP_TD ); ?></label>

							<?php $initial_password = isset( $_POST['pass1'] ) ? stripslashes( $_POST['pass1'] ) : wp_generate_password( 18 ); ?>

							<input tabindex="3" type="password" id="pass1" name="pass1" class="text required" autocomplete="off" data-reveal="1" data-pw="<?php echo esc_attr( $initial_password ); ?>" aria-describedby="pass-strength-result" />
							<input type="text" style="display:none" name="pass2" id="pass2" autocomplete="off" />
						</div>
						<div class="large-6 columns form-field">
							<button type="button" class="button secondary small wp-hide-pw hide-if-no-js" data-start-masked="<?php echo (int) isset( $_POST['pass1'] ); ?>" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', APP_TD ); ?>">
								<span class="dashicons dashicons-hidden"></span>
								<span class="text"><?php _e( 'Hide', APP_TD ); ?></span>
							</button>
						</div>
					</div>

				<?php endif; ?>

				<div class="row">
					<div class="large-12 columns form-field">
						<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', APP_TD ); ?></div>
						<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?></p>
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns form-field">
						<input tabindex="2" type="submit" id="resetpass" name="resetpass" value="<?php _e( 'Reset Password', APP_TD ); ?>" />
						<?php do_action( 'lostpassword_form' ); ?>
					</div>
				</div>

			</fieldset>

			<!-- autofocus the field -->
			<script type="text/javascript">try{document.getElementById('pass1').focus();}catch(e){}</script>

		</form>

	</div>
</div>

