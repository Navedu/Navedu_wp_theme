<?php get_header() ?>
<div class="container-fluid p-0" style="min-height:100vh">



    <div class="container h-100 pb-5" style="padding-top: 200px;">
        <h1>
            <?php
                the_title();
            ?>
        </h1>
        <?php
        the_content();
    ?>

    </div>

</div>
<?php get_footer();?>