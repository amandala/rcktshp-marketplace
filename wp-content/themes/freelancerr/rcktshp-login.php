<form action="<?php echo appthemes_get_login_url( 'login_post' ); ?>" method="post" class="login-form" id="rcktshp-login-form">

    <fieldset>

        <div class="form-field">
            <label>
                <input type="text" name="log" class="text regular-text required" tabindex="2" id="login_username" value="" placeholder="User Name"/>
            </label>
        </div>

        <div class="form-field">
            <label>
                <input type="password" name="pwd" class="text regular-text required" tabindex="3" id="login_password" value="" placeholder="Password" />
            </label>
        </div>

        <div class="form-field" id="submit-button">
            <input class="button orange" tabindex="5" type="submit" id="login" name="login" value="<?php _e( 'Login', APP_TD ); ?>" />
            <?php

            if(isset($_SESSION['post_data'])){
                echo '<input type="hidden" name="redirect_to" value="'.site_url('post-a-project').'">';
            }
            else{
                echo APP_Login::redirect_field();
            }
            ?>
            <input type="hidden" name="testcookie" value="1" />
        </div>

        <div class="form-field" id="remember-me">
            <input type="checkbox" name="rememberme" class="checkbox" tabindex="4" id="rememberme" value="forever" />
            <label for="rememberme"><?php _e( 'Remember me', APP_TD ); ?></label>
        </div>



        <?php do_action( 'login_form' ); ?>

    </fieldset>

    <!-- autofocus the field -->
    <script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

</form>
