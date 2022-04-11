<?php
/**
 * Single page file for the Barebones shop theme.
 */
?>

<?php get_header(); ?>

<body>
    <div class="container-fluid content p-0">
        <div class="container-lg pt-5">
            <?php
                if( have_posts() ) {
                    while( have_posts() ){
                        the_post();

                        get_template_part('template-parts/content', 'listing');
                    }
                }
            ?>
        </div>

        <div class="mt-5 mb5"></div>
</body>

<?php get_footer(); ?>