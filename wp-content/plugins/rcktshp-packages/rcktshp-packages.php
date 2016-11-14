<?php
/**

 * Plugin Name: RCKTSHP Packages Plugin

 *

 * Description: Custom post type to hold a package entry

 * Version:  1.0

 * Author: Amanda Haynes

 * Author URI:https://github.com/amandala

 * License:  GPL2

 */
if ( ! function_exists( 'unregister_post_type' ) ) :
    function unregister_post_type( $post_type ) {
        global $wp_post_types;
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
            return true;
        }
        return false;
    }
endif;

unregister_post_type('packages');

add_action( 'init', 'rcktshp_package' );


function rcktshp_package() {
    $labels = array(
        'name'               => _x( 'Package', 'post type general name' ),
        'singular_name'      => _x( 'Package', 'post type singular name' ),
        'add_new'            => _x( 'Add New Package', 'tutorial' ),
        'add_new_item'       => __( 'Add New Package' ),
        'edit_item'          => __( 'Edit Package' ),
        'new_item'           => __( 'New Package' ),
        'all_items'          => __( 'All Packages' ),
        'view_item'          => __( 'View Package' ),
        'search_items'       => __( 'Search Packages' ),
        'not_found'          => __( 'No Packages found' ),
        'not_found_in_trash' => __( 'No Packages found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Packages'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds the data for a RCKTSHP Package',
        'public'        => true,
        'menu_position' => 10,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'rewrite' => true,
        'supports'      => array( 'title', 'editor' ,'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields','post-formats'
        ),
        'has_archive'   => true,
        'menu_icon' => 'dashicons-cart',
        'slug'               =>'category'


    );
    register_post_type( 'packages', $args );
}

/* Functions to add a custom taxonomy to the Tutorials *.

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
*/
function add_custom_taxonomies_pack() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('package_category', 'packages', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Package Category', 'taxonomy general name' ),
            'singular_name' => _x( 'Package Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Categories' ),
            'all_items' => __( 'All Categories' ),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => __( 'Edit Category' ),
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'new_item_name' => __( 'New Category Name' ),
            'menu_name' => __( 'Package Category' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'package_cat', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));

}
add_action( 'init', 'add_custom_taxonomies_pack', 0 );


/* Functions to add custom meta values to the portfolio */

add_action('save_post', 'save_meta');


add_action("admin_init", "admin_init_pack");
add_action('save_post', 'save_meta_pack');

function admin_init_pack(){
    add_meta_box("prodInfo-meta", "Package Details", "meta_options_pack", "packages", "normal", "core");
}


function meta_options_pack(){
    global $post;
    $meta = get_post_meta($post->ID);

    ?>
    <fieldset>
        <legend class="backend-legend">General:</legend>
        <div class="large-12 columns tutorials-plugin-meta">
            <label>Price: </label><input type="text" value="<?php echo $meta['price'][0]; ?>" name="price"/>
            <label>Snippet: </label><input type="text" value="<?php echo $meta['snippet'][0]; ?>" name="snippet"/>
        </div>
    </fieldset>
    </fieldset>
    <fieldset>
        <legend class="backend-legend">Add Ons:</legend>
        <div class="large-12 columns tutorials-plugin-meta">
            <label>Content Creation/Photos: </label><input type="checkbox" <?php if($meta['addon_content'][0] == 'on'){echo 'checked';} ?> name="addon_content"/>
        </div>
    </fieldset>
    <fieldset>
        <legend class="backend-legend">Content Creation Details</legend>
         <div class="large-12 columns tutorials-plugin-meta">
            <textarea name="addon_content_details" rows="2" cols="50" name="addon_content_details"><?php echo $meta['addon_content_details'][0]; ?></textarea><br />
            <label>Content Creation Price/Unit: </label><input type="number" value="<?php echo $meta['addon_content_price'][0]; ?>" name="addon_content_price" min="0"/>
            <label>Number of Units: </label><input type="number" value="<?php echo $meta['num_units'][0]; ?>" name="num_units" min="0"/>
        </div>
    </fieldset>

    <style>
        legend.backend-legend {
            font-weight: bold;
            padding: 1rem 0rem;
        }
    </style>
<?php
}


function save_meta_pack(){
    global $post;


    update_post_meta($post->ID, "price", $_POST["price"]);
    update_post_meta($post->ID, "snippet", $_POST["snippet"]);
    update_post_meta($post->ID, "num_units", $_POST["num_units"]);


   if(isset($_POST["addon_content"]))
    {
        $meta_box_checkbox_value = $_POST["addon_content"];
    }
    update_post_meta($post->ID, "addon_content", $meta_box_checkbox_value);

    if(isset($_POST['addon_content_details'])){
        update_post_meta($post->ID, "addon_content_details", $_POST["addon_content_details"]);
    }

    if(isset($_POST['addon_content_price'])){
        update_post_meta($post->ID, "addon_content_price", $_POST["addon_content_price"]);
    }

}





