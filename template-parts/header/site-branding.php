<?php
/**
 * Template part for displaying the logo, site title and header banner.
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>
<div class="site-branding">
    <?php if(has_header_image( ) ) : ?>
    <div class="image-overlay">
        <div class="hero-text">
        <!--Site Title and Description-->
        <?php if (display_header_text()==true) : ?> 
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name');?>
                </a>
            </h1>
        <?php $highstarter_description = get_bloginfo('description', 'display');
            if ($highstarter_description || is_customize_preview()): ?>
                <p class="site-description">
                    <?php echo $highstarter_description; ?>
                </p>
            <?php endif;
        endif; ?>
        <!--Call to action-->
        <?php highstarter_call_to_action() ?>
        </div>
    </div>
    <?php else:
         // Site Title and Description
        if (display_header_text()==true) : ?> 
        <div class="no-header-image">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" style="padding-top: 1em" rel="home">
                    <?php bloginfo('name');?>
                </a>
            </h1>
        <?php $highstarter_description = get_bloginfo('description', 'display');
            if ($highstarter_description || is_customize_preview()): ?>
                <p class="site-description">
                    <?php echo $highstarter_description; ?>
                </p>
            <?php endif; ?>
        </div>
        <?php endif;
    endif; ?>
</div>