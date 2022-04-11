<?php
/**
 * Front-page file for the Barebones shop theme.
 */
?>

<?php get_header(); ?>

<body>
    <div class="container-fluid content p-0">
        <div class="row g-0">
            <div class="hero-container">
                <div class="hero">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="header_img" class="img-fluid">
                </div>
                <div class="hero-text">
                    <h2 class="text-shadow">
                        <?php
                            the_title()
                        ?>
                    </h2>
                    <div class="hero-short-text text-shadow">
                        <?php
                            echo strip_tags(the_content()['innerHTML'])
                        ?>
                    </div>
                    <a href="<?php echo home_url()."/about"; ?>">
                        <button class=" btn
                            header-btn">Læs mere
                        </button>

                    </a>
                </div>
            </div>
        </div>
        <div class="container container-sm p-0 pt-5">
            <div class="row row-sm g-0">

                <?php
                $args = array(
                    'posts_per_page'    => 12,
                    'post_type'     => 'post',
                    'order' => 'DESC',
                );

                $the_query = new WP_Query( $args );

                if( $the_query->have_posts() ){
                    while( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part('template-parts/content', 'archive');
                    }
                }
            ?>

            </div>
        </div>

        <div class="justify-content-center" style="display: flex;">
            <a href="<?php echo get_post_type_archive_link('post') ?>"><button class="btn btn-dark">Se
                    mere...</button></a>
        </div>

        <div class="mt-5 mb5"></div>
</body>

<?php get_footer(); ?>