<?php
function create_form_type()
{
	register_post_type('forms',
		[
			'labels' => [
				'name' => __('Formularze'),
				'singular_name' => __('Formularz')
			],
			'public' => true,
			'has_archive' => true,
			'rewrite' => ['slug' => 'forms'],
			'show_in_rest' => true,
		]
	);
}
add_action('init', 'create_form_type');