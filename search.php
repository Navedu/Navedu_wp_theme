<?php get_header() ?>

<div class="container-fluid" style="min-height:100vh; margin-top:200px;">

    <div class="container">
        <div class="row">
            <h1><?php echo 'Resultater for: "'.get_search_query().'"' ?></h1>
        </div>

        <div class="row">
            <?php
                if( have_posts() ) {
                    while( have_posts() ){
                        the_post();

                        get_template_part('template-parts/content', 'archive');
                    }
                }else{
                    echo "<h4 class='mt-4'>Ingen resultater fundet...</h4>";
                }
            ?>
        </div>
    </div>



</div>


<?php get_footer() ?>