<?php
/**
 * The template for displaying project listings
 */
?>


<div class="large-10 push-1 columns">
    <div id="main-wrapper">

        <h3>Browsing all tutorials</h3>
        <div id="main " class="large-8 columns tutorial-archive-wrapper">


            <?php
            // If the query var is set use it; otherwise, initialize it to one.
            $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $display_count = 10;

            $offset = ( $page - 1 ) * $display_count;


            $loop = new WP_Query( array(
                'post_type' => 'tutorials',
                'posts_per_page' => -1,
                'number'  =>  $display_count,
                'page'  => $page,
                'offset'     =>  $offset
     ) );

            while ( $loop->have_posts() ) : $loop->the_post();

                           $title = $post->post_title;
                           $permalink = get_permalink($post->ID);

                            $terms = get_the_terms($post->ID, 'series' );
                            $meta = get_post_meta($post->ID);

                            $guest_author = $meta['guest_author'][0];

                        ?>
                        <div class="tutorial-archive-single-tutorial">
                            <div class="row">
                                <div class="large-4 columns">
                                    <div class="archive-single-image">
                                        <?php echo the_post_thumbnail( '100' ); ?>
                                    </div>
                                </div>
                                <div class="large-8 columns">
                                    <?php
                                        echo '<h5 class="archive-single-tutorial-title"><a href="'.$permalink.'">'. $title. '</a></h5>';

                                        if($guest_author == ''){

                                            echo '<p class="single-author">By: <span>'.get_the_hrb_author_posts_link().'<span></p>';
                                        }
                                        else{
                                            echo '<p class="single-author">By: <span>'.$guest_author.'<span></p>';
                                        }
                                        echo '<p class="single-author">Date: <span>'. mysql2date('j M Y', $post->post_date) .'</span></p>';
                                        echo '<p class="archive-single-excerpt">'.get_the_excerpt().'</p>';

                                    ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="large-8 columns">
                                <?php
                                if(! empty ($terms) ) {


                                    foreach($terms as $term){
                                        echo '<span class="tutorial-category-tag">'.$term->name.'</span>';
                                    }
                                }


                                ?>
                                </div>
                                <div class="large-4 columns">
                                    <div class="archive-comments">
                                        <?php
                                        $comments_link = get_comments_link( $post->ID);
                                        $number_comments = get_comments_number( $post->ID );
                                        ?>
                                        <span><a href="<?php echo $comments_link; ?>"><i class="fa fa-comments"></i> <?php echo $number_comments ?></a></span>
                                    </div>


                                </div>
                            </div>
                        </div>



                        <?php

                endwhile; wp_reset_query();

            ?>



        </div><!-- end #main -->


        <div id="sidebar-archive-tutorials" class="large-4 columns">
            <div class="sidebar-widget-wrap cf">
                <?php get_sidebar('archive-tutorial'); ?>
            </div><!-- end .sidebar-widget-wrap -->
        </div><!-- end #sidebar -->
    </div>
</div>
