<?php
/**
 * Kickstarter theme Customizer
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

//Allow users to change page layout (Right sidebar or Fullwidth) via Theme Customizer

add_action('customize_register', 'kickstarter_register_theme_customizer');

function kickstarter_register_theme_customizer($wp_customize) {

    $wp_customize->add_section('theme_options', array(
        'title' => __('Options', 'kickstarter'),
        'description' => __( 'Change the layout of the whole website. You can choose to display or to hide the right sidebar.' )
    ));
    $wp_customize->add_setting('page_layout', array(
        'default' => __('Right Sidebar', 'kickstarter'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'theme_options',
        array(
            'label' => __('Page Layout', 'kickstarter'),
            'section' => 'theme_options',
            'settings' => 'page_layout',
            'type' => 'radio',
            'choices' => array(
                'default' => __('Right Sidebar', 'kickstarter'),
                'fullWidth' => __('Full-width', 'kickstarter'),
                ),
            )
        )
    );
}


function kickstarter_customize_css() {

    $layout = get_theme_mod('page_layout');

    if ($layout == 'fullWidth'): ?>

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
    </style>

    <?php endif;
}
add_action('wp_footer', 'kickstarter_customize_css');


//Allow users to change theme colors through WordPress Customizer

function kickstarter_customize_colors( $wp_customize ) {
    
    //Primary menu background color
	$wp_customize->add_setting('header_background_color', array(
		'default'        => '#fff',
		'transport'   => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	   ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
	   'label'   => 'Header Background Color',
	   'section' => 'colors',
		)));

	//Site title color
	$wp_customize->add_setting( 'site_title_textcolor' , array(
        'default'     => "#fff",
		'transport'   => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_textcolor', array(
		'label'        => __( 'Site Title Color', 'nasio' ),
        'section'    => 'colors',
	) ) );

	// Links Text color
	$wp_customize->add_setting( 'link_textcolor' , array(
        'default'     => "#007bff",
		'transport'   => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
		'label'        => __( 'Links Color', 'nasio' ),
        'section'    => 'colors',
    ) ) );

    	// Headings color
	$wp_customize->add_setting( 'header_textcolor' , array(
        'default'     => "#333",
		'transport'   => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
		'label'        => __( 'Headings Text Color', 'nasio' ),
        'section'    => 'colors',
    ) ) );
    
        //Buttons
    $wp_customize->add_setting( 'button_color' , array(
        'default'     => "#ff6663",
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_color', array(
        'label'        => __( 'Buttons', 'nasio' ),
        'section'    => 'colors',
    ) ) );
    
}
add_action( 'customize_register', 'kickstarter_customize_colors' );

function kickstarter_customize_colors_css() {
    ?>
    <style type="text/css">
    body h1, body h2, body h3 {
        color: #<?php echo esc_attr(get_theme_mod('header_textcolor', "#333")); ?>;
    }
    body a {
        color: <?php echo esc_attr(get_theme_mod('link_textcolor', '007bff')); ?>;
    }
    .site-header-wrapper {
        background-color: <?php echo esc_attr(get_theme_mod('header_background_color', "#fff")); ?>;
	}
	.hero-text .site-title a, .hero-text p {
		color: <?php echo esc_attr(get_theme_mod('site_title_textcolor', "#fff")); ?>;
    }
    button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"] {
        background-color: <?php echo esc_attr(get_theme_mod('button_color', "#ff6663")); ?>;
}

    </style>
    <?php
}
add_action( 'wp_footer', 'kickstarter_customize_colors_css');

//Allow users to change or remove the call to action on the Homepage 

function kickstarter_customize_register_frontpage_banner( $wp_customize ) {

    $wp_customize->add_section('header_banner', array(
        'title' => __('Call to Action', 'kickstarter'),
        'description' => __( 'Customize the Call to Action Button on the Header Image.' )
    ));

    /** Banner Label */
    $wp_customize->add_setting(
        'banner_label',
        array(
            'default'           => __( 'Get Started', 'kickstarter' ),
            'sanitize_callback' => 'wp_kses_post'
        )
    );
    
    $wp_customize->add_control(
        'banner_label',
        array(
            'label'           => __( 'Banner Text', 'kickstarter' ),
            'section'         => 'header_banner',
            'type'            => 'text'
        )
    );

        /** Banner Link */
        $wp_customize->add_setting(
            'banner_link',
            array(
                'default'           => '#',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'banner_link',
            array(
                'label'           => __( 'Banner Link', 'kickstarter' ),
                'section'         => 'header_banner',
                'type'            => 'url'
            )
        );

}

add_action( 'customize_register', 'kickstarter_customize_register_frontpage_banner' );