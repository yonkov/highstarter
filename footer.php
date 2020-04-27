<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="row mb-5">
            <?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
        </div>
        <!--row-->
    </div><!-- .container -->
</footer><!-- #colophon -->
<?php wp_footer(); ?>

</div> <!-- .wrapper -->

</main> <!-- .main -->

</body>

</html>