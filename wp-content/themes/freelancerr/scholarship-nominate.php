<?php
/*
Template Name: Scholarship Nominate
*/

	if(is_user_logged_in() ){
		ob_start();
		wp_logout();
	}
?>
<div class='large-10 push-1 columns' id='scholarship-banner'>
	<img alt="rocketship web makeover" style="width:100%;" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/scholarship/banner-nominate.png">
</div>

	<div class="form-greeting large-10 push-1 columns " id ="heading">
		<h3 class="greeting">Help a small business that you love:</h3>
		<p class='instruction'>RCKTSHP is awarding weekly cash prizes for nominating at least 3 small businesses that you think need a new website.</p>
		<p class='instruction pad'>Two $250 scholarships will be awarded each week.</p>
		<h3 class="greeting">Here's how you enter:</h3>
		<p class='instruction pad'>
		<ol>
			<li class="instruction">Be a registered freelancer on RCKTSHP, if you’re not already you can sign up quickly below</li>
			<li class="instruction">In the text field, nominate at least 3 small businesses that need a website or could use a website makeover.</li>
			<li class="instruction">Post on the <a href="https://www.facebook.com/rcktshp/" target="_blank">RCKTSHP Facebook</a> page or <a href="https://www.twitter.com/RCKTSHP" target="_blank">Tweet @ RCKTSHP</a>. Tag each small business nomination and use the following: <em>“I nominate @XYZ_business for a Website Makeover sponsored by @RCKTSHP. #SupportSmallBusiness"</em></li>

		</ol>
		<p class='instruction'>RCKTSHP will sponsor new websites for selected small businesses that have been nominated. Help a small business that you love, start nominating businesses that need a new website today!</p>
		</p>



		<div class='next-button-section'>
			<button id="show-signup-section" class='schol-button center' type="button" onclick="ga('send', 'event', 'WMform', 'Click', 'New Registrant');">I'm NOT REGISTERED</button><br />
			<a id="show-registered-form" class='schol-button center' type="button" onclick="ga('send', 'event', 'WMform', 'Click', 'Already Registered');">I'm ALREADY REGISTERED</a>


		</div>
		<?php if ( function_exists('sharethis_button') && $hrb_options->listing_sharethis ): ?>

			<div class="row share-this" id="reg-form-share">
				<div class="large-12 columns">
					<div><?php sharethis_button(); ?></div>
				</div>
			</div>

		<?php endif; ?>
		<p class='instruction pad elig'>Eligibility:</p>
		<p class='instruction pad elig'>Any person who is 18 years of age and older at time of entry, who is a Canadian Resident or International student studying in Canada, on the contest closing date and who is enrolled in a Canadian High School, or Canadian Publicly funded University or College for the 2014-2015 or 2015-2016 school year excluding any schools located in the province of Quebec. Quebec residents can still sign up on RCKTSHP but they are not eligible to win the scholarship for $250.</p>
		<p class='instruction pad elig'>View our Full Scholarship Terms <a href="<?php site_url() ?>/the-nominate-and-win-scholarship-terms/">here</a></p>
	</div>

	<div class="large-10 push-1 columns form-greeting" id ="oops">
		<h3 class="greeting">Oops! Something went wrong.</h3>
		<p class='instruction pad'>Possible errors include:</p>
		<p class='instruction pad'>
			<ol>
				<li>Entering an invalid email address</li>
					<ul>
						<li>RCKTSHP is unusable without a valid email address</li>
					</ul>
				<li>Trying to use an email address that is already registered on the site</li>
					<ul>
						<li>make sure you aren't already registered on RCKTSHP by checking your email inbox for our Welcome email</li>
					</ul>
				<li>Trying to use a username that is already registered on the site</li>
					<ul>
						<li>generic usernames like first names are popular and may already be taken</li>
					</ul>

			</ol>
		</p>
		<p class='instruction bold'>Click the 'Try Again' button below for the exact reason for the error, and to complete the registration again.</p>
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
		<div class='next-button-section'>
			<button id="try-again" class='schol-button center' type="button" onclick="ga('send', 'event', 'WMform', 'Click', 'Error');">TRY AGAIN</button>
		</div>
	</div>

	<div class="large-10 columns push-1 form-greeting" id ="heading4">
		<h3 class="greeting">Congratulations!</h3>
		<p class='instruction'>You've successfully registered for RCKTSHP and can apply for jobs right away. You're on your way to earning valuable work experience.</p>
		<p class='instruction'>In order to be qualified for <span class='ital'>The Nominate and Win Scholarship</span>,  you need to fill out your user profile as best you can. Remember to add a profile picture, a description of your skills and interests and expertise, your educational background, work experience and some skills!</p>
		<div class=' next-button-section centered-wrapper'>
				<button id="login-button" class='schol-button center' type="button" onclick="ga('send', 'event', 'WMform', 'Click', 'Login'); location.href = '<?php echo site_url() ?>/edit-profile/';">LOG IN NOW!</button>
		</div>

	</div>

</div>

		<?php

		$email_subject = 'Thank you for applying to The Website Makeover Scholarship';
		$email_content = "<p>Hello, ".  $_POST['first_name'] . "</p>
		<p>Your scholarship application was successfully received and you are now a member on RCKTSHP.</p>
					<p>The winners of the The Nominate and Win will be announced weekly.</p>
					<p>Now that you've successfully registered here's what you can do:
						<ul>
							<li class='instruction'>Post on the <a href='https://www.facebook.com/rcktshp/' target='_blank'>RCKTSHP Facebook</a> page or <a href='https://www.twitter.com/RCKTSHP' target='_blank'>Tweet @RCKTSHP</a>. Tag each small business and use the following: <em>'I nominate @XYZ_business for a Website Makeover sponsored by @RCKTSHP. #SupportSmallBusiness'</em></li>
							<li>Login to your account and add a profile picture </li>
							<li>Make sure all the required fields are filled out to be eligible for the scholarship </li>
							<li><a href='". site_url()."/projects/''>Browse projects</a> on our job postings board</li>
							<li>Submit proposals to apply for project work using your credits </li>
						</ul>
					</p>
					<p>We've added 10 free credits to your account to help you get on your way.</p>";


		$err = '';
		$success = '';

		global $wpdb, $PasswordHash, $current_user, $user_ID;

		if(isset($_POST['task']) && $_POST['task'] == 'register' ) { //if the user is registering

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
			$province = $wpdb->escape(trim($_POST['province']));

			//Bio and Skills
			$entry = str_replace('"', "'", $wpdb->escape(trim($_POST['entry'])) );
			$entry = stripslashes($entry);


			// check that all required fields are filled out
			if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "" ) {
				$err = 'All fields in the "Sign Up Info" section are mandatory!';
			}
			if(  $province == "" ) {
				$err = 'Province information is mandatory!';
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err = $email . ' is not a valid email address.';
			}
			else if(email_exists($email) ) {
				$err = 'Nice try! That email address has already been registered. <br /><br />If you are already a member on RCKTSHP and want to apply for the scholarship, press back in your browser and pick the "Already Registered" option. ';
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
						$user_data = get_user_by('id', $user_id);
						$user_email = $user_data->user_email;

						//var_dump($user_data);
						$email_to_b = $user_email ." submitted the following:" . $entry;

					rcktshp_custom_email('bbutchart@madebyuppercut.com', 'New Nominate and Win entry', $email_to_b);

					do_action('user_register', $user_id);

					$success = "Congrats! You're done";


					// Payment and Tax
					update_user_meta($user_id, 'hrb_email', $hrb_email );
					update_usermeta( $user_id, 'province', $province );

					// Bio and Skills
					update_usermeta( $user_id, 'scholarship_entry_nominate_win', $entry );

					update_usermeta( $user_id, 'scholarship', 'Nominate and Win' );

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
		elseif(isset($_POST['task']) && $_POST['task'] == 'addmeta' ) {
			$email = $_POST['email-r'];

			$user = get_user_by('email', $email);

			if(isset($_POST['entry-reg'])) {
				$user = get_user_by('email', $_POST['email-r']);
				$entry = $wpdb->escape(trim($_POST['entry-reg']));
				$entry = str_replace('"', "'", $entry);
				$entry = stripslashes($entry);
			}

			if($user){ //if the user exists - make the entry in the table and send emails
				$user_id = $user->ID;
				update_user_meta( $user_id, 'scholarship_entry_nominate_win', $entry);
				update_usermeta( $user_id, 'scholarship', 'Nominate and Win' );
				$err = 'Congrats';

				rcktshp_custom_email($_POST['email'], $email_subject,  $email_content);
				$user_data = $user->data;

				$user_email = $user_data->user_email;
				$email_to_b = $user_email ." submitted the following:" . $entry;

				rcktshp_custom_email('bbutchart@madebyuppercut.com', 'New Nominate and Win entry', $email_to_b);
			}
			else{
				$err = "That email didn't seem to work. Make sure you use the email that you signed up with";
			}
		}

		?>

<div class='large-10 push-1 columns scholarship-form'>
		<div class="large-8 columns">

			<div id="signup-section">
				<form method="post" id='registration-form'>

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
								<label class='scol-label'>Show us your stuff! In under 200 words, nominate at least three small businesses for a website makeover. Make sure you include the URL, and why you think they are deserving.</label>
								<textarea class="text regular-text valid" value="" name="entry" id="entry" rows="20" cols="20" aria-invalid="false" style="height:200px"/></textarea>
							</div>

							<h4 class='scol-form-sec'>Payments & Tax</h4>
							<div class="large-6 columns">
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
								<div class="large-8 columns">
									<input class='schol-sign-check' type="checkbox" value="yes" name="newsletter" id="newsletter" checked='checked'/> <span id='yes'>Yes, I would like to receive emails regarding new projects </span><i class="fa fa-question-circle" id='paypal-tooltip' title='Occasionally, we send out a newsletter to let students know about recent project postings.'></i>
									<br />
									<input class='schol-sign-check' type="checkbox" value="yes" name="over18" id="over18" style='margin: 0 0 0 0;'/> <span id='yes'>Yes, I am over 18 and I agree to the <a href='<?php echo site_url()?>/terms/' target='_blank'>RCKTSHP Terms</a>  </span><i class="fa fa-question-circle" id='paypal-tooltip' title='We require users of RCKTSHP site to be at least 18 years old. '></i>
								</div>
								<div class="large-4 columns">
									<div class='submit-form-section'>
										<button id='submit-button-new' type="button" name="btnregister" class="schol-button next" onclick="ga('send', 'event', 'WMform', 'Click', 'Submit');">SUBMIT</button>
										<input type="hidden" name="task" value="register" />
									</div>
								</div>

							</div>

						</fieldset>
				</form>
		</div>


		<div  id="already-registered-form">
			<form method="post" id="already-reg-form">
				<fieldset class="scholarship-section" >
					<?php
					if(! empty($err)){
						echo '<p class="schol-error">'.$err . '</p>';
					}
					?>

					<legend class="scol-legend">Show us your stuff!</legend>

					<div class="large-6 columns">
						<label for="email-r">E-mail:</label>
						<input type="email" id="email-r" name="email-r" />
					</div>
					<div class="large-12 columns">

						<label class='scol-label'>Nominate at least three small businesses in need of a website makeover. In under 200 words tell us why they’re deserving. Make sure to include the URL and why you feel they are deserving.</label>
						<textarea class="text regular-text valid" value="" name="entry-reg" id="entry-reg" rows="20" cols="20" aria-invalid="false" style="height:200px"/></textarea>
					</div>


					<div class="large-4 columns">
						<div class='submit-form-section'>
							<button id='submit-button-registered' type="button" name="btnscholarship" class="schol-button next" onclick="ga('send', 'event', 'WMform', 'Click', 'Submit');">SUBMIT</button>
							<input type="hidden" name="task" value="addmeta" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>

	</div>
		<!-- subARS -->
	<div class='large-4 columns schol-sidebar' id='sidebar-basic'>
		<h4 class='schol-sidebar-heading'>RCKTSHP</h4>
		<p class='sidebar-schol'>is where businesses look for help on projects from students just like you.</p>
		<p class='sidebar-schol'>Do you know your way around Facebook, Twitter or Instagram?   Do you do any blogging and writing?  Design logos?  Know how to build a website using Wordpress or Squarespace?   </p>
		<p class='sidebar-schol'>Build your relevant work experience by working on projects from real employers, including:
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
		jQuery('#scholarship-entry-section').hide();
		jQuery('#already-registered-form').hide();

		jQuery('#oops').hide();

		jQuery('#heading4').hide();

	// move forward to sign up section
	jQuery('#show-signup-section').click(function(){
		jQuery(this).hide();
		jQuery('#heading').hide();
		jQuery('#signup-section').show();
		jQuery('#heading1').show();
		jQuery('#sidebar-basic').show();
		jQuery('#message').hide();
	});

	jQuery('#show-registered-form').click( function() {
		jQuery('#heading').hide();
		jQuery('#already-registered-form').show();
		jQuery('#sidebar-basic').show();
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
	jQuery('#submit-button-new').click(function(){

		if(jQuery('#email').val() == ''){
			alert("You need to enter your email address");
			return false;
		}
		else if(jQuery('#username').val() == ''){
			alert("You will need a username!");
			return false;
		}
		if(jQuery('#pwd1').val() == '' || jQuery('#pwd2').val() == ''){
			alert("You need a password");
			return false;
		}
		else if(jQuery('#province').val() == ''){
			alert("You need to pick a Province, Territory or State");
			return false;
		}
		else if(jQuery('#entry').val() == ''){
			alert("You didn't write anything!");
			return false;
		}
		else if(jQuery('#pwd1').val() != jQuery('#pwd2').val() ){
			alert("Passwords don't match");
			return false;
		}
		if(jQuery("#over18").prop('checked') !== true){
    		alert("You will have to agree to the RCKTSHP terms and conditions to be registered on the site.");
    		return false;
		}
		else{
 			jQuery('#registration-form').submit();
		}

	});

	jQuery('#submit-button-registered').click( function() {
		if(jQuery('#email-r').val() == ''){
			alert("You need to enter your email address");
			return false;
		}
		if(jQuery('#entry-reg').val() == ''){
			alert("You didn't write anything!");
			return false;
		}
		else{
			jQuery('#already-reg-form').submit();
		}
	});

	// upon successfull compltion of the registration
	jQuery(function(){
		var error = jQuery('.schol-error').text();
		if(error.indexOf('Congrats') >=0){
			jQuery('#heading').hide();
			jQuery('#form-section').hide();
			jQuery('#signup-section').hide();
			jQuery('#heading4').show();
			jQuery('#sidebar-basic').hide();
		}
		else if( error ){
			jQuery('#heading').hide();
			jQuery('#message').hide();
			jQuery('#oops').show();
		}
	});

</script>
