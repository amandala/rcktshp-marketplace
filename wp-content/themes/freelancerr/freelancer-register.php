<?php
/*
* Template Name: Freelancer Register
*/
?>

<?php

$err = '';
$success = '';

global $wpdb, $PasswordHash, $current_user, $user_ID;

if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

    // Registration fields

    $pwd1 = $wpdb->escape(trim($_POST['pass1']));
    $pwd2 = $wpdb->escape(trim($_POST['pass2']));
    $email = $wpdb->escape(trim($_POST['email']));
    $email2 = $wpdb->escape(trim($_POST['email2']));
    $username = $wpdb->escape(trim($_POST['user_login']));
    $terms = $wpdb->escape(trim($_POST['terms']));
    $role = $_POST['role'];

    // Payments and Tax
    $province = $wpdb->escape(trim($_POST['province']));

    // check that all required fields are filled out
    if( $email == "" || $email2 == "" || $pwd1 == "" || $pwd2 == "" || $username == ""  ) {
        $err = 'You did not fill the form out entirely!';
    }
    if( $province == "" ) {
        $err = 'Province or State is mandatory';
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = $email . ' is not a valid email address.';
    }
    else if(email_exists($email) ) {
        $err = 'That email address has already been registered.';
    } else if($pwd1 <> $pwd2 ){
        $err = 'Passwords did not match.';
    }
    else if($terms !== 'yes') {
        $err =  'You can not sign up if you don\'t agree to the terms';
    }
    else {

        $user_id = wp_insert_user(
            array (
                'display_name' => $username,
                'user_pass' =>  $pwd1,
                'user_login' =>  $username,
                'user_email' =>  $email,
                'role' => $role ) );

        if( is_wp_error($user_id) ) {
            $err = 'That username is already in use. Please try another! ';
        } else {

            do_action('user_register', $user_id);
            $user = get_user_by('id', $user_id);

            wp_new_user_notification($user_id, '');

            $success = "Congrats! You're registered";

            // Payment and Tax
            update_user_meta($user_id, 'hrb_email', $hrb_email );
            update_usermeta( $user_id, 'province', $province );

            if( $_POST['terms'] != ''){
                update_usermeta( $user_id, 'terms', $_POST['terms'] );
            }
            update_usermeta( $user_id, 'newsletter', 'yes' );
        }
    }
}
?>

<div class='large-10 push-1 columns' id="form-freelancer-register">
    <div class="large-8 columns" id='form-section'>
        <!--display error/success message-->
        <div  class="large-12 columns" id="message">
            <?php
            if(! empty($err) ) :
                echo '<p class="error">'.$err.'';
            endif;
            ?>
            <?php
            if(! empty($success) ) :
                wp_redirect(site_url('welcome-freelancer'));
                exit;
            endif;
            ?>
        </div>

        <form method="post" id='form-register-freelancer'>
            <div id="signup-section">
                <fieldset>
                    <legend> Please complete all fields to register as a freelancer:</legend>
                    <h4 class='form-register-sec'>General</h4>
                    <div class="large-6 columns">
                        <p><input tabindex="1" type="text" name="user_login" id="user_login" placeholder="Username (for login)" value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];} ?>" /></p>
                        <p><input tabindex="2" type="text" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" /></p>
                        <p><input tabindex="3" type="text"  name="email2" id="email2" placeholder="Confirm Email" value="<?php if(isset($_POST['email'])){echo $_POST['email2'];} ?>"/></p>
                    </div>
                    <div class="large-6 columns">
                        <p><input tabindex="4" type="password" name="pass1" id="pass1" placeholder="Password"/></p>
                        <p><input tabindex="5" type="password"  name="pass2" id="pass2" placeholder="Confirm Password" /></p>
                    </div>

                    <h4 class='large-12 columns form-register-sec'>Province/State of Residence</h4>
                    <div class="large-6 columns">
                        <select tabindex="6" id="province" class="input" type="text" name="province">
                            <option value="">Select Location</option>
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
                    <div class="large-12 columns"><p class="small grey">Used to calculate tax in your location when you complete a project.</p></div>

                    <div style="display: none;" class="large-4 small-12 columns form-field user-role-type">
                        <label class='scol-label'>Your role on RCKTSHP<i class="fa fa-question-circle" id='paypal-tooltip' title='We use PayPal because it’s a free, simple, and safe method of transferring payments. Please provide the email address that you use to sign in to your PayPal account, to ensure payments can be sent and received accordingly. '></i></label>
                        <select  name="role">
                            <option value="<?php echo esc_attr( HRB_ROLE_FREELANCER ); ?>"><?php echo __( 'Freelancer', APP_TD ); ?></option>
                        </select>
                    </div>
                    <hr class="register" />
                    <div class="large-12 columns">
                        <input tabindex="7" type="checkbox" value="yes" name="terms" id="terms"/> <span id='yes'>Yes, I am over 18 and agree to the RCKTSHP <a href=''>Terms and Conditions </a></span><i class="fa fa-question-circle" id='paypal-tooltip' title='We require users of the site to be at least 18 years of age.'></i>
                    </div>
                    <div class="large-12 columns"><p class="small grey">By joining I agree to receive emails from RCTKSHP.</p></div>
                    <div class="large-12 columns centered">
                        <button  tabindex="8" id='submit-button' type="submit" name="btnregister" class="button orange" >Join RCKTSHP</button>
                        <input type="hidden" name="task" value="register" />
                    </div>
                </fieldset>


            </div>
        </form>
    </div>
    <div class="large-4 columns sidebar-howto">
        <div class="package-form-sidebar" id="help-sidebar">
            <p>Need help? <span>Email us at <a href="mailto:help@rctkshp.com?subject=Need help posting a project">help@rcktshp.com</a></span></p>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready( function(){
        var user_login = "<?php echo $_POST['user_login']; ?>";
        var user_email = "<?php echo $_POST['user_email']; ?>";

        jQuery('#user_login').val(user_login);
        jQuery('#email').val(user_email);
        jQuery('#email2').val(user_email);
    });
</script>