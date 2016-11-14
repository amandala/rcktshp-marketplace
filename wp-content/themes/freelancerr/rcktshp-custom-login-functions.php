<?php


function callback($buffer) {
	// You can modify $buffer here, and then return the updated code
	return $buffer;
}
function buffer_start() { ob_start("callback"); }
function buffer_end() { ob_end_flush(); }
// Add hooks for output buffering
add_action('init', 'buffer_start');
add_action('wp_footer', 'buffer_end');


/*****************/
/* Custom Login  */
/****************/

// Remove session data and destroy session for package builder
// Hooks into: wp_logout

function kill_session_data(){
	session_start('package');

	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	session_destroy();
}

add_action('wp_logout', 'kill_session_data');

function packages_registration_form( ) {

	$bytes = openssl_random_pseudo_bytes(4);

	$pwd = bin2hex($bytes);

	global $err;
	if($err){
		echo '<span class="reg-error">'. $err . '</span>';
	}

	?>
	<form action="<?php echo appthemes_get_registration_url( 'login_post' ); ?>" method="post" class="login-form register-form custom" name="registerform" id="login-form">
		<fieldset>
			<div class="row">
				<div class="form-field">
					<input tabindex="1" type="text" class="text required" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" placeholder="Business Name"/>
				</div>

				<div class="form-field">
					<input tabindex="2" type="text" class="text required email" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" placeholder="Business Email"/>
				</div>
			</div>

			<div id="custom-reg-password" style="display: none;">
				<div class="row">
					<div class="large-6 columns form-field">
						<label><?php _e( 'Password:', APP_TD ); ?></label>
						<input tabindex="3" type="password" class="text required" name="pass1" id="pass1" value="<?php echo $pwd ?>" autocomplete="off" />
					</div>

					<div class="large-6 columns form-field">
						<label><?php _e( 'Password Again:', APP_TD ); ?></label>
						<input tabindex="4" type="password" class="text required" name="pass2" id="pass2" value="<?php echo $pwd ?>" autocomplete="off" />
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns form-field">
						<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', APP_TD ); ?></div>
						<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?></p>
					</div>
				</div>
				<div style="display: none;">
					<div class="row" >
						<div class="large-4 small-12 columns form-field user-role-type">

							<select name="role">
								<option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Employer', APP_TD ); ?></option>
							</select>

						</div>
					</div>
				</div>
			</div>

			<div class="form-field" id="cta-reg">
				<p class="small-text">By joining I agree to <a href="<?php echo site_url()?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
				<input type="hidden" name="redirect_to" value="<?php echo site_url() ?>/welcome">
				<input  tabindex="30" type="submit" class="button orange" id="register" name="register" value="<?php _e( 'Get started for free!', APP_TD ); ?>" />
				<input type="hidden" name="task" value="register" />
			</div>


		</fieldset>

	</form>

	<?php
}


function rcktshp_custom_registration_vars( $package_vars ) {
	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		// sanitize user form input
		global  $err, $password, $email, $username;



		$username	= 	sanitize_user($_POST['user_login']);
		$username = strtolower(str_replace(" ", "", $username ));
		$password 	= 	esc_attr($_POST['pass1']);
		$email 		= 	sanitize_email($_POST['user_email']);



		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = $email . ' is not a valid email address.';
		}
		else if(email_exists($email) ) {
			$err = 'Email already registered. <a href="'.site_url().'/login">Login</a>';
		}
		else if(username_exists($username)){
			$err = "That username is already in use. <a href=\"'.site_url().'/login\">Login</a>";
		}
		else{

			$id = packages_create_user($username, $password, $email, "employer");

		}

	}

	packages_registration_form_vars( $package_vars );
}


function rcktshp_custom_registration() {
	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		// sanitize user form input
		global  $err, $password, $email, $username;


		$username	= 	sanitize_user($_POST['user_login']);
		$username = strtolower(str_replace(" ", "", $username ));
		$password 	= 	esc_attr($_POST['pass1']);
		$email 		= 	sanitize_email($_POST['user_email']);



		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = $email . 'That is not a valid email address.';
		}
		else if(email_exists($email) ) {
			$err = 'Email already registered. <a href="'.site_url().'/login">Login</a>';
		}
		else if(username_exists($username)){
			$err = "That username is already in use. <a href=\"'.site_url().'/login\">Login</a>";
		}
		else{
			$id = packages_create_user($username, $password, $email, "employer_freelancer");
		}
	}
	packages_registration_form();
}

function packages_create_user($username, $password, $email, $role){

	$userdata = array(
		'user_login'  => $username,
		'user_email'    =>  $email,
		'user_pass'   => $password,
		'role'		=> $role
	);

	$user_id = wp_insert_user($userdata);

	do_action('user_register', $user_id);

}

//hooks into the user_register action to log a user in after registering
function auto_login_new_user( $user_id ) {
	wp_set_current_user($user_id);
	wp_set_auth_cookie($user_id);

	session_start('package');
	$package_deets = $_SESSION['post_data'];

	$referer = wp_get_referer();

}
add_action( 'user_register', 'auto_login_new_user' );
// TODO decide if you need this anymore


function packages_registration_form_vars( $package_vars ) {
	echo '
    <style>
	div {
		margin-bottom:2px;
	}

	input{
		margin-bottom:4px;
	}
	</style>
	';

	$bytes = openssl_random_pseudo_bytes(4);

	$pwd = bin2hex($bytes);

	global $err;
	if($err){
		echo '<span class="reg-error">'. $err . '</span>';
	}

	?>
	<form method="post" action="<?php echo appthemes_get_registration_url( 'login_post' ); ?>" class="login-form register-form custom" name="registerform" id="login-form">
		<?php
		foreach( $package_vars as $key => $value){ ?>
			<input type="hidden" name="<?php echo $key?>" value="<?php echo $value ?>">
			<?php
		}
		?>
		<fieldset>
			<div class="row">
				<div class="form-field">
					<input tabindex="1" type="text" class="text required" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" placeholder="Business Name"/>
				</div>

				<div class="form-field">
					<input tabindex="2" type="text" class="text required email" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" placeholder="Business Email"/>
				</div>
			</div>

			<div id="custom-reg-password" style="display: none;">
				<div class="row">
					<div class="large-6 columns form-field">
						<label><?php _e( 'Password:', APP_TD ); ?></label>
						<input tabindex="3" type="password" class="text required" name="pass1" id="pass1" value="<?php echo $pwd ?>" autocomplete="off" />
					</div>

					<div class="large-6 columns form-field">
						<label><?php _e( 'Password Again:', APP_TD ); ?></label>
						<input tabindex="4" type="password" class="text required" name="pass2" id="pass2" value="<?php echo $pwd ?>" autocomplete="off" />
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns form-field">
						<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', APP_TD ); ?></div>
						<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?></p>
					</div>
				</div>
				<div style="display: none;">
					<div class="row" >
						<div class="large-4 small-12 columns form-field user-role-type">

							<select name="role">
								<option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Employer', APP_TD ); ?></option>
							</select>

						</div>
					</div>
				</div>
			</div>



			<div class="form-field right">
				<input type="hidden" name="redirect_to" value=<?php echo site_url()?>"/rcktshp-marketplace/post-a-project/">
				<input  tabindex="30" type="submit" class="button orange" id="register" name="register" value="<?php _e( 'Next Step', APP_TD ); ?>" />
				<input type="hidden" name="task" value="register" />
			</div>


		</fieldset>

	</form>
	<?php
}



function complete_registration() {
	global $reg_errors, $username, $password, $email;
	if ( count($reg_errors->get_error_messages()) < 1 ) {
		$userdata = array(
			'user_login'	=> 	$username,
			'user_email' 	=> 	$email,
			'user_pass' 	=> 	$password,
			'role'          => 'employer'
		);
		$user = wp_insert_user( $userdata );
		if( is_wp_error($user) ) {
			echo 'Error on user creation.';
		} else {
			do_action('user_register', $user);
		}
	}
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
	ob_start();
	custom_registration_function();
	return ob_get_clean();
}


function rcktshp_custom_login_packages(){
	?>
	<form action="<?php echo appthemes_get_login_url( 'login_post' ); ?>" method="post" class="login-form" id="login-form">

		<fieldset>

			<div class="form-field">
				<label><?php _e( 'Username:', APP_TD ); ?>
					<input type="text" name="log" class="text regular-text required" tabindex="2" id="login_username" value="" />
				</label>
			</div>

			<div class="form-field">
				<label>
					<?php _e( 'Password:', APP_TD ); ?>
					<input type="password" name="pwd" class="text regular-text required" tabindex="3" id="login_password" value="" />
				</label>
			</div>

			<div class="form-field">
				<input tabindex="5" type="submit" id="login" name="login" value="<?php _e( 'Login', APP_TD ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php echo site_url()?>/post-a-project/">
				<input type="hidden" name="testcookie" value="1" />
			</div>

			<div class="form-field">
				<input type="checkbox" name="rememberme" class="checkbox" tabindex="4" id="rememberme" value="forever" />
				<label for="rememberme"><?php _e( 'Remember me', APP_TD ); ?></label>
			</div>

			<div class="form-field">
				<a href="<?php echo appthemes_get_password_recovery_url(); ?>"><?php _e( 'Lost your password?', APP_TD ); ?></a>
			</div>

			<?php wp_register( '<div class="form-field" id="register">', '</div>' ); ?>

			<?php // add back to make custom login fields do_action( 'login_form' ); ?>
		</fieldset>

		<!-- autofocus the field -->
		<script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

	</form>

	<?php
}

