<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
?>

<?php
get_header(); ?>
<div>
    <!-- Start of main-content -->
    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="post-title">
                    <?php
				the_archive_title( '<h2>', '</h2>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="main-content">
                    <div class="row">
                        <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/post/content', 'excerpt' );

                    endwhile; // End of the loop.

                else : ?>

                        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'highstarter' ); ?>
                        </p>
                        <?php
                        get_search_form();

                endif;
                highstarter_numeric_posts_nav(); //Pagination
                ?>       
                    </div>
                </div>
                <!-- END of main-content -->
                <!-- Show Sidebar -->
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer();