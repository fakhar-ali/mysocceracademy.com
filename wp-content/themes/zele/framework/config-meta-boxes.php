<?php

// PAGE

$menus = wp_get_nav_menus();
$menu_arr = array( '' => '' );
foreach( $menus as $m ) {
	$menu_arr[ $m->name ] = $m->name;
}

boldthemes_add_mb( array( 'id' => 'page', 'title' => esc_html__( 'Settings', 'zele' ), 'post_type' => 'page', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'menu_name',
		'name'     => esc_html__( 'Custom Primary Menu Name', 'zele' ),
		'type'     => 'select',
		'options'  => $menu_arr
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'footer_menu_name',
		'name'     => esc_html__( 'Custom Footer Menu Name', 'zele' ),
		'type'     => 'select',
		'options'  => $menu_arr
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'page',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'zele' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// POST

boldthemes_add_mb( array( 'id' => 'post', 'title' => esc_html__( 'Settings', 'zele' ), 'post_type' => 'post', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'menu_name',
		'name'     => esc_html__( 'Custom Primary Menu Name', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'footer_menu_name',
		'name'     => esc_html__( 'Custom Footer Menu Name', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'images',
		'name'     => esc_html__( 'Images', 'zele' ),
		'type'     => 'image_advanced'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'grid_gallery',
		'name'     => esc_html__( 'Grid Gallery', 'zele' ),
		'type'     => 'checkbox'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'video',
		'name'     => esc_html__( 'Video', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'audio',
		'name'     => esc_html__( 'Audio', 'zele' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'link_title',
		'name'     => esc_html__( 'Link', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'link_url',
		'name'     => esc_html__( 'Link URL', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'quote',
		'name'     => esc_html__( 'Quote', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'quote_author',
		'name'     => esc_html__( 'Quote Author', 'zele' ),
		'type'     => 'text'
	)
);

boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'post',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'zele' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// PORTFOLIO

boldthemes_add_mb( array( 'id' => 'portfolio', 'title' => esc_html__( 'Settings', 'zele' ), 'post_type' => 'portfolio', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'images',
		'name'     => esc_html__( 'Images', 'zele' ),
		'type'     => 'image_advanced'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'grid_gallery',
		'name'     => esc_html__( 'Grid Gallery', 'zele' ),
		'type'     => 'checkbox'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'video',
		'name'     => esc_html__( 'Video', 'zele' ),
		'type'     => 'text'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'audio',
		'name'     => esc_html__( 'Audio', 'zele' ),
		'type'     => 'textarea'
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'custom_fields',
		'name'     => esc_html__( 'Custom Fields', 'zele' ),
		'type'     => 'boldthemestext1',
		'clone'    => true
	)
);
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'portfolio',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'zele' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

// PRODUCT

boldthemes_add_mb( array( 'id' => 'product', 'title' => esc_html__( 'Settings', 'zele' ), 'post_type' => 'product', 'autosave' => true ) );
boldthemes_add_mb_field( 
	array(
		'mb_id'    => 'product',
		'field_id' => 'override',
		'name'     => esc_html__( 'Override Global Settings', 'zele' ),
		'type'     => 'boldthemestext',
		'clone'    => true
	)
);

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'boldthemes_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
if ( ! function_exists( 'boldthemes_register_meta_boxes' ) ) {
	function boldthemes_register_meta_boxes( $meta_boxes ) {

		// FAKE CUSTOMIZE CLASSES

		if ( ! class_exists( 'WP_Customize_Control' ) ) {

			class WP_Customize_Control {
				public $o;
				public $s;
				public $a;
				function __construct( $o, $s, $a ) {
					$this->o = $o;
					$this->s = $s;
					$this->a = $a;
				}
			}

			class WP_Customize_Image_Control extends WP_Customize_Control {
					
			}

			class WP_Customize_Color_Control extends WP_Customize_Control {
				
			}

			class BoldThemes_Fake_Customizer {
				
				public $control_arr = array();
				public $section_arr = array();

				function add_setting( $a ) {

				}

				function add_control( $s, $a = null ) {
					if ( $a !== null  ) {
						if ( isset( $this->section_arr[ $a['section'] ] ) ) {
							$this->control_arr[ $s ] = $a;
						}
					} else {
						if ( $s->s != 'reset' && isset( $this->section_arr[ $s->a['section'] ] ) ) {
							$s->a['type'] = get_class( $s );
							$this->control_arr[ $s->s ] = $s->a;
						}
					}
				}

				function add_section( $s, $a ) {
					$this->section_arr[ $s ] = $a;
				}

				function remove_section( $s ) {
					unset( $this->section_arr[ $s ] );
				}
			}
			BoldThemesFramework::$fake_customizer = new BoldThemes_Fake_Customizer();
			do_action( 'boldthemes_customize_register', BoldThemesFramework::$fake_customizer );
		}

		/**
		 * Prefix of meta keys (optional)
		 * Use underscore (_) at the beginning to make keys hidden
		 * Alt.: You also can make prefix empty to disable it
		 */
		
		$prefix = BoldThemesFramework::$pfx . '_';

		$mb_count = count( $meta_boxes );

		foreach( BoldThemesFramework::$meta_boxes as $meta_box_id => $meta_box ) {
			$meta_boxes[] = array(
				'id' => $meta_box_id,
	
				// Meta box title - Will appear at the drag and drop handle bar. Required.
				'title' => $meta_box['title'],

				// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
				'pages' => array( $meta_box['post_type'] ),

				// Auto save: true, false (default). Optional.
				'autosave' => $meta_box['autosave'],
			);
	
			// List of meta fields
			$f = 0;
			foreach( $meta_box['fields'] as $field ) {
				$meta_boxes[ $mb_count ]['fields'][] = array(
					'id'   => $prefix . $field['id']
				);

				foreach ( $field as $k => $v ) {
					if ( $k != 'id' ) {
						$meta_boxes[ $mb_count ]['fields'][ $f ][ $k ] = $v;
					}
				}	
				
				$f++;
			}
			
			if ( isset($meta_boxes[ $mb_count ]['fields'] ) && is_array($meta_boxes[ $mb_count ]['fields']) ){
				usort( $meta_boxes[ $mb_count ]['fields'], 'boldthemes_mb_fields_sort' );
			}
			
			$mb_count++;
		}

		return $meta_boxes;

	}
}

/**
 * Sort fields
 */
if ( ! function_exists( 'boldthemes_mb_fields_sort' ) ) {
	function boldthemes_mb_fields_sort( $a, $b ) {
		if ( $a['order'] == $b['order'] ) {
			return 0;
		}
		return ( $a['order'] < $b['order'] ) ? -1 : 1;
	}
}