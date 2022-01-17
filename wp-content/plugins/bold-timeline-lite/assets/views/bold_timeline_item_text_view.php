<?php
		$prefix = 'bold_timeline_item_text';
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
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}   
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . '>';
		if ( $content != '' ) $output .= '<div class="bold_timeline_item_text_inner">' . wptexturize( do_shortcode( $content ) ) . '</div>';
		$output .= '</div>';