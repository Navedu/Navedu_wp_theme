<?php
/**
 * Footer file for the Barebones shop theme.
 */
?>

<footer class="fluid-container-md .footer" id="footer">
    <div class="row gx-0">
        <div class="col-md-4 align-self-center">
            <div class="social-contact m-3">
                <div class="row">
                    <h4>Kontakt</h4>
                </div>

                <div class="row">
                    <a href="https://instagram.com/bellevueretro" target="_"><i class="bi bi-instagram"></i><span
                            class="ms-2">@bellevueretro</span></a>
                </div>
                <div class="row">
                    <a href="mailto:<?php the_email() ?>" target="_"><i class="bi bi-envelope"></i><span
                            class="ms-2"><?php echo the_email(); ?></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md justify-content-center" style="display:flex;">
            <?php
                if(function_exists('the_custom_logo')){
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id);
                }
            ?>
            <img src="<?php echo $logo[0] ?>" alt="br_logo" class="img-fluid p-3">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4" style="display: flex;
align-content: center;
align-items: center;
justify-content: center;
text-align: center;">
            <div class="footer-widget-right">
                <?php if ( is_active_sidebar( 'footer_sidebar_1' ) ) : ?>
                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
                </div><!-- #primary-sidebar -->
                <?php endif; ?>
            </div>
        </div>
    </div>

</footer>

<?php
    wp_footer();
?>