<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9"
    <?php language_attributes(); ?> >
    <![endif]-->
    <!--[if gt IE 8]>
    <!-->
<html class="no-js"
    <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/html">
        <!--
        <![endif]-->
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>" />
                <meta name="viewport" content="width=device-width" />
                <title><?php wp_title( '-', true, 'right' ); ?></title>
                <?php wp_head(); ?>


                <link rel="shortcut icon" href="<?php echo get_option('favicon'); ?>" type="image/x-icon" />
                    <link rel="shortcut icon" href="<?php echo get_option('favicon'); ?>" />
                        <link rel="icon" type="image/png" href="<?php echo get_option('favicon'); ?>" />

                        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

                        <!-- Start of Async HubSpot Analytics Code -->
                        <script type="text/javascript">
                            (function(d,s,i,r) {
                                if (d.getElementById(i)){return;}
                                var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
                                n.id=i;n.src='//js.hs-analytics.net/analytics/'+(Math.ceil(new Date()/r)*r)+'/715353.js';
                                e.parentNode.insertBefore(n, e);
                            })(document,"script","hs-analytics",300000);
                        </script>

                        <!-- Facebook Pixel Code -->
                        <script>
                            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                                document,'script','//connect.facebook.net/en_US/fbevents.js');

                            fbq('init', '923392571031535');
                            fbq('track', "PageView");
                        </script>
                        <noscript><img height="1" width="1" style="display:none"
                                       src="https://www.facebook.com/tr?id=923392571031535&ev=PageView&noscript=1"
                                /></noscript>

                        <!-- End Facebook Pixel Code -->

            <!-- Custom share buttons google plus script -->
            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

            <!-- Load Facebook SDK for JavaScript -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

            <!-- Begin Inspectlet Embed Code -->
            <script type="text/javascript" id="inspectletjs">
                window.__insp = window.__insp || [];
                __insp.push(['wid', 349428179]);
                (function() {
                    function ldinsp(){if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript';                        insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x =                           document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
                     setTimeout(ldinsp, 500); document.readyState != "complete" ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp,                          false)) : ldinsp();
                })();
            </script>
            <!-- End Inspectlet Embed Code -->


                        </head>




                        <!-- End of Async HubSpot Analytics Code -->
                        <body

                            <?php body_class('preload'); ?> >
                            <?php appthemes_before(); ?>
                            <?php appthemes_before_header(); ?>
                            <?php get_header( app_template_base() ); ?>
                            <?php appthemes_after_header(); ?>
                            <div class="full-width" id='page-full'>
                               
                                    <?php /*enable advertising*/ get_template_part( 'includes/header','advertising' ); ?>
                                    <div class="large-12 columns wrap">
                                        <div class="page-wrapper">
                                            <?php do_action( 'appthemes_notices' ); ?>
                                            <?php load_template( app_template_path() ); ?>
                                        </div>
                                    </div>
                                    <!-- end columns -->
                                    <div class="clear"></div>
                                    <?php /*enable advertising*/ get_template_part( 'includes/footer','advertising' ); ?>
                                
                                <!-- end row -->
                            </div>
                            <?php appthemes_before_footer(); ?>
                            <?php get_footer( app_template_base() ); ?>
                            <?php appthemes_after_footer(); ?>
                            <?php appthemes_after(); ?>
                            <?php wp_footer(); ?>
                            <script>
                        		( function( jQuery ) {
                        			jQuery( document ).foundation();
                        		}) ( jQuery );
                        	</script>

                        </body>
                    </html>
