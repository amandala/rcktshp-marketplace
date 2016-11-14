<?php
/**
 * Views for the main static pages.
 *
 * Views prepare and provide data to the page requested by the user.
 *
 */

/**
 * Presistent view for Site AND Login/Registration page.
 */
class HRB_Login_Registration extends APP_View {

    function condition() {
		return true;
    }

	static function redirect_field() {
		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$redirect = $_REQUEST['redirect_to'];
		} else {
			$redirect = hrb_get_dashboard_url_for();
		}

		return html( 'input', array(
			'type' => 'hidden',
			'name' => 'redirect_to',
			'value' => esc_url( $redirect )
		) );
	}

	/**
	 * Retrieves the required vars for the site and the Login/Registration template.
	 *
	 * @uses apply_filters() Calls 'hrb_login_registration_template_vars'
	 *
	 */
    function template_vars() {
        global $hrb_options;

        $template_vars = array(
            'hrb_options' => $hrb_options,
        );
        return apply_filters( 'hrb_login_registration_template_vars', $template_vars );
    }

	/**
	 * Additional code to run on template redirect.
	 */
    function template_redirect() {
    	wp_enqueue_style('dashicons');
    }

}

/**
 * How it Works Page.
 */
class HRB_How_Works_Page extends APP_View_Page {

    private static $_template;

	function __construct() {
        self::$_template = 'how-works.php';
		parent::__construct( self::$_template, __( 'How it Works', APP_TD ) );
	}

	static function get_id() {
		return self::_get_page_id( self::$_template );
	}
}

/**
 * Site Terms Page.
 */
class HRB_Site_Terms_Page extends APP_View_Page {

    private static $_template;

	function __construct() {
        self::$_template = 'site-terms.php';
		parent::__construct( self::$_template, __( 'Site Terms', APP_TD ) );
	}

	static function get_id() {
		return self::_get_page_id( self::$_template );
	}
}

/**
 * View for single posts.
 */
class HRB_Blog_Single extends APP_View {

	function condition() {
		return is_singular('post');
	}

	function template_redirect() {
		global $hrb_options;

		// enqeue required scripts/styles

		if ( $hrb_options->projects_clarification ) {
			hrb_register_enqueue_scripts( 'comment-reply' );
		}
	}

}

/**
 * Blog Archive Page.
 */
class HRB_Blog_Archive extends APP_View_Page {

    private static $_template;

	function __construct() {
        self::$_template = 'home.php';
		parent::__construct( self::$_template, __( 'Blog', APP_TD ) );

		add_action( 'appthemes_before_blog_post_content', array( $this, 'blog_featured_image' ) );
	}

	function condition() {
		return parent::condition() || is_category();
	}

	function template_include( $template ) {
		return locate_template( self::$_template );
	}

	static function get_id() {
		return self::_get_page_id( self::$_template );
	}

	public function blog_featured_image() {
		if ( ! is_singular() && has_post_thumbnail() ) {
			echo html('a', array(
				'href' => get_permalink(),
				'title' => the_title_attribute( array( 'echo' => 0 ) ),
				), get_the_post_thumbnail( get_the_ID(), array( 420, 150 ), array( 'class' => 'alignleft' ) ) );
		}
	}

}

/**
 * Home Archive Page.
 */
class HRB_Home_Archive extends APP_View_Page {

    private static $_template;

	function __construct() {
        self::$_template = 'index.php';
		parent::__construct( self::$_template, __( 'Home', APP_TD ) );
	}

	function template_include( $template ) {
		global $wp_query;

		$wp_query->is_home = true;
		$wp_query->is_frontpage = true;

		return $template;
	}

	static function get_id() {
        return self::_get_page_id( self::$_template );
	}
}
