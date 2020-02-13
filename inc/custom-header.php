<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link       https://developer.wordpress.org/themes/functionality/custom-headers/
 * @package WordPress
 * @subpackage Kickstarter
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses kickstarter_header_style()
 */
function kickstarter_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'kickstarter_custom_header_args', array(
		'default-image'      => get_template_directory_uri() . '/assets/images/2500X750.jpg',
        'flex-width'         => true,
		'flex-height'        => true,
		'width'              => 2000,
		'height'             => 420,
		'wp-head-callback'   => 'kickstarter_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'kickstarter_custom_header_setup' );

if ( ! function_exists( 'kickstarter_header_style' ) ) :
	
	//Styles the header image displayed on the blog.
	function kickstarter_header_style() {
		$height = get_theme_mod( 'header_image_height', '380' );
		$repeat = get_theme_mod( 'header-background-repeat', 'no-repeat' );
		$size = get_theme_mod( 'header-background-size', 'cover' );
		$position = get_theme_mod( 'header-background-position', 'center' );
		$attachment = get_theme_mod( 'header-background-attachment', 1 )? 'fixed': 'scroll';
		$overlay = get_theme_mod('header_image_overlay', 1);
		// Get the opacity of the color overlay.
		$color_overlay_opacity  = get_theme_mod( 'cover_template_overlay_opacity' );
		//$color_overlay_opacity  = ( false === $color_overlay_opacity ) ? 1 : $color_overlay_opacity;
		?>
		<style type="text/css">

		.image-overlay {
			min-height: <?php echo esc_attr( $height ) ?>px;
		}
		<?php if ($overlay) : ?>
		.image-overlay {
			background: rgba(0, 0, 0, .<?php echo esc_attr($color_overlay_opacity); ?>);
		}
		<?php endif;

		if ( has_header_image() ) : ?>
		.site-branding {
			background-image: url( <?php header_image(); ?> );
			background-repeat: <?php echo esc_attr( $repeat ); ?>;
			background-size: <?php echo esc_attr( $size ); ?>;
			background-position: <?php echo esc_attr( $position ); ?>;
			background-attachment: <?php echo esc_attr( $attachment ); ?>;
		}
		<?php endif; ?>
	</style>
	<?php
	}
endif;