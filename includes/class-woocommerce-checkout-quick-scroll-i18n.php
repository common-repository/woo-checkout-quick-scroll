<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       swiftdesigns.com.au
 * @since      1.0.0
 *
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/includes
 * @author     John Cook <hello@swiftdesigns.com.au>
 */
class Woocommerce_Checkout_Quick_Scroll_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-checkout-quick-scroll',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
