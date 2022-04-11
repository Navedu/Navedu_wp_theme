<?php
/**
 * Index page file for the Barebones shop theme.
 */
?>

<?php get_header(); ?>

<body>
    <div class="container container-sm content p-0">
        <div class=" row row-sm g-0 pt-5">
            <?php
                if( have_posts() ) {
                    while( have_posts() ){
                        the_post();

                        get_template_part('template-parts/content', 'archive');
                    }
                }
            ?>
        </div>
    </div>


    <?php
                the_posts_pagination( )
            ?>

    <div class="mt-5 mb5"></div>
</body>

<?php get_footer(); ?>