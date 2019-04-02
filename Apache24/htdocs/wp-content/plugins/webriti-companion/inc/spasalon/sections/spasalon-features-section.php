<?php

$current_options = wp_parse_args(  get_option( 'spa_theme_options', array() ), default_data() );

if ( ! function_exists( 'spasalon_features' ) ) :

	function spasalon_features() {
		
		$current_options = get_option( 'spa_theme_options');
		$hide_section = isset($current_options['service_hide'])? $current_options['service_hide']:true;
	
		$spasalon_service_title    = isset($current_options['tagline_title'])? $current_options['tagline_title'] : esc_html__('Treatment we are offering','webriti-companion');
		$spasalon_service_subtitle = isset($current_options['tagline_contents'])?$current_options['tagline_contents']: esc_html__('In commodo pulvinar metus, id tristique massa ultrices at. Nulla auctor turpis ut mi pulvinar eu accumsan risus sagittis. Mauris nunc ligula, ullamcorper vitae accumsan eu,congue in nulla. Cras hendrerit mi quis nisi semper in sodales nisl faucibus. Sed quis quam eu ante ornare hendrerit.','webriti-companion');
		$spasalon_service_content  = ! empty($current_options['spasalon_service_content']) ? $current_options['spasalon_service_content'] : spasalon_get_service_default();
		$section_is_empty = empty( $spasalon_service_content ) && empty( $spasalon_service_subtitle ) && empty( $spasalon_service_title );

if( $hide_section == true ):

?>

<!-- Service Section -->

<section id="section" class="service">

	<div class="container">
	
		<!-- Section Title -->
		
		<div class="row">
		
			<div class="col-md-12">
			
				<div class="section-header">
				
				<?php
					if ( ! empty( $spasalon_service_title ) || is_customize_preview() ) {
						echo '<h1 class="section-title txt-color">' . esc_html( $spasalon_service_title ) . '</h1>';
					}
					if ( ! empty( $spasalon_service_subtitle ) || is_customize_preview() ) {
						echo '<p class="section-subtitle">' . esc_html( $spasalon_service_subtitle ) . '</p>';
					}
				?>
				
				</div>
				
			</div>
			
		</div>
		<!-- /Section Title -->	
		<?php
		
		spasalon_service_content($spasalon_service_content);
		?>
	</div>
	
</section>

<!-- End of Service Section -->

<div class="clearfix"></div>

<?php endif; 
		
		}
		
	endif;
	

function spasalon_service_content( $spasalon_service_content, $is_callback = false ) {

	if ( ! $is_callback ) {
	?>
	
		<?php
	}
	if ( ! empty( $spasalon_service_content ) ) :
		

		$allowed_html = array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'b'      => array(),
		'i'      => array(),
		);
		$spasalon_service_content = json_decode( $spasalon_service_content );
			echo '<div class="row" id="service_content_section">';
		foreach ( $spasalon_service_content as $service_item ) :
			$icon = ! empty( $service_item->icon_value ) ? apply_filters( 'spasalon_translate_single_string', $service_item->icon_value, 'service section' ) : '';
			$title = ! empty( $service_item->title ) ? apply_filters( 'spasalon_translate_single_string', $service_item->title, 'service section' ) : '';
			$text = ! empty( $service_item->text ) ? apply_filters( 'spasalon_translate_single_string', $service_item->text, 'service section' ) : '';
			$link = ! empty( $service_item->link ) ? apply_filters( 'spasalon_translate_single_string', $service_item->link, 'service section' ) : '';
			$image = ! empty( $service_item->image_url ) ? apply_filters( 'spasalon_translate_single_string', $service_item->image_url, 'service section' ) : '';
			$opennewtab = ! empty( $service_item->open_new_tab) ? apply_filters('spasalon_translate_single_string',$service_item->open_new_tab, 'service section' ) : '';
			
			$color = '';
			if ( is_customize_preview() && ! empty( $service_item->color ) ) {
				$color = $service_item->color;
			}
			
			?>
			<div class="col-md-3 col-sm-6 col-xs-12 service-box">
			<div class="post text-center">
								<?php if ( ! empty( $image ) ) : ?>
									<?php if ( ! empty( $link ) ) : ?>
										<a href="<?php echo esc_url( $link ); ?>" <?php if($opennewtab== "yes"){ echo "target='_blank'";} ?>>
									<?php endif; ?>
									<figure class="post-thumbnail">
									<img class="services_cols_mn_icon"
										 src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
									<?php if ( ! empty( $link ) ) : ?>
									</figure>
										</a>
									<?php endif; ?>
								<?php endif; ?>
			
			<?php if ( ! empty( $link ) ) : ?>
						<a href="<?php echo esc_url( $link ); ?>" <?php if($opennewtab== "yes"){ echo "target='_blank'";} ?>>
							<?php endif; ?>
				<?php if ( ! empty( $icon ) ) :?>
							<figure class="post-thumbnail service-icon">
									<i class="fa <?php echo esc_html( $icon ); ?> " <?php if ( ! empty( $color ) ) { echo 'style="background-color:' . $color . '"'; } ?>"></i>
								</figure>
							<?php endif; ?>
				<?php if ( ! empty( $title ) ) : ?>
				
								<div class="entry-header">
								<h4 class="entry-title"><?php echo esc_html( $title ); ?></h4>
								</div>
							<?php endif; ?>
				<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
			<?php if ( ! empty( $text ) ) : ?>
			
							<div class="entry-content">
							<p><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
							
							</div>
			
							
						<?php endif; ?>
			</div>
			</div>
			<?php
			endforeach;?>
	</div><?php
		endif;
	if ( ! $is_callback ) {
	?>
		
		<?php
	}
}


/**
 * Get default values for service section.
 *
 * @since 1.1.31
 * @access public
 */
function spasalon_get_service_default() {
	
	$ServiceOldData = get_option('widget_wbr_feature_page_widget');
	
	$the_sidebars = wp_get_sidebars_widgets();
	//Print_r($the_sidebars['sidebar-service']);
	if(!empty($the_sidebars['sidebar-service'])){
		//print_r("Hello in else");
	$pro_service_data = array();
	foreach ($the_sidebars['sidebar-service'] as $data) {
	
		$widget_data = explode('-',$data);
		$data  = $widget_data[1];
		if($widget_data[0] == 'wbr_feature_page_widget'){
			$options = get_option( 'widget_wbr_feature_page_widget' );
			$pro_service_data[] = array(
			'icon_value' => '',
			'image_url'  => get_the_post_thumbnail_url($options[$widget_data[1]]['selected_page']),
			'title'      => get_the_title($options[$widget_data[1]]['selected_page']),
			'text'       => get_post_field('post_content', $options[$widget_data[1]]['selected_page']),
			'color'		 => '#f22853',
			'link'       => '#',
			'open_new_tab' => 'no',
			'id'         => 'customizer_repeater_56d7ea7f40b56',
			);
		}
		
	}
	return apply_filters(
					'spasalon_service_default_content', json_encode($pro_service_data)
					);
	
	}
	else {
		//print_r("Hello in else");
		
	return apply_filters(
		'spasalon_service_default_content', json_encode(
			array(
				array(
				'icon_value' => 'fa fa-leaf',
				'image_url'  => '',
				'title'      => esc_html__( 'Spa Treatment', 'spasalon' ),
				'text'       => 'An veritus voluptatum vim, no duo veritus ocurreret. Stet rebum hendrerit pro an, omnesque salutandi theophrastus ne pri.',
				'color'		 => '#f22853',
				'link'       => '#',
				'open_new_tab' => 'no',

				),
				array(
				'icon_value' => 'fa fa-street-view',
				'image_url'  => '',
				'title'      => esc_html__( 'Detox Treatment', 'spasalon' ),
				'text'       => 'An veritus voluptatum vim, no duo veritus ocurreret. Stet rebum hendrerit pro an, omnesque salutandi theophrastus ne pri.',
				'color'		 => '#6dc82b',
				'link'       => '#',
				'open_new_tab' => 'no',
				
				),
				array(
				'icon_value' => 'fa fa-user',
				'image_url'  => '',
				'title'      => esc_html__( 'Facial Treatment', 'spasalon' ),
				'text'       => 'An veritus voluptatum vim, no duo veritus ocurreret. Stet rebum hendrerit pro an, omnesque salutandi theophrastus ne pri.',
				'color'		 => '#fe8000',
				'link'       => '#',
				'open_new_tab' => 'no',
				
				),
				array(
				'icon_value' => 'fa fa-lemon-o',
				'image_url'  => '',
				'title'      => esc_html__( 'Other Treatment', 'spasalon' ),
				'text'       => 'An veritus voluptatum vim, no duo veritus ocurreret. Stet rebum hendrerit pro an, omnesque salutandi theophrastus ne pri.',
				'color'		 => '#1abac8',
				'link'       => '#',
				'open_new_tab' => 'no',

				),
			)
		)
	);
	}
}

if ( function_exists( 'spasalon_features' ) ) {
	$section_priority = apply_filters( 'spasalon_section_priority', 10, 'spasalon_features' );
	add_action( 'spasalon_sections', 'spasalon_features', absint( $section_priority ) );
	
}
?>