<div class="col-lg-3 col-md-4 col-6 p-3 item-listed" data-aos="fade-up">
    <a href=" <?php the_permalink() ?>">
        <?php $tn_src = "hejsa" ?>
        <img src="<?php the_post_thumbnail_url() ?>" alt="" class="img-fluid thumb-img">
        <h5><?php the_title() ?></h5>
        <div class="item-short-desc"><?php the_excerpt() ?></div>
    </a>
</div>