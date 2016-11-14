<?php

class APP_Google_Map_Provider extends APP_Map_Provider {
	public function __construct() {
		parent::__construct( 'google', array(
			'dropdown' => __( 'Google', APP_TD ),
			'admin' => __( 'Google', APP_TD )
		) );
	}

	public function init() {

	}

	public function has_required_vars() {

		if ( empty( $this->options['geo_region'] ) && empty( $_POST['map_provider_settings']['google']['geo_region'] ) ) {
			return __( 'Region', APP_TD );
		}

		if ( empty( $this->options['geo_language'] ) && empty( $_POST['map_provider_settings']['google']['geo_language'] ) ) {
			return __( 'Language', APP_TD );
		}

		if ( empty( $this->options['geo_unit'] ) && empty( $_POST['map_provider_settings']['google']['geo_unit'] ) ) {
			return __( 'Unit', APP_TD );
		}

		return true;
	}

	public function _enqueue_scripts() {
		$google_maps_url = is_ssl() ? 'https://maps-api-ssl.google.com/maps/api/js' : 'http://maps.google.com/maps/api/js';

		$defaults = array(
			'geo_region' => 'US',
			'geo_language' => 'en',
			'geo_unit' => 'mi',
			'api_key' => '',
		);

		$options = wp_parse_args( $this->options, $defaults );

		$params = array(
			'v' => 3,
			'sensor' => 'false',
			'region' => $options['geo_region'],
			'language' => $options['geo_language'],
		);

		if ( ! empty( $options['api_key'] ) ) {
			$params['key'] = $options['api_key'];
		}

		$google_maps_url = esc_url( add_query_arg( $params, $google_maps_url ) );

		wp_enqueue_script( 'google-maps-api', $google_maps_url, array(), '3', true );

		$appthemes_maps_url = get_template_directory_uri() . '/includes/geo/map-providers/google-maps.js';

		wp_enqueue_script( 'appthemes-maps', $appthemes_maps_url, array(), '1', true );

	}

	public function _map_provider_vars() {
		$this->map_provider_vars = wp_parse_args( $this->options, array(
			'text_directions_error' => __( 'Could not get directions to the given address. Please make your search more specific.', APP_TD ),
		) );
	}

	public function form() {

		$general = array(
			'title' => __( 'General', APP_TD ),
			'fields' => array(
				array(
						'title' => __( 'Region Biasing', APP_TD ),
						'desc' => sprintf( __( 'Find your two-letter <a href="%s" target="_blank">region code</a>', APP_TD ), 'http://en.wikipedia.org/wiki/ISO_3166-1#Current_codes' ),
						'type' => 'text',
						'name' => 'geo_region',
						'tip' => __( "If you set this to 'IT' and a user enters 'Florence' in the location search field, it will target 'Florence, Italy' rather than 'Florence, Alabama'.", APP_TD ),
						'extra' => array(
							'class' => 'small-text'
						)
					),
					array(
						'title' => __( 'Language', APP_TD ),
						'desc' => sprintf( __( 'Find your two-letter <a href="%s" target="_blank">language code</a>', APP_TD ), 'http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes' ),
						'type' => 'text',
						'name' => 'geo_language',
						'tip'  => __( 'Used to format the address and map controls.', APP_TD ),
						'extra' => array(
							'class' => 'small-text'
						),
					),
					array(
						'title' => __( 'Distance Unit', APP_TD ),
						'type' => 'select',
						'name' => 'geo_unit',
						'values' => array(
							'km' => __( 'Kilometers', APP_TD ),
							'mi' => __( 'Miles', APP_TD ),
						),
						'tip' => '',
					),
					array(
						'title' => __( 'API Key', APP_TD ),
						'desc' => sprintf( __( 'Get started using the <a href="%s" target="_blank">Maps API</a>', APP_TD ), 'https://developers.google.com/maps/documentation/javascript/tutorial#api_key' ),
						'type' => 'text',
						'name' => 'api_key',
						'tip' => __( 'Activate your Google Maps JavaScript API Service and paste in the API key here. This field is optional but recommended.', APP_TD ),
					),
			)
		);

		return $general;
	}
}

appthemes_register_map_provider( 'APP_Google_Map_Provider' );
