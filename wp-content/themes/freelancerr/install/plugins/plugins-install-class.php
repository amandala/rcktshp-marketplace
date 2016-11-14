<?php

class pluginsInstallClass {

    static function init(){
        global $_GET;

        if( ! empty($_GET['run_basic_install']) ){
            fOpt::Set('basicinstall', 'plugins', '' );
        }

        if( isSet( $_GET['all_plugins_installed'] ) ){
            fOpt::Set('basicinstall', 'plugins', 'finished' );
            return;
        }

        if( isSet( $_GET['all_plugins_aborted'] ) ){
            fOpt::Set('basicinstall', 'plugins', 'aborted' );
            return;
        }

        require_once dirname(dirname( __FILE__ )) . '/revslider/install.php';
        add_action( 'admin_footer', array( 'revsliderInstall','addDefaultSliders' ) );

        switch ( get_option('basicinstall', 'plugins' ) ) {

            case 'activate-required-plugins-page':
                // plugins.php - just to look - all activated
                add_action( 'admin_init', array('pluginsInstallClass','moveToThemeOptions') );
                break;

            case 'move-to-activate-required-plugins-page':
                // showing installation
                add_action( 'admin_init', array('pluginsInstallClass','addAfterAutoInstall') );
                break;

            case 'install-required-plugins-page':
                // showing in tgm strange stuff
                add_action( 'admin_init', array('pluginsInstallClass','addAutoInstallJavaScript') );
                break;

            default:
                // just on theme switch
                add_action("admin_init", array('pluginsInstallClass','redirectToInstallPlugins') );
                break;
        }
    }

    static function moveToThemeOptions(){

        require_once dirname(dirname( __FILE__ )) . '/revslider/install.php';
        revsliderInstall::addDefaultSliders();

        fOpt::Set('basicinstall', 'plugins', 'finished' );
        wp_enqueue_script('jquery');
        wp_enqueue_script(
              'ff_autoinstall4',
              get_template_directory_uri().'/install/plugins/js-plugins-install-4.js',
              array('jquery'),
              md5( filemtime( get_template_directory().'/install/plugins/js-plugins-install-4.js' ) ),
              false  // into footer
        );
    }

    static function addAfterAutoInstall(){
        fOpt::Set('basicinstall', 'plugins', 'activate-required-plugins-page' );
        wp_enqueue_script('jquery');
        wp_enqueue_script(
              'ff_autoinstall3',
              get_template_directory_uri().'/install/plugins/js-plugins-install-3.js',
              array('jquery'),
              md5( filemtime( get_template_directory().'/install/plugins/js-plugins-install-3.js' ) ),
              false  // into footer
        );
    }

    static function addAutoInstallJavaScript(){
        fOpt::Set('basicinstall', 'plugins', 'move-to-activate-required-plugins-page' );
        wp_enqueue_script('jquery');
        wp_enqueue_script(
              'ff_autoinstall2',
              get_template_directory_uri().'/install/plugins/js-plugins-install-2.js',
              array('jquery'),
              md5( filemtime( get_template_directory().'/install/plugins/js-plugins-install-2.js' ) ),
              false  // into footer
        );
    }

    static function redirectToInstallPlugins(){
        get_option('basicinstall', 'plugins', 'install-required-plugins-page' );
        wp_enqueue_script('jquery');
        wp_enqueue_script(
              'ff_autoinstall1',
              get_template_directory_uri().'/install/plugins/js-plugins-install-1.js',
              array('jquery'),
              md5( filemtime( get_stylesheet_directory().'/install/plugins/js-plugins-install-1.js' ) ),
              false  // into footer
        );
    }
}


