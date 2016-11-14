<?php
  
if( ! function_exists('is_admin') ) { exit; }
if( is_admin() ) {


    function switchToThemeOptions(){
        wp_enqueue_script(
              'js-switch-to-install',
              get_template_directory_uri().'/install/js-switch-to-theme-install.js',
              array('jquery')
        );
    }
    
    global $_GET;
    if( !empty($_GET) and  !empty($_GET['install_action'])  ){
        add_action( 'admin_enqueue_scripts', 'switchToThemeOptions' );
    }


    //require_once dirname( __FILE__ ) . '/ffGetByTitle.php';

    // Options (wp_gen_options) are installed separatebly

    // This will install all pages, taxonomies, menus, etc.

    //require_once dirname( __FILE__ ) . '/data/install.php';
    //dataInstall:install();

    // For plugins installation
    
    require_once dirname( __FILE__ ) . '/plugins/install.php';
    require_once 'plugins/plugins-install-class.php';

   // require_once dirname( __FILE__ ) . '/basic/installBasic.php';
   // ffInstallBasic::init();
}

