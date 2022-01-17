<?php
        $prefix = 'bold_timeline_item_button';
		$class = array( $prefix );	

		if ( $el_id == '' ) {
			$el_id = 'id_' . uniqid();
		}else{
			$el_id = 'id_' . $el_id . '_' . uniqid();
		}		
		$id_attr = ' ' . 'id="' . $el_id . '"';
                
                if ( $el_class != '' ) {
			$class[] = $el_class;
		}
                
                if ( $responsive != '' ) {
			$class[] = $responsive;
		}

		if ( $style != '' ) {
			$class[] = $prefix . '_style_' . $style;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}				

		if ( $shape != '' ) {
			$class[] = $prefix . '_shape_' . $shape;
		}		

		if ( $width != '' ) {
			$class[] = $prefix . '_width_' . $width;
		}		

		if ( $size != '' ) {
			$class[] = $prefix . '_size_' . $size;
		}
		
		$css_override = '';
		Bold_Timeline::$crush_vars = array();
		
		Bold_Timeline::$crush_vars['defaultButtonColor'] = '';
		if ( $color != '' ) {
			Bold_Timeline::$crush_vars['defaultButtonColor'] = $color;	
		}
		require( dirname(__FILE__) . '/../../css-override-button.php' );
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . ' data-css-override="' . $css_override . '"><div class="bold_timeline_item_button_inner">';
		if ( $url != '' ) {
			$output .= '<a href="' . $url . '" alt=' . $title . ' class="bold_timeline_item_button_innet_text">' . $title . '</a>';
		} else {
			$output .= '<span class="bold_timeline_item_button_innet_text">' . $title . '</span>';
		}
		$output .= '</div></div>';
