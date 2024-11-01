<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       swiftdesigns.com.au
 * @since      1.0.0
 *
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/admin
 * @author     John Cook <hello@swiftdesigns.com.au>
 */
class Woocommerce_Checkout_Quick_Scroll_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $woo_checkout_quick_scroll    The ID of this plugin.
	 */
	private $woo_checkout_quick_scroll;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $woo_checkout_quick_scroll       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $woo_checkout_quick_scroll, $version ) {

		$this->woo_checkout_quick_scroll = $woo_checkout_quick_scroll;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {
        if ( 'woocommerce_page_wccqs-settings-page' != $hook ) {
                return;
        }

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Checkout_Quick_Scroll_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Checkout_Quick_Scroll_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->woo_checkout_quick_scroll, plugin_dir_url( __FILE__ ) . 'css/woocommerce-checkout-quick-scroll-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Checkout_Quick_Scroll_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Checkout_Quick_Scroll_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->woo_checkout_quick_scroll, plugin_dir_url( __FILE__ ) . 'js/wp-color-picker-script.js', array( 'wp-color-picker' ), false, true );

		wp_enqueue_script( $this->woo_checkout_quick_scroll, plugin_dir_url( __FILE__ ) . 'js/woocommerce-checkout-quick-scroll-admin.js', array( 'jquery' ), $this->version, false );

	}

}
/**
*
*
* Begin constructing the fun stuff of the plugin
* In this section we will add all the admin fields and selectors
*
*/
// New feature - Add a restock notice on product page
/*
 *
 * Add meta field to product pages for out of stock message
 *
 *
*/
add_action( 'woocommerce_product_options_stock_fields', 'wccqs_restock_notice_field' );
function wccqs_restock_notice_field() {
	global $woocommerce, $post;
	woocommerce_wp_textarea_input(
		array(
			'id'          => 'wccqs_restock_notice',
			'placeholder' => 'Back in stock by Friday!',
			'label'       => 'Restock notice',
			'description' => "Let your customers know when the product will be back in stock. Notice: This will also change the backorder text. eg. Don't allow backorder will display this message below the out of stock message. Allow backorder will replace backorder text with this message",
			'desc_tip'    => 'true',
		)
	);
}

// save data
add_action( 'woocommerce_process_product_meta', 'wccqs_restock_notice_save_data' );
function wccqs_restock_notice_save_data( $post_id ) {
	if ( 'no' === get_option( 'woocommerce_manage_stock' ) ) {
		return;
	}

	$wccqs_restock_notice_textarea = $_POST['wccqs_restock_notice'];
	if ( isset( $wccqs_restock_notice_textarea ) ) {
		update_post_meta( $post_id, 'wccqs_restock_notice', esc_html( $wccqs_restock_notice_textarea ) );
	}
}

// Set up settings page and menu item
add_action( 'admin_menu', 'wc_checkout_quick_scroll_add_admin_menu' );
add_action( 'admin_init', 'wc_checkout_quick_scroll_settings_init' );

function wc_checkout_quick_scroll_add_admin_menu(  ) {
    add_submenu_page( 'woocommerce', 'Woo Checkout Quick Scroll Settings', 'Woo Checkout Quick Scroll Settings', 'manage_options', 'wccqs-settings-page', 'wc_checkout_quick_scroll_options_page' );
}

function wc_checkout_quick_scroll_settings_init(  ) {
    register_setting( 'wccqsPlugin', 'wc_checkout_quick_scroll_settings' );
    add_settings_section(
        'wc_checkout_quick_scroll_wccqsPlugin_section',
        __( 'Name your button', 'wordpress' ),
        'wc_checkout_quick_scroll_settings_section_callback',
        'wccqsPlugin'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_0',
        __( 'Scroll to shipping details text <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short name for your button here that will be visible on the checkout page below the billing form and will allow for a quick scroll directly to shipping details section. eg. Skip to shipping details</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_0_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_1',
        __( 'Scroll to payment details text (below billing form) <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short name for your button here that will be visible on the checkout page below the billing form and will allow for a quick scroll directly to payment section. eg. Standard delivery and skip to payment</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_1_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_2',
        __( 'Scroll to payment details text (below shipping rates) <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short name for your button here that will be visible on the checkout page below the shipping details and will allow for a quick scroll directly to payment details section. eg. Go to payment</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_2_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    ); 

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_6',
        __( 'Button colors (must include # or RGBA before numbers) <span class="wccqs-query">?<span class="wccqs-tooltip">Enter the hex color for your button. This is the background color, not the text color. It can be rgba or #. eg #ff0000. Default is #96588a</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_6_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    ); 

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_font',
        __( 'Button text colors (must include # or RGBA before numbers) <span class="wccqs-query">?<span class="wccqs-tooltip">Enter the hex color for your button. This is the  text color. It can be rgba or #. eg #ff0000. Default is theme default</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_font_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    ); 

    add_settings_field(
        'wc_checkout_quick_scroll_select_field_5',
        __( 'Disable buttons on desktop', 'wordpress' ),
        'wc_checkout_quick_scroll_select_field_5_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_3',
        __( 'Terms and conditions text <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short T and C terms here that will be visible on the checkout page near the pay now button. eg. You accept that we have a 5 day production and handling  time</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_3_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_7',
        __( 'Backorder notice text <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short message here that will be visible on the checkout page near the pay now button when products in the cart are on backorder. eg. Your cart contacts products on backorder - Postage delays can be expected</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_7_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_8',
        __( 'Top of checkout page message <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short message here that will be visible on the checkout page at the top of the screen. This is handy to display an important shop message eg. We are on holidays until Sunday</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_8_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );
	
    add_settings_field(
        'wc_checkout_quick_scroll_text_field_backinstock',
        __( 'Restocking message font color (must include # or RGBA before numbers) <span class="wccqs-query">?<span class="wccqs-tooltip">Enter the hex color for restocking message. It can be rgba or #. eg #ff0000. Default is theme color</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_backinstock',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    ); 
	
    add_settings_field(
        'wc_checkout_quick_scroll_select_field_9',
        __( 'Improved out of stock display', 'wordpress' ),
        'wc_checkout_quick_scroll_select_field_9_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_10',
        __( 'Out of stock message title <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short message here that will be visible on the product page above the gallery. This will display something saying that the item is out of stock eg. Oops, All Sold Out</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_10_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );

    add_settings_field(
        'wc_checkout_quick_scroll_text_field_11',
        __( 'Out of stock message sub heading <span class="wccqs-query">?<span class="wccqs-tooltip">Enter a short message here encouraging shoppers to explore related products eg. Perhaps one of the following will interest you?</span></span>', 'wordpress' ),
        'wc_checkout_quick_scroll_text_field_11_render',
        'wccqsPlugin',
        'wc_checkout_quick_scroll_wccqsPlugin_section'
    );


}

function wc_checkout_quick_scroll_text_field_0_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_0]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_0']; ?>'>
    <?php
}

function wc_checkout_quick_scroll_text_field_1_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_1]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_1']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_2_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_2]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_2']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_6_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type="text" value="<?php echo $options['wc_checkout_quick_scroll_text_field_6']; ?>" class="my-color-field" id="color-picker-1" data-default-color="#e0e0e0" name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_6]'/> 

<?php
}

function wc_checkout_quick_scroll_text_field_font_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' value='<?php echo $options['wc_checkout_quick_scroll_text_field_font']; ?>' class="my-color-field" id="color-picker-2" data-default-color="#ddd" name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_font]' >

<?php
}

function wc_checkout_quick_scroll_select_field_5_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <select name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_select_field_5]'>
        <option value='1' <?php selected( $options['wc_checkout_quick_scroll_select_field_5'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['wc_checkout_quick_scroll_select_field_5'], 2 ); ?>>No</option>
    </select>
<br>
<br>
<h3>Need special text fields?</h3>
<p>Note: Leaving a field empty will not show the field in the front end</p>
<?php
}

function wc_checkout_quick_scroll_text_field_3_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_3]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_3']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_7_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_7]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_7']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_8_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_8]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_8']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_backinstock(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' value='<?php echo $options['wc_checkout_quick_scroll_text_field_backinstock']; ?>' class="my-color-field" id="color-picker-3" data-default-color="#601793" name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_backinstock]'>
<br>
<br>
<br>
<h3>Better out of stock display</h3>
<p>Note: Leaving a text field empty will not show the field in the front end. Setting the display to no will disable on the front end</p>
<p>Note: Some themes will display related products above the gallery (next to the short description) and some will display above the content. This section uses the built in Woocommerce related products code. If no products appear the theme either doesn't support related products (eg. overwriting it with theme specific code) or you don't have any related products. For besty accuracy try and place your products in appropriate categories and tags</p>
<?php
}

function wc_checkout_quick_scroll_select_field_9_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <select name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_select_field_9]'>
        <option value='1' <?php selected( $options['wc_checkout_quick_scroll_select_field_9'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['wc_checkout_quick_scroll_select_field_9'], 2 ); ?>>No</option>
    </select>
<?php
}

function wc_checkout_quick_scroll_text_field_10_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_10]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_10']; ?>'>

<?php
}

function wc_checkout_quick_scroll_text_field_11_render(  ) {
    $options = get_option( 'wc_checkout_quick_scroll_settings' );
    ?>
    <input type='text' name='wc_checkout_quick_scroll_settings[wc_checkout_quick_scroll_text_field_11]' value='<?php echo $options['wc_checkout_quick_scroll_text_field_11']; ?>'>

<?php
}

function wc_checkout_quick_scroll_settings_section_callback(  ) {
    echo __( 'Enter into the fields below the text that you want to appear on quick scroll buttons on the checkout page. These buttons will take your shoppers to either the shipping details or payment selection section of the checkout page instantly, vastly inproving user experience. You can use some simple CSS styling placed in the theme customizer found in appearance>>customize>>additional css to change the colour of the buttons. The selector is a.go-pay. Visit the read me text file for more customisation tips', 'wordpress' );
}

function wc_checkout_quick_scroll_options_page(  ) {
    ?>
    <form action='options.php' method='post'>

        <h2>WooCommerce Quick Scroll Settings</h2>

        <?php
        settings_fields( 'wccqsPlugin' );
        do_settings_sections( 'wccqsPlugin' );
        submit_button();
        ?>

    </form>
    <?php
}

