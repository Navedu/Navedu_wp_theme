<?php
/**
 * Archive page file for the Barebones shop theme.
 */
?>

<?php get_header(); ?>

<body>

    <div class="container container-sm content p-0">
        <div class="row row-sm g-0" style="padding-top: 30px">
            <div class="row">
                <h1>
                    <?php
                    $cat_name = single_cat_title( '', false );
                    echo $cat_name
                 ?>
                </h1>
            </div>
            <div class="row">
                <ul class="nav">
                    <?php
                        // Get submenus
                        $cat_id = get_cat_ID( $cat_name ); 
                        $args = array('child_of' => $cat_id);
                        $categories = get_categories( $args );

                        $first = true;

                        foreach ($categories as $category){
                            $sub_menu_title = $category->name;
                            $sub_menu_url = get_category_link( $category->term_id );

                            if($first){
                                $output .= '';
                                $first = false;
                            }else{
                                $output .= '<li class="nav-item"><a class="nav-link">|</a></li>';
                            }
                            
                            $output .= '<li class="nav-item"><a class="nav-link" href="'.$sub_menu_url.'">'.$sub_menu_title.'</a></li>';
                        }
                        
                        echo $output;
                    ?>
                </ul>
            </div>
            <?php
                if( have_posts() ) {
                    while( have_posts() ){
                        the_post();

                        get_template_part('template-parts/content', 'archive');
                    }
                }
            ?>

            <?php
                the_posts_pagination()
            ?>
        </div>
    </div>

    <div class="mt-5 mb5"></div>
</body>

<?php get_footer(); ?>