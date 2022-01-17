<?php

namespace WPForms\Pro;

use WPForms\Pro\Integrations\TranslationsPress\Translations;

/**
 * Class Migrations handles Pro plugin upgrade routines.
 *
 * @since 1.5.9
 */
class Migrations {

	/**
	 * WP option name to store the migration version.
	 *
	 * @since 1.5.9
	 */
	const OPTION_NAME = 'wpforms_version';

	/**
	 * Have we migrated?
	 *
	 * @since 1.5.9
	 *
	 * @var bool
	 */
	private $is_migrated = false;

	/**
	 * Class init.
	 *
	 * @since 1.5.9
	 */
	public function init() {

		// Run general migrations first.
		( new \WPForms\Migrations() )->init();

		$this->hooks();
		$this->migration_hooks();
	}

	/**
	 * General hooks.
	 *
	 * @since 1.5.9
	 */
	private function hooks() {

		add_action( 'wpforms_loaded', array( $this, 'maybe_migrate' ), -9997 );
		add_action( 'wpforms_loaded', array( $this, 'update_version' ), -9996 );
	}

	/**
	 * Migration specific hooks.
	 *
	 * @since 1.5.9
	 */
	private function migration_hooks() {

		add_action( 'wp_ajax_wpforms_upgrade_143', array( $this, 'v143_upgrade_ajax' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'wpforms_tools_display_tab_upgrade', array( $this, 'upgrade_tab' ) );
	}

	/**
	 * Run the migration if needed.
	 *
	 * @since 1.5.9
	 */
	public function maybe_migrate() {

		if ( ! is_admin() ) {
			return;
		}

		// Retrieve the last known version.
		$version = get_option( self::OPTION_NAME );

		if ( empty( $version ) ) {
			return;
		}

		$this->migrate( $version );
	}

	/**
	 * Run the migrations for a specific version.
	 *
	 * @since 1.5.9
	 *
	 * @param string $version Version to run the migrations for.
	 */
	private function migrate( $version ) {

		wpforms()->get( 'pro' )->objects();

		if ( version_compare( $version, '1.1.6', '<' ) ) {
			$this->v116_upgrade();
		}

		if ( version_compare( $version, '1.3.3', '<' ) ) {
			$this->v133_upgrade();
		}

		if ( version_compare( $version, '1.4.3', '<' ) ) {
			$this->v143_upgrade();
		}

		if ( version_compare( $version, '1.5.0', '<' ) ) {
			$this->v150_upgrade();
		}

		if ( version_compare( $version, '1.5.9', '<' ) ) {
			$this->v159_upgrade();
		}

		if ( version_compare( $version, '1.6.5', '<' ) ) {
			$this->v165_upgrade();
		}

		if ( version_compare( $version, '1.6.8', '<' ) ) {
			$this->v168_upgrade();
		}
	}

	/**
	 * If upgrade has occurred, update version options in database.
	 *
	 * @since 1.5.9
	 */
	public function update_version() {

		if ( ! is_admin() ) {
			return;
		}

		if ( ! $this->is_migrated ) {
			return;
		}

		// Retrieve the last known version.
		$version = get_option( self::OPTION_NAME );

		if ( empty( $version ) ) {
			return;
		}

		update_option( 'wpforms_version_upgraded_from', $version );
		update_option( self::OPTION_NAME, WPFORMS_VERSION );
	}

	/**
	 * Perform database upgrades for version 1.1.6.
	 *
	 * @since 1.1.6
	 * @since 1.5.9 Moved from WPForms_Upgrades.
	 */
	private function v116_upgrade() {

		wpforms()->entry_meta->create_table();

		$this->is_migrated = true;
	}

	/**
	 * Perform database upgrades for version 1.3.3.
	 *
	 * @since 1.1.3
	 * @since 1.5.9 Moved from WPForms_Upgrades.
	 */
	private function v133_upgrade() {

		global $wpdb;

		$wpdb->query( "ALTER TABLE {$wpdb->prefix}wpforms_entries ADD user_uuid VARCHAR(36)" );

		$this->is_migrated = true;
	}

	/**
	 * Perform database upgrades for version 1.4.3.
	 *
	 * @since 1.4.3
	 * @since 1.5.9 Moved from WPForms_Upgrades.
	 */
	private function v143_upgrade() {

		// Create the new entry fields table.
		wpforms()->entry_fields->create_table();

		// Check the total number of entries currently stored.
		$entry_total = wpforms()->entry->get_entries( array(), true );

		// If the site has at least one entry, indicate to a user
		// that we need to run the database upgrade routine.
		if ( ! empty( $entry_total ) ) {
			update_option( 'wpforms_fields_update', true );
		}

		$this->is_migrated = true;
	}

	/**
	 * AJAX upgrade routine that upgrades existing entries field to the new
	 * entry fields database.
	 *
	 * @since 1.4.3
	 * @since 1.5.9 Moved from WPForms_Upgrades.
	 */
	public function v143_upgrade_ajax() {

		// Run a security check.
		check_ajax_referer( 'wpforms-admin', 'nonce' );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			wp_send_json_error();
		}

		global $wpdb;

		// Table names.
		$fields_table  = $wpdb->prefix . 'wpforms_entry_fields';
		$entries_table = $wpdb->prefix . 'wpforms_entries';

		// Check if this is the initial total check.
		if ( ! empty( $_POST['init'] ) ) {

			$upgraded = count( $wpdb->get_results( "SELECT DISTINCT entry_id FROM {$fields_table}" ) );

			// If we have fields that have already been upgraded, then we know
			// this is resuming a previous attempt.
			if ( ! empty( $upgraded ) ) {

				// Determine the last entry that was added in the upgrade routine.
				$last_entry_id = $wpdb->get_var( "SELECT MAX(entry_id) FROM {$fields_table}" );

				// Delete fields with this entry.
				$wpdb->query(
					$wpdb->prepare(
						"DELETE FROM {$fields_table} WHERE `entry_id` = %d;",
						absint( $last_entry_id )
					)
				);
			}

			wp_send_json_success(
				array(
					'total'    => wpforms()->entry->get_entries( array(), true ),
					'upgraded' => $upgraded,
				)
			);
		}

		if ( empty( $_POST['upgraded'] ) ) {

			// If upgraded entries is 0 we know this is the beginning of the
			// upgrade routine, so update the option to indicate that the
			// upgrade has started but not completed. This way if it doesn't
			// finish, we can resume and complete.
			update_option( 'wpforms_fields_update', 'incomplete' );

			// Fetch the first 10 entries.
			$entries = wpforms()->entry->get_entries(
				array(
					'number' => 10,
					'order'  => 'ASC',
				)
			);

		} else {

			// Determine the last entry that was added in the upgrade routine.
			$last_entry_id = $wpdb->get_var( "SELECT MAX(entry_id) FROM {$fields_table}" );

			$entries = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM {$entries_table} WHERE entry_id > %d ORDER BY entry_id ASC LIMIT 10;",
					absint( $last_entry_id )
				)
			);
		}

		// Loop through the entries and add each field value to the new entry
		// fields database table.
		if ( ! empty( $entries ) ) {
			foreach ( $entries as $entry ) {

				$fields = wpforms_decode( $entry->fields );

				if ( ! empty( $fields ) ) {
					foreach ( $fields as $field ) {
						if ( isset( $field['id'] ) && isset( $field['value'] ) && '' !== $field['value'] ) {
							wpforms()->entry_fields->add(
								array(
									'entry_id' => absint( $entry->entry_id ),
									'form_id'  => absint( $entry->form_id ),
									'field_id' => absint( $field['id'] ),
									'value'    => $field['value'],
									'date'     => $entry->date,
								)
							);
						}
					}
				}
			}
		}

		// If there are less than 10 entries, this batch completed the
		// upgrade routine. Update the option accordingly.
		if ( count( $entries ) < 10 ) {
			delete_option( 'wpforms_fields_update' );
		}

		wp_send_json_success(
			array(
				'count' => count( $entries ),
			)
		);
	}

	/**
	 * Perform database upgrades for version 1.5.0.
	 *
	 * @since 1.5.0
	 * @since 1.5.9 Moved from WPForms_Upgrades.
	 */
	private function v150_upgrade() {

		$forms = \wpforms()->form->get( '', array( 'fields' => 'ids' ) );

		if ( empty( $forms ) || ! \is_array( $forms ) ) {
			return;
		}

		foreach ( $forms as $form_id ) {
			delete_post_meta( $form_id, 'wpforms_entries_count' );
		}

		$this->is_migrated = true;
	}

	/**
	 * Re-check that all database tables exist for Lite users
	 * who upgraded to Pro using the settings workflow for v1.5.9.
	 *
	 * @since 1.5.9
	 */
	private function v159_upgrade() {

		$wpforms_pro = wpforms()->get( 'pro' );

		// Check and create custom DB tables.
		if ( ! $wpforms_pro->custom_tables_exist() ) {
			$wpforms_pro->create_custom_tables();
		}

		$this->is_migrated = true;
	}

	/**
	 * Alert the user if there are upgrades that need to be performed.
	 *
	 * @since 1.4.3
	 */
	public function admin_notice() {

		// Only show upgrade notice to site administrators.
		if ( ! is_super_admin() ) {
			return;
		}

		// Don't show upgrade notices on the upgrades screen.
		if ( ! empty( $_GET['page'] ) && $_GET['page'] === 'wpforms-tools' && ! empty( $_GET['view'] ) && $_GET['view'] === 'upgrade' ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return;
		}

		// v1.4.3 fields database upgrade notice.
		$upgrade_v143 = get_option( 'wpforms_fields_update', false );

		if ( $upgrade_v143 ) {
			if ( $upgrade_v143 === 'incomplete' ) {
				/* translators: %s - resume page URL. */
				$msg = __( 'WPForms database upgrade is incomplete, click <a href="%s">here</a> to resume.', 'wpforms' );
			} else {
				/* translators: %s - entries upgrade page URL. */
				$msg = __( 'WPForms needs to upgrade the database, click <a href="%s">here</a> to start the upgrade.', 'wpforms' );
			}

			\WPForms\Admin\Notice::info(
				sprintf(
					wp_kses(
						$msg,
						[
							'a' => [
								'href' => [],
							],
						]
					),
					esc_url( admin_url( 'admin.php?page=wpforms-tools&view=upgrade' ) )
				)
			);
		}
	}

	/**
	 * Generate the upgrade tab inside the Tools page if needed.
	 *
	 * @since 1.4.3
	 */
	public function upgrade_tab() {

		// v1.4.3 fields database upgrade.
		$upgrade_v143 = get_option( 'wpforms_fields_update', false );
		if ( $upgrade_v143 ) {

			$msg   = esc_html__( 'WPForms needs to upgrade the database, click the button below to begin.', 'wpforms' );
			$label = esc_html__( 'Run Upgrade', 'wpforms' );

			if ( 'incomplete' === $upgrade_v143 ) {
				$msg   = esc_html__( 'WPForms database upgrade is incomplete, click the button below to resume.', 'wpforms' );
				$label = esc_html__( 'Resume Upgrade', 'wpforms' );
			}

			echo '<div class="wpforms-setting-row tools upgrade" id="wpforms-upgrade-143">';

				echo '<h3>' . esc_html__( 'Upgrade', 'wpforms' ) . '</h3>';
				echo '<p>' . $msg . '</p>';
				echo '<p>' . esc_html__( 'Please do not leave this page or close the browser while the upgrade is in progress.', 'wpforms' ) . '</p>';
				echo '<button class="wpforms-btn wpforms-btn-md wpforms-btn-orange" id="wpforms-tools-upgrade-fields">' . $label . '</button>';

				echo '<div class="status" style="display:none;">';
					echo '<div class="progress-bar"><div class="bar"></div></div>';
					echo '<p class="msg"><span class="percent">0%</span> - ';
						printf(
							/* translators: %1$s - total number of entries upgraded; %2$s - total number of entries on site. */
							esc_html__( 'Updated %1$s of %2$s entries.', 'wpforms' ),
							'<span class="current">0</span>',
							'<span class="total">0</span>'
						);
					echo '</p>';
				echo '</div>';

			echo '</div>';

			return;
		}

		echo '<p>' . esc_html__( 'No updates are currently needed.', 'wpforms' ) . '</p>';
	}

	/**
	 * Do all the required migrations for WPForms v1.6.5.
	 *
	 * @since 1.6.5
	 */
	private function v165_upgrade() {

		if ( ! class_exists( Translations::class ) ) {
			return;
		}

		$t15s = new Translations();

		if ( $t15s->allow_load() ) {
			$t15s->download_plugins_translations();
		}

		$this->is_migrated = true;
	}

	/**
	 * Do all the required migrations for WPForms v1.6.8.
	 *
	 * @since 1.6.8
	 */
	private function v168_upgrade() {

		if ( ! function_exists( 'wpforms_form_templates_pack' ) ) {
			return;
		}

		add_action(
			'admin_init',
			static function() {
				deactivate_plugins( 'wpforms-form-templates-pack/wpforms-form-templates-pack.php' );
			}
		);
	}
}
