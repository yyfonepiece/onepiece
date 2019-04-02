<?php
if ( ! function_exists( 'quality_funfact' ) ) :

function quality_funfact() {

$quality_funfact_content  = get_theme_mod( 'quality_funfact_content');

$funfact_background = get_theme_mod('funfact_background',WC__PLUGIN_URL .'/inc/quality/images/funfact-bg.jpg');	
 if($funfact_background != '') { ?>
<section class="funfact" style="background-image:url('<?php echo esc_url($funfact_background);?>'); 50% 0 fixed; position: relative; ">
	<?php } else { ?>
<section class="funfact">
<?php } 
$funfact_overlay_section_color = get_theme_mod('funfact_overlay_section_color','rgba(0,0,0,0.85)');
$funfact_image_overlay = get_theme_mod('funfact_image_overlay',true);
?>
<div class="overlay"<?php if($funfact_image_overlay != false) { ?>style="background-color:<?php echo $funfact_overlay_section_color; } ?>">
<div class="container">

		<div class="row ">
		<?php 
		if ( ! empty( $quality_funfact_content ) ) {
		$allowed_html = array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'b'      => array(),
		'i'      => array(),
		);	
			
		$quality_funfact_content = json_decode( $quality_funfact_content );
		foreach ( $quality_funfact_content as $features_item ) {
		$icon = ! empty( $features_item->icon_value ) ? apply_filters( 'quality_translate_single_string',$features_item->icon_value, 'Funfact section' ) : '';
		$title = ! empty( $features_item->title ) ? apply_filters( 'quality_translate_single_string', $features_item->title, 'Funfact section' ) : '';
		$text = ! empty( $features_item->text ) ? apply_filters( 'quality_translate_single_string',
		$features_item->text, 'Funfact section' ) : '';
		?>
		<div class="col-lg-3 col-md-3 col-sm-6">	
			<div class="funfact-inner text-center">
				<?php if ( ! empty( $icon ) ) :?>
				<i class="fa <?php echo esc_html( $icon ); ?> funfact-icon"></i><?php endif; ?>
				<?php if ( ! empty( $title ) ) : ?>
				<h1 class="funfact-title"><?php echo esc_html( $title ); ?></h1><?php endif; ?>
				<?php if ( ! empty( $text ) ) : ?>
				<p class="description"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p><?php endif; ?>
			</div>  
		</div>
		<?php } } else { ?>
			<div class="col-lg-3 col-md-3 col-sm-6">	
				<div class="funfact-inner text-center">
					<i class="fa fa-smile-o funfact-icon"></i>
					<h1 class="funfact-title"><?php echo '2500'; ?></h1>
					<p class="description"><?php _e('Happy Customer','quality'); ?></p>
				</div>  
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">		
				<div class="funfact-inner text-center">
					<i class="fa  fa-handshake-o funfact-icon"></i>
					<h1 class="funfact-title"><?php echo '2500'; ?></h1>
					<p class="description"><?php _e('Finish Projects','quality'); ?></p>
				</div>  
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">		
				<div class="funfact-inner text-center">
					<i class="fa fa-line-chart funfact-icon"></i>
					<h1 class="funfact-title"><?php echo '90%'; ?></h1>
					<p class="description"><?php _e('Business Growth','quality'); ?></p>
				</div>  
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">			
				<div class="funfact-inner text-center">
					<i class="fa fa-coffee funfact-icon"></i>
					<h1 class="funfact-title"> <?php echo '1350'; ?></h1>
					<p class="description"><?php _e('Cups of Coffee','quality'); ?></p>
				</div>  
			</div>
		<?php } ?>
		</div>	 

	</div>
	</div>
</section>
<!-- /End of Funfact Section ---->
<div class="clearfix"></div>
<?php }  endif; 
if ( function_exists( 'quality_funfact' ) ) {
		$section_priority = apply_filters( 'quality_section_priority', 11, 'quality_funfact' );
		add_action( 'quality_sections', 'quality_funfact', absint( $section_priority ) );
}
?>