<?php
function quality_funfact_customizer( $wp_customize ) {
 
//Funfact section panel
$wp_customize->add_panel( 'quality_funfact_options', array(
		'priority'       => 800,
		'capability'     => 'edit_theme_options',
		'title'      => __('Funfact settings', 'quality'),
	) );

	
	$wp_customize->add_section( 'funfact_section_head' , array(
		'title'      => __('Funfact settings','quality'),
		'panel'  => 'quality_funfact_options',
		'priority'   => 60,
   	) );
	
	//Funfact Background Image
			$wp_customize->add_setting( 'funfact_background', array(
			  'sanitize_callback' => 'esc_url_raw',
			  'default' => WC__PLUGIN_URL .'/inc/quality/images/funfact-bg.jpg',
			) );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'funfact_background', array(
			  'label'    => __( 'Background Image', 'quality' ),
			  'section'  => 'funfact_section_head',
			  'settings' => 'funfact_background',
			) ) );
			
		// Funfact Image overlay
		$wp_customize->add_setting( 'funfact_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('funfact_image_overlay', array(
			'label'    => __('Enable funfact image overlay', 'quality' ),
			'section'  => 'funfact_section_head',
			'type' => 'checkbox',
		) );
		
		
		if(class_exists('Quality_Customize_Alpha_Color_Control'))
		{
		//Funfact Background Overlay Color
		$wp_customize->add_setting( 'funfact_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0,0,0,0.85)',
            ) );	
            
            $wp_customize->add_control(new Quality_Customize_Alpha_Color_Control( $wp_customize,'funfact_overlay_section_color', array(
               'label'      => __('Funfact image overlay color','quality' ),
                'palette' => true,
                'section' => 'funfact_section_head')
            ) );
		}
	
	
	
	if ( class_exists( 'Quality_Repeater' ) ) {
			$wp_customize->add_setting( 'quality_funfact_content', array(
			) );

			$wp_customize->add_control( new Quality_Repeater( $wp_customize, 'quality_funfact_content', array(
				'label'                             => esc_html__( 'Funfact content', 'quality' ),
				'section'                           => 'funfact_section_head',
				'priority'                          => 220,
				'add_field_label'                   => esc_html__( 'Add new funfact', 'quality' ),
				'item_name'                         => esc_html__( 'Funfact', 'quality' ),
				'customizer_repeater_icon_control'  => true,
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				) ) );
		}		
	
}
add_action( 'customize_register', 'quality_funfact_customizer' );

// Quality default funfact content data
if ( ! function_exists( 'quality_funfact_default_customize_register' ) ) :
	function quality_funfact_default_customize_register( $wp_customize ){
		
	$quality_funfact_content_control = $wp_customize->get_setting( 'quality_funfact_content' );
				if ( ! empty( $quality_funfact_content_control ) ) {
					$quality_funfact_content_control->default = json_encode( array(
						array(
						'icon_value' => 'fa fa-smile-o funfact-icon',
						'title'      => esc_html__( '2500', 'quality' ),
						'text'       => 'Happy Customer',
						'id'         => 'customizer_repeater_56d7ea7f40b56',
						'color'      => '#e91e63',
						),
						array(
						'icon_value' => 'fa fa-handshake-o funfact-icon',
						'title'      => esc_html__( '550', 'quality' ),
						'text'       => 'Finish Projects',
						'color'      => '#00bcd4',
						),
						array(
						'icon_value' => 'fa fa-line-chart funfact-icon',
						'title'      => esc_html__( '90%', 'quality' ),
						'text'       => 'Business Growth',
						'id'         => 'customizer_repeater_56d7ea7f40b86',
						'color'      => '#4caf50',
						),
						
						array(
						'icon_value' => 'fa fa-coffee funfact-icon',
						'title'      => esc_html__( '1350', 'quality' ),
						'text'       => 'Cups of Coffee',
						'id'         => 'customizer_repeater_56d7ea7f40b87',
						'color'      => '#4caf50',
						),
						
					) );

				}	
		
		

	
}		
add_action( 'customize_register', 'quality_funfact_default_customize_register' );
endif;
?>