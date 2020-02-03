<?php
/**
 * Template part for displaying the logo, site title and header banner.
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>
<div class="site-branding">
    <div class="image-overlay">
        <div class="hero-text">
        <!--Site Title and Description-->
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name');?>
                </a>
            </h1>
    <?php $description = get_bloginfo('description', 'display');
    
    if ($description || is_customize_preview()): ?>
        <p class="site-description">
            <?php echo $description; ?>
        </p>
        <!--Call to action-->
        <?php kickstarter_call_to_action() ?>
        </div>
    <?php endif;?>
    </div>
</div>