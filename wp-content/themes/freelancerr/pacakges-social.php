<?php
/**
Template Name: Packages - Social
 **/
?>

<div class="project-archive-wrapper">
    <div id="package-header">
        <h3>Grow new customers affordably with Small Business social media and marketing</h3>
    </div>
<?php
//for a given post type, return all
$post_type = 'packages';
$tax = 'package_category';
$tax_terms = get_terms($tax);

if ($tax_terms) {
    foreach ($tax_terms  as $tax_term) {
        if($tax_term->slug === 'social-media'){
            ?>
            <div class="package-grey-back" id="packages-<?php echo $tax_term->slug ?>">
                <div class="packages-wrapper large-10 columns push-1">
                <?php

                // If the query var is set use it; otherwise, initialize it to one.
                $page = get_query_var('paged') ? get_query_var('paged') : 1;
                $display_count = 10;

                $offset = ($page - 1) * $display_count;


                $loop = new WP_Query(array(
                    'post_type' => $post_type,
                    "$tax" => $tax_term->slug,
                    'orderby' => 'meta_value_num',
                    'meta_key' => 'price',
                    'order' => 'ASC',
                    'posts_per_page' => -1,
                    'number' => $display_count,
                    'page' => $page,
                    'offset' => $offset
                ));

                while ($loop->have_posts()) : $loop->the_post();

                    $title = strtolower($post->post_title);
                    $slug = $post->post_name;
                    $meta = get_post_meta($post->ID);


                    $cats = get_the_terms($post->ID, 'package_category');
                    $package_cat = $cats[0]->slug;

                    $package_title = ucfirst($title) ;

                    $includes = get_post_meta($post->ID, 'includes');

                    ?>
                    <div class="single-package large-4 medium-12 small-12 columns">
                        <div class="full-package">
                            <div class="package-header" id="package-<?php echo $slug; ?>">
                                <p class="package-title"><?php echo $title; ?></p>
                                <h4 class="package-price" id="price_<?php echo $slug; ?>">
                                    $<?php echo $meta['price'][0] ?></h4>
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
                                        <input type="hidden" name="snippet" value="<?php echo $meta['snippet'][0] ?>" id="snippet">
                                        <input type="hidden" name="unit_price" value="<?php echo $meta['addon_content_price'][0] ?>" id="unit_price">
                                        <input type="hidden" name="package_price" value="<?php echo $meta['price'][0] ?>" id="package_price">
                                        <!-- store all the post variables that came in into hidden fields so they are sent over with this form on submit -->
                                        <?php

                                        if ($meta['addon_content'][0] === 'on') {

                                            ?>
                                            <div class="addon">
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
                                            <input class="button orange package-submit" type="submit" value="Get started for free" onclick="ga('send', {hitType:'event', eventCategory:'<?php echo ucfirst($catUC);?>-Packages', eventAction:'click', eventLabel:'<?php echo ucfirst($slugUC);?>', eventValue:'<?php echo $meta['price'][0] ?>'})">
                                        </div>
                                    </form>
                                </div> <!-- end addons -->
                            </div> <!-- end package signup -->
                        </div> <!-- end full package -->
                    </div>  <!-- end single package -->

                <?php
            endwhile;

            wp_reset_query();

            ?>
            </div>
         </div> <!-- end package grey-back --> <?php
        }
    }
} ?>
    <div class="full-width-div package-grey-back">
        <div id="package-header">
            <h3 class="centered">Not finding what you're looking for? Try these packages:</h3>
        </div>
        <div class="tile-wrapper row">
            <ul class="small-block-grid-3">
                <li>
                    <a href="<?php echo site_url(); ?>/website-packages">
                        <div class="tile">
                            <h3>Business <br /> Websites</h3>
                            <p>From $99</p>
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
    <div class="full-width-div override white">
        <h3 class="centered">Social Media packages with a <br />Satisfaction Guarantee</h3>
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
</div>


<script>

    jQuery(document).ready( function (){


        //handle the different header colors
        // will need to be modified when we haeve more than three
        jQuery('.package-header').eq(1).css('background-color', '#27b7c0');
        jQuery('.package-header').eq(2).css('background-color', '#1B9BA1');

        // hold the original prices in an array
        var priceHolder = {};
        jQuery('[id^=price_]').each( function(){
            var package = jQuery(this).attr('id');
            var pack = package.split('_')[1];
            var packagePrice = jQuery(this).text().replace(/\D/g,'') ;
            priceHolder[pack] = packagePrice;
        });

        //update price when add option
        // TODO adjust pricing depending on package selected
        jQuery('.addon_content').change( function (){
            var id = jQuery(this).attr('id');

            var price = jQuery('#price_'+id).text().replace(/\D/g,''); //the visible price on the card header
            var actPrice = jQuery('form#'+id).children('#package_price'); //the price hidden input value that is sent in the session
            var numUnits = jQuery('form#'+id).children('#num_units').val();
            var unitPrice = jQuery('form#'+id).children('#unit_price').val();


            if(jQuery('.addon_content').is(":checked") ){
                var newPrice = parseInt(price, 10) + numUnits * unitPrice;
                jQuery('#price_'+id).text('$'+newPrice);
                actPrice.val(newPrice);
            }
            else{
                var newPrice = parseInt(price, 10) - numUnits * unitPrice;
                jQuery('#price_'+id).text('$'+newPrice);
                actPrice.val(newPrice);
            }
        })
    });

</script>



