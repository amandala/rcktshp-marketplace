<?php
/**
Template Name: Main Register
 **/
?>

<?php
//if the user is already logged in, redirect them to the post a project page
if ( is_user_logged_in() ) { redirect(site_url(). '/welcome' ) ;}
?>

<div class="large-10 push-1 columns">
    <div class="large-9 push-1 columns">
        <div class="auth-div" id="register">
            <h5>Tell us about your business.</h5>
            <?php

            rcktshp_custom_registration( );

            ?>
        </div>

        <div class="auth-div white" id="forgot">
            <div class="forgot-link">
                <p class="small-text">By joining I agree to <a href="<?php echo site_url() ?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
            </div>
            <div class="forgot-link">
                <span>Have you already completed this step? </span><a href="<?php echo site_url(); ?>/login?redirect_to=<?php echo site_url()?>/welcome" >Login to your account</a>
            </div>
        </div>
    </div>
    <div class="large-2 pull-1 columns sidebar-howto">
        <div class="package-form-sidebar" id="help-sidebar">
            <p>Need help? <span>Email us at <a href="mailto:help@rctkshp.com?subject=Need help posting a project">help@rcktshp.com</a></span></p>
        </div>
    </div>
</div>




