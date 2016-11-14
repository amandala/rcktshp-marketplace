

<div class="top-navigation">
        <div class="large-10 push-1 columns">
           <div id='header-row'>


            <!-- always visible nav items -->
               <nav class="top-bar" data-topbar role="navigation">
                   <ul class="title-area">
                       <li class="name">
                           <?php nw_display_logo(); ?>
                       </li>
                       <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                       <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
                   </ul>

                   <section class="top-bar-section">
                       <!-- Right Nav Section -->
                       <ul class="right">
                           <?php the_nw_user_nav_links(); ?>
                       </ul>

                       <!-- Left Nav Section -->
                       <ul class="left">
                           <li class="has-dropdown"><a href="<?php echo site_url('packages')?>">Hire a Freelancer</a>
                               <ul class="dropdown">
                                   <li class="has-dropdown"><a href="<?php echo site_url('website-packages')?>">Websites Packages</a>
                                       <ul class="dropdown">
                                           <li ><a href="<?php echo site_url('one-page-website-package')?>">$99 website</a></li>
                                       </ul>
                                   </li>

                                   <li><a href="<?php echo site_url('social-media-packages')?>">Social Media Packages</a></li>
                                   <li><a href="<?php echo site_url('blog-packages')?>">Blog Content Packages</a></li>
                                   <li><a href="<?php echo site_url('post-a-project')?>">Custom Project</a></li>
                               </ul>
                           </li>
                           <li class="has-dropdown"><a href="#">Small Business Resources</a>
                               <ul class="dropdown">
                                   <li><a href="<?php echo site_url('ebook-social-media')?>">The Complete Guide<br /> to Social Media</a></li>
                                   <li><a href="<?php echo site_url('ebook-websites')?>">The Complete Guide <br /> to Websites</a></li>
                                   <li><a class="footer-link" href="<?php echo site_url() ?>/resource-index">Resources Page</a></li>
                               </ul>
                           </li>
                           <li class="has-dropdown"><a href="<?php echo site_url('how-it-works')?>">How it Works</a>
                               <ul class="dropdown">
                                   <li><a href="<?php echo site_url('faq')?>">FAQ</a></li>
                                   <li><a href="<?php echo site_url('contact')?>">Support</a></li>

                               </ul>
                           </li>
                           <li><a href="<?php echo site_url('about-us')?>">About Us</a></li>
                       </ul>
                   </section>
               </nav>
            </div>

            <div class="clear"></div>

        </div>
        <!-- end columns -->
    </div>
    <!-- end row -->
</div>
<!-- end top-navigation -->
<!-- end top-navigation -->


    
    
    