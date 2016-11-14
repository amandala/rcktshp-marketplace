<?php
/*
Template Name: RCKTSHP Welcome Freelancer
*/
?>
<?php if ( !is_user_logged_in() ) {
    auth_redirect();
}; ?>

<div class="full-width-div">
    <h3 class="centered">Welcome to the RCKTSHP Community.</h3>
    <p class="centered margin">Thanks for registering on RCKTSHP.com. We have projects from business websites to social media and more to help grow your freelancing skills. <a href="<?php echo site_url(); ?>/edit-profile">Edit your profile</a> to impress potential clients on RCKTSHP.</p>
</div>
<div class="full-width-div">
    <h3 class="centered">Free Ebook Download<h3>
            <p class="welcome margin centered">Other ebooks tell you everything you should do.  Ours include step-by-step tutorials to show you how to do, what you should do.</p>
            <div class="large-10 push-1 columns">
                <ul class="small-block-grid-2" id="welcome-ebook-download">
                    <li>
                        <img id="social-image-welcome" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/complete-guide-social-image.jpg"><br />
                        <a id="social-button-welcome" target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: 'Social' });" target="_blank"  href="https://www.rcktshp.com/wp-content/uploads/2016/01/RCKTSHP-Social-Media-eBook.pdf" ><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a>
                    </li>
                    <li>
                        <img id="social-image-welcome" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/complete-guide-website-image.jpg"><br />
                        <a id="social-button-welcome" target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: 'Website' });" target="_blank"  href="https://www.rcktshp.com/wp-content/uploads/2016/02/RCKTSHP-Web-Development-eBook-Final.pdf" ><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a>
                    </li>
                </ul>
            </div>
</div>
<div class="full-width-div centered">
    <h3 class="centered">Start expanding your professional portfolio right now!</h3>
    <a href="<?php echo site_url();?>/projects" class="button orange">Browse Project Opportunities</a>
</div>
<div class="full-width-div">
    <h3 class="centered">Need some guidance?</h3>
    <p class="centered bold no-margin">Visit <a href="<?php echo site_url();?>/how-it-works">How it Works</a>, <a href="<?php echo site_url();?>/faq">FAQ</a>, or feel free to <a href="mailto:hello@rcktshp.com">Contact Us</a>.</p>
</div>
<div class="full-width-div">
    <h3 class="centered">Tutorials to expand your skills:</h3>
    <div class="tile-wrapper row">
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/tutorials/getting-your-business-on-google-my-business/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-seo.png">
                    <p>Posting business listings on Google</p>
                </div>
            </a>
        </div>
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/series/social-media/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-sm.png">
                    <p>Expanding customer reach on social media</p>
                </div>
            </a>
        </div>
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/tutorials/wordpress-website-small-business/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-website.png">
                    <p>Building Wordpress Websites</p>
                </div>
            </a>
        </div>
    </div>
</div>



