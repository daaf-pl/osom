<?php

if (!function_exists('osom_setup')) {
	function osom_setup(): void
	{
		add_theme_support(
			'html5',
			[
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			]
		);

		$logo_width = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			[
				'height' => $logo_height,
				'width' => $logo_width,
				'flex-width' => true,
				'flex-height' => true,
				'unlink-homepage-logo' => true,
			]
		);

		add_theme_support('responsive-embeds');
	}
}
add_action('after_setup_theme', 'osom_setup');

function osom_form_scripts(): void
{
	wp_enqueue_style('osom-form-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));

	wp_enqueue_script(
		'osom-form-script',
		get_template_directory_uri() . '/js/script.js',
		['jquery'],
		wp_get_theme()->get('Version'),
		true
	);
}

add_action('wp_enqueue_scripts', 'osom_form_scripts');

function wpb_add_google_fonts(): void
{
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap', false);
}

add_action('wp_enqueue_scripts', 'wpb_add_google_fonts');

function add_svg_to_upload_mimes( $types ) {
	$types[ 'svg' ] = 'image/svg+xml';
	return $types;
}
add_filter( 'upload_mimes', 'add_svg_to_upload_mimes' );

require get_template_directory() . '/inc/autoloader.php';
require get_template_directory() . '/inc/form-messages.php';

