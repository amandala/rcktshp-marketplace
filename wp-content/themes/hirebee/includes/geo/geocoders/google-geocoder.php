<?php

/**
 * Geocoder using Google Maps API v3
 */
class APP_Google_Geocoder extends APP_Geocoder {

	private $api_url = 'http://maps.googleapis.com/maps/api/geocode/json';

	/**
	 * Sets up the gateway
	 */
	public function __construct() {
		parent::__construct( 'google', array(
			'dropdown' => __( 'Google', APP_TD ),
			'admin' => __( 'Google', APP_TD )
		) );
	}

	public function has_required_vars() {

		if ( empty( $this->options['geo_region'] ) && empty( $_POST['geocoder_settings']['google']['geo_region'] ) ) {
			return __( 'Region', APP_TD );
		}

		if ( empty( $this->options['geo_language'] ) && empty( $_POST['geocoder_settings']['google']['geo_language'] ) ) {
			return __( 'Language', APP_TD );
		}

		if ( empty( $this->options['geo_unit'] ) && empty( $_POST['geocoder_settings']['google']['geo_unit'] ) ) {
			return __( 'Unit', APP_TD );
		}

		return true;
	}

	public function geocode_address( $address ) {
		$args = array(
			'address' => urlencode( $address )
		);

		return $this->geocode_api( $args );
	}

	public function geocode_lat_lng( $lat, $lng ) {
		$args = array(
			'latlng' => (float) $lat . ',' . (float) $lng,
		);

		return $this->geocode_api( $args );
	}

	public function geocode_api( $args ) {

		$defaults = array(
			'geo_region' => 'US',
			'geo_language' => 'en',
			'geo_unit' => 'mi',
			'api_key' => '',
		);

		$options = wp_parse_args( $this->options, $defaults );

		$params = array(
			'sensor' => 'false',
			'region' => $options['geo_region'],
			'language' => $options['geo_language'],
		);

		$args = wp_parse_args( $args, $params );

		$api_url = add_query_arg( $args, $this->api_url );
		if ( ! empty( $options['geo_client_id'] ) && ! empty( $options['geo_private_key'] ) ) {
			$api_url = $this->sign_url( $api_url );
		} else if ( ! empty( $options['api_key'] ) ) {
			// calls with key specified needs to be made via SSL url
			$api_url = str_ireplace( 'http://', 'https://', $api_url );
			$api_url = add_query_arg( array( 'key' => $options['api_key'] ), $api_url );
		}

		$api_url = esc_url_raw( $api_url );

		$response = wp_remote_get( $api_url );

		if ( 200 != wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		$this->geocode_results = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! $this->geocode_results || 'OK' != $this->geocode_results['status'] ) {
			return false;
		}

		$this->process_geocode();
	}

	public function set_response_code() {
		if ( isset( $this->geocode_results['status'] ) ) {
			$this->_set_response_code( $this->geocode_results['status'] );
		}
	}

	public function set_bounds() {

		if ( isset( $this->geocode_results['results'][0]['geometry'] ) ) {

			$geometry = $this->geocode_results['results'][0]['geometry'];

			// bounds are not always returned, so fall back to viewport
			$bounds_type = isset( $geometry['bounds'] ) ? 'bounds' : 'viewport';

			$this->_set_bounds(
				$geometry[ $bounds_type ]['northeast']['lat'],
				$geometry[ $bounds_type ]['northeast']['lng'],
				$geometry[ $bounds_type ]['southwest']['lat'],
				$geometry[ $bounds_type ]['southwest']['lng']
			);
		}
	}

	public function set_coords() {

		if ( isset( $this->geocode_results['results'][0]['geometry']['location'] ) ) {
			$point = $this->geocode_results['results'][0]['geometry']['location'];

			$this->_set_coords( $point['lat'], $point['lng'] );
		}
	}

	public function set_address() {
		if ( isset( $this->geocode_results['results'][0]['formatted_address'] ) ) {
			$formatted_address = $this->geocode_results['results'][0]['formatted_address'];
			$this->_set_address( $formatted_address );
		}
	}

	/**
	 * Signs a URL with a cryptographic key for Google Business.
	 * URL Signing Debugger: https://m4b-url-signer.appspot.com/
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	public function sign_url( $url ) {
		if ( ! function_exists( 'hash_hmac' ) ) {
			return $url;
		}

		$url = add_query_arg( 'client', $this->options['geo_client_id'], $url );

		$url = esc_url( $url );

		$parsed_url = parse_url( $url );
		$url_to_sign = $parsed_url['path'] . '?' . $parsed_url['query'];

		// Decode the private key into its binary format
		$decoded_key = base64_decode( str_replace( array( '-', '_' ), array( '+', '/' ), $this->options['geo_private_key'] ) );

		// Create a signature using the private key and the URL-encoded
		// string using HMAC SHA1. This signature will be binary.
		$signature = hash_hmac( 'sha1', $url_to_sign, $decoded_key, true );
		$encoded_signature = str_replace( array( '+', '/' ), array( '-', '_' ), base64_encode( $signature ) );

		// Note: add_query_arg() malformed signature
		return $url . '&signature=' . $encoded_signature;
	}

	public function form() {

		$settings = array(
			array(
				'title' => __( 'General', APP_TD ),
				'fields' => array(
					array(
						'title' => __( 'Region Biasing', APP_TD ),
						'desc' => sprintf( __( 'Find your two-letter <a href="%s" target="_blank">region code</a>', APP_TD ), 'http://en.wikipedia.org/wiki/ISO_3166-1#Current_codes' ),
						'type' => 'text',
						'name' => 'geo_region',
						'tip'  => __( "If you set this to 'IT' and a user enters 'Florence' in the location search field, it will target 'Florence, Italy' rather than 'Florence, Alabama'.", APP_TD ),
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
						'desc' => sprintf( __( 'Get started using the <a href="%s" target="_blank">Geocoding API</a>', APP_TD ), 'https://developers.google.com/maps/documentation/geocoding/index#api_key' ),
						'type' => 'text',
						'name' => 'api_key',
						'tip' => __( 'Create a project in the Google Developers Console and paste in the API key here. This field is optional but recommended.', APP_TD ),
					),
				)
			),
			array(
				'title' => __( 'Premium Service', APP_TD ),
				'desc' => sprintf( __( "<a href='%s' target='_blank'>Google Maps API for Work</a> is a paid service that provides higher daily <a href='%s' target='_blank'>usage limits</a>. If you're a large business or max out your daily limit on shared hosting, this option is for you. <a href='%s' target='_blank'>Pricing</a> depends on your usage.", APP_TD ), 'https://developers.google.com/maps/documentation/business/', 'https://developers.google.com/maps/documentation/geocoding/#Limits', 'https://developers.google.com/maps/usagelimits/#cost', 'https://developers.google.com/maps/documentation/geocoding/index#api_key' ),
				'fields' => array(
					array(
						'title' => __( 'Client ID', APP_TD ),
						'desc' => __( 'Begins with a "gme-" prefix', APP_TD ),
						'type' => 'text',
						'name' => 'geo_client_id',
						'tip' => __( 'Identifies you as a Google Maps API for Work customer and enables support and purchased quota.', APP_TD ),
					),
					array(
						'title' => __( 'Private key', APP_TD ),
						'type' => 'text',
						'name' => 'geo_private_key',
						'tip' => __( 'Your cryptographic URL-signing key will be issued with your client ID and is a "secret shared key" between you and Google.', APP_TD ),
					),
				)
			),
		);


		return $settings;
	}
}

appthemes_register_geocoder( 'APP_Google_Geocoder' );
