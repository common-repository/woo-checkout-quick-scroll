Woo Checkout Quick Scroll
Contributors: Johnc1979
Donate link: swiftdesigns.com.au
Tags: WooCommerce, checkout, buttons
Requires at least: 3.5
Requires PHP: 5.6
Tested up to: 5.1
Stable tag: 1.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Woo Checkout Quick Scroll places up to 3 buttons on the checkout page to allow shoppers to quickly scroll to the next section.

== Description ==

Woocommerce Checkout Quick Scroll places up to 3 buttons on the checkout page to allow shoppers to quickly scroll to the next section. Shop admins can set the text for each button and the color of the buttons. In this version all buttons will be the same color. The default color is the Woocommerce colors.

**Why would you need this?**

When I'm shopping on a mobile device I hate scrolling, especially when I don't know how long a form might be. By strategically placing buttons on the checkout page you can help your shoppers bypass some annoying scrolling and get to payment much quicker.

**What are the buttons?**

The first section contains 2 buttons just below the billing form. The first will take shoppers to the shipping section and the second will take shoppers to the payment section.

the second section contains 1 button below the shipping field which will scroll to the payment section.

**What if I don't want a button there?**

Easy as. Simply leave the field empty and no button will display

**I can see a benefit for this on mobiles, can it be disabled for desktop?**

It sure can. There's an option to disable the buttons for desktop display. Simply select yes and the buttons won't appear on a desktop

**Does it work with a multistep checkout?**

I haven't tested it, but I wouldn't think so. If you want to use this on mobiles and get rid of the pesky multistep checkout for mobiles I recommend installing Plugin Organizer. With Plugin Organizer you can selectively load plugins on a page by page basis and for mobile or desktop use. To use a multistep checkout with this plugin and Plugin Organizer simply enable selective mobile loading then edit the checkout page. Drag the multistep checkout plugin to the mobile section and it will be disabled for mobile devices.

**What else is included in the plugin?**

**Additional checkbox**
As a bonus there are some additional sections. You can create an additional T&C field. This is ideal for handmade ot made to order products which requires a checkbox confirmation.

**A backorder notice**
If the customer has a product in their cart that's on backorder it will display a notice with a warning symbol near the pay button

**Top of checkout message**
If you need to advertise an important message on the checkout to grab buyers attention, such as holiday notice, you can set a message here. This text will appear centered at the top of the checkout page in h2 text

**Improved out of stock display**
If you have a product that's out of stock and it brings traffic, there's nothing worse as a buyer, or shop owner, seeing the product out of stock. This could cause unwanted bounces and lost sales. Even more annoying is you may have something that is related and the shopper may have bought. This section aims to solve that.

Once enabled it will display related products below the product title when an item is out of stock. You can even set 2 lines of messages informing buyers. eg. Sorry, out of stock. Perhaps one of the following may interest you? This can help reduce bounces, which we all know Google hate and is a negative SEO signal

**New feature - Restocking notice**
This adds a new field to the individual product edit page. It will become visible when manage stock is enabled. In the field that appears you can add a restocking notice that will appera below the out of stock notice. You can use this either in conjunction with the improved out of stock display or by itself. If the field is left blank nothing will appear. You can define the color of the text in the general Woo Quick Scroll settings page. If left empty it will default tot he theme color.

**Will this plugin work on all themes?**

It should. It doesn't really do anything fancy, but some themes might alter the way Woocommerce does things.

**Cache**

Most of the settings should not need a cache to be cleared for the changes to be visible on the frontend. If you do need to clear the cache on the frontend to see changes on the checkout page you are caching your checkout page and should rectify it ASAP. Only the improved out of stock display will need the have the cache cleared to see changes on the frontend. Once activated changes to stock status should purge the cache automatically resulting in the change being visible instantly.

**Future releases**
I plan to expand the plugin further to allow users to make additional changes to the checkout page and flow as well as cart and product pages

== Installation ==

1. Upload `woocommerce-checkout-quick-scroll.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings, WooCommerce Quick Scroll Settings

Or

1. Search Woocommerce Checkout Quick Scroll in add new plugin
2. Click Install
3. Click Activate
4. Go to settings, WooCommerce Quick Scroll Settings

== Frequently Asked Questions ==

None yet

== Screenshots ==

1. Settings page
2. Showing button placement below the billing form
3. Showing the billing form when button fields are left empty
4. Top of checkout message
5. Backorder alert and additional T&C field
6. Out of stock display on Woocommerce product page
7. Gif showing the buttons in action on a smart phone
8. Restock field product page admin view
9. Restock message product page frontend


== Changelog ==
= 1.0.6 =
* Fixed php warnings
* Fixed admin styling

= 1.0.5 =
* New feature: Added color picker to replace manual hex entry
* Improvement: Added font color option for buttons
* Improvement: Slight settings page reorder
* Improvement: Back in stock notice now changes backorder text. eg. You can customise the backorder text
* Bug fix: Fixed checkbox validation
* Bug fix: Empty stock notice text field now saves as empty instead of saving last known input

= 1.0.4 =
* Bug fix: Admin option for restocking color was missing

= 1.0.3 =
* New feature: Add a back in stock notice on a per product basis. You can customise the colour display in the settings panel
* Enhancement: Moved settings page to WooCommerce menu
* Bug fix: public CSS button link

= 1.0.2 =
* Added ID's to the checkout page to fix themes that don't use the standard Woo ID's
* Reformatted links to point to new ID's

= 1.0.1 =
* Bug fixes (jQuery)
* Broken link fixes
* Bold backorder alert
* Renamed settings page to Woo Checkout Quick Scroll Settings

= 1.0 =
* Initial Release

== Upgrade Notice ==
= 1.0.6 =
* Fixed php warnings
* Fixed admin styling

= 1.0.5 =
* New feature: Added color picker to replace manual hex entry
* Improvement: Added font color option for buttons
* Improvement: Slight settings page reorder
* Improvement: Back in stock notice now changes backorder text. eg. You can customise the backorder text
* Bug fix: Fixed checkbox validation
* Bug fix: Empty stock notice text field now saves as empty instead of saving last known input

= 1.0.4 =
* Bug fix: Admin option for restocking color was missing

= 1.0.3 =
* New feature: Add a back in stock notice on a per product basis. You can customise the colour display in the settings panel
* Enhancement: Moved settings page to WooCommerce menu
* Bug fix: public CSS button link

= 1.0.2 =
* Added ID's to the checkout page to fix themes that don't use the standard Woo ID's
* Reformatted links to point to new ID's

= 1.0.1 =
* Bug fixes (jQuery)
* Broken link fixes
* Bold backorder alert
* Renamed settings page to Woo Checkout Quick Scroll Settings

= 1.0 =
* Initial Release
