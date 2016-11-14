<?php
/*
Plugin Name: Email Customizer
Plugin URI: 
Description: I created this plugin to rule the world via awesome WordPress email goodness
Version: 1.0
Author: Amanda Haynes
Author URI: 
*/

?>
<?php
add_filter ("wp_mail_content_type", "email_customizer_type");
function email_customizer_type() {
	return "text/html";
}

	
if (!function_exists('wp_new_user_notification')){
    function wp_new_user_notification($user_id, $plaintext_pass) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        $user_meta = get_user_meta($user_id);
        $user_role = $user_meta['edfg_capabilities'];

        $email_subject = "Welcome to RCKTSHP! ";


        ob_start();

        include("email_header.php");
            if( strpos($user_role[0], 'employer_freelancer') !== false || strpos($user_role[0], 'employer') !== false ){
                ?>
                 <p>Welcome <?php echo $user->display_name ?></p>
                 <p>Thank you for joining RCKTSHP, we're very excited to have you on board.</p>
                 <ol>
                    <li>Upload your business logo and add a description of your business to your <a style="color:#F25926" href="<?php echo site_url() ?>/edit-profile/">profile</a>: </li>
                    <li>Choose a <a style="color:#F25926" href="<?php echo site_url(); ?>/website-packages">Website</a> or <a style="color:#F25926" href="<?php echo site_url(); ?>/social-media-packages">Social Media package</a> or  Post a <a style="color:#F25926" href="<?php echo site_url();?>/post-a-project"> custom project</a> with ease.</li>
                 </ol>
				 <p><b>Download our free ebooks:</b></p>
				 <p>The Complete Guide to Social Media for Small Business <a style="color:#F25926" href="https://www.rcktshp.com/social-media-download-page/">Here</a></p>
				 <p>The Complete Guide to Websites for Small Business <a style="color:#F25926" href="https://www.rcktshp.com/website-download-page/">Here</a></p>
                 <p>If you have any questions please visit our <a style="color:#F25926" href="<?php echo site_url() ?>/faq/">FAQ</a> or feel free to contact us.</p>
                 <p>Below are your login credentials. Please keep them in a safe place to ensure the security of your account.</p>
                 <p>Your username is <strong style="color:#EF5A32"><?php echo $user_login ?></strong><br />
                <?php
            }
            else if ( strpos($user_role[0], 'freelancer') !== false  ){
                ?>
                 <p>Welcome <?php echo $user->display_name ?></p>
                 <p>Thank you for joining RCKTSHP, we're very excited to have you on board.</p>

				<p><b>Download our free ebooks:</b></p>
				<p>The Complete Guide to Social Media for Small Business <a style="color:#F25926" href="https://www.rcktshp.com/social-media-download-page/">Here</a></p>
				<p>The Complete Guide to Websites for Small Business <a style="color:#F25926" href="https://www.rcktshp.com/website-download-page/">Here</a></p>

                 <ol>
                    <li>Start adding your skills and experience to to your <a style="color:#F25926" href="<?php echo site_url() ?>/edit-profile/">profile</a>: </li>
                    <li>Find work on our <a style="color:#EF5A32" href="<?php echo site_url() ?>/projects/">project opportunity listing</a></li>
                    <li>Submit proposals to apply for project work. Credits are used to apply for projects.</li>
                 </ol>
                 <p>We've added 5 free credits to your account to help you get on your way.</p>
                 <p>If you have any questions please visit our <a style="color:#F25926" href="<?php echo site_url() ?>/faq/">FAQ</a> or feel free to <a style="color:#F25926" href="mailto:hello@rcktshp.com">contact us</a>.</p>
              <p>Below are your login credentials. Please keep them in a safe place to ensure the security of your account.</p>

                <p>Your username is <strong style="color:#27b7c0"><?php echo $user_login ?></strong><br />

                <?php
            }
        ?>

        <?php
        include("email_footer.php");

        $message = ob_get_contents();
        ob_end_clean();

        wp_mail($user_email, $email_subject, $message);
    }
}





?>