<?php
/*
Template Name: RCKTSHP Freelancer Landing
*/
?>

<div class="" id ="homepage-content">
    <div class="white-back">
        <div class="home-section large-10 push-1 columns">
            <div class="large-6 columns" id="home-signup">
                <div class="homepage-heading bold">
                    <h3 class="centered">Project opportunities for <br /> all types of professionals</h3>
                </div>
                <div class="">
                    <div class="auth-div home">
                        <h5>Find projects looking for help with websites, social media, and more.</h5>
                        <form action="<?php echo site_url();?>/freelancer-register" method="post" class="login-form register-form custom" name="registerform" id="login-form">
                            <fieldset>
                                <div class="row">
                                    <div class="form-field">
                                        <input tabindex="1" type="text" class="text required" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" placeholder="Name"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-field">
                                        <input tabindex="1" type="text" class="text required" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="form-field" id="cta-reg">
                                    <p class="small-text">By joining I agree to <a href="<?php echo site_url()?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
                                    <input type="hidden" name="redirect_to" value="<?php echo site_url() ?>/welcome-freelancer">
                                    <input  tabindex="30" type="submit" class="button orange" id="freelancer-reg" name="freelancer-reg" value="<?php _e( 'Get started for free!', APP_TD ); ?>" />
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="large-6 columns" id="home-image-freelancer">

            </div>
        </div>
    </div>

    <div class="grey-back">
        <div class="home-section large-10 push-1 columns">
            <div class='homepage-heading half'>
                <h3 class="centered">Join independent freelancers building rewarding careers doing what they love.</h3>
            </div>
            <div class="large-6 small-12 columns home-sat-wrapper">
                <div class="home-sat">
                    <div class="home-sat-q">
                        <p>With RCKTSHP, I was able to practice my skills, and gain experience all while finishing my degree. The countless connections I'v made have helped me start my own business. </p>
                    </div>
                    <div class="home-sat-q">
                        <div class="large-12 small-12 columns home-sat-w">
                            <h4>Amanda Haynes</h4>
                            <p>Web Developer</p>
                        </div>
                    </div>
                    <div class=" home-sat-i">
                        <img class="home-sat-img" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/home/amanda.png">
                    </div>
                </div>
            </div>
            <div class="large-6 small-12 columns home-sat-wrapper">
                <div class="home-sat">
                    <div class="home-sat-q sat">
                        <h4>Find paid project opportunities fitting your skill set to work on.</h4>
                        <h4>Build your reputation. Earn positive ratings and reviews to win more project opportunities.</h4>
                    </div>
                    <div class=" home-sat-i">
                        <img class="home-sat-img" id="home-sat-freelancer" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/home/freelancer-home.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="full-width-div  centered">
        <a class="button orange" href="<?php echo site_url()?>/projects">Browse Project Opportunities</a>
    </div>
</div>

<script>

    function divHeightResize() {
        //for the orange boxes
        var maxHeight = -1;
        //for the top sections (sign up and image)

        var heightto = jQuery('#home-signup').height();
        jQuery('#home-image').innerHeight(heightto);

    }


    jQuery(window).on("resize", divHeightResize);
    jQuery(document).on("ready", divHeightResize);
</script>
