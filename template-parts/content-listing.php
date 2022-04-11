<div class="container item-container">
    <div class="row">
        <div class="col-lg-7 p-2">
            <div id="carouselExampleIndicators" class="carousel slide my-auto h-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php 
                        $post = get_post(); 

                        if ( has_blocks( $post->post_content ) ) {
                            $blocks = parse_blocks( $post->post_content );
                            $i = 0;
                            foreach ($blocks as $block){
                                if ( $block['blockName'] == "core/image" ){
                                    echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'"
                                    class="active" aria-current="true" aria-label="Slide '.$i.'"></button>';
                                    $i++;
                                }
                            }
                            
                        }
                    ?>
                </div>
                <div class="carousel-inner h-100">
                    <?php 
                        $post = get_post(); 

                        if ( has_blocks( $post->post_content ) ) {
                            $blocks = parse_blocks( $post->post_content );
                            $i = 0;
                            foreach ($blocks as $block){
                                if ( $block['blockName'] == "core/image" ){

                                    $i++;
                                    $img_url = wp_get_attachment_image_url($block['attrs']['id'], 'large');

                                    if ($i == 1){
                                        echo '<div class="carousel-item active"><img src="'.$img_url.'" class="d-block thumb-img-listing"></div>';
                                    } else{
                                        echo '<div class="carousel-item"><img src="'.$img_url.'" class="d-block thumb-img-listing"></div>';
                                    }
                                }
                            }
                            
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-lg-5 text-center my-auto pt-5 pb-5">
            <h1>
                <b>
                    <?php
                        the_title();
                    ?>
                </b>
            </h1>
            <h3>
                <?php 
                    echo get_post()->price;
                ?>
            </h3>
            <p>
                <i>
                    <?php
                        echo "Varenr.: ".get_post()->product_no;
                    ?>
                </i>
            </p>
            <p>
                <?php
                    echo the_excerpt();
                ?>
            </p>
            <a href="mailto:<?php the_email() ?>?subject=<?php echo the_title()." / #".get_post()->product_no ?>"">
                <button class=" btn-dark rounded-1">
                <h3 class="m-2">Kontakt og køb</h3>
                </button>
            </a>
        </div>
    </div>

</div>