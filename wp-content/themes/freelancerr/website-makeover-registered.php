<?php
/*
Template Name: Website Makeover - Registered
*/
?>
<?php

if(isset($_POST['email'])){

	if(isset($_POST['entry'])){
		$user = get_user_by('email',$_POST['email'] );
		$entry = $wpdb->escape(trim($_POST['entry']));
		$entry = str_replace('"', "'", $entry);
		$entry = stripslashes($entry);

			//var_dump($user);

		if($user){
			$user_id = $user->ID;
			update_user_meta( $user_id, 'scholarship_entry_web_makeover', $entry);
			update_usermeta( $user_id, 'scholarship', 'Web Makeover' );
			$err = 'Congrats';
		}
		else{
			$err = "That email didn't seem to work. Make sure you use the email that you signed up with";
		}

		$email_subject = 'Thank you for applying to The Web Makeover Scholarship';
		$email_content = "<p>Hello, ".  $_POST['first_name'] . "</p>
		<p>Your scholarship application was successfully received.</p>
					<p>The winner of the The Web Makeover Scholarship will be announced shortly after the contest closes November 30, 2015 at 11:59 P.M EST.</p>
					<p>Now that you've successfully entered here's what you can do:
						<ul>
							<li>Post on the<a href='www.facebook.com/rcktshp/' target='_blank'>RCKTSHP Facebook</a> page or Post a Tweet on Twitter (link target=_blank).   Tag each small business nomination and use the following: <em>I nominate @XYZ_business for a Website Makeover sponsored by RCKTSHP. #SupportSmallBusiness</em></li>
							<li>Login to your account and make sure you have a profile picture </li>
							<li>Make sure you fill out your profile as best you can. All profiles will be reviewed, and preference will be given to those with a complete profile!</li>
							<li><a href='". site_url()."/projects/''>Browse projects</a> on our job postings board</li>
							<li>Submit proposals to apply for project work using your credits </li>
						</ul>
					</p>
					<p>We've added 10 free credits to your account to help you get on your way.</p>";

		rcktshp_custom_email($_POST['email'], $email_subject,  $email_content);
		$user_data = $user->data;

		$user_email = $user_data->user_email;
		$email_to_b = $user_email ." submitted the following:" . $entry;

		rcktshp_custom_email('bbutchart@madebyuppercut.com', 'New Website Makeover entry', $email_to_b);

	}
	else{
		$err = 'You should submit <em>something</em> if you want to be considered';
	}
}
?>

<div class='large-10 push-1 columns' id='scholarship-banner'>
	<img style="width:100%;" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/scholarship/WMbanner.jpg">
	<a name="banner"></a>

	<div class="form-greeting" id="greeting">

	</div>
	<?php if ( function_exists('sharethis_button') && $hrb_options->listing_sharethis ): ?>
		<div class="row share-this" id="reg-form-share">
			<div class="large-12 columns">
				<div><?php sharethis_button(); ?></div>
			</div>
		</div>
	<?php endif; ?>
</div>


	<div class="large-10 push-1 columns form-greeting" id ="oops">
		<h3 class="greeting">Oops! Something went wrong.</h3>
		<p class='instruction pad'>Please use the email address you signed up for RCKTSHP with</p>
		<p class='instruction pad'>If you keep having trouble, please <a href="<?php echo site_url()?>/contact/">contact us!</a></a></p>

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
			<button id="try-again" class='schol-button center' type="button" >TRY AGAIN</button>
		</div>
	</div>



	<div class="large-10 push-1 columns form-greeting" id ="heading4">
		<h3 class="greeting">Congratulations!</h3>
		<p class='instruction'>You've successfully entered The Web Makeover Schoalarship</p>
		<p class='instruction'>In order to be qualified,  You need to fill out your user profile as best you can. Remember to log in and add a profile picture, a description of your skills and interests, your educational background, work experience and some skills!</p>
		<div class=' next-button-section centered-wrapper'>
				<button id="login-button" class='schol-button center' type="button" onclick="ga('send', 'event', 'WMform', 'Click', 'Login'); location.href = '<?php echo site_url() ?>/edit-profile/';">LOG IN NOW!</button>
		</div>
	</div>



<div class='large-10 push-1 columns' id='heading-show-us'>
	<div class='large-8 columns' id='scholarship-signup-already-registered'>
		<div id="scholarship-entry-section">
			<!--display error/success message-->
			<form method="post" action="" id="already-reg-form">
				<fieldset class="scholarship-section" >
					<?php
					if(! empty($err)){
						echo '<p class="schol-error">'.$err . '</p>';
					}
					?>

					<legend class="scol-legend">Show us your stuff!</legend>

					<div class="large-6 columns">
						<label for="mail">E-mail:</label>
						<input type="email" id="mail" name="email" />
					</div>
					<div class="large-12 columns">

						<label class='scol-label'>Nominate three small businesses in need of a website makeover. In under 200 words tell us why they’re deserving.</label>
						<textarea class="text regular-text valid" value="" name="entry" id="entry" rows="20" cols="20" aria-invalid="false" style="height:200px"/></textarea>
					</div>


					<div class="large-4 columns">
						<div class='submit-form-section'>
							<button id='already-reg-submit' type="button" name="btnscholarship" class="schol-button next" onclick="ga('send', 'event', 'WMform', 'Click', 'Submit');">SUBMIT</button>
							<input type="hidden" name="task" value="addmeta" />
						</div>
					</div>
				</fieldset>
			</form>

		</div>
	</div>
	<div class='large-4 columns schol-sidebar' id='sidebar-basic'>
		<h4 class='schol-sidebar-heading'>Make it count</h4>
		<p class='sidebar-schol'>In order to have your entry considered, you need to ensure your freelancer profile is filled out as completely as possible.</p>
		<p class='sidebar-schol'>Once you're done, log in and confirm that your profile has:
		<ul id='sidebar-list' class='sidebar-schol'>
			<li>A profile picture</li>
			<li>A description of your skills and talents</li>
			<li>Education and work experience information</li>
			<li>Relevant volunteer, awards, and membership information</li>
		</ul>
		</p>
	</div>
</div>


<script type="text/javascript">

	jQuery('#oops').hide();
	jQuery('#heading4').hide();


	jQuery('#already-reg-submit').click(function(){
		jQuery('#heading').hide();
		jQuery('#already-reg-form').submit();
	});

	// move forward to sign up section
	jQuery('#try-again').click(function(){
		jQuery(this).hide();
		jQuery('#oops').hide();
		jQuery('#greeting').show();
		jQuery('#heading').show();
		jQuery('#heading-show-us').show();

	});


	// upon successfull compltion of the registration
	jQuery(function(){
		var error = jQuery('.schol-error').text();
		if(error.indexOf('Congrats') >=0){
			jQuery('#heading').hide();
			jQuery('#greeting').hide();
			jQuery('#scholarship-entry-section').hide();
			jQuery('#signup-section').hide();
			jQuery('#heading4').show();
			jQuery('#sidebar-basic').hide();
		}
		else if( error ){
			jQuery('#greeting').hide();
			jQuery('#heading-show-us').hide();
			jQuery('#message').hide();
			jQuery('#oops').show();
			jQuery('#show-us-your-stuff').hide();
		}

	});

</script>
