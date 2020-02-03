<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>
<div class="footer-credits">
    <?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
    <br>
    <br> 
    <?php if( get_theme_mod( 'footer_text_block') != "" ) : ?> 
    <?php esc_attr(get_theme_mod( 'footer_text_block')); ?>
    
    <?php else : ?>
            <a href="<?php echo esc_url( __( 'https://yonkov.github.io/', 'nasio' ) ); ?>" class="imprint">
                <?php printf( __( 'Designed by %s', 'nasio' ), 'Atanas Yonkov' );?>
            </a>
            <span> || </span>
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nasio' ) ); ?>" class="imprint">
                <?php printf( __( 'Powered by %s', 'nasio' ), 'WordPress' ); ?>
            </a>
    <?php endif ?>

</div>