<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              swiftdesigns.com.au
 * @since             1.0.0
 * @package           Woocommerce_Checkout_Quick_Scroll
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Checkout Quick Scroll
 * Plugin URI:        https://swiftdesigns.com.au/created-plugins/woocommerce-checkout-quick-scroll.zip
 * Description:       This plugin adds buttons to the checkout page for faster shopper scrolling.
 * Version:           1.0.6
 * Author:            John Cook
 * Author URI:        swiftdesigns.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-checkout-quick-scroll
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'woo_checkout_quick_scroll', '1.0.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-checkout-quick-scroll-activator.php
 */
function activate_woocommerce_checkout_quick_scroll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-checkout-quick-scroll-activator.php';
	Woocommerce_Checkout_Quick_Scroll_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-checkout-quick-scroll-deactivator.php
 */
function deactivate_woocommerce_checkout_quick_scroll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-checkout-quick-scroll-deactivator.php';
	Woocommerce_Checkout_Quick_Scroll_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_checkout_quick_scroll' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_checkout_quick_scroll' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-checkout-quick-scroll.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_checkout_quick_scroll() {

	$plugin = new Woocommerce_Checkout_Quick_Scroll();
	$plugin->run();

}
run_woocommerce_checkout_quick_scroll();

// enqueue styles and scripts
/*
wp_enqueue_style('woocommerce-checkout-quick-scroll-styles', plugin_dir_url( __FILE__ ) . 'public/css/woocommerce-checkout-quick-scroll-public.css' );

add_action('wp_enqueue_scripts', 'qg_enqueue');
function qg_enqueue() {
    wp_enqueue_script(
        'qgjs',
        plugin_dir_url(__FILE__).'public/js/woocommerce-checkout-quick-scroll-public.js'
    );
}
*/
