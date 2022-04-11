<div class="align-items-center" style="display:flex;">
    <form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
        style="justify-content: center;display: flex;" class="ms-auto ps-2">
        <input type="hidden" name="post_type" value="post" />
        <input type="text" class="search-field" name="s" placeholder="Søg..." value="<?php echo get_search_query(); ?>">
        <button type="submit" class="btn">
            <i class="bi bi-search" type="submit"></i>
        </button>
    </form>

</div>