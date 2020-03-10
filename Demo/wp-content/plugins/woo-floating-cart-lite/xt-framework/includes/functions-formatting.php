<?php

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @since  1.0.0 Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with esc_attr()
 * @param  string $var Data to sanitize.
 * @return string
 */
function xtfw_sanitize_tooltip( $var ) {
	return htmlspecialchars(
		wp_kses(
			html_entity_decode( $var ),
			array(
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'small'  => array(),
				'span'   => array(),
				'ul'     => array(),
				'li'     => array(),
				'ol'     => array(),
				'p'      => array(),
			)
		)
	);
}

/**
 * Parse a relative date option from the settings API into a standard format.
 *
 * @since 1.0.0
 * @param mixed $raw_value Value stored in DB.
 * @return array Nicely formatted array with number and unit values.
 */
function xtfw_parse_relative_date_option( $raw_value ) {
	$periods = array(
		'days'   => esc_html__( 'Day(s)', 'xt-framework' ),
		'weeks'  => esc_html__( 'Week(s)', 'xt-framework' ),
		'months' => esc_html__( 'Month(s)', 'xt-framework' ),
		'years'  => esc_html__( 'Year(s)', 'xt-framework' ),
	);

	$value = wp_parse_args(
		(array) $raw_value,
		array(
			'number' => '',
			'unit'   => 'days',
		)
	);

	$value['number'] = ! empty( $value['number'] ) ? absint( $value['number'] ) : '';

	if ( ! in_array( $value['unit'], array_keys( $periods ), true ) ) {
		$value['unit'] = 'days';
	}

	return $value;
}

/**
 * Convert a float to a string without locale formatting which PHP adds when changing floats to strings.
 *
 * @since 1.0.0
 * @param  float $float Float value to format.
 * @return string
 */
function xtfw_float_to_string( $float ) {

	if(function_exists('wc_float_to_string')) {
		return wc_float_to_string($float);
	}

	if ( ! is_float( $float ) ) {
		return $float;
	}

	$locale = localeconv();
	$string = strval( $float );
	$string = str_replace( $locale['decimal_point'], '.', $string );

	return $string;
}

/**
 * Implode and escape HTML attributes for output.
 *
 * @since 1.0.0
 * @param array $raw_attributes Attribute name value pairs.
 * @return string
 */
function xtfw_implode_html_attributes( $raw_attributes ) {
	$attributes = array();
	foreach ( $raw_attributes as $name => $value ) {
		$attributes[] = esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}
	return implode( ' ', $attributes );
}

/**
 * Format a decimal with PHP Locale settings.
 *
 * @since 1.0.0
 * @param  string $value Decimal to localize.
 * @return string
 */
function xtfw_format_localized_decimal( $value ) {

	if(function_exists('woocommerce_format_localized_decimal')) {
		return xtfw_format_localized_decimal($value);
	}

	$locale = localeconv();
	return apply_filters( 'xtfw_format_localized_decimal', str_replace( '.', $locale['decimal_point'], strval( $value ) ), $value );
}


/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 *
 * @since 1.0.0
 * @param string|array $var Data to sanitize.
 * @return string|array
 */
function xtfw_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wc_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}