<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link       https://developer.wordpress.org/themes/functionality/custom-headers/
 * @package Highstarter
 * 
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses highstarter_header_style()
 */

register_default_headers( array(
    'default-image' => array(
        'url'           => get_template_directory_uri() . '/assets/images/2500X750.jpg',
        'thumbnail_url' => get_template_directory_uri() . '/assets/images/2500X750.jpg',
        'description'   => __( 'Default Header Image', 'highstarter' )
    ),
) );

function highstarter_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('highstarter_custom_header_args', array(
        'default-image'      => get_template_directory_uri() . '/assets/images/2500X750.jpg',
        'flex-width'         => true,
        'flex-height'        => true,
        'width'              => 2000,
        'height'             => 540,
        'wp-head-callback'   => 'highstarter_header_style',
    )));
}
add_action('after_setup_theme', 'highstarter_custom_header_setup');

if (! function_exists('highstarter_header_style')) :
    
    //Style the header image from the theme customizer.
    function highstarter_header_style() {
        $height = get_theme_mod('header_image_height', '380px');
        $trimmed_height = str_replace(' ', '', $height);
        $repeat = get_theme_mod('header-background-repeat', 'no-repeat');
        $size = get_theme_mod('header-background-size', 'cover');
        $position = get_theme_mod('header-background-position', 'center');
        $attachment = get_theme_mod('header-background-attachment', 1)? 'fixed': 'scroll';
        $overlay  = get_theme_mod('cover_template_overlay_opacity', '1'); ?>
	    <style type="text/css">
		.image-overlay {
			min-height: <?php echo esc_attr( $trimmed_height) ?>;
		}

		.image-overlay {
			background: rgba(0, 0, 0, .<?php echo esc_attr($overlay); ?>);
		}

		<?php if (has_header_image()) : ?>.site-branding {
			background-image: url(<?php header_image(); ?>);
			background-repeat: <?php echo esc_attr($repeat); ?>;
			background-size: <?php echo esc_attr($size); ?>;
			background-position: <?php echo esc_attr($position); ?>;
			background-attachment: <?php echo esc_attr($attachment); ?>;
        }
        <?php else : ?>
        .dark-mode .no-header-image .site-description,
        .dark-mode .no-header-image .site-title a {
            color: #fff;
        }
        .no-header-image .site-description,
        .no-header-image .site-title a {
            color: #333;
            margin-bottom: 0
        }
        .no-header-image .site-title {
            padding-top: .25em;
        }
        .no-header-image .site-description {
            padding-bottom: .5em;
        }

        .no-header-image .site-title a {
            font-size: 38px;
        }
		<?php endif; ?>
	    </style>
	<?php
    }
endif;