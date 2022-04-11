<?php
/**
 * Header file for the Barebones shop theme.
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

    <header id="header-container" class="">
        <nav class="navbar navbar-expand-md navbar-light header">
            <div class="container-fluid header-container">
                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                    <?php
                        if(function_exists('the_custom_logo')){
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id);
                        }
                    ?>
                    <img src="<?php echo $logo[0] ?>" alt="" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse p-3" id="navbarSupportedContent">
                    <?php
                            wp_nav_menu(
                                array(
                                    'menu' => 'primary',
                                    'container' => '',
                                    'depth' => '1',
                                    'theme_location' => 'primary',
                                    'items_wrap' => '<ul class="navbar-nav ms-auto mb-2 mb-md-0">%3$s</ul>',
                                    'walker' => new Bare_Menu_Walker()
                                ),
                            );
                            get_search_form();
                
                        ?>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>