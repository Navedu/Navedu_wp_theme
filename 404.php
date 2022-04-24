<?php get_header(); ?>

<div class="container-fluid p-0 container-404" style="display:flex; justify-content-center;align-items:center;">
    <div class="container align-items-center text-center">
        <a href="<?php echo home_url(); ?>">
            <?php
                if(function_exists('the_custom_logo')){
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                }
            ?>
            <img src="<?php echo $logo[0] ?>" alt="" width="25%" class="d-inline-block align-text-top pb-2">
            <h2 class="mt-4">404 - Siden blev ikke fundet</h2>
            <p>
                Denne side findes ikke, vælg venligt et andet sted fra menuen i toppen eller tryk her for
                at gå tilbage til forsiden.
            </p>
        </a>
    </div>
</div>

<?php get_footer(); ?>