<div class="large-7 columns push-1" id="single-blog-post">
    <div id="main" >


        <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        } ?>

        <?php appthemes_before_blog_loop(); ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php appthemes_before_blog_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php appthemes_before_blog_post_title(); ?>

                <?php
                $meta = get_post_meta($post->ID);

                $guest_author = $meta['guest_author'][0];

                ?>


                <div class="single-tutorial">
                    <div class="tutorial-header-wrapper">
                        <div class="tutorial-title-single">
                            <h4><h1 class="post-heading"><span class="left-hanger"><?php the_title(); ?></span></h1></h4>
                            <?php
                            if($guest_author == ''){

                                 echo '<p class="single-tutorial-name">By: <span class="tutorial-author">'. get_the_hrb_author_posts_link();
                            }
                            else{
                                echo '<p class="single-author">By: <span>'.$guest_author;
                            }
                            ?></span></p>
                            <p class="single-tutorial-date">Date: <span class="tutorial-date"><?php the_date('j F Y'); ?></span></p>
                        </div>
                    </div>

                    <?php appthemes_after_blog_post_title(); ?>

                    <section class="overview cf single-tutorial">

                        <?php appthemes_before_blog_post_content(); ?>

                        <?php the_content(); ?>

                        <?php $terms = get_the_terms( $post->ID, 'totorialcategory' );

                            //var_dump($terms);

                        ?>

                        <?php appthemes_after_blog_post_content(); ?>

                        <?php edit_post_link( __( 'Edit', APP_TD ), '<span class="edit-link">', '</span>' ); ?>
                    </section>

                    <?php if ( function_exists( 'sharethis_button' ) && $hrb_options->blog_post_sharethis ): ?>

                        <section class="sharethis cf">
                            <div class="sharethis"><?php sharethis_button(); ?></div>
                        </section>

                    <?php endif; ?>
                </div>



            <div class="single-tutorial-comments-wrapper" id="comments">
                <div class="single-tutorial-comment-heading">
                    <h2 class="tutorial-comments-heading">Comments</h2>
                </div>


                    <?php

                    $args = array (
                        'post_id' => $post->ID,
                        'orderby' => 'comment_date'
                    );
                    $comments = get_comments($args);

                    if( ! empty ($comments) ){
                        echo ' <div class="single-tutorial-comments">';
                        foreach($comments as $comment){
                            $email = $comment ->comment_author_email;
                            $av = get_avatar($email);


                            $author = $comment->comment_author;
                            $content = $comment->comment_content;

                            ?>
                            <div class=" row single-comment">
                                <div class="large-2 columns">
                                    <?php the_hrb_user_gravatar( $comment->user_id, 100 );?>
                                </div>
                                <div class="large-10 columns">
                                    <?php echo '<p class=single-author>'.$author.'</p>'; ?>
                                    <p class="single-date"><?php comment_date('j F Y');?></p>
                                    <p ><?php echo $content ?></p>
                                </div>
                            </div>
                            <?php
                        }

                    echo '</div>';
                    }



                ?>
                    <div class="leave-a-comment">
                    <?php

                    $form_args = array(
                        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Leave a comment:', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                        'label_submit' => 'Submit',
                        'title_reply' => '',
                        'title_reply_to' => '',
                        'logged_in_as' => '',
                        'id_form' => 'tutorial-comment',
                        'comment_notes_after' => ''
                    );

                    comment_form($form_args); ?>

                </div>

            </article>

            <?php appthemes_after_blog_post(); ?>

        <?php endwhile; ?>

        <?php appthemes_after_blog_loop(); ?>

    </div><!-- /#main -->



</div>

<div id="sidebar-single-tutorial" class="large-3 pull-1 columns">

    <div class="sidebar-widget-wrap single-tutorial-sidebar">
        <?php get_sidebar('single-tutorial'); ?>
    </div><!-- end .sidebar-widget-wrap -->

</div><!-- end #sidebar -->