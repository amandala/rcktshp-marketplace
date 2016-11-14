<?php
/**
 * The template for displaying project listings
 */
?>


<div class="large-10 push-1 columns">
    <div id="main-wrapper">

        <div id="main " class="large-12 columns portfolio-archive-wrapper">

            <div class="large-3 medium-12 small-12 columns single-portfolio">
                <div id='portfolio-rcktshp-believes' >
                    <h2>RCKTSHP believes in students.</h2>
                    <p>RCKTSHP's student freelancers have shown they have what it takes to create exceptional work.</p>
                </div>
            </div>

            <?php
            // If the query var is set use it; otherwise, initialize it to one.
            $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $display_count = 10;

            $offset = ( $page - 1 ) * $display_count;


            $loop = new WP_Query( array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
                'number'  =>  $display_count,
                'page'  => $page,
                'offset'     =>  $offset
            ) );

            while ( $loop->have_posts() ) : $loop->the_post();

                   $title = $post->post_title;
                   $permalink = get_permalink($post->ID);
                   $terms = get_the_terms($post->ID, 'category' );
                   $meta = get_post_meta($post->ID);

                  $free_id =$meta['freelancer'][0];
                    $freelancer = get_user_by('id', $free_id);

                        ?>




                <div class="large-3 medium-12 small-12 columns single-portfolio">
                    <div class="portfolio-entry">
                        <div class="archive-portfilio-image">
                            <?php
                            if($meta['link'][0] !== ''){
                                $link = $meta['link'][0];
                                echo '<a  target="_blank" href="' .$link . '">' ;
                            }
                            else{
                                echo '<a href="' . $permalink . '">';
                            }

                            echo the_post_thumbnail( '200' ); ?></a>
                        </div>
                        <div class="archive-portfolio-details">
                            <h5 class="port-title"><?php echo $title; ?></h5>
                            <div class="port-terms">

                                <?php
                                if(! empty($terms)) {
                                    foreach ($terms as $term) {
                                        echo '<span class="portfolio-cat">' . $term->name . '</span>';
                                    }
                                }?>
                            </div>
                            <p class="port-freelancer">By: <a href="<?php echo site_url() ?>/profile/<?php echo $freelancer->user_login  ?>"><?php echo $freelancer->display_name ?></a> </p>
                        </div>
                    </div>
                </div>
            <?php
                endwhile; wp_reset_query();
            ?>
        </div><!-- end #main -->
    </div>
</div>

<script>


    (function() {

        // resize all the cards to match the tallest card
        function divHeightResize(){
            var maxHeight = -1;

            jQuery('.archive-portfolio-details').each(function() {
                maxHeight = maxHeight > jQuery(this).height() ? maxHeight : jQuery(this).innerHeight();
            });

            jQuery('.archive-portfolio-details').each(function() {
                jQuery(this).innerHeight(maxHeight);
            });

        }

        // resize the teal rcktshp believes card to match the rest of the cards
        function tealDivHeightResize(){
            var portfoliosize = jQuery('.portfolio-entry').first().innerHeight();

            jQuery('#portfolio-rcktshp-believes').innerHeight(portfoliosize);


            jQuery(window).resize( function(){
                var portfoliosize = jQuery('.portfolio-entry').first().innerHeight();

                jQuery('#portfolio-rcktshp-believes').innerHeight(portfoliosize);
            });

        }

        jQuery(window).on("resize", tealDivHeightResize);
        jQuery(document).on("ready", tealDivHeightResize);

        jQuery(window).on("resize", divHeightResize);
        jQuery(document).on("ready", divHeightResize);


    })();


</script>
