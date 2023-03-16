<?php
/**
 * Highstarter theme Customizer.
 *
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Call Custom Sanitization Functions.
 */
require get_template_directory() . '/inc/sanitization-functions.php';

/*
 ** Allow users to change theme colors through the WordPress Customizer
 */

function highstarter_customize_colors( $wp_customize ) {
	$wp_customize->get_section( 'colors' )->description = esc_html__( 'Customze the colors of the light theme mode. To customize the dark theme mode, go to the Night Mode section.', 'highstarter' );

	// Primary menu background color
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label'   => esc_html__( 'Header Background Color', 'highstarter' ),
				'section' => 'colors',
			)
		)
	);

	// Links Text color
	$wp_customize->add_setting(
		'link_textcolor',
		array(
			'default'           => '#007bff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_textcolor',
			array(
				'label'   => esc_html__( 'Links Color', 'highstarter' ),
				'section' => 'colors',
			)
		)
	);

	// Headings color
	$wp_customize->add_setting(
		'headings_textcolor',
		array(
			'default'           => '#333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'headings_textcolor',
			array(
				'label'   => esc_html__( 'Headings Text Color', 'highstarter' ),
				'section' => 'colors',
			)
		)
	);

	// Buttons
	$wp_customize->add_setting(
		'button_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'button_color',
			array(
				'label'   => esc_html__( 'Buttons', 'highstarter' ),
				'section' => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'highstarter_customize_colors' );

function highstarter_customize_colors_css() {
	$header_text_color = get_theme_mod( 'header_textcolor' ); ?>

<style type="text/css">
body h1,
body h2,
body h3 {
	color: <?php echo esc_attr( get_theme_mod( 'headings_textcolor', '#333' ) ); ?>;
}
body a {
	color: <?php echo esc_attr( get_theme_mod( 'link_textcolor', '#007bff' ) ); ?>;
}
.site-header-wrapper {
	background-color: <?php echo esc_attr( get_theme_mod( 'header_background_color' ) ); ?>;
}
	<?php if ( $header_text_color ) : ?>
.hero-text .site-title a,
header .site-description {
	color: #<?php echo esc_attr( get_theme_mod( 'header_textcolor', 'fff' ) ); ?>;
}

	<?php endif; ?>
button,
a.button,
a.button:visited,
input[type="button"],
input[type="reset"],
input[type="submit"] {
	background-color: <?php echo esc_attr( get_theme_mod( 'button_color' ) ); ?> !important;
}
</style>

	<?php
}
add_action( 'wp_head', 'highstarter_customize_colors_css' );

/*
 * Allow users to change or remove the call to action on the Homepage
 * and customize the header image
 */

function highstarter_customize_register_banner_and_header( $wp_customize ) {
	/*
	 * HEADER IMAGE OPTIONS
	 *
	 */

	$wp_customize->add_section(
		'header_options',
		array(
			'title'       => esc_html__( 'Header Options', 'highstarter' ),
			'description' => esc_html__( 'Customize the header image to taste with the options below. Change width, height and position of the image. Choose to add or remove the parallax effect on the image. Customize the call to action button on the header of the Homepage. Please note: for these options to work, make sure that a header image is specified in the "Header Image" section.', 'highstarter' ),
			'priority'    => 99,
		)
	);

	// Header background size
	$wp_customize->add_setting(
		'header-background-size',
		array(
			'default'           => 'cover',
			'sanitize_callback' => 'highstarter_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'header-background-size',
		array(
			'label'       => esc_html__( 'Header Background Size', 'highstarter' ),
			'section'     => 'header_options',
			'description' => esc_html__( 'Resize the header image to adjust to the width of the whole screen or choose to keep its initial width.', 'highstarter' ),
			'type'        => 'select',
			'choices'     => array(
				'initial' => esc_html( 'initial' ),
				'cover'   => esc_html( 'cover' ),
			),
		)
	);

	// Header Image Position
	$wp_customize->add_setting(
		'header-background-position',
		array(
			'default'           => 'center',
			'sanitize_callback' => 'highstarter_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'header-background-position',
		array(
			'label'       => esc_html__( 'Header Background Position', 'highstarter' ),
			'section'     => 'header_options',
			'description' => esc_html__( 'Choose how you want to position the header image.', 'highstarter' ),
			'type'        => 'select',
			'choices'     => array(
				'top'    => esc_html( 'top' ),
				'center' => esc_html( 'center' ),
				'bottom' => esc_html( 'bottom' ),
			),
		)
	);

	// Header Height

	$wp_customize->add_setting(
		'header_image_height',
		array(
			'default'           => '380px',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_image_height',
		array(
			'label'       => esc_html__( 'Header Image Height', 'highstarter' ),
			'section'     => 'header_options',
			'type'        => 'text',
			'description' => esc_html__( 'Change the height of the header image. Write below a number in pixels (default is 380px).', 'highstarter' ),
		)
	);

	// Header Parallax Effect
	$wp_customize->add_setting(
		'header-background-attachment',
		array(
			'default'           => 1,
			'sanitize_callback' => 'highstarter_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'header-background-attachment',
		array(
			'label'       => esc_html__( 'Header Image Parallax', 'highstarter' ),
			'section'     => 'header_options',
			'description' => esc_html__( 'Add beautiful parallax effect on the header image.', 'highstarter' ),
			'type'        => 'checkbox',
		)
	);

	// Header Overlay

	function highstarter_customize_opacity_range() {
		return apply_filters(
			'highstarter_customize_opacity_range',
			array(
				'min'  => 0,
				'max'  => 9,
				'step' => 1,
			)
		);
	}

	$wp_customize->add_setting(
		'cover_template_overlay_opacity',
		array(
			'default'           => '1',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'cover_template_overlay_opacity',
		array(
			'label'       => __( 'Header Overlay Opacity', 'highstarter' ),
			'description' => __( 'Make sure that the contrast is high enough so that the text is readable.', 'highstarter' ),
			'section'     => 'header_options',
			'type'        => 'range',
			'input_attrs' => highstarter_customize_opacity_range(),
		)
	);

	/*
	 * CALL TO ACTION
	 */

	// Banner label
	$wp_customize->add_setting(
		'banner_label',
		array(
			'default'           => esc_html__( 'Get Started', 'highstarter' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'banner_label',
		array(
			'label'       => esc_html__( 'Banner Text', 'highstarter' ),
			'section'     => 'header_options',
			'description' => esc_html__( 'Change the default text of the button.', 'highstarter' ),
			'type'        => 'text',
		)
	);

	// Banner Link
	$wp_customize->add_setting(
		'banner_link',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'banner_link',
		array(
			'label'       => esc_html__( 'Banner Link', 'highstarter' ),
			'section'     => 'header_options',
			'description' => esc_html__( 'Add link to the button. You can link it to the About page or the Contact page or to a specific section from the Homepage.', 'highstarter' ),
			'type'        => 'url',
		)
	);
}

add_action( 'customize_register', 'highstarter_customize_register_banner_and_header' );

/*
 **Allow users to change page layout (Right sidebar or Fullwidth) via Theme Customizer
 */

function highstarter_register_theme_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'layout_options',
		array(
			'title'       => esc_html__( 'Page Layout', 'highstarter' ),
			'description' => esc_html__( 'Change the layout of the whole website. You can choose to display right sidebar, left sidebar or hide the sidebar completely.', 'highstarter' ),
		)
	);

	$wp_customize->add_setting(
		'page_layout',
		array(
			'default'           => 'one',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'layout_options',
			array(
				'label'    => esc_html__( 'Page Layout', 'highstarter' ),
				'section'  => 'layout_options',
				'settings' => 'page_layout',
				'type'     => 'radio',
				'choices'  => array(
					'one'   => esc_html__( 'Right Sidebar', 'highstarter' ),
					'two'   => esc_html__( 'Full-width', 'highstarter' ),
					'three' => esc_html__( 'Left Sidebar', 'highstarter' ),
				),
			)
		)
	);
}

add_action( 'customize_register', 'highstarter_register_theme_customizer' );

function highstarter_customize_css() {
	$layout = get_theme_mod( 'page_layout' );

	if ( $layout == 'two' ) :
		?>

<style type="text/css">
	.main-content {
		max-width: 100% !important;
		flex: 100% !important;
	}
	.blog-entries .blog-entry img {
		width: 100% !important;
	}
	.sidebar {
		display: none;
	}
	body .container {
		max-width: 980px;
	}
</style>

	<?php elseif ( $layout == 'three' ) : ?>
	
<style type="text/css">
	.blog-entries {
		flex-direction: row-reverse;
	}
		<?php if ( ! is_rtl() ) : ?>
	@media (min-width: 60em){
		.sidebar-wrapper, .dark-mode .sidebar-box {
			padding-left: 0;
		}	
	}
	<?php else : ?>
	@media (min-width: 60em){
		.sidebar-wrapper, .dark-mode .sidebar-box {
			padding-right: 0;
		}
	}   
	<?php endif; ?>
</style>  

		<?php
	endif;
}
add_action( 'wp_head', 'highstarter_customize_css' );

/*
 * Night Mode
 * @since version 2.0
 */

function highstarter_night_mode_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'night_mode',
		array(
			'title'       => esc_html( __( 'Night Mode', 'highstarter' ) ),
			'description' => esc_html(
				__( 'Customize the dark theme mode. For additional customizations, you can use the "dark-mode" body class and add the code to the Additional Css tab.', 'highstarter' )
			),
		)
	);

	// Enable Dark Mode
	$wp_customize->add_setting(
		'enable_dark_mode',
		array(
			'default'           => 1,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'enable_dark_mode',
		array(
			'label'       => esc_html__( 'Enable Dark Mode', 'highstarter' ),
			'section'     => 'night_mode',
			'description' => esc_html__( 'Enable site visitors to switch to dark theme mode in the theme footer.', 'highstarter' ),
			'type'        => 'checkbox',
		)
	);

	// Change Dark Mode Colors

	$wp_customize->add_setting(
		'dark_mode_background_color',
		array(
			'default'           => '#262626',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'dark_mode_background_color',
			array(
				'label'   => __( 'Background', 'highstarter' ),
				'section' => 'night_mode',
			)
		)
	);

	$wp_customize->add_setting(
		'dark_mode_logo',
		array(
			'default'           => '', // Add Default Image URL
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'dark_mode_logo_control',
			array(
				'label'         => __( 'Upload Dark Mode Logo', 'highstarter' ),
				'description' => __( 'Replace logo to match the dark theme.', 'highstarter' ),
				'section'       => 'night_mode',
				'settings'      => 'dark_mode_logo',
				'button_labels' => array(//
					'select' => 'Select Logo',
					'remove' => 'Remove Logo',
					'change' => 'Change Logo',
				),
			)
		)
	);
}

add_action( 'customize_register', 'highstarter_night_mode_customizer' );

function highstarter_customize_night_mode_css() {
	$isDarkMode = get_theme_mod( 'enable_dark_mode', 1 ) ? 'block' : 'none';
	?>

<style type="text/css">
body.dark-mode header, body.dark-mode main *, 
body.dark-mode main .hentry, body.dark-mode main .sidebar-box,
body.dark-mode .site-header-wrapper,
body.dark-mode .main-navigation ul,
body.dark-mode .main-navigation ul ul {
	background-color: <?php echo esc_attr( get_theme_mod( 'dark_mode_background_color', '#262626' ) ); ?>;
}
body.dark-mode form#commentform, body.dark-mode .comment-body {
	background-color: <?php echo esc_attr( get_theme_mod( 'dark_mode_background_color', '#262626' ) ); ?> !important;
}
</style>

	<?php
}

add_action( 'wp_head', 'highstarter_customize_night_mode_css' );