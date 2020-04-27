<?php
/**
 * The template for displaying a page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_header(); ?>
<section id="content" class="site-section">
    <div class="container">
        <div class="row blog-entries">
            <div class="main-content">
                <div class="row">
                <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/post/content', get_post_format() );
                highstarter_post_nav();
				// If comments are open, load up the comment template.
				if ( comments_open() ) :
					comments_template();
				endif;       
			endwhile; // End of the loop.
            ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer();