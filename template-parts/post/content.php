<?php
/**
 * Template part for displaying posts
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<article <?php post_class(); ?>>

	<?php highstarter_thumbnail('large'); ?>

	<div class="entry-header">
        <div class="breadcrumb"><?php highstarter_breadcrumbs();?></div>
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>

			<div class="entry-meta posted-on">
				<?php highstarter_post_meta_header(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( esc_html__( 'Continue reading &rarr;', 'highstarter' ) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'highstarter' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
        <div class="entry-meta taxonomies">
            <?php highstarter_post_meta_footer(); ?>
        </div>
	</div><!-- .entry-footer -->

</article><!-- #post-## -->
