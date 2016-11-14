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
<div id="sticky-container">
    <?php
    $meta = get_post_meta($post->ID);
    $time = $meta['time'][0];
    ?>

        <div class="single-tutorial-sidebar-section" id="tutorial-steps">
            <?php

                if(isset($time)){

                    if($time === 1){
                        $hour = 'hour';
                    }
                    else{
                        $hour = 'hours';
                    }
                    echo '<h4 class="tut-sidebar-heading small">Time to complete: '. $time .' ' . $hour . '</h4>';
                }

                for($count=1; $count<=10; $count++){
                    $attr = 'step'.$count;
                    if(! empty ($meta[$attr] ) ){
                        echo '<p class="step"><a href="#step'.$count.'">Step '.$count. '</a>: '. $meta[$attr][0]. '</p>';
                    }
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