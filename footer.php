<?php
/**
 * Footer file for Navedu Technologies.
 */
?>

<footer>
        <div class="footer-container mt-5">
            <div class="container pt-5">
                <div class="row">
                    <div class="col">
                        <a href="<?php echo home_url(); ?>">
                            <?php
                                if(function_exists('the_custom_logo')){
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                }
                            ?>
                            <img src="<?php echo $logo[0] ?>" class="footer-img" alt="NAVEDU" class="d-inline-block align-text-top">
                        </a>
                    </div>
                </div>

                <div class="row pt-5">
                    <div class="col">
                        <!-- Footer Widget 1 -->
                        <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'sidebar-1' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <!-- Footer Widget 2 -->
                        <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'sidebar-2' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <!-- Footer Widget 3 -->
                        <?php if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'sidebar-3' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <!-- Footer Widget 4 -->
                        <?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'sidebar-4' ); ?>
                            </div>
                        <?php } ?>                        
                    </div>
                </div>
                <div class="row pt-5">
                    <!-- Footer Widget 5 - Copyright notice -->
                    <?php if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'sidebar-5' ); ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>