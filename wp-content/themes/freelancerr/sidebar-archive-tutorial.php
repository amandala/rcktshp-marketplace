<div>

<?php

$terms = get_terms('series');


$tax_slug = get_query_var( 'series' ); // this is the current taxonomy you are on
$parent_slug = get_term_by('id', $parent, 'series')->slug;
//var_dump($tax_slug);

?>

    <?php $tax_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

    <div class="single-tutorial-sidebar-section" id="tutorial-whatis">
        <h4 class="tut-sidebar-heading">What is RCKTSHP?</h4>
        <p>For the projects you don't have time for, RCKSTHP provides employers with a connection to student freelancers. Benefits to using RCKTSHP include:
        <ol>
            <li class="rcktshp-tutorials-sidebar-bold">Employer Guarantee</li>
            <li class="rcktshp-tutorials-sidebar-bold">Rate and review your freelancer</li>
        </ol>
        </p>
    </div>

    <div id="sticky-anchor"></div>
    <div class="tutorial-sidebar-wrapper" id="sticky-container">
        <div class="single-tutorial-sidebar-section " >

            <div class="sidebar-archive-tags">
                <a href="<?php echo site_url()?>/tutorials" class="tutorial-archive-sidebar-categories">Browse all tutorials</a>
            </div>

            <div class="sidebar-archive-tags">
                <h4>Main Categories</h4>
                <?php foreach($terms as $term){
                    $parent = $term->parent;
                    if($parent === '0'){ //if you are on the top level parent of the taxonomy
                        echo '<a href="'.site_url().'/series/'.$term->slug.'"
                        class="tutorial-archive-sidebar-categories">'.$term->name.'</a>';


                    }
                }

                ?>
            </div>

            <?php
                if($tax_slug !== ''){
                    echo '<div class="sidebar-archive-tags">';
                    echo '<h4>Categories within '.$tax_term->name.'</h4>';
                    foreach($terms as $term){

                        $id = $term->term_id;
                        $name = $term->name;
                        $slug = $term->slug;
                        $parent = $term->parent;
                        $parent_slug = get_term_by('id', $parent, 'series')->slug;


                        if($parent_slug === $tax_slug) {
                            echo '<a href="' . site_url() . '/series/' . $term->slug . '"
                    class="tutorial-archive-sidebar-categories">' . $term->name . '</a>';
                            $on_page[$term->id] = $term;


                        }

                    }
                    echo '</div>';
                }
            ?>


            </div>

            <div class="single-tutorial-sidebar-section" id="tutorial-signup">
                <h4 class="tut-sidebar-heading">Subscribe</h4>
                <h4 id="tut-sidebar-subscribe-call">to the RCKTSHP Accelerator Blog</h4>
                <p id="tut-sidebar-subscribe-copy">Get expert marketing and website tips and tricks, step-by-step tutorials and proven strategies to build your business, delivered straight to your inbox.</p>
                <!-- Begin MailChimp Signup Form -->
                <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
                <style type="text/css">
                    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                </style>
                <div id="mc_embed_signup">
                    <form action="//rcktshp.us8.list-manage.com/subscribe/post?u=f053ac23d0ff09e29473b7981&amp;id=d52fb39487" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">

                            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                                </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;"><input type="text" name="b_f053ac23d0ff09e29473b7981_d52fb39487" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>

                <!--End mc_embed_signup-->
            </div>
        </div>


    </div>

</div>


