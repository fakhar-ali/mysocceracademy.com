<?php

namespace WPForms\Pro\Forms\Fields\DateTime;

/**
 * Editing Date / Time field entries.
 *
 * @since 1.6.0
 */
class EntriesEdit extends \WPForms\Pro\Forms\Fields\Base\EntriesEdit {

	/**
	 * Constructor.
	 *
	 * @since 1.6.0
	 */
	public function __construct() {

		parent::__construct( 'date-time' );
	}

	/**
	 * Enqueues for the Edit Entry page.
	 *
	 * @since 1.6.0
	 */
	public function enqueues() {

		wp_enqueue_style(
			'wpforms-jquery-timepicker',
			WPFORMS_PLUGIN_URL . 'assets/css/jquery.timepicker.css',
			[],
			'1.11.5'
		);
		wp_enqueue_style(
			'wpforms-flatpickr',
			WPFORMS_PLUGIN_URL . 'assets/css/flatpickr.min.css',
			[],
			'4.6.9'
		);

		wp_enqueue_script(
			'wpforms-flatpickr',
			WPFORMS_PLUGIN_URL . 'assets/js/flatpickr.min.js',
			[ 'jquery' ],
			'4.6.9',
			true
		);
		wp_enqueue_script(
			'wpforms-jquery-timepicker',
			WPFORMS_PLUGIN_URL . 'assets/js/jquery.timepicker.min.js',
			[ 'jquery' ],
			'1.11.5',
			true
		);
	}

	/**
	 * Display the field on the Edit Entry page.
	 *
	 * @since 1.6.0
	 *
	 * @param array $entry_field Entry field data.
	 * @param array $field       Field data and settings.
	 * @param array $form_data   Form data and settings.
	 */
	public function field_display( $entry_field, $field, $form_data ) {

		// Properly populate subfields with the value.
		$inputs = [ 'date', 'time' ];
		foreach ( $inputs as $input ) {

			// Skip if value is empty.
			if ( empty( $entry_field[ $input ] ) ) {
				continue;
			}

			// Populate date dropdowns.
			if ( $input === 'date' && $field['date_type'] === 'dropdown' ) {
				$field['properties']['inputs']['date']['default'] = [
					'd' => gmdate( 'd', $entry_field['unix'] ),
					'm' => gmdate( 'm', $entry_field['unix'] ),
					'y' => gmdate( 'Y', $entry_field['unix'] ),
				];
				continue;
			}

			// Generate input value according to the datetime format.
			$input_format        = ! empty( $field[ $input . '_format' ] ) ? $field[ $input . '_format' ] : 'm/d/Y';
			$input_value         = ! empty( $entry_field['unix'] ) ? gmdate( $input_format, $entry_field['unix'] ) : $entry_field[ $input ];
			$field['properties'] = $this->field_object->get_field_populated_single_property_value_public( $input_value, $input, $field['properties'], $field );
		}

		$this->field_object->field_display( $field, null, $form_data );
	}
}
