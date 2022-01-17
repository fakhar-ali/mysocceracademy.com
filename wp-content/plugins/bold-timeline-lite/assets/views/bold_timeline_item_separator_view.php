<?php

                $prefix = 'bold_timeline_item_separator';
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

		if ( $top_margin != '' ) {
			$class[] = $prefix . '_top_margin_' . $top_margin;
		}		

		if ( $bottom_margin != '' ) {
			$class[] = $prefix . '_bottom_margin_' . $bottom_margin;
		}
		
		$output = '<div class="' . implode( ' ', $class ) . '"' . $id_attr . $style_attr . '><div class="bold_timeline_item_separator_inner">';
		
		$output .= '</div></div>';
