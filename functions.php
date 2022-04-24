<?php
/**
 * Functions file for Navedu Technologies.
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


function bare_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'post-thumbnails' );

}
add_action('after_setup_theme', 'bare_theme_support');

function bare_menus(){
    $locations = array(
        'main-menu' => 'Navigation bar header',
        'socials' => 'Social navigation menu'
    );

    register_nav_menus($locations);
}

add_action('init', 'bare_menus');


function navedu_enqueue_styles_scripts(){
    $version = wp_get_theme()->get('Version');

    // Styles
    wp_enqueue_style('navedu-stylesheet', get_stylesheet_uri(), array('navedu-bootstrap', 'navedu-bootstrap-icons'), $version);
    wp_enqueue_style('navedu-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), '5.1.3');
    wp_enqueue_style('navedu-bootstrap-icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css", array(), '1.8.1');
    wp_enqueue_style('aos-animations', "https://unpkg.com/aos@2.3.1/dist/aos.css", array(), '2.3.1');

    // Scripts
    wp_enqueue_script('navedu-bootstrap-popper', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',array(), '5.1.3');
    wp_enqueue_script('aos-animations-script', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1');
    wp_enqueue_script('navedu-script', get_template_directory_uri().'/assets/js/script.js',array('navedu-bootstrap-popper'), $version);
}

add_action('wp_enqueue_scripts', 'navedu_enqueue_styles_scripts');

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

/**
 * Register sidebars and widgetized areas.
 *
 */
function navedu_widgets_init() {
	register_sidebar( array(
    'name'          => __( 'Footer 1', 'navedu' ),
    'id'            => 'sidebar-footer-1',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
  register_sidebar( array(
    'name'          => __( 'Footer 2', 'navedu' ),
    'id'            => 'sidebar-footer-2',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
  register_sidebar( array(
    'name'          => __( 'Footer 3', 'navedu' ),
    'id'            => 'sidebar-footer-3',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
  register_sidebar( array(
    'name'          => __( 'Footer 4', 'navedu' ),
    'id'            => 'sidebar-footer-4',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
  register_sidebar( array(
    'name'          => __( 'Footer Copyright', 'navedu' ),
    'id'            => 'sidebar-footer-copyright',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
  register_sidebar( array(
    'name'          => __( 'Frontpage Hero', 'navedu' ),
    'id'            => 'sidebar-fp-hero',
    'description'   => __( 'Add widgets here to appear in your footer.', 'navedu' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action( 'widgets_init', 'navedu_widgets_init' );


// From https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

?>