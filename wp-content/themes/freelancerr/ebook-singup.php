<?php
/**
* Template Name: Ebook Sign Up Page
*/
?><?php
    $post_meta = get_post_meta($post->ID);
    $bytes = openssl_random_pseudo_bytes(4);
    $pwd = bin2hex($bytes);

    if(is_user_logged_in()){
        if($post_meta['download-link'] !== ''){

            $url = site_url($post_meta['download-link'][0]);
            wp_redirect( $url );
            exit;
        }

    }

    if(isset($_POST['task']) && $_POST['task'] == 'register-ebook' ) {
        $pwd1 = $wpdb->escape(trim($_POST['pass1']));
        $first_name = $wpdb->escape(trim($_POST['first_name']));
        $last_name = $wpdb->escape(trim($_POST['last_name']));
        $username = $first_name . $last_name;
        $email = $wpdb->escape(trim($_POST['user_email']));
        $website = $wpdb->escape(trim($_POST['user_url']));
        $role = $_POST['role'];


        if( email_exists($email)){
            $err = "That email address is already registered on RCKTSHP. <a href='<?php echo site_url(); ?>/login'>Sign in</a> with your account for access to all our free ebooks.";
        }
        else{
            $user_id = wp_insert_user(
                array('first_name' => apply_filters('pre_user_first_name', $first_name),
                    'last_name' => apply_filters('pre_user_last_name', $last_name),
                    'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
                    'user_login' => apply_filters('pre_user_user_login', $username),
                    'user_email' => apply_filters('pre_user_user_email', $email),
                    'user_url' => $website,
                    'role' => $role));

            if (is_wp_error($user_id)) {
                $err = 'That username is already in use. We are creating a username for you by combining your first and last names. Try adding a number to the end of your last name. ';
            } else {
                $err = 'Success.... redirecting';

                ebook_welcome_email($user_id);

                update_user_meta($user_id, 'ebook_signup', $post_meta['ebook-name'][0]);
                header("Refresh:0");
            }
        }


    }
?>

<div class="large-10 push-1 columns" id="ebook-page">
    <?php while ( have_posts() ) : the_post(); ?>


        <div class="ebook-title-wrapper">
            <h3 class=><?php echo $post_meta['title'][0] ?></h3>
            <h3 class="bold"><?php echo $post_meta['subtitle'][0] ?></h3>
        </div>
        <div id="ebook-content-wrapper">
            <div class="large-8 medium-12 small-12 columns" id="ebook-content">
                <?php echo the_post_thumbnail( 50, "id=ebook-img" ); ?>
                <p><?php the_content(); ?></p>
            </div>
            <div class="large-4 medium-12  small-12 columns" id=ebook-form>
                <div class="auth-div" id="ebook">
                    <h5 class="centered"><?php echo $post_meta['form-title'][0] ?></h5>

                    <form method="post" name="ebook_reg">
                        <?php
                        if($err !== NULL){ echo '<span class="alert-box error"> ' . $err . '</span>';} ?>
                        <fieldset>
                            <div class="row">
                                <div class="form-field">
                                    <input tabindex="1" type="text" class="text required" name="first_name" id="first_name" value="<?php if (isset($_POST['first_name'])) echo esc_attr(stripslashes($_POST['first_name'])); ?>" placeholder="First Name *"/>
                                </div>
                                <div class="form-field">
                                    <input tabindex="1" type="text" class="text required" name="last_name" id="last_name" value="<?php if (isset($_POST['last_name'])) echo esc_attr(stripslashes($_POST['last_name'])); ?>" placeholder="Last Name *"/>
                                </div>
                                <div class="form-field">
                                    <input tabindex="2" type="text" class="text required email" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" placeholder="Email *"/>
                                </div>
                                <div class="form-field">
                                    <input tabindex="2" type="text" class="text" name="user_url" id="user_url" value="<?php if (isset($_POST['user_url'])) echo esc_attr(stripslashes($_POST['user_url'])); ?>" placeholder="URL (optional)"/>
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
                            </div>

                            <div class="row" >
                                <div class="large-12 small-12 columns form-field user-role-type">
                                  <span>I am a:</span> <select name="role">
                                        <option value="<?php echo esc_attr( HRB_ROLE_EMPLOYER ); ?>" selected="selected"><?php echo __( 'Small Business', APP_TD ); ?></option>
                                        <option value="<?php echo esc_attr( HRB_ROLE_FREELANCER ); ?>"><?php echo __( 'Freelancer', APP_TD ); ?></option>
                                        <?php if ( $hrb_options->share_roles_caps ): ?>
                                            <option value="<?php echo esc_attr( HRB_ROLE_BOTH ); ?>"/> <?php echo __( 'Both', APP_TD ) ?></option>
                                        <?php endif; ?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-field" id="cta-reg">
                                <p class="small-text">By joining I agree to <a href="<?php echo site_url()?>/terms">site terms</a> and to receive emails from RCKTSHP</p>
                                <input type="hidden" name="redirect_to" value="<?php echo site_url() ?>/<?php echo $download_link ?> ">
                                <input  tabindex="30" type="submit" class="button orange" id="register" name="register" value="<?php _e( 'Download', APP_TD ); ?>" />
                                <input type="hidden" name="task" value="register-ebook" />
                            </div>

                        </fieldset>

                    </form>

                    <?php
                    //rcktshp_custom_registration_ebook($post_meta['download-link'][0]);
                    //if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( $post_meta['form'][0] ); }  ?>
                </div>
            </div>
        </div>
    <?php endwhile; // end of the loop. ?>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('input[type=submit]').addClass('button orange');
    });
</script>