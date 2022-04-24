<?php
/**
 * Header file for Navedu Technologies.
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header>
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container">
                <a class="navbar-brand mb-2" href="<?php echo home_url(); ?>">
                    <?php
                        if(function_exists('the_custom_logo')){
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        }
                    ?>
                    <img src="<?php echo $logo[0] ?>" class="header-img" alt="NAVEDU" class="d-inline-block align-text-top">
                </a>
                <div class="navbar-toggler">
                <button class="nbtn-dark">
                        <i class="bi bi-handbag"></i>
                    </button>
                    <button class="nbtn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                            'depth' => 2,
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ));
                    ?>
                </div>
                <div class="container justify-content-end" style="display: flex;">
                    <button class="nbtn-light d-none d-lg-block">
                        <a href="mailto:kontakt@navedu.dk">Kontakt</a>
                    </button>
                    <button class="nbtn-dark d-none d-lg-block">
                        <i class="bi bi-handbag"></i>
                    </button>
                </div>
            </div>


            </div>
        </nav>
    </header>

</html>