<?php
/**

 * Plugin Name: RCKTSHP Portfolio Plugin

 * Plugin URI: https://github.com/amandala/rcktshp-tutorials-plugin

 * Description: Custom post type to hold a portfolio entry

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

unregister_post_type('portfolio');

add_action( 'init', 'rcktshp_portfolio' );


function rcktshp_portfolio() {
    $labels = array(
        'name'               => _x( 'Portfolio Entries', 'post type general name' ),
        'singular_name'      => _x( 'Portfolio Entry', 'post type singular name' ),
        'add_new'            => _x( 'Add New Portfolio Entry', 'tutorial' ),
        'add_new_item'       => __( 'Add New Portfolio Entry' ),
        'edit_item'          => __( 'Edit Portfolio Entry' ),
        'new_item'           => __( 'New Portfolio Entry' ),
        'all_items'          => __( 'All Portfolio Entries' ),
        'view_item'          => __( 'View Portfolio Entry' ),
        'search_items'       => __( 'Search Portfolio Entries' ),
        'not_found'          => __( 'No Portfolio Entries found' ),
        'not_found_in_trash' => __( 'No Portfolio Entries found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds the data for a RCKTSHP Portfolio Entry',
        'public'        => true,
        'menu_position' => 10,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'taxonomies' => array('category'),
        'rewrite' => true,
        'supports'      => array( 'title', 'editor' ,'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields','post-formats'
        ),
        'has_archive'   => true,
        'menu_icon' => 'dashicons-star-filled',
        'slug'               =>'category'


    );
    register_post_type( 'portfolio', $args );
}


/* Functions to add custom meta values to the portfolio */

add_action('save_post', 'save_meta');


add_action("admin_init", "admin_init_port");
add_action('save_post', 'save_meta_port');

function admin_init_port(){
    add_meta_box("prodInfo-meta", "Portfolio Entry Details", "meta_options_port", "portfolio", "normal", "core");
}


function meta_options_port(){
    global $post;
    $meta = get_post_meta($post->ID);
    ?>

    <?php $args = array(
        'show_option_all'         => null, // string
        'show_option_none'        => null, // string
        'hide_if_only_one_author' => null, // string
        'orderby'                 => 'display_name',
        'order'                   => 'ASC',
        'include'                 => null, // string
        'exclude'                 => null, // string
        'multi'                   => false,
        'show'                    => 'display_name',
        'echo'                    => true,
        'selected'                => false,
        'include_selected'        => false,
        'name'                    => 'freelancer', // string
        'id'                      => null, // integer
        'class'                   => null, // string
        'blog_id'                 => $GLOBALS['blog_id'],
        'who'                     => null // string
    );
    echo "<label>Freelancer: </label>"; wp_dropdown_users( $args );
    ?>



    <div class="large-12 columns tutorials-plugin-meta">
        <label>Link:</label> <input type="text" value="<?php echo $meta['link'][0]; ?>" name="link"/>
        <span>ex. http://www.link.com <b>Protocol must be included!</b></span>

    </div>
<?php
}

function save_meta_port(){
    global $post;

    if(isset($_POST["freelancer"]) ){
        update_post_meta($post->ID, "freelancer", $_POST["freelancer"]);
    }
    if( isset($_POST["link"]) ){
        update_post_meta($post->ID, "link", $_POST["link"]);
    }


}





