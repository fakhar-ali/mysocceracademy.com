<?php

/**
 * WPForms Pro. Load Pro specific features/functionality.
 *
 * @since 1.2.1
 */
class WPForms_Pro {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.2.1
	 */
	public function __construct() {

		$this->constants();
		$this->includes();

		$this->init();
	}

	/**
	 * Setup plugin constants.
	 *
	 * @since 1.2.1
	 */
	public function constants() {

		// Plugin Updater API.
		if ( ! defined( 'WPFORMS_UPDATER_API' ) ) {
			define( 'WPFORMS_UPDATER_API', 'https://wpforms.com/' );
		}
	}

	/**
	 * Include files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/class-entry.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/class-entry-fields.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/class-entry-meta.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/class-conditional-logic-core.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/class-conditional-logic-fields.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/payments/class-payment.php';
		require_once WPFORMS_PLUGIN_DIR . 'pro/includes/payments/functions.php';

		if ( is_admin() || wp_doing_cron() ) {
			require_once WPFORMS_PLUGIN_DIR . 'pro/includes/admin/ajax-actions.php';
			require_once WPFORMS_PLUGIN_DIR . 'pro/includes/admin/entries/class-entries-single.php';
			require_once WPFORMS_PLUGIN_DIR . 'pro/includes/admin/entries/class-entries-list.php';
			require_once WPFORMS_PLUGIN_DIR . 'pro/includes/admin/class-updater.php';
			require_once WPFORMS_PLUGIN_DIR . 'pro/includes/admin/class-license.php';
		}
	}

	/**
	 * Hook in various places in WordPress and WPForms.
	 *
	 * @since 1.5.9
	 */
	public function init() {

		add_action( 'init', array( $this, 'load_textdomain' ), 10 );
		add_filter( 'plugin_action_links_' . plugin_basename( WPFORMS_PLUGIN_DIR . 'wpforms.php' ), array( $this, 'plugin_action_links' ), 11 );
		add_action( 'wpforms_loaded', array( $this, 'objects' ), 1 );
		add_action( 'wpforms_loaded', array( $this, 'updater' ), 30 );
		add_action( 'wpforms_install', array( $this, 'install' ), 10 );
		add_filter( 'wpforms_settings_tabs', array( $this, 'register_settings_tabs' ), 5, 1 );
		add_filter( 'wpforms_settings_defaults', array( $this, 'register_settings_fields' ), 5, 1 );
		add_action( 'wpforms_settings_init', array( $this, 'reinstall_custom_tables' ) );
		add_action( 'wpforms_process_entry_save', array( $this, 'entry_save' ), 10, 4 );
		add_action( 'wpforms_form_settings_general', array( $this, 'form_settings_general' ), 10 );
		add_filter( 'wpforms_overview_table_columns', array( $this, 'form_table_columns' ), 10, 1 );
		add_filter( 'wpforms_overview_table_column_value', array( $this, 'form_table_columns_value' ), 10, 3 );
		add_action( 'wpforms_form_settings_notifications', array( $this, 'form_settings_notifications' ), 8, 1 );
		add_action( 'wpforms_form_settings_confirmations', array( $this, 'form_settings_confirmations' ) );
		add_filter( 'wpforms_builder_strings', array( $this, 'form_builder_strings' ), 10, 2 );
		add_filter( 'wpforms_frontend_strings', array( $this, 'frontend_strings' ) );
		add_action( 'admin_notices', array( $this, 'conditional_logic_addon_notice' ) );
		add_action( 'wpforms_builder_print_footer_scripts', array( $this, 'builder_templates' ) );
		add_filter( 'wpforms_email_footer_text', array( $this, 'form_notification_footer' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueues' ) );
		add_filter( 'wpforms_helpers_templates_get_theme_template_paths', array( $this, 'add_templates' ) );
		add_filter( 'wpforms_integrations_usagetracking_is_enabled', '__return_true' );

		$this->allow_wp_auto_update_plugins();
	}

	/**
	 * Setup objects.
	 *
	 * @since 1.2.1
	 */
	public function objects() {

		// Global objects.
		wpforms()->entry        = new WPForms_Entry_Handler();
		wpforms()->entry_fields = new WPForms_Entry_Fields_Handler();
		wpforms()->entry_meta   = new WPForms_Entry_Meta_Handler();

		if ( is_admin() && ! wpforms()->license instanceof WPForms_License ) {
			wpforms()->license = new WPForms_License();
		}
	}

	/**
	 * Load plugin updater.
	 *
	 * @since 1.0.0
	 */
	public function updater() {

		if ( ! is_admin() ) {
			return;
		}

		$key = wpforms_get_license_key();

		if ( ! $key ) {
			return;
		}

		// Go ahead and initialize the updater.
		new \WPForms_Updater(
			array(
				'plugin_name' => 'WPForms',
				'plugin_slug' => 'wpforms',
				'plugin_path' => plugin_basename( WPFORMS_PLUGIN_FILE ),
				'plugin_url'  => trailingslashit( WPFORMS_PLUGIN_URL ),
				'remote_url'  => WPFORMS_UPDATER_API,
				'version'     => WPFORMS_VERSION,
				'key'         => $key,
			)
		);

		// Fire a hook for Addons to register their updater since we know the key is present.
		do_action( 'wpforms_updater', $key );
	}

	/**
	 * Handle plugin installation upon activation.
	 *
	 * @since 1.2.1
	 */
	public function install() {

		$wpforms_install               = new stdClass();
		$wpforms_install->entry        = new WPForms_Entry_Handler();
		$wpforms_install->entry_fields = new WPForms_Entry_Fields_Handler();
		$wpforms_install->entry_meta   = new WPForms_Entry_Meta_Handler();

		$this->create_custom_tables( $wpforms_install );

		$license = get_option( 'wpforms_connect', false );

		if ( $license ) {
			update_option(
				'wpforms_license',
				array(
					'key' => $license,
				)
			);
			$wpforms_install->license = new WPForms_License();
			$wpforms_install->license->validate_key( $license );
			delete_option( 'wpforms_connect' );
		}

		$this->force_translations_update();
	}

	/**
	 * Force WPForms Lite languages download on Pro activation.
	 *
	 * This action will force to download any new translations for WPForms Lite
	 * right away instead of waiting for 12 hours.
	 *
	 * @since 1.6.0
	 */
	protected function force_translations_update() {

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		require_once ABSPATH . 'wp-admin/includes/class-automatic-upgrader-skin.php';

		$locales = array_unique( array( get_locale(), get_user_locale() ) );

		if ( 1 === count( $locales ) && 'en_US' === $locales[0] ) {
			return;
		}

		$to_update = [];

		foreach ( $locales as $locale ) {
			$to_update[] = (object) array(
				'type'       => 'plugin',
				'slug'       => 'wpforms-lite',
				'language'   => $locale,
				'version'    => WPFORMS_VERSION,
				'package'    => 'https://downloads.wordpress.org/translation/plugin/wpforms-lite/' . WPFORMS_VERSION . '/' . $locale . '.zip',
				'autoupdate' => true,
			);
		}

		$upgrader = new Language_Pack_Upgrader( new Automatic_Upgrader_Skin() );
		$upgrader->bulk_upgrade( $to_update );
	}

	/**
	 * Load the separate PRO plugin translation file.
	 *
	 * @since 1.5.0
	 */
	public function load_textdomain() {

		// If the user is logged in, unset the current text-domains before loading our text domain.
		// This feels hacky, but this way a user's set language in their profile will be used,
		// rather than the site-specific language.
		if ( is_user_logged_in() ) {
			unload_textdomain( 'wpforms' );
		}

		load_plugin_textdomain( 'wpforms', false, dirname( plugin_basename( WPFORMS_PLUGIN_FILE ) ) . '/pro/assets/languages/' );
	}

	/**
	 * Add Pro-specific templates to the list of searchable template paths.
	 *
	 * @since 1.5.6
	 *
	 * @param array $paths Paths to templates.
	 *
	 * @return array
	 */
	public function add_templates( $paths ) {

		$paths = (array) $paths;

		$paths[102] = trailingslashit( __DIR__ . '/templates' );

		return $paths;
	}

	/**
	 * Add custom links to the WPForms plugin row on Plugins page.
	 *
	 * @since 1.5.9
	 *
	 * @param array $links Plugin row links.
	 *
	 * @return array
	 */
	public function plugin_action_links( $links ) {

		$custom = array();

		if ( isset( $links['support'] ) ) {
			unset( $links['support'] );
		}

		if ( isset( $links['settings'] ) ) {
			$custom['settings'] = $links['settings'];
			unset( $links['settings'] );
		}

		$custom['docs']    = sprintf(
			'<a href="%1$s" target="_blank" aria-label="%2$s" rel="noopener noreferrer">%3$s</a>',
			'https://wpforms.com/docs/',
			esc_attr__( 'Go to WPForms.com Docs page', 'wpforms' ),
			esc_html__( 'Docs', 'wpforms' )
		);
		$custom['support'] = sprintf(
			'<a href="%1$s" target="_blank" aria-label="%2$s" rel="noopener noreferrer">%3$s</a>',
			'https://wpforms.com/account/support/',
			esc_attr__( 'Go to WPForms.com Support page', 'wpforms' ),
			esc_html__( 'Support', 'wpforms' )
		);

		return array_merge( $custom, (array) $links );
	}

	/**
	 * Register Pro settings tabs.
	 *
	 * @since 1.3.9
	 *
	 * @param array $tabs Admin area tabs list.
	 *
	 * @return array
	 */
	public function register_settings_tabs( $tabs ) {

		// Add Payments tab.
		$payments = array(
			'payments' => array(
				'name'   => esc_html__( 'Payments', 'wpforms' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms' ),
			),
		);

		$tabs = wpforms_array_insert( $tabs, $payments, 'validation' );

		return $tabs;
	}

	/**
	 * Pro admin scripts and styles.
	 *
	 * @since 1.5.5
	 */
	public function admin_enqueues() {

		if ( ! wpforms_is_admin_page() ) {
			return;
		}

		$min = wpforms_get_min_suffix();

		// Pro admin styles.
		wp_enqueue_style(
			'wpforms-pro-admin',
			WPFORMS_PLUGIN_URL . "pro/assets/css/admin{$min}.css",
			array(),
			WPFORMS_VERSION
		);
	}

	/**
	 * Register Pro settings fields.
	 *
	 * @since 1.3.9
	 *
	 * @param array $settings Admin area settings list.
	 *
	 * @return array
	 */
	public function register_settings_fields( $settings ) {

		$currencies      = wpforms_get_currencies();
		$currency_option = [];

		// Format currencies for select element.
		foreach ( $currencies as $code => $currency ) {
			$currency_option[ $code ] = sprintf( '%s (%s %s)', $currency['name'], $code, $currency['symbol'] );
		}

		// Validation settings for fields only available in Pro.
		$settings['validation']['validation-phone']            = [
			'id'      => 'validation-phone',
			'name'    => esc_html__( 'Phone', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Please enter a valid phone number.', 'wpforms' ),
		];
		$settings['validation']['validation-fileextension']    = [
			'id'      => 'validation-fileextension',
			'name'    => esc_html__( 'File Extension', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'File type is not allowed.', 'wpforms' ),
		];
		$settings['validation']['validation-filesize']         = [
			'id'      => 'validation-filesize',
			'name'    => esc_html__( 'File Size', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'File exceeds max size allowed. File was not uploaded.', 'wpforms' ),
		];
		$settings['validation']['validation-maxfilenumber']    = [
			'id'      => 'validation-maxfilenumber',
			'name'    => esc_html__( 'File Uploads', 'wpforms' ),
			'type'    => 'text',
			'default' => sprintf( /* translators: %s - max number of files allowed. */
				esc_html__( 'File uploads exceed the maximum number allowed (%s).', 'wpforms' ),
				'{fileLimit}'
			),
		];
		$settings['validation']['validation-time12h']          = [
			'id'      => 'validation-time12h',
			'name'    => esc_html__( 'Time (12 hour)', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Please enter time in 12-hour AM/PM format (eg 8:45 AM).', 'wpforms' ),
		];
		$settings['validation']['validation-time24h']          = [
			'id'      => 'validation-time24h',
			'name'    => esc_html__( 'Time (24 hour)', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Please enter time in 24-hour format (eg 22:45).', 'wpforms' ),
		];
		$settings['validation']['validation-time-limit']       = [
			'id'      => 'validation-time-limit',
			'name'    => esc_html__( 'Limit Hours', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Please enter time between {minTime} and {maxTime}.', 'wpforms' ),
		];
		$settings['validation']['validation-requiredpayment']  = [
			'id'      => 'validation-requiredpayment',
			'name'    => esc_html__( 'Payment Required', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Payment is required.', 'wpforms' ),
		];
		$settings['validation']['validation-creditcard']       = [
			'id'      => 'validation-creditcard',
			'name'    => esc_html__( 'Credit Card', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'Please enter a valid credit card number.', 'wpforms' ),
		];
		$settings['validation']['validation-post_max_size']    = [
			'id'      => 'validation-post_max_size',
			'name'    => esc_html__( 'File Upload Total Size', 'wpforms' ),
			'type'    => 'text',
			'default' => sprintf( /* translators: %1$s - total size of the selected files in megabytes, %2$s - allowed file upload limit in megabytes.*/
				esc_html__( 'The total size of the selected files %1$s Mb exceeds the allowed limit %2$s Mb.', 'wpforms' ),
				'{totalSize}',
				'{maxSize}'
			),
		];
		$settings['validation']['validation-passwordstrength'] = [
			'id'      => 'validation-passwordstrength',
			'name'    => esc_html__( 'Password Strength', 'wpforms' ),
			'type'    => 'text',
			'default' => esc_html__( 'A stronger password is required. Consider using upper and lower case letters, numbers, and symbols.', 'wpforms' ),
		];

		// Payment settings.
		$settings['payments']['payments-heading'] = [
			'id'       => 'payments-heading',
			'content'  => '<h4>' . esc_html__( 'Payments', 'wpforms' ) . '</h4>',
			'type'     => 'content',
			'no_label' => true,
			'class'    => [ 'section-heading', 'no-desc' ],
		];
		$settings['payments']['currency']         = [
			'id'        => 'currency',
			'name'      => esc_html__( 'Currency', 'wpforms' ),
			'type'      => 'select',
			'choicesjs' => true,
			'search'    => true,
			'default'   => 'USD',
			'options'   => $currency_option,
		];

		// Additional GDPR related options.
		$settings['general'] = wpforms_array_insert(
			$settings['general'],
			[
				'gdpr-disable-uuid'    => [
					'id'   => 'gdpr-disable-uuid',
					'name' => esc_html__( 'Disable User Cookies', 'wpforms' ),
					'desc' => esc_html__( 'Check this option to disable user tracking cookies. This will disable the Related Entries feature and the Form Abandonment/Geolocation addons.', 'wpforms' ),
					'type' => 'checkbox',
				],
				'gdpr-disable-details' => [
					'id'   => 'gdpr-disable-details',
					'name' => esc_html__( 'Disable User Details', 'wpforms' ),
					'desc' => esc_html__( 'Check this option to prevent the storage of IP addresses and User Agent on all forms. If unchecked, then this can be managed on a form-by-form basis inside the form builder under Settings → General', 'wpforms' ),
					'type' => 'checkbox',
				],
			],
			'gdpr'
		);

		unset( $settings['misc'][ \WPForms\Integrations\UsageTracking\UsageTracking::SETTINGS_SLUG ] );

		return $settings;
	}

	/**
	 * Save entry to database.
	 *
	 * @since 1.2.1
	 *
	 * @param array      $fields    List of form fields.
	 * @param array      $entry     User submitted data.
	 * @param int|string $form_id   Form ID.
	 * @param array      $form_data Prepared form settings.
	 */
	public function entry_save( $fields, $entry, $form_id, $form_data = array() ) {

		// Check if form has entries disabled.
		if ( isset( $form_data['settings']['disable_entries'] ) ) {
			return;
		}

		// Provide the opportunity to override via a filter.
		if ( ! apply_filters( 'wpforms_entry_save', true, $fields, $entry, $form_data ) ) {
			return;
		}

		$fields     = apply_filters( 'wpforms_entry_save_data', $fields, $entry, $form_data );
		$user_id    = is_user_logged_in() ? get_current_user_id() : 0;
		$user_ip    = wpforms_get_ip();
		$user_agent = ! empty( $_SERVER['HTTP_USER_AGENT'] ) ? substr( sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ), 0, 256 ) : '';
		$user_uuid  = ! empty( $_COOKIE['_wpfuuid'] ) ? sanitize_key( $_COOKIE['_wpfuuid'] ) : '';
		$date       = date( 'Y-m-d H:i:s' );

		// If GDPR enhancements are enabled and user details are disabled
		// globally or in the form settings, discard the IP and UA.
		if ( ! wpforms_is_collecting_ip_allowed( $form_data ) || ! apply_filters( 'wpforms_disable_entry_user_ip', '__return_false', $fields, $form_data ) ) {
			$user_agent = '';
			$user_ip    = '';
		}

		$entry_args = apply_filters(
			'wpforms_entry_save_args',
			array(
				'form_id'    => absint( $form_id ),
				'user_id'    => absint( $user_id ),
				'fields'     => wp_json_encode( $fields ),
				'ip_address' => sanitize_text_field( $user_ip ),
				'user_agent' => sanitize_text_field( $user_agent ),
				'date'       => $date,
				'user_uuid'  => sanitize_text_field( $user_uuid ),
			),
			$form_data
		);

		// Create entry.
		$entry_id = wpforms()->entry->add( $entry_args );

		// Create fields.
		if ( $entry_id ) {
			foreach ( $fields as $field ) {

				$field = apply_filters( 'wpforms_entry_save_fields', $field, $form_data, $entry_id );

				if ( isset( $field['value'] ) && '' !== $field['value'] ) {
					wpforms()->entry_fields->add(
						array(
							'entry_id' => $entry_id,
							'form_id'  => absint( $form_id ),
							'field_id' => absint( $field['id'] ),
							'value'    => $field['value'],
							'date'     => $date,
						)
					);
				}
			}
		}

		wpforms()->process->entry_id = $entry_id;
	}

	/**
	 * Add additional form settings to the General section.
	 *
	 * @since 1.2.1
	 *
	 * @param \WPForms_Builder_Panel_Settings $instance Settings management panel instance.
	 */
	public function form_settings_general( $instance ) {

		// Only provide this option if the user has configured payments.
		if (
			isset( $instance->form_data['settings']['disable_entries'] ) ||
			(
				empty( $instance->form_data['payments']['paypal_standard']['enable'] ) ||
				empty( $instance->form_data['payments']['stripe']['enable'] )
			)
		) {
			wpforms_panel_field(
				'toggle',
				'settings',
				'disable_entries',
				$instance->form_data,
				esc_html__( 'Disable storing entry information in WordPress', 'wpforms' )
			);
		}

		// Only provide this option if GDPR enhancements are enabled and user
		// details are not disabled globally.
		if ( wpforms_setting( 'gdpr', false ) && ! wpforms_setting( 'gdpr-disable-details', false ) ) {
			wpforms_panel_field(
				'toggle',
				'settings',
				'disable_ip',
				$instance->form_data,
				esc_html__( 'Disable storing user details (IP address and user agent)', 'wpforms' )
			);
		}
	}

	/**
	 * Add entry counts column to form table.
	 *
	 * @since 1.2.1
	 *
	 * @param array $columns List of table columns.
	 *
	 * @return array
	 */
	public function form_table_columns( $columns ) {

		if ( ! wpforms_current_user_can( 'view_entries' ) ) {
			return $columns;
		}

		$columns['entries'] = esc_html__( 'Entries', 'wpforms' );

		return $columns;
	}

	/**
	 * Add entry counts value to entry count column.
	 *
	 * @since 1.2.1
	 *
	 * @param string $value
	 * @param object $form
	 * @param string $column_name
	 *
	 * @return string
	 */
	public function form_table_columns_value( $value, $form, $column_name ) {

		if ( 'entries' !== $column_name ) {
			return $value;
		}

		if ( ! wpforms_current_user_can( 'view_entries_form_single', $form->ID ) ) {
			return '-';
		}

		$count = wpforms()->entry->get_entries(
			array(
				'form_id' => $form->ID,
			),
			true
		);

		$value = sprintf(
			'<a href="%s">%d</a>',
			add_query_arg(
				array(
					'view'    => 'list',
					'form_id' => $form->ID,
				),
				admin_url( 'admin.php?page=wpforms-entries' )
			),
			$count
		);

		return $value;
	}

	/**
	 * Form notification settings, supports multiple notifications.
	 *
	 * @since 1.2.3
	 *
	 * @param object $settings
	 */
	public function form_settings_notifications( $settings ) {

		$cc               = wpforms_setting( 'email-carbon-copy', false );
		$form_settings    = ! empty( $settings->form_data['settings'] ) ? $settings->form_data['settings'] : [];
		$notifications    = is_array( $form_settings ) && isset( $form_settings['notifications'] ) ? $form_settings['notifications'] : [];
		$from_name_after  = apply_filters( 'wpforms_builder_notifications_from_name_after', '' );
		$from_email_after = apply_filters( 'wpforms_builder_notifications_from_email_after', '' );
		$from_email       = '{admin_email}';
		$from_name        = sanitize_text_field( get_option( 'blogname' ) );

		// If WP Mail SMTP is available, use its settings.
		if ( class_exists( '\WPMailSMTP\Options' ) ) {
			$mail_options = \WPMailSMTP\Options::init()->get_group( 'mail' );
			$from_email   = $mail_options['from_email_force'] ? $mail_options['from_email'] : $from_email;
			$from_name    = $mail_options['from_name_force'] ? $mail_options['from_name'] : $from_name;
		}

		// Fetch next ID and handle backwards compatibility.
		if ( empty( $notifications ) ) {
			$next_id = 2;

			/* translators: %s - form name. */
			$notifications[1]['subject']        = ! empty( $form_settings['notification_subject'] ) ? $form_settings['notification_subject'] : sprintf( esc_html__( 'New %s Entry', 'wpforms' ), $settings->form->post_title );
			$notifications[1]['email']          = ! empty( $form_settings['notification_email'] ) ? $form_settings['notification_email'] : '{admin_email}';
			$notifications[1]['sender_name']    = ! empty( $form_settings['notification_fromname'] ) ? $form_settings['notification_fromname'] : $from_name;
			$notifications[1]['sender_address'] = ! empty( $form_settings['notification_fromaddress'] ) ? $form_settings['notification_fromaddress'] : $from_email;
			$notifications[1]['replyto']        = ! empty( $form_settings['notification_replyto'] ) ? $form_settings['notification_replyto'] : '';
		} else {
			$next_id = max( array_keys( $notifications ) ) + 1;
		}

		$default_notifications_key = min( array_keys( $notifications ) );

		$hidden = empty( $settings->form_data['settings']['notification_enable'] ) ? 'wpforms-hidden' : '';

		echo '<div class="wpforms-panel-content-section-title">';
			echo '<span id="wpforms-builder-settings-notifications-title">';
				esc_html_e( 'Notifications', 'wpforms' );
			echo '</span>';
			echo '<button class="wpforms-notifications-add wpforms-builder-settings-block-add ' . esc_attr( $hidden ) . '" data-block-type="notification" data-next-id="' . absint( $next_id ) . '">' . esc_html__( 'Add New Notification', 'wpforms' ) . '</button>';// phpcs:ignore
		echo '</div>';

		$dismissed = get_user_meta( get_current_user_id(), 'wpforms_dismissed', true );

		if ( empty( $dismissed['edu-builder-notifications-description'] ) ) {
			echo '<div class="wpforms-panel-content-section-description wpforms-dismiss-container wpforms-dismiss-out">';
			echo '<button type="button" class="wpforms-dismiss-button" title="' . esc_attr__( 'Dismiss this message.', 'wpforms' ) . '" data-section="builder-notifications-description"></button>';
			echo '<p>';
			printf(
				wp_kses( /* translators: %s - Link to the WPForms.com doc article. */
					__( 'Notifications are emails sent when a form is submitted. By default, these emails include entry details. For setup and customization options, including a video overview, please <a href="%s" target="_blank" rel="noopener noreferrer">see our tutorial</a>.', 'wpforms' ),
					[
						'a' => [
							'href'   => [],
							'rel'    => [],
							'target' => [],
						],
					]
				),
				'https://wpforms.com/docs/setup-form-notification-wpforms/'
			);
			echo '</p>';
			echo '<p>';
			printf(
				wp_kses( /* translators: 1$s, %2$s - Links to the WPForms.com doc articles. */
					__( 'After saving these settings, be sure to <a href="%1$s" target="_blank" rel="noopener noreferrer">test a form submission</a>. This lets you see how emails will look, and to ensure that<br>they <a href="%2$s" target="_blank" rel="noopener noreferrer">are delivered successfully</a>.', 'wpforms' ),
					[
						'a'  => [
							'href'   => [],
							'rel'    => [],
							'target' => [],
						],
						'br' => [],
					]
				),
				'https://wpforms.com/docs/how-to-properly-test-your-wordpress-forms-before-launching-checklist/',
				'https://wpforms.com/docs/troubleshooting-email-notifications/'
			);
			echo '</p>';
			echo '</div>';
		}

		wpforms_panel_field(
			'toggle',
			'settings',
			'notification_enable',
			$settings->form_data,
			esc_html__( 'Enable Notifications', 'wpforms' ),
			[
				'value' => empty( $form_settings['notification_enable'] ) ? 0 : 1,
			]
		);

		foreach ( $notifications as $id => $notification ) {

			$name          = ! empty( $notification['notification_name'] ) ? $notification['notification_name'] : esc_html__( 'Default Notification', 'wpforms' );
			$closed_state  = '';
			$toggle_state  = '<i class="fa fa-chevron-circle-up"></i>';
			$block_classes = 'wpforms-notification wpforms-builder-settings-block';

			if ( ! empty( $settings->form_data['id'] ) && 'closed' === wpforms_builder_settings_block_get_state( $settings->form_data['id'], $id, 'notification' ) ) {
				$closed_state = 'style="display:none"';
				$toggle_state = '<i class="fa fa-chevron-circle-down"></i>';
			}

			if ( $default_notifications_key === $id ) {
				$block_classes .= ' wpforms-builder-settings-block-default';
			}

			do_action( 'wpforms_form_settings_notifications_single_before', $settings, $id );
			?>

			<div class="<?php echo esc_attr( $block_classes ); ?>" data-block-type="notification" data-block-id="<?php echo absint( $id ); ?>">

				<div class="wpforms-builder-settings-block-header">
					<div class="wpforms-builder-settings-block-actions">
						<?php do_action( 'wpforms_form_settings_notifications_single_action', $id, $notification, $settings ); ?>

						<button class="wpforms-builder-settings-block-clone" title="<?php esc_attr_e( 'Clone', 'wpforms' ); ?>"><i class="fa fa-copy"></i></button><!--
						--><button class="wpforms-builder-settings-block-delete" title="<?php esc_attr_e( 'Delete', 'wpforms' ); ?>"><i class="fa fa-trash-o"></i></button><!--
						--><button class="wpforms-builder-settings-block-toggle" title="<?php esc_attr_e( 'Open / Close', 'wpforms' ); ?>">
							<?php echo $toggle_state; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</button>
					</div>

					<div class="wpforms-builder-settings-block-name-holder">
						<span class="wpforms-builder-settings-block-name">
							<?php echo esc_html( $name ); ?>
						</span>
						<div class="wpforms-builder-settings-block-name-edit">
							<input type="text" name="settings[notifications][<?php echo absint( $id ); ?>][notification_name]" value="<?php echo esc_attr( $name ); ?>">
						</div>
						<button class="wpforms-builder-settings-block-edit" title="<?php esc_attr_e( 'Edit', 'wpforms' ); ?>"><i class="fa fa-pencil"></i></button>
					</div>

				</div>

				<div class="wpforms-builder-settings-block-content" <?php echo $closed_state; ?>>

					<?php
					wpforms_panel_field(
						'text',
						'notifications',
						'email',
						$settings->form_data,
						esc_html__( 'Send To Email Address', 'wpforms' ),
						[
							'default'    => '{admin_email}',
							'tooltip'    => esc_html__( 'Enter the email address to receive form entry notifications. For multiple notifications, separate email addresses with a comma.', 'wpforms' ),
							'smarttags'  => [
								'type'   => 'fields',
								'fields' => 'email',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-email-' . $id,
							'class'      => 'email-recipient',
						]
					);
					if ( $cc ) :
						wpforms_panel_field(
							'text',
							'notifications',
							'carboncopy',
							$settings->form_data,
							esc_html__( 'CC', 'wpforms' ),
							[
								'smarttags'  => [
									'type'   => 'fields',
									'fields' => 'email',
								],
								'parent'     => 'settings',
								'subsection' => $id,
								'input_id'   => 'wpforms-panel-field-notifications-carboncopy-' . $id,
							]
						);
					endif;
					wpforms_panel_field(
						'text',
						'notifications',
						'subject',
						$settings->form_data,
						esc_html__( 'Email Subject Line', 'wpforms' ),
						[
							/* translators: %s - form name. */
							'default'    => sprintf( esc_html__( 'New Entry: %s', 'wpforms' ), $settings->form->post_title ),
							'smarttags'  => [
								'type' => 'all',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-subject-' . $id,
						]
					);
					wpforms_panel_field(
						'text',
						'notifications',
						'sender_name',
						$settings->form_data,
						esc_html__( 'From Name', 'wpforms' ),
						[
							'default'    => $from_name,
							'smarttags'  => [
								'type'   => 'fields',
								'fields' => 'name,text',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-sender_name-' . $id,
							'readonly'   => ! empty( $from_name_after ),
							'after'      => ! empty( $from_name_after ) ? '<p class="note">' . $from_name_after . '</p>' : '',
							'class'      => 'from-name',
						]
					);
					wpforms_panel_field(
						'text',
						'notifications',
						'sender_address',
						$settings->form_data,
						esc_html__( 'From Email', 'wpforms' ),
						[
							'default'    => $from_email,
							'smarttags'  => [
								'type'   => 'fields',
								'fields' => 'email',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-sender_address-' . $id,
							'readonly'   => ! empty( $from_email_after ),
							'after'      => ! empty( $from_email_after ) ? '<p class="note">' . $from_email_after . '</p>' : '',
							'class'      => 'from-email',
						]
					);
					wpforms_panel_field(
						'text',
						'notifications',
						'replyto',
						$settings->form_data,
						esc_html__( 'Reply-To Email Address', 'wpforms' ),
						[
							'smarttags'  => [
								'type'   => 'fields',
								'fields' => 'email',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-replyto-' . $id,
						]
					);
					wpforms_panel_field(
						'textarea',
						'notifications',
						'message',
						$settings->form_data,
						esc_html__( 'Email Message', 'wpforms' ),
						[
							'rows'       => 6,
							'default'    => '{all_fields}',
							'smarttags'  => [
								'type' => 'all',
							],
							'parent'     => 'settings',
							'subsection' => $id,
							'input_id'   => 'wpforms-panel-field-notifications-message-' . $id,
							'class'      => 'email-msg',
							/* translators: %s - all fields smart tag. */
							'after'      => '<p class="note">' . sprintf( esc_html__( 'To display all form fields, use the %s Smart Tag.', 'wpforms' ), '<code>{all_fields}</code>' ) . '</p>',
						]
					);

					wpforms_conditional_logic()->builder_block(
						[
							'form'        => $settings->form_data,
							'type'        => 'panel',
							'panel'       => 'notifications',
							'parent'      => 'settings',
							'subsection'  => $id,
							'actions'     => [
								'go'   => esc_html__( 'Send', 'wpforms' ),
								'stop' => esc_html__( 'Don\'t send', 'wpforms' ),
							],
							'action_desc' => esc_html__( 'this notification if', 'wpforms' ),
							'reference'   => esc_html__( 'Email notifications', 'wpforms' ),
						]
					);

					// Hook for addons.
					do_action( 'wpforms_form_settings_notifications_single_after', $settings, $id );
					?>

				</div><!-- /.wpforms-builder-settings-block-content -->

			</div><!-- /.wpforms-builder-settings-block -->

			<?php
		}
	}

	/**
	 * Form confirmation settings, supports multiple confirmations.
	 *
	 * @since 1.4.8
	 *
	 * @param WPForms_Builder_Panel_Settings $settings Builder panel settings.
	 */
	public function form_settings_confirmations( $settings ) {

		wp_enqueue_editor();

		$form_settings = ! empty( $settings->form_data['settings'] ) ? $settings->form_data['settings'] : [];
		$confirmations = is_array( $form_settings ) && isset( $form_settings['confirmations'] ) ? $form_settings['confirmations'] : [];

		// Fetch next ID and handle backwards compatibility.
		if ( empty( $confirmations ) ) {
			$next_id = 2;

			$confirmations[1]['type']           = ! empty( $form_settings['confirmation_type'] ) ? $form_settings['confirmation_type'] : 'message';
			$confirmations[1]['message']        = ! empty( $form_settings['confirmation_message'] ) ? $form_settings['confirmation_message'] : esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms' );
			$confirmations[1]['message_scroll'] = ! empty( $form_settings['confirmation_message_scroll'] ) ? $form_settings['confirmation_message_scroll'] : 1;
			$confirmations[1]['page']           = ! empty( $form_settings['confirmation_page'] ) ? $form_settings['confirmation_page'] : '';
			$confirmations[1]['redirect']       = ! empty( $form_settings['confirmation_redirect'] ) ? $form_settings['confirmation_redirect'] : '';

			$settings->form_data['settings']['confirmations'] = $confirmations;
		} else {
			$next_id = max( array_keys( $confirmations ) ) + 1;
		}

		$default_confirmation_key = min( array_keys( $confirmations ) );

		echo '<div class="wpforms-panel-content-section-title">';
		esc_html_e( 'Confirmations', 'wpforms' );
		echo '<button class="wpforms-confirmation-add wpforms-builder-settings-block-add" data-block-type="confirmation" data-next-id="' . absint( $next_id ) . '">' . esc_html__( 'Add New Confirmation', 'wpforms' ) . '</button>';
		echo '</div>';

		foreach ( $confirmations as $field_id => $confirmation ) {

			$name          = ! empty( $confirmation['name'] ) ? $confirmation['name'] : esc_html__( 'Default Confirmation', 'wpforms' );
			$closed_state  = '';
			$toggle_state  = '<i class="fa fa-chevron-circle-up"></i>';
			$block_classes = 'wpforms-confirmation wpforms-builder-settings-block';

			if ( $default_confirmation_key === $field_id ) {
				$block_classes .= ' wpforms-builder-settings-block-default';
			}

			if ( ! empty( $settings->form_data['id'] ) && 'closed' === wpforms_builder_settings_block_get_state( $settings->form_data['id'], $field_id, 'confirmation' ) ) {
				$closed_state = 'style="display:none"';
				$toggle_state = '<i class="fa fa-chevron-circle-down"></i>';
			}

			/**
			 * Fires before each confirmation to add custom fields.
			 *
			 * @since 1.4.8
			 *
			 * @param WPForms_Builder_Panel_Settings $settings Builder panel settings.
			 * @param int                            $field_id Field ID.
			 */
			do_action( 'wpforms_form_settings_confirmations_single_before', $settings, $field_id );
			?>

			<div class="<?php echo esc_attr( $block_classes ); ?>" data-block-type="confirmation" data-block-id="<?php echo absint( $field_id ); ?>">

				<div class="wpforms-builder-settings-block-header">
					<div class="wpforms-builder-settings-block-actions">
						<?php do_action( 'wpforms_form_settings_confirmations_single_action', $field_id, $confirmation, $settings ); ?>

						<button class="wpforms-builder-settings-block-delete" title="<?php esc_attr_e( 'Delete', 'wpforms' ); ?>"><i class="fa fa-trash-o"></i></button><!--
						--><button class="wpforms-builder-settings-block-toggle" title="<?php esc_attr_e( 'Open / Close', 'wpforms' ); ?>">
							<?php echo $toggle_state; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</button>
					</div>

					<div class="wpforms-builder-settings-block-name-holder">
						<span class="wpforms-builder-settings-block-name"><?php echo esc_html( $name ); ?></span>

						<div class="wpforms-builder-settings-block-name-edit">
							<input type="text" name="settings[confirmations][<?php echo absint( $field_id ); ?>][name]" value="<?php echo esc_attr( $name ); ?>">
						</div>
						<button class="wpforms-builder-settings-block-edit" title="<?php esc_attr_e( 'Edit', 'wpforms' ); ?>"><i class="fa fa-pencil"></i></button>
					</div>

				</div>

				<div class="wpforms-builder-settings-block-content" <?php echo $closed_state; ?>>

					<?php
					wpforms_panel_field(
						'select',
						'confirmations',
						'type',
						$settings->form_data,
						esc_html__( 'Confirmation Type', 'wpforms' ),
						[
							'default'     => 'message',
							'options'     => [
								'message'  => esc_html__( 'Message', 'wpforms' ),
								'page'     => esc_html__( 'Show Page', 'wpforms' ),
								'redirect' => esc_html__( 'Go to URL (Redirect)', 'wpforms' ),
							],
							'class'       => 'wpforms-panel-field-confirmations-type-wrap',
							'input_id'    => 'wpforms-panel-field-confirmations-type-' . $field_id,
							'input_class' => 'wpforms-panel-field-confirmations-type',
							'parent'      => 'settings',
							'subsection'  => $field_id,
						]
					);

					wpforms_panel_field(
						'textarea',
						'confirmations',
						'message',
						$settings->form_data,
						esc_html__( 'Confirmation Message', 'wpforms' ),
						[
							'default'     => esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms' ),
							'tinymce'     => [
								'editor_height' => '200',
							],
							'input_id'    => 'wpforms-panel-field-confirmations-message-' . $field_id,
							'input_class' => 'wpforms-panel-field-confirmations-message',
							'parent'      => 'settings',
							'subsection'  => $field_id,
							'class'       => 'wpforms-panel-field-tinymce',
							'smarttags'   => [
								'type' => 'all',
							],
						]
					);

					wpforms_panel_field(
						'toggle',
						'confirmations',
						'message_scroll',
						$settings->form_data,
						esc_html__( 'Automatically scroll to the confirmation message', 'wpforms' ),
						[
							'input_id'    => 'wpforms-panel-field-confirmations-message_scroll-' . $field_id,
							'input_class' => 'wpforms-panel-field-confirmations-message_scroll',
							'parent'      => 'settings',
							'subsection'  => $field_id,
						]
					);

					$p     = [];
					$pages = get_pages();

					foreach ( $pages as $page ) {
						$depth          = count( $page->ancestors );
						$p[ $page->ID ] = str_repeat( '-', $depth ) . ' ' . $page->post_title;
					}

					wpforms_panel_field(
						'select',
						'confirmations',
						'page',
						$settings->form_data,
						esc_html__( 'Confirmation Page', 'wpforms' ),
						[
							'options'     => $p,
							'input_id'    => 'wpforms-panel-field-confirmations-page-' . $field_id,
							'input_class' => 'wpforms-panel-field-confirmations-page',
							'parent'      => 'settings',
							'subsection'  => $field_id,
						]
					);

					wpforms_panel_field(
						'text',
						'confirmations',
						'redirect',
						$settings->form_data,
						esc_html__( 'Confirmation Redirect URL', 'wpforms' ),
						[
							'input_id'    => 'wpforms-panel-field-confirmations-redirect-' . $field_id,
							'input_class' => 'wpforms-panel-field-confirmations-redirect',
							'parent'      => 'settings',
							'subsection'  => $field_id,
						]
					);

					wpforms_conditional_logic()->builder_block(
						[
							'form'        => $settings->form_data,
							'type'        => 'panel',
							'panel'       => 'confirmations',
							'parent'      => 'settings',
							'subsection'  => $field_id,
							'actions'     => [
								'go'   => esc_html__( 'Use', 'wpforms' ),
								'stop' => esc_html__( 'Don\'t use', 'wpforms' ),
							],
							'action_desc' => esc_html__( 'this confirmation if', 'wpforms' ),
							'reference'   => esc_html__( 'Form confirmations', 'wpforms' ),
						]
					);

					do_action_deprecated(
						'wpforms_form_settings_confirmation',
						[ $settings ],
						'1.4.8 of WPForms plugin',
						'wpforms_form_settings_confirmations_single_after'
					);

					/**
					 * Fires after each confirmation to add custom fields.
					 *
					 * @since 1.4.8
					 *
					 * @param WPForms_Builder_Panel_Settings $settings Builder panel settings.
					 * @param int                            $field_id Field ID.
					 */
					do_action( 'wpforms_form_settings_confirmations_single_after', $settings, $field_id );
					?>

				</div><!-- /.wpforms-builder-settings-block-content -->

			</div><!-- /.wpforms-builder-settings-block -->

			<?php
		}
	}

	/**
	 * Append additional strings for form builder.
	 *
	 * @since 1.2.6
	 *
	 * @param array  $strings List of strings.
	 * @param object $form    CPT of the form.
	 *
	 * @return array
	 */
	public function form_builder_strings( $strings, $form ) {

		$currency   = wpforms_get_currency();
		$currencies = wpforms_get_currencies();

		$strings['currency']            = sanitize_text_field( $currency );
		$strings['currency_name']       = isset( $currencies[ $currency ]['name'] ) ? sanitize_text_field( $currencies[ $currency ]['name'] ) : '';
		$strings['currency_decimals']   = wpforms_get_currency_decimals( $currencies[ $currency ] );
		$strings['currency_decimal']    = isset( $currencies[ $currency ]['decimal_separator'] ) ? sanitize_text_field( $currencies[ $currency ]['decimal_separator'] ) : '.';
		$strings['currency_thousands']  = isset( $currencies[ $currency ]['thousands_separator'] ) ? sanitize_text_field( $currencies[ $currency ]['thousands_separator'] ) : ',';
		$strings['currency_symbol']     = isset( $currencies[ $currency ]['symbol'] ) ? sanitize_text_field( $currencies[ $currency ]['symbol'] ) : '$';
		$strings['currency_symbol_pos'] = isset( $currencies[ $currency ]['symbol_pos'] ) ? sanitize_text_field( $currencies[ $currency ]['symbol_pos'] ) : 'left';
		$strings['notification_clone']  = esc_html__( ' - clone', 'wpforms' );

		$strings['notification_by_status_enable_alert'] = wp_kses(
		// translators: %s: Payment provider completed payments. Example: `PayPal Standard completed payments`.
			__( '<p>You have just enabled this notification for <strong>%s</strong>. Please note that this email notification will only send for <strong>%s</strong>.</p><p>If you\'d like to set up additional notifications for this form, please see our <a href="https://wpforms.com/docs/setup-form-notification-wpforms/" rel="nofollow noopener" target="_blank">tutorial</a>.</p>', 'wpforms' ), // phpcs:ignore WordPress.WP.I18n.UnorderedPlaceholdersText
			[
				'p'      => [],
				'strong' => [],
				'a'      => [
					'href'   => [],
					'rel'    => [],
					'target' => [],
				],
			]
		);

		$strings['notification_by_status_switch_alert'] = wp_kses(
		// translators: %1$s: Payment provider completed payments. Example: `PayPal Standard completed payments`, %2$s - Disabled Payment provider completed payments.
			__( '<p>You have just <strong>disabled</strong> the notification for <strong>%2$s</strong> and <strong>enabled</strong> the notification for <strong>%1$s</strong>. Please note that this email notification will only send for <strong>%1$s</strong>.</p><p>If you\'d like to set up additional notifications for this form, please see our <a href="https://wpforms.com/docs/setup-form-notification-wpforms/" rel="nofollow noopener" target="_blank">tutorial</a>.</p>', 'wpforms' ), // phpcs:ignore WordPress.WP.I18n.UnorderedPlaceholdersText
			[
				'p'      => [],
				'strong' => [],
				'a'      => [
					'href'   => [],
					'rel'    => [],
					'target' => [],
				],
			]
		);

		return $strings;
	}

	/**
	 * Modify javascript `wpforms_settings` properties on site front end.
	 *
	 * @since 1.4.6
	 *
	 * @param array $strings Array wpforms_setting properties.
	 *
	 * @return array
	 */
	public function frontend_strings( $strings ) {

		// If the user has GDPR enhancements enabled and has disabled UUID,
		// disable the setting, otherwise enable it.
		$strings['uuid_cookie'] = ! wpforms_setting( 'gdpr-disable-uuid', false );

		$strings['val_requiredpayment'] = wpforms_setting( 'validation-requiredpayment', esc_html__( 'Payment is required.', 'wpforms' ) );
		$strings['val_creditcard']      = wpforms_setting( 'validation-creditcard', esc_html__( 'Please enter a valid credit card number.', 'wpforms' ) );
		$strings['val_post_max_size']   = wpforms_setting(
			'validation-post_max_size',
			sprintf( /* translators: %1$s - total size of the selected files in megabytes, %2$s - allowed file upload limit in megabytes.*/
				esc_html__( 'The total size of the selected files %1$s Mb exceeds the allowed limit %2$s Mb.', 'wpforms' ),
				'{totalSize}',
				'{maxSize}'
			)
		);

		// Date/time.
		$strings['val_time12h']    = wpforms_setting( 'validation-time12h', esc_html__( 'Please enter time in 12-hour AM/PM format (eg 8:45 AM).', 'wpforms' ) );
		$strings['val_time24h']    = wpforms_setting( 'validation-time24h', esc_html__( 'Please enter time in 24-hour format (eg 22:45).', 'wpforms' ) );
		$strings['val_time_limit'] = wpforms_setting( 'validation-time-limit', esc_html__( 'Please enter time between {minTime} and {maxTime}.', 'wpforms' ) );

		// URL.
		$strings['val_url'] = wpforms_setting( 'validation-url', esc_html__( 'Please enter a valid URL.', 'wpforms' ) );

		// File upload.
		$strings['val_fileextension'] = wpforms_setting( 'validation-fileextension', esc_html__( 'File type is not allowed.', 'wpforms' ) );
		$strings['val_filesize']      = wpforms_setting( 'validation-filesize', esc_html__( 'File exceeds max size allowed. File was not uploaded.', 'wpforms' ) );
		$strings['post_max_size']     = wpforms_size_to_bytes( ini_get( 'post_max_size' ) );

		return $strings;
	}

	/**
	 * Check to see if the Conditional Logic addon is installed, if so notify
	 * the user that it can be removed.
	 *
	 * @since 1.3.8
	 */
	public function conditional_logic_addon_notice() {

		if ( file_exists( WP_PLUGIN_DIR . '/wpforms-conditional-logic/wpforms-conditional-logic.php' ) && ! defined( 'WPFORMS_DEBUG' ) ) {
			$notice = sprintf(
				wp_kses( /* translators: %s - WPForms.com announcement page URL. */
					__( 'Conditional logic functionality is now included in the core WPForms plugin! The WPForms Conditional Logic addon can be removed without affecting your forms. For more details <a href="%s" target="_blank" rel="noopener noreferrer">read our announcement</a>.', 'wpforms' ),
					[
						'a' => [
							'href'   => [],
							'target' => [],
							'rel'    => [],
						],
					]
				),
				'https://wpforms.com/announcing-wpforms-1-3-8/'
			);

			\WPForms\Admin\Notice::info( $notice );
		}
	}

	/**
	 * Used to register the templates for setting blocks inside form builder.
	 *
	 * @since 1.4.8
	 */
	public function builder_templates() {

		$conditional_logic_tooltip = '<a href="https://wpforms.com/docs/how-to-use-conditional-logic-with-wpforms/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'How to use Conditional Logic', 'wpforms' ) . '</a>';
		?>

		<!-- Confirmation block 'message' field template -->
		<script type="text/html" id="tmpl-wpforms-builder-confirmations-message-field">
			<div id="wpforms-panel-field-confirmations-message-{{ data.id }}-wrap" class="wpforms-panel-field wpforms-panel-field-tinymce" style="display: block;">
				<label for="wpforms-panel-field-confirmations-message-{{ data.id }}"><?php esc_html_e( 'Confirmation Message', 'wpforms' ); ?></label>
				<textarea id="wpforms-panel-field-confirmations-message-{{ data.id }}" name="settings[confirmations][{{ data.id }}][message]" rows="3" placeholder="" class="wpforms-panel-field-confirmations-message"></textarea>
				<a href="#" class="toggle-smart-tag-display toggle-unfoldable-cont" data-type="all" data-fields=""><i class="fa fa-tags"></i><span><?php esc_html_e( 'Show Smart Tags', 'wpforms' ); ?></span></a>
			</div>
		</script>

		<!-- Conditional logic toggle field template -->
		<script  type="text/html" id="tmpl-wpforms-builder-conditional-logic-toggle-field">
			<div id="wpforms-panel-field-settings-{{ data.type }}s-{{ data.id }}-conditional_logic-wrap" class="wpforms-panel-field wpforms-conditionals-enable-toggle wpforms-panel-field-checkbox">
				<span class="wpforms-toggle-control">
					<input type="checkbox" id="wpforms-panel-field-settings-{{ data.type }}s-{{ data.id }}-conditional_logic-checkbox" name="settings[{{ data.type }}s][{{ data.id }}][conditional_logic]" value="1"
						class="wpforms-panel-field-conditional_logic-checkbox"
						data-name="settings[{{ data.type }}s][{{ data.id }}]"
						data-actions="{{ data.actions }}"
						data-action-desc="{{ data.actionDesc }}">
					<label class="wpforms-toggle-control-icon" for="wpforms-panel-field-settings-{{ data.type }}s-{{ data.id }}-conditional_logic-checkbox"></label>
					<label for="wpforms-panel-field-settings-{{ data.type }}s-{{ data.id }}-conditional_logic-checkbox" class="wpforms-toggle-control-label">
						<?php esc_html_e( 'Enable Conditional Logic', 'wpforms' ); ?>
					</label><i class="fa fa-question-circle-o wpforms-help-tooltip tooltipstered" title="<?php echo esc_attr( $conditional_logic_tooltip ); ?>"></i>
				</span>
			</div>
		</script>

		<?php
	}

	/**
	 * Expired license notification in form notification email footer.
	 *
	 * @since 1.5.0
	 *
	 * @param string $text Footer text.
	 *
	 * @return string
	 */
	public function form_notification_footer( $text ) {

		$license = get_option( 'wpforms_license', array() );

		if (
			empty( $license['is_expired'] ) &&
			empty( $license['is_disabled'] ) &&
			empty( $license['is_invalid'] )
		) {
			return $text;
		}

		$notice = sprintf(
			wp_kses(
				/* translators: %s - WPForms.com Account dashboard URL. */
				__( 'Your WPForms license key has expired. In order to continue receiving support and plugin updates you must renew your license key. Please log in to <a href="%s" target="_blank" rel="noopener noreferrer">your WPForms.com account</a> to renew your license.', 'wpforms' ),
				array(
					'a'      => array(
						'href'   => array(),
						'target' => array(),
						'rel'    => array(),
					),
				)
			),
			'https://wpforms.com/account/'
		);

		return $notice . '<br><br>' . $text;
	}

	/**
	 * Get the list of all custom tables starting with `wpforms_*`.
	 *
	 * @since 1.5.9
	 *
	 * @return array List of table names.
	 */
	public function get_existing_custom_tables() {
		_deprecated_function( __CLASS__ . '::' . __METHOD__, '1.6.3', 'wpforms()->get_existing_custom_tables()' );

		return wpforms()->get_existing_custom_tables();
	}

	/**
	 * Check if all custom tables exist.
	 *
	 * @since 1.5.9
	 *
	 * @return bool True if all custom tables exist. False if any is missing.
	 */
	public function custom_tables_exist() {

		global $wpdb;

		$custom_tables = array(
			'wpforms_entries',
			'wpforms_entry_fields',
			'wpforms_entry_meta',
		);

		$tables = wpforms()->get_existing_custom_tables();

		foreach ( $custom_tables as $table ) {
			if ( ! in_array( $wpdb->prefix . $table, $tables, true ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Create all Pro plugin custom DB tables.
	 *
	 * @since 1.5.9
	 *
	 * @param stdClass|bool $wpforms_install WPForms install object.
	 */
	public function create_custom_tables( $wpforms_install = false ) {

		if ( empty( $wpforms_install ) ) {
			$wpforms_install               = new stdClass();
			$wpforms_install->entry        = new WPForms_Entry_Handler();
			$wpforms_install->entry_fields = new WPForms_Entry_Fields_Handler();
			$wpforms_install->entry_meta   = new WPForms_Entry_Meta_Handler();
		}

		// Entry tables.
		$wpforms_install->entry->create_table();
		$wpforms_install->entry_fields->create_table();
		$wpforms_install->entry_meta->create_table();
	}

	/**
	 * Re-create plugin custom tables if don't exist.
	 *
	 * @since 1.5.9
	 *
	 * @param \WPForms_Settings $wpforms_settings WPForms settings object.
	 */
	public function reinstall_custom_tables( $wpforms_settings ) {

		if ( empty( $wpforms_settings->view ) ) {
			return;
		}

		// Proceed on Settings plugin admin area page only.
		if ( $wpforms_settings->view !== 'general' ) {
			return;
		}

		// Proceed when no custom Pro tables exist.
		if ( $this->custom_tables_exist() ) {
			return;
		}

		// Install on a current site only.
		$this->create_custom_tables();
	}

	/**
	 * Allow the WordPress 5.5+ 'auto-updates' feature.
	 *
	 * 1) auto-updates for Lite should work as-is, no changes to the default logic
	 *    for a plugin that is hosted on WP.org
	 * 2) auto-updates for Pro should be controlled using the default WP "Enable auto-updates" link.
	 *    But when it's clicked - we enable it not only for Pro plugin (and updates are retrieved from our API
	 *    as it currently works), but for all of our addons too.
	 * 3) auto-updates for addons can not be changed per addon. Instead of a link, we should display a plain text
	 *    "Addon auto-updates controlled by WPForms".
	 *    This way toggling auto-update for Pro will toggle that for ALL addons at once too.
	 *
	 * @since 1.6.4
	 */
	private function allow_wp_auto_update_plugins() {

		// If license wasn't found. Is it the Lite version?
		if ( ! wpforms_get_license_type() ) {
			return;
		}

		add_filter( 'plugin_auto_update_setting_html', array( $this, 'auto_update_setting_html' ), 100, 3 );
		add_filter( 'pre_update_site_option_auto_update_plugins', array( $this, 'update_auto_update_plugins_option' ), 100, 4 );
	}

	/**
	 * Filter the HTML of the auto-updates setting for WPForms addons.
	 *
	 * @since 1.6.2.2
	 * @since 1.6.4 Changed the HTML for WPForms addons only.
	 *
	 * @param string $html        The HTML of the plugin's auto-update column content, including
	 *                            toggle auto-update action links and time to next update.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @param array  $plugin_data An array of plugin data.
	 *
	 * @return string
	 */
	public function auto_update_setting_html( $html, $plugin_file, $plugin_data ) {

		if ( empty( $plugin_data['Author'] ) ) {
			return $html;
		}

		if ( $plugin_data['Author'] !== 'WPForms' ) {
			return $html;
		}

		if ( 0 !== strpos( $plugin_file, 'wpforms' ) ) {
			return $html;
		}

		$lite_pro_files = [
			'wpforms-lite/wpforms.php',
			'wpforms/wpforms.php',
		];

		if ( in_array( $plugin_file, $lite_pro_files, true ) ) {
			return $html;
		}

		return esc_html__( 'Addon auto-updates controlled by WPForms', 'wpforms' );
	}

	/**
	 * Filter value, which is prepared for `auto_update_plugins` option before it's saved into DB.
	 * We need to include OR exclude all WPForms addons, depends on what status has main WPForms plugin.
	 *
	 * @since 1.6.2.2
	 * @since 1.6.4 Added dependency from the main WPForms plugin.
	 *
	 * @param mixed  $plugins     New plugins of the network option.
	 * @param mixed  $old_plugins Old plugins of the network option.
	 * @param string $option      Option name.
	 * @param int    $network_id  ID of the network.
	 *
	 * @return array
	 */
	public function update_auto_update_plugins_option( $plugins, $old_plugins, $option, $network_id ) {

		// No need to filter out our plugins if none were saved.
		if ( empty( $plugins ) ) {
			return $plugins;
		}

		// Protection from a malformed data.
		if ( ! is_array( $plugins ) ) {
			return $plugins;
		}

		// Check whether auto-updates for plugins are supported and enabled. If not, return early.
		if (
			! function_exists( 'wp_is_auto_update_enabled_for_type' ) ||
			! wp_is_auto_update_enabled_for_type( 'plugin' )
		) {
			return $plugins;
		}

		// Check whether auto-updates for main WPForms plugin is enabled.
		// If so, enabled it for all WPForms plugins. Otherwise - disable for all WPForms plugins.
		if ( in_array( 'wpforms/wpforms.php', $plugins, true ) ) {
			$new_plugins = array_unique( array_merge( $plugins, $this->get_wpforms_plugins() ) );
		} else {
			$new_plugins = array_diff( $plugins, $this->get_wpforms_plugins() );
		}

		return $new_plugins;
	}

	/**
	 * Retrieve collection with WPForms plugins file paths.
	 *
	 * @since 1.6.2.2
	 *
	 * @return array
	 */
	protected function get_wpforms_plugins() {

		$plugins = [];
		$license = wpforms()->license;

		if ( empty( $license ) ) {
			return $plugins;
		}

		$addons_data = $license->addons();

		if ( empty( $addons_data ) ) {
			return $plugins;
		}

		$plugins = array_map(
			static function( $slug ) {

				return "{$slug}/{$slug}.php";
			},
			wp_list_pluck( $addons_data, 'slug' )
		);

		$plugins[] = 'wpforms/wpforms.php';

		return $plugins;
	}
}

return new WPForms_Pro();
