<?php
/**
 * Template Name: Ebook Download Page
 */
?>

<div class="large-10 push-1 columns" id="ebook-page">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php $post_meta = get_post_meta($post->ID);
        ?>
        <div class="ebook-title-wrapper">
            <h3><?php echo $post_meta['title'][0] ?></h3>
            <h3 class="bold"><?php echo $post_meta['subtitle'][0] ?></h3>
        </div>

        <div class="ebook-download-wrapper">
            <ul class="small-block-grid-2" id="social-share-buttons">
                <li><a target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: '<?php echo $post_meta['GA-label'][0] ;?>' });" href="<?php echo $post_meta['download-button'][0]; ?>"><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a></li>
                <li><div class="social-single">

                        <div id="twitterbutton"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Check out this free Ebook from @rcktshp <?php  the_permalink() ;?> " rel="rcktshp"><img src="http://www.siamcomm.com/wp-content/uploads/2011/05/twitter.png" data-pin-nopin="true"></a></div>

                        <div id="likebutton"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>;"><img src="http://www.siamcomm.com/wp-content/uploads/2011/05/facebook.png" data-pin-nopin="true"></a></div>

                        <div id="linkedinshare"><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=Check out this free Ebook from @RCKTSHP&source=rcktshp"><img src="http://www.siamcomm.com/wp-content/uploads/2011/05/linkedin.png" data-pin-nopin="true"></a></div>

                    </div></li>
            </ul>
        </div>

        <div id="ebook-content-wrapper">
            <div class="large-12 medium-12 small-12 columns" id="ebook-content">
               <div class="large-6 columns"> <p><?php the_content(); ?></p></div>
               <div class="large-6 columns"><?php echo the_post_thumbnail( 50, "id=ebook-img" ); ?> </div>

            </div>
        </div>
    <?php endwhile; // end of the loop. ?>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('input[type=submit]').addClass('button orange');
    });
</script>