<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_header(); ?>

<section class="site-section">
    <div class="container">
        <div class="row blog-entries">
            <div class="main-content">
            <article class="hentry">
                <h2 class="mb-4"><?php _e( 'Oops! That page can&rsquo;t be found.', 'highstarter' ); ?></h2>

                <div class="row">
                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'highstarter' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </article>

			</div>
				
            <?php get_sidebar(); ?>
        </div>
</section>
</div>

<?php get_footer();