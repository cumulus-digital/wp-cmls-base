<?php
/**
 * Header script settings.
 */

namespace CMLS_Base\Settings\HeadScripts;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

$html_inject_options = array(
	array(
		'id'          => 'cmls-html-head_start',
		'description' => 'Start of HEAD tag',
		'hook'        => 'cmls_template-head-begin',
		'priority'    => \PHP_INT_MIN,
	),
	array(
		'id'          => 'cmls-html-head_end',
		'description' => 'Before closing HEAD tag',
		'hook'        => 'cmls_template-head-end',
		'priority'    => \PHP_INT_MIN,
	),
	array(
		'id'          => 'cmls-html-body_start',
		'description' => 'Start of BODY tag',
		'hook'        => 'wp_body_open',
		'priority'    => \PHP_INT_MIN,
	),
	array(
		'id'          => 'cmls-html-body_end',
		'description' => 'Before closing BODY tag',
		'hook'        => 'wp_footer',
		'priority'    => \PHP_INT_MAX,
	),
);

\add_filter( 'admin_init', function () use ( $html_inject_options ) {
	\add_settings_section(
		'cmls-theme_settings-html_inject',
		'HTML Injection',
		function () {
			?>
			<p>
				This theme provides hooks for injecting custom HTML at various positions in the document.
				If the Cumulus Wordpress Security Headers plugin is installed, and auto-nonce is enabled,
				the output will be filtered.
			</p>
			<?php
		},
		'cmls-theme_settings'
	);

	foreach ( $html_inject_options as $option ) {
		\register_setting(
			'cmls-theme_settings',
			$option['id'],
			array(
				'description'       => $option['description'],
				'type'              => 'string',
				'sanitize_callback' => null,
				'default'           => null,
			)
		);
		\add_settings_field(
			$option['id'],
			'<label for="' . $option['id'] . '">' . $option['description'] . '</label>',
			function () use ( $option ) {
				$value = \get_option( $option['id'], '' );
				?>
				<textarea
					rows="10"
					id="<?php echo $option['id']; ?>"
					name="<?php echo $option['id']; ?>"
					class="regular-text"
					style="width: 600px; max-width: 100%;"
				><?php echo $value; ?></textarea>
				<?php
			},
			'cmls-theme_settings',
			'cmls-theme_settings-html_inject'
		);
	}
} );

foreach ( $html_inject_options as $option ) {
	if ( ! empty( \get_option( $option['id'], false ) ) ) {
		\add_action(
			$option['hook'],
			function () use ( $option ) {
				$value = \get_option( $option['id'], null );
				if ( ! empty( $value ) ) {
					$scripts = \apply_filters( 'cmls_wpsh_filter_scripts', \do_shortcode( $value, false ) );
					if ( ! empty( $scripts ) ) {
						echo $scripts;
					}
				}
			},
			$option['priority'],
			0
		);
	}
}
