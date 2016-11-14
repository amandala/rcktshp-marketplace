
<?php
/**
 * The template for displaying project listings
 */

?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>



<div class="large-10 push-1 columns" >
 <div id="main-wrapper">
     <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<p id="breadcrumbs">','</p>');
     } ?>
     <h3>Browsing <?php echo $term->name ?></h3>
     <div id="main " class="large-8 columns tutorial-archive-wrapper">
      <?php
      while ( have_posts() ) : the_post();

       $title = $post->post_title;
       $permalink = get_permalink($post->ID);

       $terms = get_the_terms($post->ID, 'series' );


       //the_content();
       //var_dump($post);
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
          echo '<p class="single-author">By: <span>'.get_the_hrb_author_posts_link().'<span></p>';
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

      // Previous/next page navigation.
      the_posts_pagination( array(
          'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
          'next_text'          => __( 'Next page', 'twentyfifteen' ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'freelancerr' ) . ' </span>',
      ) );

      // If no content, include the "No posts found" template.
      ?>
     </div><!-- end #main -->


     <div id="sidebar" class="large-4 columns">
      <div class="sidebar-widget-wrap cf">
       <?php get_sidebar('archive-tutorial'); ?>
      </div><!-- end .sidebar-widget-wrap -->
     </div><!-- end #sidebar -->
 </div>
</div>

