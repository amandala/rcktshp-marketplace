<?php
/*
Template Name: custom-reg
*/
?>
<?php
	if(is_user_logged_in() ){
		ob_start();
		wp_logout();
	}
?>

<div class='large-10 push-1 columns' id='scholarship-banner'>
	<img style="width:100%;" src="<?php echo site_url()?>/wp-includes/images/scholarship-banner1200.jpg">
	<a name="banner"></a>

	<div class="form-greeting" id ="heading">
		<h3 class="greeting">The student’s struggle is real!</h3>
		<p class='instruction'>Can’t get a job because you don’t have experience? Don’t have experience because you can’t get a job?</p>
		<h3 class="instruction pad">RCKTSHP is pleased to announce <span class='greet-teal'>RCKTSHP</span>.</h3>
		<p class='instruction pad'>Start using the skill set you’ve built in the classroom. We connect students like you, to local employers with paid bite-sized business projects. Work on real-world projects that develop relevant work experience, while building your professional reputation.</p>
		<p class='instruction pad'>We’re awarding $500 to one deserving student who registers as a freelancer on RCKTSHP and has a <span class='greet-teal'>thoroughly completed profile.</span></p>
		<div class='next-button-section centered-wrapper'>
			<button id="show-signup-section" class='schol-button center' type="button" onclick="ga('send', 'event', 'EWEform', 'Click', 'Start');">GET STARTED</button>
		</div>
		<p class='instruction pad elig'>Eligibility:</p>
		<p class='instruction pad elig'>Any person who is 18 years of age and older at time of entry, who is a Canadian Resident or International student studying in Canada, on the contest closing date and who is enrolled in a Canadian High School, or Canadian Publicly funded University or College for the 2014-2015 or 2015-2016 school year excluding any schools located in the province of Quebec. Quebec residents can still register on RCKTSHP but they are not eligible to win the scholarship for $500.</p>
		<p class='instruction pad elig'>View our Full Scholarship Terms <a href="<?php site_url() ?>/earn-work-experience-scholarship-terms-and-conditions/">here</a></p>
	</div>

	<div class="form-greeting" id ="oops">
		<h3 class="greeting">Oops!</h3>
		<p class='instruction bold'>Something went wrong.</p>
		<div class='next-button-section'>
			<button id="try-again" class='schol-button center' type="button" onclick="ga('send', 'event', 'EWEform', 'Click', 'Error');">TRY AGAIN</button>
		</div>
	</div>

	<div class="form-greeting" id ="heading4">
		<h3 class="greeting">Congratulations!</h3>
		<p class='instruction'>You've successfully registered on RCKTSHP and can apply for jobs right away. You're on your way to earning valuable work experience.</p>
		<p class='instruction'>In order to be qualified for the <span class='ital'>Earn Work Experience Scholarship</span>,  You need to fill out your user profile as best you can.</p>
		<div class='centered-wrapper'>
				<button id="login-button" class='schol-button center' type="button" onclick="ga('send', 'event', 'EWEform', 'Click', 'Login'); location.href = '<?php echo site_url() ?>/edit-profile/';">LOG IN NOW!</button>
		</div>

	</div>

</div>

		<?php
		$projects_link = site_url() . '/projects/';
		$email_subject = 'Thank You For Applying To The Earn Work Experience Scholarship';
		$email_content = "<p>Hello, ".  $_POST['first_name'] . "</p>
		<p>Your scholarship application was successfully received and you are now a member of RCKTSHP.</p>
					<p>The winner of The $500 Earn Work Experience Scholarship will be announced shortly after the contest closes August 31, 2015 at 11:59 P.M EST.</p>
					<p>Now that you've successfully registered and completed your profile here's what you can do:
						<ul>
							<li>Login to your account and add a profile picture </li>
							<li><a href='".$projects_link."'>Browse projects</a> on our job postings board</li>
							<li>Submit proposals to apply for project work using your credits </li>
						</ul>
					</p>
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
			$website = $wpdb->escape(trim($_POST['user_url']));

			// Payments and Tax
			$hrb_email = $wpdb->escape(trim($_POST['email']));
			$paypal_email = $wpdb->escape(trim($_POST['paypal_email']));
			$province = $wpdb->escape(trim($_POST['province']));

			//Bio and Skills
			$description = stripslashes( $wpdb->escape(trim($_POST['description'])) );


			// check that all required fields are filled out
			if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "" ) {
				$err = 'All fields in the "Sign Up Info" section are mandatory!';
			}
			if( $paypal_email == "" || $province == "" ) {
				$err = 'Paypal email and Province are mandatory!';
			}
			if( $description == "" ) {
				$err = 'You need to fill out the "About Me" section to qualify!';
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err = $email . ' is not a valid email address.';
			} else if(!filter_var($paypal_email, FILTER_VALIDATE_EMAIL)) {
				$err = $paypal_email . ' is not a valid email address.';
			} else if(email_exists($email) ) {
				$err = 'Nice try! That email address has already been registered. <br />If you are already a member of RCKTSHP and want to apply for the scholarship, email us at <a style="color: white; text-decoration:underline;" href="mailto:hello@rcktshp.com">hello@rcktshp.com</a> and we will enter you in! ';
			} else if($pwd1 <> $pwd2 ){
				$err = 'Passwords did not match.';
			} else if($over18 != '' ){
				$err = "Unfortunately you need to be at least 18 and agree to our terms to sign up on RCKTSHP. If you are over 18, please review the <a href='<?php echo site_url()?>/terms/' target='_blank' style='color:white; text-decoration:underline'>site terms</a> and try again.";
			}
			else {

					$user_id = wp_insert_user(
						array ('first_name' => apply_filters('pre_user_first_name', $first_name),
						'last_name' => apply_filters('pre_user_last_name', $last_name),
						'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
						'user_login' => apply_filters('pre_user_user_login', $username),
						'user_email' => apply_filters('pre_user_user_email', $email),
						'user_url' => $website,
						'role' => 'freelancer' ) );

					if( is_wp_error($user_id) ) {
						$err = 'That username is already in use. Please try another! ';
					}
					else {

					rcktshp_custom_email($email, $email_subject,  $email_content);

					do_action('user_register', $user_id);

					$success = "Congrats! You're done";

					// Social
					update_user_meta($user_id, 'hrb_facebook', $facebook );
					update_user_meta($user_id, 'hrb_instagram', $instagram );
					update_user_meta($user_id, 'hrb_twitter', $twitter );
					update_user_meta($user_id, 'hrb_linkedin', $linkedin );

					// Payment and Tax
					update_user_meta($user_id, 'hrb_email', $hrb_email );
					update_user_meta($user_id, 'edfg_pp_adaptive_paypal_email', $hrb_email );
					update_usermeta( $user_id, 'province', $province );

					// Bio and Skills
					update_usermeta( $user_id, 'description', $description );

					update_usermeta( $user_id, 'scholarship', 'Earn Work Experience' );

					if( $_POST['newsletter'] != ''){
						update_usermeta( $user_id, 'newsletter', $_POST['newsletter'] );
					}
					else{
						update_usermeta( $user_id, 'newsletter', 'no');
					}

					if( $_POST['over18'] != ''){
						update_usermeta( $user_id, 'terms', 'yes' );
						update_usermeta( $user_id, 'over18', $_POST['over18'] );
					}
					else{
							update_usermeta( $user_id, 'terms', 'no' );
							update_usermeta( $user_id, 'over18', 'no');
					}

				}
			}
		}
		?>

<div class='large-10 push-1 columns' id='full-sec'>
		<div class="large-8 columns" id='form-section'>


			<form method="post" id='schol-form'>
					<div id="signup-section">
						<!--display error/success message-->


						<fieldset class="scholarship-section" >
							<legend class="scol-legend">Your Basics</legend>

							<div  class="large-12 columns" id="message">
								<?php
									if(! empty($err) ) :
										echo '<p class="schol-error">'.$err.'';
									endif;
								?>
								<?php
									if(! empty($success) ) :
										echo '<p class="schol-error" >'.$success.'';
									endif;
								?>
							</div>
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
							<div class="large-12 columns">
								<label class='scol-label'>About Me</label>
								<textarea class="text regular-text valid" value="" name="description" id="description" rows="20" cols="20" aria-invalid="false" style="height:200px"/></textarea>
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
							<div class="large-12 columns">
								<input class='schol-sign-check' type="checkbox" value="yes" name="newsletter" id="newsletter" checked='checked'/> <span id='yes'>Yes, I would like to receive emails regarding new projects </span><i class="fa fa-question-circle" id='paypal-tooltip' title='Occasionally, we send out a newsletter to let students know about recent project postings.'></i>
								<br />
								<input class='schol-sign-check' type="checkbox" value="yes" name="over18" id="over18" style='margin: 0 0 0 0;'/> <span id='yes'>Yes, I am over 18 and I agree to the <a href='<?php echo site_url()?>/terms/' target='_blank'>RCKTSHP Terms</a>  </span><i class="fa fa-question-circle" id='paypal-tooltip' title='We require users of RCKTSHP site to be at least 18 years old. '></i>
							</div>
						</fieldset>
						<div class='submit-form-section'>
							<button id='submit-button' type="button" name="btnregister" class="schol-button next" onclick="ga('send', 'event', 'EWEform', 'Click', 'Submit');">SUBMIT</button>
							<input type="hidden" name="task" value="register" />
						</div>
				</div>
			</form>
	</div>
		<!-- SIDEBARS -->
			<div class='large-4 columns schol-sidebar' id='sidebar-basic'>
				<h4 class='schol-sidebar-heading'>What Can I Do on RCKTSHP?</h4>
				<p class='sidebar-schol'>Do you know how to build a website? Run social media campaigns? Design logos? Write engaging content?</p>
				<p class='sidebar-schol'>Any project of a digital nature can be completed on RCKTSHP. This includes:
				<ul id='sidebar-list' class='sidebar-schol'>
					<li>Graphic design</li>
					<li>Web development</li>
					<li>Software development & programming</li>
					<li>Multimedia creation</li>
					<li>Photography and image alterations</li>
					<li>Social media marketing</li>
					<li>Marketing strategy and content creation</li>
					<li>Research projects</li>
					<li>Creative & technical writing</li>
					<li>Analytics reporting</li>
					<li>Customer service & support</li>
				</ul>
				</p>
			</div>
</div>

<script type="text/javascript">

		jQuery('#sidebar-basic').hide();
		//on page load - hide everything except greeting
		jQuery('#signup-section').hide();

		jQuery('#prog-bar1').hide();
		jQuery('#prog-bar33').hide();
		jQuery('#prog-bar66').hide();
		jQuery('#prog-bar100').hide();

		jQuery('#oops').hide();
		jQuery('#heading1').hide();
		jQuery('#heading4').hide();

	// move forward to sign up section
	jQuery('#show-signup-section').click(function(){
		jQuery(this).hide();
		jQuery('#heading').hide();
		jQuery('#signup-section').show();

		jQuery('#heading1').show();
		jQuery('#sidebar-basic').show();
		jQuery('#message').hide();

		jQuery('.next-button-section2').hide();

	});


	// move forward to sign up section
	jQuery('#try-again').click(function(){
		jQuery(this).hide();
		jQuery('#oops').hide();
		jQuery('#heading').hide();
		jQuery('#signup-section').show();

		jQuery('#heading1').show();
		jQuery('#sidebar-basic').show();
		jQuery('#sidebar-bio').hide();
		jQuery('#message').show();

	});

	// move back to social section
	jQuery('#submit-button').click(function(){
		if(jQuery('#pwd1').val() == '' || jQuery('#pwd2').val() == ''){
			alert("You need a password");
		}
		else if(jQuery('#pwd1').val() != jQuery('#pwd2').val() ){
			alert("Passwords don't match");
		}
		else if(jQuery('#email').val() == ''){
			alert("You need to enter your email address");
		}
		else if(jQuery('#paypal_email').val() == ''){
			alert("You need to enter your PayPal email address");
		}
		else if(jQuery('#province').val() == ''){
			alert("You need to pick a Province, Territory or State");
		}
		else if(jQuery('#username').val() == ''){
			alert("You will need a username!");
		}
		else if(jQuery('#description').val() == ''){
			alert("Say something about yourself! The more completely you fill out your profile, the higher your chances of winning the Scholarship.");
		}
		else{
 			jQuery('#schol-form').submit();
		}


	});

	// upon successfull compltion of the registration
	jQuery(function(){
		var error = jQuery('.schol-error').text();
		if(error.indexOf('Congrats') >=0){
			jQuery('#heading').hide();
			jQuery('#heading1').hide();
			jQuery('#heading3').hide();
			jQuery('#prog-bar1').hide();
			jQuery('#form-section').hide();
			jQuery('#signup-section').hide();
			jQuery('#heading4').show();
			jQuery('#sidebar-basic').hide();
			jQuery('#prog-bar100').show();
		}
		else if( error ){
			jQuery('#heading').hide();
			jQuery('#message').hide();
			jQuery('#oops').show();
		}

	});

</script>
