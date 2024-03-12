<?php
/*SOURCE https://www.wpexplorer.com/wordpress-theme-options/ 
MODIFIED SOME FUNCTIONS
*/
/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Theme_Options' ) ) {

	class WPEX_Theme_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'WPEX_Theme_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'WPEX_Theme_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Options', 'text-domain' ),
				esc_html__( 'Theme Options', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'WPEX_Theme_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'WPEX_Theme_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Phone
				if ( ! empty( $options['phone_number'] ) ) {
					$options['phone_number'] = sanitize_text_field( $options['phone_number'] );
				} else {
					unset( $options['phone_number'] ); // Remove from options if empty
				}
				
				// Fax
				if ( ! empty( $options['fax_number'] ) ) {
					$options['fax_number'] = sanitize_text_field( $options['fax_number'] );
				} else {
					unset( $options['fax_number'] ); // Remove from options if empty
				}

				// Address
				if ( ! empty( $options['address1_text'] ) ) {
					$options['address1_text'] = sanitize_text_field( $options['address1_text'] );
				} else {
					unset( $options['address1_text'] ); // Remove from options if empty
				}
				
				if ( ! empty( $options['address2_text'] ) ) {
					$options['address2_text'] = sanitize_text_field( $options['address2_text'] );
				} else {
					unset( $options['address2_text'] ); // Remove from options if empty
				}
				
				// Facebook
				if ( ! empty( $options['fb_link'] ) ) {
					$options['fb_link'] = sanitize_text_field( $options['fb_link'] );
				} else {
					unset( $options['fb_link'] ); // Remove from options if empty
				}
				
				// Twitter
				if ( ! empty( $options['twit_link'] ) ) {
					$options['twit_link'] = sanitize_text_field( $options['twit_link'] );
				} else {
					unset( $options['twit_link'] ); // Remove from options if empty
				}
				
				// Linkedin
				if ( ! empty( $options['linked_link'] ) ) {
					$options['linked_link'] = sanitize_text_field( $options['linked_link'] );
				} else {
					unset( $options['linked_link'] ); // Remove from options if empty
				}
				
				// Pinterest
				if ( ! empty( $options['pin_link'] ) ) {
					$options['pin_link'] = sanitize_text_field( $options['pin_link'] );
				} else {
					unset( $options['pin_link'] ); // Remove from options if empty
				}
				
			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Theme Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">

						<?php // Checkbox example ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Custom Logo Upload', 'text-domain' ); ?></th>
							<td>
										<?php wp_nonce_field('_update_logo', '_update_logo'); ?>
								<label for="logo" style="display: block;height: 200px;width: 200px;line-height: 200px;text-align: center;font-size: 18px;color:#fff;<?php 
								if (has_custom_logo()) {
								$custom_logo_id = get_theme_mod( 'custom_logo' );
								$image = wp_get_attachment_image_src( $custom_logo_id , 'medium' );
								echo 'background:url( $value = self::get_theme_option( "custom_logo" );'.esc_html($image[0]).') no-repeat center center;background-size: contain';
								}	else {
								echo 'background:#444';
								}
								?>" >	
								Upload Logo
								</label>
								<input type="file" id="logo" style="visibility:hidden">
								<br>
								<input type="button" onClick="removeLogo()" value="Remove Logo">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Phone Number', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'phone_number' ); ?>
								<input type="text" name="theme_options[phone_number]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Fax Number', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'fax_number' ); ?>
								<input type="text" name="theme_options[fax_number]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Address First Line', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'address1_text' ); ?>
								<input type="text" name="theme_options[address1_text]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Address Second Line', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'address2_text' ); ?>
								<input type="text" name="theme_options[address2_text]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Facebook Link', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'fb_link' ); ?>
								<input type="text" name="theme_options[fb_link]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Twitter Link', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'twit_link' ); ?>
								<input type="text" name="theme_options[twit_link]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Linkedin Link', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'linked_link' ); ?>
								<input type="text" name="theme_options[linked_link]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Pinterest Link', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'pin_link' ); ?>
								<input type="text" name="theme_options[pin_link]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
			<script type="text/javascript">
//remove logo
function removeLogo() {
				var ajaxurl = '<?php echo esc_url(admin_url("admin-ajax.php")); ?>';
				var nonce = document.getElementById("_update_logo").value;
				
			var data = new FormData();
			data.append("nonce", nonce);
			data.append("action", "removelogo");
			var value = jQuery.ajax({
				url: ajaxurl,
				data : data,
				type: 'POST',
				cache: false,
	            processData: false, // Don't process the files
	            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {	
				var logo = document.getElementById("logo").parentElement.getElementsByTagName('label')[0];
					console.log('data.response ' + data["response"] + ' ' + textStatus);
					if( data.response == 'SUCCESS' ){
					logo.innerHTML = 'Deleted';
					logo.style.background = "#444";
					}	if( data.response == 'ERROR' ){
					logo.style.background = '#fdd2d2';
					logo.innerHTML = 'Error: '+data.error;
					console.log(data.debug);
					}
					},
				error: function(jqXHR, textStatus, errorThrown){ 
				var logo = document.getElementById("logo").parentElement.getElementsByTagName('label')[0];				
					logo.style.background = '#fdd2d2';
					logo.innerHTML = 'Error: '+errorThrown;
					}
				})
			};

//update logo
var logo = document.getElementById("logo");
logo.addEventListener("change", function (e) {

			var ajaxurl = '<?php echo esc_url(admin_url("admin-ajax.php")); ?>';
			var nonce = document.getElementById("_update_logo").value;

				this.parentElement.getElementsByTagName('label')[0].innerHTML = "Wait a Bit";
				this.parentElement.getElementsByTagName('label')[0].style.background = "#444";
				meta = this.files[0].name;
				file = this.files[0];
			
				 if( file.type === "image/jpg" || file.type === "image/png"  || file.type === "image/jpeg") {
		         extension = true;
		        } else {
					this.parentElement.getElementsByTagName("label")[0].style.background = "#fdd2d2";
					this.parentElement.getElementsByTagName("label")[0].innerHTML = "Jpg/png plz";
				}
			
			if (extension === true) {
			var data = new FormData();
			data.append("file", file);
			data.append("nonce", nonce);
			data.append("meta", meta);
			data.append("action", "updatelogo");
			var value = jQuery.ajax({
				url: ajaxurl,
				data : data,
				type: 'POST',
				cache: false,
	            processData: false, // Don't process the files
	            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {	
				var logo = document.getElementById("logo").parentElement.getElementsByTagName('label')[0];
					console.log('data.response ' + data["response"] + ' ' + textStatus);
					if( data.response == 'SUCCESS' ){
						logo.innerHTML = 'Updated';
					   logo.style.background = "url('" + data.thumb +"') no-repeat center center";
					   logo.style.backgroundSize = "contain";
					}	if( data.response == 'ERROR' ){
					logo.style.background = '#fdd2d2';
					logo.innerHTML = 'Error: '+data.error;
					console.log(data.debug);
					}
					},
				error: function(jqXHR, textStatus, errorThrown){ 
				var logo = document.getElementById("logo").parentElement.getElementsByTagName('label')[0];				
					logo.style.background = '#fdd2d2';
					logo.innerHTML = 'Error: '+errorThrown;
					}
				})
			}
			
		}, true);
</script>
		<?php }

	}
}
new WPEX_Theme_Options();

// Helper function to use in your theme to return a theme option value
function ct_custom_get_theme_option( $id = '' ) {
	return WPEX_Theme_Options::get_theme_option( $id );
}