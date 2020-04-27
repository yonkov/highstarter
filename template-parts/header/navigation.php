<?php
/**
 * Template part for displaying the primary navigation menu.
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<!--Toggle menu on mobile-->
<button class="menu-toggle" id="menu-toggle" role="button" tabindex="0">
    <div></div>
    <div></div>
    <div></div>
</button>

<nav id="site-navigation" class="main-navigation">

<?php // Insert menu items through WP admin
    wp_nav_menu(
        array(
            'theme_location' => 'top',
            'menu_class' => 'menu-primary-container',
            'container_class' => 'menu-primary-container',
        )
    );
?>
</nav><!-- .menu-1 -->