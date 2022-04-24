<?php
/**
 * Front-page file for the Barebones shop theme.
 */
?>

<?php get_header(); ?>


<?php
    // Get the featured image url
    $bg_img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
?>
<div class="hero-container align-items-center" style="display: flex; background-image: url(<?php echo $bg_img_url ?>);">
    <div class="container">

        

        <div class="hero-text-container me-auto">
            <?php if ( is_active_sidebar( 'sidebar-fp-hero' ) ) { ?>
                <div class="hero-widget">
                    <?php dynamic_sidebar( 'sidebar-fp-hero' ); ?>
                </div>
            <?php } ?>

            <!-- To be used in widget - for the link to be dynamic -->
            <!-- <button class="nbtn-dark"><a href="#routines">Lær mere</a></button> -->
        </div>
    </div>
</div>

<div class="container mt-5">
    <?php the_content() ?>
</div>


<?php get_footer(); ?>