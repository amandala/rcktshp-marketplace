<?php
/**
Template Name: Packages - Feature Website
 **/
?>

<div class="row">
    <div class="full-width-div">
        <h3 class="centered" id="feature-package-heading">Single Page Small Business Website</h3>

        <div class="large-6 columns">
            <p>Single-page websites are a current design trend for small businesses.<p>
            <p>With most people browsing the web using their smart phone, a responsive, single page website really shines with beautifully designed short sections:
                <ul><li>About Company</li>
                <li>Hours of Operation</li>
                <li>Business Address</li>
                <li>Contact Info</li></p>
            </ul>
            <p>One-page design that quickly informs your clients of the info they need.</p>
            <p>View sample Single-page Business Website:</p>
            <figure>
                <a href="http://demo.themeisle.com/zerif-lite/" target="_blank"><img src="<?php echo site_url();?>/wp-content/themes/freelancerr/images/zerif-free.jpg"></a>
                <figcaption><a href="http://demo.themeisle.com/zerif-lite/">Single-page demo using Zeri Theme</a></figcaption>
            </figure>
        </div>
        <div class="large-6 columns">
            <?php
            $posttitle = 'Single Page Website';
            $postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
            $post = get_post($postid);

            $title = strtolower($post->post_title);
            $slug = $post->post_name;
            $meta = get_post_meta($post->ID);
            $cats = get_the_terms($post->ID, 'package_category');
            $package_cat = $cats[0]->slug;
            $package_title = ucfirst($title);
            $includes = get_post_meta($post->ID, 'includes');

            ?>
            <div class="single-package ">
                    <div class="full-package" id="feature-package">
                        <div class="package-header" id="package-<?php echo $slug; ?>">
                            <p class="centered package-title">Single Page Website Package for $99</p>
                        </div>
                        <div class="package-details">
                            <p>Includes:</p>

                            <?php foreach ($includes as $i) {
                                echo '<span class="package-includes">' . $i . '</span>';
                            } ?>
                        </div>
                        <div class="package-select">
                            <div class="package-form">

                                <form action="<?php echo site_url() ?>/package-register" method="post" id="<?php echo $slug; ?>">
                                    <input type="hidden" name="package_type" value="<?php echo $package_cat ?>">
                                    <input type="hidden" name="package_level" value="<?php echo $slug ?>">
                                    <input type="hidden" name="post_title" value="<?php echo $package_title; ?>">
                                    <input type="hidden" name="package_id" value="<?php echo $post->ID ?>">
                                    <input type="hidden" name="package_content" value="<?php echo $post->post_content ?>">
                                    <input type="hidden" name="num_units" value="<?php echo $meta['num_units'][0] ?>" id="num_units">
                                    <input type="hidden" name="unit_price" value="<?php echo $meta['addon_content_price'][0] ?>" id="unit_price">
                                    <input type="hidden" name="package_price" value="<?php echo $meta['price'][0] ?>" id="package_price">
                                    <input type="hidden" name="snippet" value="<?php echo $meta['snippet'][0] ?>" id="snippet">
                                    <!-- store all the post variables that came in into hidden fields so they are sent over with this form on submit -->
                                    <?php

                                    if ($meta['addon_content'][0] === 'on') {

                                        ?>
                                        <div class=" centered addon">
                                            Content Creation: <input type="checkbox" name="addon_content" class="addon_content" id="<?php echo $slug; ?>"/>
                                        </div> <?php
                                    }
                                    ?>
                                    <div class="package-sign-up">
                                        <?php
                                        $slugUC = preg_replace_callback('/(?<=( |-))./',
                                            function ($m) { return strtoupper($m[0]); },
                                            $slug);
                                        $catUC = preg_replace_callback('/(?<=( |-))./',
                                            function ($m) { return strtoupper($m[0]); },
                                            $package_cat);
                                        ?>
                                        <div class="centered">
                                             <input class="button orange package-submit" type="submit" value="Get started for free" onclick="ga('send', {hitType:'event', eventCategory:'<?php echo ucfirst($catUC);?>-Packages', eventAction:'click', eventLabel:'<?php echo ucfirst($slugUC);?>', eventValue:'<?php echo $meta['price'][0] ?>'})">
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end addons -->
                        </div> <!-- end package signup -->
                    </div> <!-- end full package -->
                 </div>  <!-- end single package -->

        </div>
    </div>
</div>
<div class="full-width-div">
    <h3 class="centered">Not finding what you're looking for? Try these packages:</h3>
    <div class="tile-wrapper row">
        <ul class="small-block-grid-3">
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
                        <h3>Custom<br /> Project Help</h3>
                        <p>Name your own price</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="full-width-div override">
    <h3 class="centered">Website packages with a <br />Satisfaction Guarantee</h3>
    <div class="tile-wrapper row">
        <div class="large-4 columns">
            <div class="tile white no-link">
                <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/pack-post.png">
                <h5 class="bold">Post a Project</h5>
                <p >Describe what you need and get applications from freelancers.</p>
            </div>
        </div>
        <div class="large-4 columns">
            <div class="tile white no-link">
                <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/pack-riskfree.png">
                <h5 class="bold">Risk Free</h5>
                <p>Find and hire only the right person that fits your project.</p>
            </div>
        </div>
        <div class="large-4 columns">
            <div class="tile white no-link">
                <img src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/icons/pack-satisfaction.png">
                <h5 class="bold">Escrow Protection</h5>
                <p>You're in control. Release payment when work is delivered completed.</p>
            </div>
        </div>
    </div>
</div>