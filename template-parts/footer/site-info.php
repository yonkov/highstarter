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
<div class="footer-meta">
    <?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
    <div class="footer-credits">
        <a href="<?php echo esc_url( 'https://yonkov.github.io/' ); ?>" class="imprint">
            <?php printf( __( 'Designed by %s', 'kickstarter' ), 'Atanas Yonkov' );?>
        </a>
        <span> || </span>
        <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>" class="imprint">
            <?php printf( __( 'Powered by %s', 'kickstarter' ), 'WordPress' ); ?>
        </a>
    </div>
    <div class="wpnm-button">
        <div class="wpnm-button-inner-left"></div>
        <div class="wpnm-button-inner"></div>
    </div>
</div>