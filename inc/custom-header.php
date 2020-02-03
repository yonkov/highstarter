<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 * <?php the_header_image_tag(); ?>
 *
 * @link       https://developer.wordpress.org/themes/functionality/custom-headers/
 *
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
        'default-image'      => get_template_directory_uri() . '/images/header.jpg',
        'default-text-color' => '000',
        'flex-width'         => true,
        'flex-height'        => true,
		'wp-head-callback'   => 'kickstarter_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'kickstarter_custom_header_setup' );

if ( ! function_exists( 'kickstarter_header_style' ) ) :
	
	//Styles the header image and text displayed on the blog.
	function kickstarter_header_style() {

		$height = get_theme_mod( 'header-background-height', '300' );
		$repeat = get_theme_mod( 'header-background-repeat', 'no-repeat' );
		$size = get_theme_mod( 'header-background-size', 'cover' );
		$position = get_theme_mod( 'header-background-position', 'center center' );
		$attachment = get_theme_mod( 'header-background-attachment', true ) ? 'fixed' : 'scroll';

		?>
		<style type="text/css">

	.site-branding {
		min-height: <?php echo esc_attr(absint( $height ) . 'px'); ?>;
	}

	<?php if ( has_header_image() ) : ?>
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