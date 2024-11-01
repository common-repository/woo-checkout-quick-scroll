<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       swiftdesigns.com.au
 * @since      1.0.0
 *
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Checkout_Quick_Scroll
 * @subpackage Woocommerce_Checkout_Quick_Scroll/public
 * @author     John Cook <hello@swiftdesigns.com.au>
 */
class Woocommerce_Checkout_Quick_Scroll_Public {

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
	 * @param      string    $woo_checkout_quick_scroll       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $woo_checkout_quick_scroll, $version ) {

		$this->woo_checkout_quick_scroll = $woo_checkout_quick_scroll;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->woo_checkout_quick_scroll, plugin_dir_url( __FILE__ ) . 'css/woocommerce-checkout-quick-scroll-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->woo_checkout_quick_scroll, plugin_dir_url( __FILE__ ) . 'js/woocommerce-checkout-quick-scroll-public.js', array( 'jquery' ), $this->version, false );

	}

}
// add a special div id for the order form that may be missing in some themes - above order details
add_action('woocommerce_checkout_before_order_review', 'wcqs_order_details_id');
    function wcqs_order_details_id(){
        echo '<div id="order_review_heading_special"></div>';
}

// add a special div id for the order form that may be missing in some themes - above payment form
add_action('woocommerce_review_order_before_payment', 'wcqs_payment_details_id', 41);
    function wcqs_payment_details_id(){
        echo '<div id="order_payment_heading_special"></div>';
}

// first button below billing form
add_action('woocommerce_after_checkout_billing_form', 'go_to_ship_pay');
function go_to_ship_pay() {
  $settings = get_option('wc_checkout_quick_scroll_settings');

  //Check if the array is set
  if(isset($settings['wc_checkout_quick_scroll_text_field_0']) && !empty($settings['wc_checkout_quick_scroll_text_field_0'])){
     echo '<a class="go-pay" href="#order_review_heading_special">';
     echo $settings['wc_checkout_quick_scroll_text_field_0'];  
     echo '</a>';
     echo '<br>';  
  }

 //Check the other value and show it
 if(isset($settings['wc_checkout_quick_scroll_text_field_1']) && !empty($settings['wc_checkout_quick_scroll_text_field_1'])){
     echo '<a class="go-pay" href="#order_payment_heading_special">';   
     echo $settings['wc_checkout_quick_scroll_text_field_1']; 
     echo '</a>';
  }


} 

// second set of buttons linking to payment only section
add_action('woocommerce_review_order_before_payment', 'go_pay');
    function go_pay(){

  $settings2 = get_option('wc_checkout_quick_scroll_settings');

  //Check if the array is set
  if(isset($settings2['wc_checkout_quick_scroll_text_field_2']) && !empty($settings2['wc_checkout_quick_scroll_text_field_2'])){
     echo '<a class="go-pay" href="#order_payment_heading_special">';
     echo $settings2['wc_checkout_quick_scroll_text_field_2'];  
     echo '</a>'; 
   }
}

// checkbox
add_action('woocommerce_review_order_before_submit', 'add_my_checkout_tickbox', 15);
  
function add_my_checkout_tickbox() {
   $settings3 = get_option('wc_checkout_quick_scroll_settings');
     //check if is in array
       if(isset($settings3['wc_checkout_quick_scroll_text_field_3']) && !empty($settings3['wc_checkout_quick_scroll_text_field_3'])){
     echo '<p class="form-row terms"> <input type="checkbox" class="input-checkbox" name="deliverycheck" id="deliverycheck" /> <label for="deliverycheck" class="checkbox">';
     echo $settings3[wc_checkout_quick_scroll_text_field_3];
     echo '</label> </p>';
   }

}
// tick the box to acknowledge handling time response if not checked
  
add_action('woocommerce_checkout_process', 'not_ticked_box');
 
function not_ticked_box() {
   $settings3 = get_option('wc_checkout_quick_scroll_settings');
    // check if in array
          if(isset($settings3[wc_checkout_quick_scroll_text_field_3]) && !empty($settings3[wc_checkout_quick_scroll_text_field_3])){
    if ( ! (int) isset( $_POST['deliverycheck'] ) ) {
// Display error message
        wc_add_notice( __( 'Please acknowledge ' . $settings3[wc_checkout_quick_scroll_text_field_3] . ' checkbox' ), 'error' );
    }
  }
}

// Media screen css to hide on desktop
add_action ( 'wp_head', 'hook_inHeader' );
function hook_inHeader() {
   $settings5 = get_option('wc_checkout_quick_scroll_settings');

if(isset($settings5['wc_checkout_quick_scroll_select_field_5']) && $settings5['wc_checkout_quick_scroll_select_field_5'] == '1'){

echo '<link href="/wp-content/plugins/woo-checkout-quick-scroll/public/css/media-css/media-new.css" rel="stylesheet">';
   }
}

// add button color to head
add_action ( 'wp_head', 'color_inHeader' );
function color_inHeader() {
  $settings6 = get_option('wc_checkout_quick_scroll_settings');
  if(isset($settings6['wc_checkout_quick_scroll_text_field_6']) && !empty($settings6['wc_checkout_quick_scroll_text_field_6'])){
?>
		<style type="text/css">
			a.go-pay {
				background-color: <?php echo $settings6['wc_checkout_quick_scroll_text_field_6']; ?> !important;
			}
                        a.go-pay:hover {
                                opacity:.7 !important;
                        }
		</style>
	<?php
    }
}

// add button font color to head
add_action ( 'wp_head', 'textcolor_inHeader' );
function textcolor_inHeader() {
  $settings_font = get_option('wc_checkout_quick_scroll_settings');
  if(isset($settings_font['wc_checkout_quick_scroll_text_field_font']) && !empty($settings_font['wc_checkout_quick_scroll_text_field_font'])){
?>
		<style type="text/css">
			a.go-pay {
				color: <?php echo $settings_font['wc_checkout_quick_scroll_text_field_font']; ?> !important;
			}
                        a.go-pay:hover {
                                opacity:.8 !important;
                        }
		</style>
	<?php
    }
}

// backorder text
add_action( 'woocommerce_review_order_before_submit', 'wccqs_checkout_add_cart_notice', 5 );

function wccqs_checkout_add_cart_notice() {
   $settings7 = get_option('wc_checkout_quick_scroll_settings');
     if(isset($settings7['wc_checkout_quick_scroll_text_field_7']) && !empty($settings7['wc_checkout_quick_scroll_text_field_7'])){
        if ( wccqs_check_cart_has_backorder_product() ) {
          echo '<div class="out-of-stock-messsage">';
          echo $settings7['wc_checkout_quick_scroll_text_field_7'];
          echo '</div>';
    }
  }
}

function wccqs_check_cart_has_backorder_product() {
    foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
        $cart_product =  wc_get_product( $values['data']->get_id() );

        if( $cart_product->is_on_backorder() )
            return true;
    }

    return false;
}

// Add a message to top of checkout page centered
add_action('woocommerce_before_checkout_form', 'wccqs_important_message');
    function wccqs_important_message(){

  $settings8 = get_option('wc_checkout_quick_scroll_settings');

  //Check if the array is set
  if(isset($settings8['wc_checkout_quick_scroll_text_field_8']) && !empty($settings8['wc_checkout_quick_scroll_text_field_8'])){
     echo '<h2 style="text-align:center;">';
     echo $settings8['wc_checkout_quick_scroll_text_field_8'];
     echo '</h2>';
  }
}
   
// out of stock
add_action( 'woocommerce_single_product_summary', 'wccqs_related_out_of_stock', 6);
function wccqs_related_out_of_stock () {
	$settings9 = get_option('wc_checkout_quick_scroll_settings');
	if(isset($settings9['wc_checkout_quick_scroll_select_field_9']) && $settings9['wc_checkout_quick_scroll_select_field_9'] == '1'){

		global $product;
		$availability = $product->get_availability();

/*check if availability in the array = string 'Out of Stock'
**if so display on page.
*/
if ( $availability['availability'] == 'Out of stock') {
   $settings10 = get_option('wc_checkout_quick_scroll_settings');
      if(isset($settings10['wc_checkout_quick_scroll_text_field_10']) && !empty($settings10['wc_checkout_quick_scroll_text_field_10'])){
	//create title
    echo '<h2 style="text-align:center;text-decoration:underline;font-size:2em;">';
    echo $settings10['wc_checkout_quick_scroll_text_field_10'];
    echo '</h2>';
  }
     $settings11 = get_option('wc_checkout_quick_scroll_settings');
      if(isset($settings11['wc_checkout_quick_scroll_text_field_11']) && !empty($settings11['wc_checkout_quick_scroll_text_field_11'])){
    echo '<h3 style="text-align:center;">';
    echo $settings11['wc_checkout_quick_scroll_text_field_11'];
    echo '</h3>';
  }
	//Create args to display related products
    $args = array( 
    'posts_per_page' => 3,  
    'columns' => 3,  
    'orderby' => 'rand' 
    ); 
	//output results
    woocommerce_related_products( apply_filters( 'wccqs_related_out_of_stock_args', $args ) ); 
    }
  }
}
// New feature
// This option is visible on the product edit page in the inventory section
/*
 * Display product text field
*/
add_filter( 'woocommerce_get_stock_html', 'wccqs_restock_notice_display', 10, 2 );
function wccqs_restock_notice_display( $html, $product ) {
	$notice = get_post_meta( $product->get_ID(), 'wccqs_restock_notice', true );
	$stock_status = $product->get_stock_status();

	if ( empty( $notice ) || 0 < $product->get_stock_quantity() || 'outofstock' !== $stock_status ) {
		return $html;
	}

	$html .= '<p class="wccqs-restock-notice">' . esc_html( $notice ) . '</p>';

	return $html;
}

// new backorder text
function wccqs_change_backorder_message( $text, $product ){
    $notice = get_post_meta( $product->get_ID(), 'wccqs_restock_notice', true );
    if ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
        $text = '<p class="wccqs-restock-notice">' . __( $notice, 'your-textdomain' ) . '</p>';
    }
    return $text;
}
add_filter( 'woocommerce_get_availability_text', 'wccqs_change_backorder_message', 10, 2 );

// add back in stock color to head
add_action ( 'wp_head', 'backinstock_color_inHeader' );
function backinstock_color_inHeader() {
  $settings_backinstock = get_option('wc_checkout_quick_scroll_settings');
  if(isset($settings_backinstock['wc_checkout_quick_scroll_text_field_backinstock']) && !empty($settings_backinstock['wc_checkout_quick_scroll_text_field_backinstock'])){
?>
		<style type="text/css">
			p.wccqs-restock-notice {
				color: <?php echo $settings_backinstock['wc_checkout_quick_scroll_text_field_backinstock']; ?> !important;
                                font-weight: 700;
			}
		</style>
	<?php
    }
}