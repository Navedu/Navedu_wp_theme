<?php
/**
 * Functions file for the Barebones shop theme.
 */
?>

<?php
/**
 * Meta boxes in posts for:
 * Price
 * Product ID
 */

add_action( 'admin_menu', 'bare_add_metabox' );

function bare_add_metabox() {
	add_meta_box(
		'bare_metabox', // metabox ID
		'Vare informationer', // title
		'bare_metabox_callback', // callback function
		'post', // post type or post types in array
		'normal', // position (normal, side, advanced)
		'default' // priority (default, low, high, core)
	);

}

function bare_metabox_callback( $post ) {

	$price = get_post_meta( $post->ID, 'price', true );
	$product_no = get_post_meta( $post->ID, 'product_no', true );

	// nonce, actually I think it is not necessary here
	wp_nonce_field( 'somerandomstr', '_barenonce' );

	echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="price">Pris:</label></th>
				<td><input type="text" id="price" name="price" value="' . esc_attr( $price ) . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="product_no">Varenr.:</label></th>
				<td><input type="text" id="product_no" name="product_no" value="' . esc_attr( $product_no ) . '" class="regular-text"></td>
			</tr>
		</tbody>
	</table>';

}

add_action( 'save_post', 'bare_save_meta', 10, 2 );

function bare_save_meta( $post_id, $post ) {

	// nonce check
	if ( ! isset( $_POST[ '_barenonce' ] ) || ! wp_verify_nonce( $_POST[ '_barenonce' ], 'somerandomstr' ) ) {
		return $post_id;
	}

	// check current use permissions
	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Do not save the data if autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// define your own post type here
	if( $post->post_type != 'post' ) {
		return $post_id;
	}

	if( isset( $_POST[ 'price' ] ) ) {
		update_post_meta( $post_id, 'price', sanitize_text_field( $_POST[ 'price' ] ) );
	} else {
		delete_post_meta( $post_id, 'price' );
	}
	if( isset( $_POST[ 'product_no' ] ) ) {
		update_post_meta( $post_id, 'product_no', sanitize_text_field( $_POST[ 'product_no' ] ) );
	} else {
		delete_post_meta( $post_id, 'product_no' );
	}

	return $post_id;
}

function get_the_price($post){
    return esc_html($post->price);
}

function get_the_productid($post){
    return esc_html($post->product_no);
}

?>



<?php
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );


function bare_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme', 'bare_theme_support');

function bare_menus(){
    $locations = array(
        'primary' => 'Navigation bar header',
        'socials' => 'Social navigation menu'
    );

    register_nav_menus($locations);
}

add_action('init', 'bare_menus');


function bare_register_styles(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('bare-stylesheet', get_template_directory_uri()."/style.css", array('bare-bootstrap', 'bare-bootstrap-icons'), $version, 'all');
    wp_enqueue_style('bare-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), '5.1.3', 'all');
    wp_enqueue_style('bare-bootstrap-icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css", array(), '1.8.1', 'all');
    
    wp_enqueue_style('aos-animations', "https://unpkg.com/aos@2.3.1/dist/aos.css", array(), '2.3.1', 'all');
}

add_action('wp_enqueue_scripts', 'bare_register_styles');

function bare_register_scripts(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script('bare-bootstrap-popper', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',array(), '5.1.3', true);
    
    wp_enqueue_script('aos-animations-script', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true);
    
    wp_enqueue_script('bare-script', get_template_directory_uri().'/assets/js/script.js',array('bare-bootstrap-popper'), $version, true);
}

add_action('wp_enqueue_scripts', 'bare_register_scripts');
?>

<?php
    function get_post_block_galleries_images( $post_id ) {
        $content = get_post_field( 'post_content', $post_id );
        $srcs = [];
    
        $i = -1;
        foreach ( parse_blocks( $content ) as $block ) {
            if ( 'core/gallery' === $block['blockName'] ) {
                $i++;
                $srcs[ $i ] = [];
    
                preg_match_all( '#src=([\'"])(.+?)\1#is', $block['innerHTML'], $src, PREG_SET_ORDER );
                if ( ! empty( $src ) ) {
                    foreach ( $src as $s ) {
                        $srcs[ $i ][] = $s[2];
                    }
                }
            }
        }
    
        return $srcs;
    }

    function the_email(){
        echo get_option('admin_email');
    }
?>

<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function bare_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer sidebar',
		'id'            => 'footer_sidebar_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'bare_widgets_init' );
?>

<?php

class Bare_Menu_Walker extends Walker_Nav_Menu{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0){
        $output .= '<li class="nav-item"><a class="nav-link" href="'.esc_attr($item->url).'">'. $item->title;
    }
    public function end_el(&$output, $item, $depth = 0, $args = null){
        $output .= '</a></li>';
    }
    
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ){
        if ( ! $element ) {
            return;
        }
        $this->start_el( $output, $element, $depth, ...array_values( $args ) );
        $this->end_el( $output, $element, $depth, ...array_values( $args ) );
    }
}

?>