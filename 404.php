<div class="container-fluid h-100 p-0" style="display:flex; flex-direction: column;">
    <?php get_header(); ?>

    <div class="container container-404">
        <div class="text-404">
            <a href="<?php echo home_url(); ?>">
                <?php
                        if(function_exists('the_custom_logo')){
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id);
                        }
                    ?>
                <img src="<?php echo $logo[0] ?>" alt="" class="d-inline-block align-text-top pb-2">
            </a>
            <h2>404 Siden blev ikke fundet</h2>
            <p>
                <b>
                    Du finder ingen møbler her...
                </b>
            </p>
            <p>
                <a href="<?php echo home_url(); ?>">
                    Denne side findes ikke, vælg venligt et andet sted fra menuen i toppen eller tryk her for
                    at gå tilbage til forsiden.
                </a>
            </p>
        </div>
    </div>


    <?php get_footer(); ?>
</div>