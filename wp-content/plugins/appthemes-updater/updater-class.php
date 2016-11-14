<?php

abstract class APP_Upgrader {

	protected $app_url;

	protected $items = array();

	static function get_key() {
		if ( defined( 'APPTHEMES_API_KEY' ) )
			return APPTHEMES_API_KEY;

		return get_site_option( 'appthemes_api_key' );
	}

	static function set_key( $key ) {
		update_site_option( 'appthemes_api_key', $key );
	}

	static function disable_old_updater() {
		if ( class_exists( 'APP_Updater' ) ) {
			remove_filter( 'http_request_args', array( 'APP_Updater', 'exclude_themes' ), 10, 2 );
			remove_filter( 'http_response', array( 'APP_Updater', 'alter_update_requests' ), 10, 3 );
			remove_action( 'all_admin_notices', array( 'APP_Updater', 'display_warning' ) );
		}
	}

	function __construct() {
		if ( !self::get_key() )
			return;

		add_action( 'init', array( __CLASS__, 'disable_old_updater' ) );

		add_filter( 'http_request_args', array( $this, 'exclude_items' ), 10, 2 );
		add_filter( 'http_response', array( $this, 'alter_update_requests' ), 10, 3 );
	}

	abstract function exclude_items( $r, $url );

	abstract function get_payload();

	abstract function alter_update_requests( $response, $args, $url );

	protected function check_for_updates() {
		$payload = $this->get_payload();
		if ( !$payload )
			return false;

		$args = array();
		$args['timeout'] = 30;

		$args['body'] = array_merge( $payload, array(
			'api_key' => APP_Upgrader::get_key()
		) );

		$raw_response = wp_remote_post( $this->app_url, $args );

		if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) )
			return false;

		$body = unserialize( wp_remote_retrieve_body( $raw_response ) );

		if ( !$body )
			return false;

		return $this->append_api_key( $body );
	}

	protected function append_api_key( $items ) {
		foreach ( $items as &$item ) {
			$item['package'] = add_query_arg( 'api_key', self::get_key(), $item['package'] );
		}

		return $items;
	}

	protected function decode( $data, $version ) {
		switch ( $version ) {
			case 1.0:
				return maybe_unserialize( $data );
				break;
			case 1.1:
				return json_decode( $data, true );
				break;
			default:
				return $data;
				break;
		}
	}

	protected function encode( $data, $version ) {
		switch ( $version ) {
			case 1.0:
				return serialize( $data );
				break;
			case 1.1:
				return json_encode( $data );
				break;
			default:
				return $data;
				break;
		}
	}

}


class APP_Theme_Upgrader extends APP_Upgrader {

	protected $app_url = 'http://api.appthemes.com/themes/update-check/2.0/';

	protected function get_hardcoded_items() {
		return array( 'vantage', 'qualitycontrol', 'classipress', 'clipper', 'jobroller' );
	}

	public static $instance;

	public function __construct() {
		parent::__construct();

		add_action( 'all_admin_notices', array( __CLASS__, 'display_warning' ) );

		self::$instance = $this;
	}

	function exclude_items( $r, $url ) {
		if ( preg_match( '#://api\.wordpress\.org/themes/update-check/(?P<version>[0-9.]+)/#', $url, $matches ) ) {
			$themes = $this->decode( $r['body']['themes'], floatval( $matches['version'] ) );

			if ( empty( $themes ) )
				return $r;

			$this->current_theme = ( $matches['version'] >= 1.1 ) ? $themes['active'] : $themes['current_theme'];

			$themes_array = ( $matches['version'] >= 1.1 ) ? $themes['themes'] : $themes;

			$themes_to_check = $this->get_marked_themes();

			foreach ( $themes_array as $name => $info ) {
				if ( ! is_array( $info ) )
					continue;

				if ( !array_key_exists( $name, $themes_to_check ) )
					continue;

				$info['AppThemes ID'] = $themes_to_check[ $name ];

				$this->items[ $name ] = $info;

				unset( $themes_array[ $name ] );
			}

			if ( $matches['version'] >= 1.1 )
				$themes['themes'] = $themes_array;
			else
				$themes = $themes_array;

			$r['body']['themes'] = $this->encode( $themes, floatval( $matches['version'] ) );
		}

		return $r;
	}

	/**
	 * Get themes that have the 'AppThemes ID' header,
	 * since it's not passed to the updater request.
	 *
	 * @return array( 'theme-slug' => 'AppThemes ID-slug' )
	 */
	protected function get_marked_themes() {
		if ( !function_exists( 'wp_get_themes' ) )
			return array();

		$hardcoded = $this->get_hardcoded_items();

		$marked = array();

		foreach ( wp_get_themes() as $key => $theme ) {
			if ( in_array( $key, $hardcoded ) )
				$marked[ $key ] = $key;
			elseif ( $theme->get( 'AppThemes ID' ) )
				$marked[ $key ] = $theme->get( 'AppThemes ID' );
		}

		return $marked;
	}

	function get_payload() {
		if ( empty( $this->items ) )
			return false;

		return array(
			'themes' => $this->items,
			'current_theme' => $this->current_theme
		);
	}

	function alter_update_requests( $response, $args, $url ) {
		if ( preg_match( '#://api\.wordpress\.org/themes/update-check/(?P<version>[0-9.]+)/#', $url, $matches ) ) {

			$our_updates = $this->check_for_updates();

			$themes = $this->decode( $response['body'], floatval( $matches['version'] ) );

			if ( $our_updates ) {
				if ( ! is_array( $themes ) )
					$themes = array();

				foreach ( $our_updates as $key => $value ) {
					if ( $matches['version'] >= 1.1 )
						$themes['themes'][ $key ] = $value;
					else
						$themes[ $key ] = $value;
				}

				$response['body'] = $this->encode( $themes, floatval( $matches['version'] ) );
			}

		}

		return $response;
	}

	function display_warning() {
		global $pagenow;

		if ( !in_array( $pagenow, array( 'themes.php', 'update-core.php' ) ) )
			return;

		if ( !current_user_can( 'update_themes' ) )
			return;

		$themes_update = get_site_transient( 'update_themes' );

		$stylesheet = get_stylesheet();

		if ( isset( $themes_update->response[ $stylesheet ] ) ) {
?>
				<div id="message" class="error">
					<p><?php echo sprintf( __( '<strong>IMPORTANT</strong>: If you have made any modifications to the AppThemes files, they will be overwritten if you proceed with the automatic update. Those with modified theme files should do a manual update instead. Visit your <a href="%1$s" target="_blank">customer dashboard</a> to download the latest version.', 'appthemes' ), 'https://my.appthemes.com/' ); ?></p>
				</div>
<?php
		}
	}
}


class APP_Plugin_Upgrader extends APP_Upgrader {

	protected $app_url = 'http://api.appthemes.com/plugins/update-check/1.0/';

	public static $instance;

	public function __construct() {
		parent::__construct();

		self::$instance = $this;
	}

	function exclude_items( $r, $url ) {
		if ( preg_match( '#://api\.wordpress\.org/plugins/update-check/(?P<version>[0-9.]+)/#', $url, $matches ) ) {
			$plugins = (array) $this->decode( $r['body']['plugins'], floatval( $matches['version'] ) );

			if ( empty( $plugins ) )
				return $r;

			foreach ( $plugins['plugins'] as $slug => $info ) {
				if ( empty( $info['AppThemes ID'] ) )
					continue;

				$this->items[ $slug ] = $info;

				unset( $plugins['plugins'][ $slug ] );
			}

			if ( $matches['version'] < 1.1 )
				$plugins = (object) $plugins;

			$r['body']['plugins'] = $this->encode( $plugins, floatval( $matches['version'] ) );
		}

		return $r;
	}

	function alter_update_requests( $response, $args, $url ) {
		if ( preg_match( '#://api\.wordpress\.org/plugins/update-check/(?P<version>[0-9.]+)/#', $url, $matches ) ) {

			$our_updates = $this->check_for_updates();

			$plugins = $this->decode( $response['body'], floatval( $matches['version'] ) );
			if ( $our_updates ) {
				foreach ( $our_updates as $key => $value ) {
					if ( $matches['version'] >= 1.1 )
						$plugins['plugins'][ $key ] = $value;
					else
						$plugins[ $key ] = (object) $value;
				}

				$response['body'] = $this->encode( $plugins, floatval( $matches['version'] ) );
			}
		}

		return $response;
	}

	function get_payload() {
		return array(
			'plugins' => $this->items,
		);
	}
}

