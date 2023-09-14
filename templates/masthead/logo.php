<?php
/**
 * CMLS Base Theme
 * Template
 * Masthead Logo.
 */

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$logos = array(
	'file-masthead-logo'                => gav( themeMods::getFiles( true ), 'file-masthead-logo', array( 'id' => null ) )['id'],
	'file-masthead-logo-inside'         => gav( themeMods::getFiles( true ), 'file-masthead-logo-inside', array( 'id' => null ) )['id'],
	'file-masthead-logo-overlay'        => gav( themeMods::getFiles( true ), 'file-masthead-logo-overlay', array( 'id' => null ) )['id'],
	'file-masthead-logo-inside-overlay' => gav( themeMods::getFiles( true ), 'file-masthead-logo-inside-overlay', array( 'id' => null ) )['id'],
);
$logo_imgs = array(
	'file-masthead-logo' => ! $logos['file-masthead-logo'] ?: \wp_get_attachment_image(
		$logos['file-masthead-logo'],
		'thumbnail-uncropped',
		false,
		array(
			'alt'         => 'Logo for ' . \get_bloginfo( 'name' ),
			'class'       => 'logo-main',
			'aria-hidden' => 'true',
		)
	),
	'file-masthead-logo-inside' => ! $logos['file-masthead-logo-inside'] ?: \wp_get_attachment_image(
		$logos['file-masthead-logo-inside'],
		'thumbnail-uncropped',
		false,
		array(
			'alt'         => '',
			'class'       => 'logo-inside',
			'aria-hidden' => 'true',
		)
	),
	'file-masthead-logo-overlay' => ! $logos['file-masthead-logo-overlay'] ?: \wp_get_attachment_image(
		$logos['file-masthead-logo-overlay'],
		'thumbnail-uncropped',
		false,
		array(
			'alt'         => '',
			'class'       => 'logo-main-overlay',
			'aria-hidden' => 'true',
		)
	),
	'file-masthead-logo-inside-overlay' => ! $logos['file-masthead-logo-inside-overlay'] ?: \wp_get_attachment_image(
		$logos['file-masthead-logo-inside-overlay'],
		'thumbnail-uncropped',
		false,
		array(
			'alt'         => '',
			'class'       => 'logo-inside-overlay',
			'aria-hidden' => 'true',
		)
	),
);
?>
<!-- templates/masthead/logo -->
<h1 class="logo">
    <a aria-label="Home" href="<?php echo \home_url(); ?>">
        <?php if ( $logo_imgs['file-masthead-logo' ] ): ?>
            <?php foreach ( $logo_imgs as $img ): ?>
                <?php echo $img; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <span><?php echo \bloginfo( 'name' ); ?></span>
    </a>
</h1>
<!-- /templates/masthead/logo -->
