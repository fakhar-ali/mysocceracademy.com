<?php 

get_header();

$image_404 = boldthemes_get_404_image();

?>

		<section class="bt-error-page gutter bt_bb_section bt_bb_background_image bt_bb_color_scheme_1" style="background-image: url('<?php echo esc_url_raw( $image_404 )?>')">
			<div class="port">
				
				<?php echo boldthemes_get_heading_html( 
					array ( 
						'superheadline' => esc_html__( 'We are sorry, page not found.', 'zele' ), 
						'headline' => esc_html__( 'Error 404.', 'zele' ),
						'size' => 'huge'
						) 
					)
				?>

				<div class="bt_bb_separator bt_bb_bottom_spacing_normal bt_bb_border_style_none"></div>

				<?php
					echo boldthemes_get_button_html( 
						array (
							'url' 			=> home_url( '/' ), 
							'text' 			=> esc_html__( 'BACK TO HOME', 'zele' ), 
							'style' 		=> 'filled',
							'color_scheme' 	=> 'dark-accent-skin',
							'size' 			=> 'normal',
							'icon'			=> 'arrow_e900',
							'icon_position' => 'right'
						)
					);
				?>

			</div>
		</section>

<?php get_footer();
