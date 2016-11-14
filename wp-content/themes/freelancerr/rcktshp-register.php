<?php
/*
Template Name: RCKTSHP Registration
*/
?>

<?php

	$email_subject = 'Welcome to RCKTSHP!';
	$email_content = "<p>Hello, ".  $_POST['first_name'] . "</p>
				<p>We've added 10 free credits to your account to help you get on your way.</p>";
	$err = '';
	$success = '';

	global $wpdb, $PasswordHash, $current_user, $user_ID;

	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		// Registration fields

		$pwd1 = $wpdb->escape(trim($_POST['pwd1']));
		$pwd2 = $wpdb->escape(trim($_POST['pwd2']));
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name = $wpdb->escape(trim($_POST['last_name']));
		$display_name = $wpdb->escape(trim($_POST['display_name']));
		$email = $wpdb->escape(trim($_POST['email']));
		$username = $wpdb->escape(trim($_POST['username']));
		$role = $_POST['role'];

		// Payments and Tax
		$hrb_email = $wpdb->escape(trim($_POST['email']));
		$paypal_email = $wpdb->escape(trim($_POST['paypal_email']));
		$province = $wpdb->escape(trim($_POST['province']));

		// Checkboxes


		// check that all required fields are filled out
		if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "" ) {
			$err = 'You did not fill the form out entirely!';
		}
		if( $province == "" ) {
			$err = 'Province or State is mandatory';
		}
		if($paypal_email == "" ){
				$err = '';
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = $email . ' is not a valid email address.';
		} else if(!filter_var($paypal_email, FILTER_VALIDATE_EMAIL)) {
			$err = $paypal_email . ' is not a valid email address.';
		} else if(email_exists($email) ) {
			$err = 'That email address has already been registered.';
		} else if($pwd1 <> $pwd2 ){
			$err = 'Passwords did not match.';
		} else {

		$user_id = wp_insert_user(
				array ('first_name' => apply_filters('pre_user_first_name', $first_name),
						'last_name' => apply_filters('pre_user_last_name', $last_name),
						'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
						'user_login' => apply_filters('pre_user_user_login', $username),
						'user_email' => apply_filters('pre_user_user_email', $email),
						'user_url' => $website,
						'role' => $role ) );

			if( is_wp_error($user_id) ) {
				$err = 'That username is already in use. Please try another! ';
			} else {

				rcktshp_custom_email($email, $email_subject,  $email_content);

				do_action('user_register', $user_id);

				$success = "Congrats! You're registered";

				// Social
				update_user_meta($user_id, 'hrb_facebook', $facebook );
				update_user_meta($user_id, 'hrb_instagram', $instagram );
				update_user_meta($user_id, 'hrb_twitter', $twitter );
				update_user_meta($user_id, 'hrb_linkedin', $linkedin );

				// Payment and Tax
				update_user_meta($user_id, 'hrb_email', $hrb_email );
				update_user_meta($user_id, 'edfg_pp_adaptive_paypal_email', $hrb_email );
				update_usermeta( $user_id, 'province', $province );


				if( $_POST['newsletter'] != ''){
					update_usermeta( $user_id, 'newsletter', $_POST['newsletter'] );
				}else{
					update_usermeta( $user_id, 'newsletter', 'no');
				}

				if( $_POST['terms'] != ''){
					update_usermeta( $user_id, 'terms', $_POST['terms'] );
				}else{
					update_usermeta( $user_id, 'terms', 'no');
				}

			}
		}
	}
?>

<div class='large-12 columns'>
	<div class="large-6 push-1 columns" id='form-section'>
	        <!--display error/success message-->
		<div  class="large-12 columns" id="message">
			<?php
				if(! empty($err) ) :
					echo '<p class="error">'.$err.'';
				endif;
			?>
			<?php
				if(! empty($success) ) :
					echo '<p class="error" >'.$success.'';
					 
				endif;
			?>
		</div>

		<form method="post" id='schol-form'>
			<div id="signup-section">

				<fieldset class="scholarship-section" >
					<legend class="scol-legend">Register on RCKTSHP</legend>
					<h4 class='scol-form-sec'>Sign Up Information</h4>
					<div class="large-4 columns">
						<label class='scol-label'>Email</label>
						<p><input type="text" value="" name="email" id="email" /></p>
						<label  class='scol-label'>Username</label>
						<p><input type="text" value="" name="username" id="username" /></p>
					</div>
					<div class="large-4 columns">
						<label  class='scol-label'>First Name</label>
						<p><input type="text" value="" name="first_name" id="first_name" /></p>
						<label  class='scol-label'>Last Name</label>
						<p><input type="text" value="" name="last_name" id="last_name" /></p>
					</div>
					<div class="large-4 columns">
						<label  class='scol-label'>Password</label>
						<p><input type="password" value="" name="pwd1" id="pwd1" /></p>
						<label class='scol-label'>Password again</label>
						<p><input type="password" value="" name="pwd2" id="pwd2" /></p>
					</div>

					<h4 class='scol-form-sec'>Payments & Tax</h4>
					<div class="large-4 columns">
						<label class='scol-label'>PayPal Email <i class="fa fa-question-circle" id='paypal-tooltip' title='We use PayPal because it’s a free, simple, and safe method of transferring payments. Please provide the email address that you use to sign in to your PayPal account, to ensure payments can be sent and received accordingly. '></i></label>
						<input type="text" value="" name="paypal_email" id="paypal_email" />
						<a id='paypal-link' href="https://www.paypal.com/ca/signup/account" target='_blank'>Dont have a Paypal email?</a>
					</div>
					<div class="large-4 columns">
						<label class='tool scol-label'>Province, Territory or State where you file your taxes <i class="fa fa-question-circle" id='province-tooltip' title='We require location information for tax purposes. Taxes will be deducted based on the tax rate of your province of residence.'></i></label>
							<select id="province" class="input" type="text" name="province">
							<option value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>"><?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?></option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AB">Alberta</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="BC">British Columbia</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MB">Manitoba</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NB">New Brunswick</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NL">Newfoundland and Labrador</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="NT">Northwest Territories</option>
							<option value="NS">Nova Scotia</option>
							<option value="NU">Nunavut</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="ON">Ontario</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="PE">Prince Edward Island</option>
							<option value="PR">Puerto Rico</option>
							<option value="QC">Quebec</option>
							<option value="RI">Rhode Island</option>
							<option value="SK">Saskatchewan</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
							<option value="YT">Yukon</option>
							</select>
					</div>

						<div class="large-4 small-12 columns form-field user-role-type">
							<label class='scol-label'>Your role on RCKTSHP<i class="fa fa-question-circle" id='paypal-tooltip' title='We use PayPal because it’s a free, simple, and safe method of transferring payments. Please provide the email address that you use to sign in to your PayPal account, to ensure payments can be sent and received accordingly. '></i></label>
							<select name="role">
								<option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Employer', APP_TD ); ?></option>
								<option value="<?php echo esc_attr( HRB_ROLE_FREELANCER ); ?>"><?php echo __( 'Freelancer', APP_TD ); ?></option>
								<?php if ( $hrb_options->share_roles_caps ): ?>
									<option value="<?php echo esc_attr( HRB_ROLE_BOTH ); ?>"/> <?php echo __( 'Both', APP_TD ) ?></option>
								<?php endif; ?>
							</select>
						</div>


					<div class="large-12 columns">
						<input type="checkbox" value="yes" name="newsletter" id="newsletter" checked='checked'/> <span id='yes'>Yes, I would like to receive emails regarding new projects</span><i class="fa fa-question-circle" id='paypal-tooltip' title='Occasionally, we send out a newsletter to let students know about recent project postings.'></i>
					</div>
					<div class="large-12 columns">
						<input type="checkbox" value="yes" name="terms" id="terms"/> <span id='yes'>Yes, I am over 18 and agree to the RCKTSHP <a href=''>Terms and Conditions</a></span><i class="fa fa-question-circle" id='paypal-tooltip' title='We require users of the site to be at least 18 years of age.'></i>
					</div>

					<button id='submit-button' type="submit" name="btnregister" class="schol-button next" >SUBMIT</button>
					<input type="hidden" name="task" value="register" />
				</fieldset>


			</div>
		</form>
	</div>
	<div id="sidebar" class="large-3 pull-1 columns">
		<div class="sidebar-widget-wrap cf">
		<?php get_sidebar( app_template_base() ); ?>
		</div><!-- end .sidebar-widget-wrap -->
	</div><!-- end #sidebar -->
</div>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#register').attr('disabled', 'disabled');
	jQuery('#social_login_frame').hide();

		jQuery('#submit-button').click(function() {
				if (jQuery('#terms').is(':checked')) {
						jQuery('#register').removeAttr('disabled');
						jQuery('#social_login_frame').show();
				} else {
						alert("You must agree to the RCKTSHP Terms and Conditions before registering");
						jQuery('#register').attr('disabled', 'disabled');
						jQuery('#social_login_frame').hide();
				}
		})
});
</script>
<script>
// upon successfull compltion of the registration
jQuery(function(){
	var error = jQuery('.error').text();
	if(error.indexOf('Congrats') >=0){

		ga('create', 'UA-52809046-3', 'auto');
		ga('send', 'event', 'form', 'register', 'scholarship', 1);
	}
	else if( error ){

	}

});

</script>
