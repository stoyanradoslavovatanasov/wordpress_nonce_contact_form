# wordpress_nonce_contact_form
=== WP Nonce Contact From ===
Contributors: Stoyan Atanasov
Tags: nonce, contact form, wp, wordpress, plugin
Requires at least: 3.5.0
Tested up to: 4.9.0

Simple wordpress contact form that uses wp_nonces functionality in order to avoid SPAM messages.

== Description ==

   Simple wordpress contact form that uses wp_nonces functionality. After user submit the contact form with his uniq nonce id the plugin logs his id.
   If he tries to submit another form before his nonce id has exprired. He will get the following message "You have already submitted this form. Thanks!"
   After the plugin has been activated, it automaticly created page with the name "contactus", redirect_contactus creates redirect to the form, so it can be seen in cotactsus page.
   The plugn's backend is visable in Settigns -> General at the botton of the page. I this page we load all contact form messages from each xml file so we can view them in the backend, 
   we aslo have a button that allows us to delete all the messages.
   We can change nonce security code expire time, if we would like the timeframe between each message form a single user to last longer.

== Installation ==

1. Upload `wp-nonce-stoyan` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The contact form page will be accesalbe under http:\\yourwebsite.com\contactus 

== Changelog ==

= 1.0 =
* Initial release
