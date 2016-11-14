<?php
/*
Template Name: RCKTSHP Welcome
*/
?>
<?php if ( !is_user_logged_in() ) {
    auth_redirect();
}; ?>

<div class="full-width-div">
    <h3 class="centered">Welcome to the RCKTSHP Community.</h3>
    <p class="welcome margin centered">Thanks for registering on RCKTSHP.com where small businesses grow online. We have experts who can help get your business online, show up in Google, and market your business on social media.</p>
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
                <a id="social-button-welcome" target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: 'Website' });" target="_blank"  href="/http://www.rcktshp.com/wp-content/uploads/2016/02/RCKTSHP-Web-Development-eBook-Final.pdf" ><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a>
            </li>
        </ul>
    </div>
</div>
<div class="full-width-div">
    <div class="large-10 push-1 columns">
        <h3 class="centered">What does your small business need help with?</h3>
        <div class="tile-wrapper row">
            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
                <li>
                    <a href="<?php echo site_url(); ?>/website-packages">
                        <div class="tile">
                            <h3>Business<br /> Websites</h3>
                            <p>From $99</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/social-media-packages">
                        <div class="tile">
                            <h3>Social Media & Marketing</h3>
                            <p>From $350</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/blog-packages">
                        <div class="tile">
                            <h3>Blog Content <br /> Generation</h3>
                            <p>Starting from $89</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/post-a-project">
                        <div class="tile">
                            <h3>Custom <br />Project</h3>
                            <p>You set the budget</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="full-width-div">
    <h3 class="centered">Need some guidance?</h3>
    <p class="centered bold no-margin">Visit <a href="<?php echo site_url();?>/how-it-works">How it Works</a>, <a href="<?php echo site_url();?>/faq">FAQ</a>, or feel free to <a href="mailto:hello@rcktshp.com">Contact Us</a>.</p>
</div>
<div class="full-width-div">
    <h3 class="centered">DIY tutorials to grow your business online:</h3>
    <div class="tile-wrapper row">
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/tutorials/getting-your-business-on-google-my-business/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-seo.png">
                    <p>Get your business listing on Google</p>
                </div>
            </a>
        </div>
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/series/social-media/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-sm.png">
                    <p>Find new customers on social media</p>
                </div>
            </a>
        </div>
        <div class="large-4 columns">
            <a href="<?php echo site_url(); ?>/tutorials/wordpress-website-small-business/">
                <div class="tile white">
                    <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/tuts-website.png">
                    <p>Learn to build your business website</p>
                </div>
            </a>
        </div>
    </div>
</div>



