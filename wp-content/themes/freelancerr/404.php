<div id="not-found-wrapper">
    <div id="not-found-astro" >
        <img id="astro" src="<?php echo site_url(); ?>/wp-content/themes/freelancerr/images/404Astronaut.png">
        <div id="lost" class="large-6 columns">
            <h4 class="not-found-heading">You seem to be lost in space...</h4>
            <h4 class="not-found-heading">Let's get you <a href="<?php echo site_url() ?>">home</a>.</h4>
            <p class="not-found-p">Or were you looking for:</p>
            <div class="large-6 columns lost-links">
                <a href="<?php echo site_url(); ?>/post-a-project">Post a Project</a>
                <a href="<?php echo site_url(); ?>/projects">Find Work</a>
                <a href="<?php echo site_url(); ?>/contact">Contact Us</a>
            </div>
            <div class="large-6 columns lost-links">
                <a href="<?php echo site_url(); ?>/faq">FAQ</a>
                <a href="<?php echo site_url(); ?>/how-it-works">How it Works</a>
                <a href="<?php echo site_url(); ?>/blog">Blog</a>
            </div>
        </div>
    </div>

</div>



<script>

    function lostOffset (){
        var screenWidth = jQuery(window).width();

        var offset = jQuery('#astro').offset();
        var offsetleft = offset.left + 'px';
        var astroHeight = jQuery('#astro').height();
        var offsettop = offset.top + astroHeight/2 - 50 + 'px';


        jQuery('#lost').css('left', offsetleft);

        if(screenWidth > 400){

            jQuery('#lost').css('top', offsettop);
        }
        else{

            var offsetTopSmall = parseInt(offsettop) - 35;
            jQuery('#lost').css('top', offsetTopSmall);
        }
    }

    jQuery(document).ready(lostOffset() );

    jQuery(window).resize( function(){
        lostOffset();
    } );

</script>
