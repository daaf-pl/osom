<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
				<?php if (has_custom_logo()) : ?>
                <div class="container logo-container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="site-logo"><?php the_custom_logo(); ?></div>
                        </div>
                    </div>
                </div>
<?php endif; ?>