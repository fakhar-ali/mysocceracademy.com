<?php

if ( ! class_exists( 'BB_Icon_Widget' ) ) {

	// ICON

	class BB_Icon_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'bt_bb_icon_widget', // Base ID
				esc_html__( 'BB Icon', 'bold-builder' ), // Name
				array( 'description' => esc_html__( 'Icon with text and link.', 'bold-builder' ) ) // Args
			);
		}

		public function widget( $args, $instance ) {
		
			$icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
			$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
			$url = ! empty( $instance['url'] ) ? $instance['url'] : '';
			$show_button = ! empty( $instance['show_button'] ) ? $instance['show_button'] : '';
			$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
			$extra_class = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';

			$extra_class = array( $extra_class );
			
			if ( $show_button != '' ) {
				$extra_class[] = 'btAccentIconWidget';
			}
			
			if ( $text != '' || $title != '' ) {
				$extra_class[] = 'btWidgetWithText';
			}
			
			echo $args['before_widget'];

			$wrap_start_tag = '<div class="btIconWidget ' . esc_attr( implode( ' ', $extra_class ) ) . '">';
			$wrap_end_tag = '</div>';

			if ( $url != '' ) {
				if ( function_exists( 'bt_bb_get_url' ) ) {
					$link = bt_bb_get_url( $url );
				} else {
					$link = $url;
				}
				$wrap_start_tag = '<a href="' . esc_url_raw( $link ) . '" target="' . esc_attr( $target ) . '" class="btIconWidget ' . esc_attr( implode( ' ', $extra_class ) ) . '">';
				$wrap_end_tag = '</a>';
			}

			echo $wrap_start_tag;
				if ( $icon != '' && $icon != 'no_icon' ) {
					echo '<div class="btIconWidgetIcon">';
						echo bt_bb_icon::get_html( $icon );
					echo '</div>';
				}
				if ( $title != '' || $text != '' ) {
					echo '<div class="btIconWidgetContent">';
						if ( $title != '' ) echo '<span class="btIconWidgetTitle">' . $title . '</span>';
						if ( $text != '' ) echo '<span class="btIconWidgetText">' . $text . '</span>';
					echo '</div>';
				}
			echo $wrap_end_tag;
		}

		public function form( $instance ) {
			$icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
			$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
			$url = ! empty( $instance['url'] ) ? $instance['url'] : '';
			$show_button = ! empty( $instance['show_button'] ) ? $instance['show_button'] : '';
			$target = ! empty( $instance['target'] ) ? $instance['target'] : '';
			$extra_class = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';

			?>		
			<div class="bt_bb_iconpicker_widget_container">
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php _e( 'Icon:', 'bold-builder' ); ?></label>
				<input type="hidden" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $icon ); ?>">
				<input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'bt_bb_iconpicker' ) ); ?>">
				<div class="bt_bb_iconpicker_widget_placeholder" data-icon="<?php echo esc_attr( $icon ); ?>"></div>
			</div>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( 'URL or slug:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
			</p>
			<?php
				if ( class_exists( 'BoldThemes_Customize_Default' ) ) { ?>
					<p>
						<input class="checkbox" type="checkbox" <?php checked( $show_button, 'on' ); ?> id="<?php echo $this->get_field_id('show_button'); ?>" name="<?php echo $this->get_field_name('show_button'); ?>" /> 
						<label for="<?php echo $this->get_field_id('show_button'); ?>"><?php _e( 'Show highlighted', 'bold-builder' ); ?></label>
					</p>
				<?php }
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php _e( 'Target:', 'bold-builder' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>">
					<option value=""></option>;
					<?php
					$target_arr = array("Self" => "_self", "Blank" => "_blank", "Parent" => "_parent", "Top" => "_top");
					foreach( $target_arr as $key => $value ) {
						if ( $value == $target ) {
							echo '<option value="' . esc_attr( $value ) . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . esc_attr( $value ) . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'extra_class' ) ); ?>"><?php _e( 'CSS extra class:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'extra_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'extra_class' ) ); ?>" type="text" value="<?php echo esc_attr( $extra_class ); ?>">
			</p>			
			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
			$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
			$instance['show_button'] = ( ! empty( $new_instance['show_button'] ) ) ? strip_tags( $new_instance['show_button'] ) : '';
			$instance['target'] = ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';
			$instance['extra_class'] = ( ! empty( $new_instance['extra_class'] ) ) ? strip_tags( $new_instance['extra_class'] ) : '';

			return $instance;
		}
	}	
}