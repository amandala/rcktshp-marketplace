<?php
/**
Template Name: Package Register
 **/
?>


<?php
$package_vars = array();
foreach($_POST as $key => $val){
    $package_vars[$key] = $val;
}
session_start();
$_SESSION['post_data'] = $_POST;


//if the user is already logged in, redirect them to the post a project page
if ( is_user_logged_in() ) { redirect(site_url(). '/post-a-project' ) ;}
?>


<div class="large-10 push-1 columns">
    <div class="large-8 columns">
        <div class="package-builder-steps">
            <img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/packages/step1.png">
        </div>
        <div class="auth-div" >
            <h5>Tell us about your business.</h5>
            <?php

            rcktshp_custom_registration_vars( $package_vars );

            ?>
        </div>

        <div class="auth-div white" id="forgot">
            <div class="forgot-link">
                <p class="small-text">By joining I agree to <a href="<?php echo site_url() ?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
            </div>
            <div class="forgot-link">
                <span>Have you already completed this step? </span><a href="<?php echo site_url(); ?>/login?redirect_to=<?php echo site_url()?>/post-a-project" >Login to your account</a>
            </div>
        </div>
    </div>
    <div class="large-4 columns sidebar-howto">
        <div class="package-form-sidebar" id="help-sidebar">
            <p>Need help? <span>Email us at <a href="mailto:help@rctkshp.com?subject=Need help posting a project">help@rcktshp.com</a></span></p>
        </div>
        <div class="package-form-sidebar" id="help-sidebar">
            <p>Already have a RCKTSHP account? <span><a href="<?php echo site_url('login'); ?>">Login Now</a></span></p>
        </div>
    </div>
</div>




