<?php
/**

 * Plugin Name: RCKTSHP Tutorials Plugin

 * Plugin URI: https://github.com/amandala/rcktshp-tutorials-plugin

 * Description: Creates cutsom post type of tutorial

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

unregister_post_type('tutorials');

add_action( 'init', 'rcktshp_tutorials' );


function rcktshp_tutorials() {
    $labels = array(
        'name'               => _x( 'Tutorials', 'post type general name' ),
        'singular_name'      => _x( 'Tutorial', 'post type singular name' ),
        'add_new'            => _x( 'Add New Tutorial', 'tutorial' ),
        'add_new_item'       => __( 'Add New Tutorial' ),
        'edit_item'          => __( 'Edit Tutorial' ),
        'new_item'           => __( 'New Tutorial' ),
        'all_items'          => __( 'All Tutorials' ),
        'view_item'          => __( 'View Tutorial' ),
        'search_items'       => __( 'Search Tutorials' ),
        'not_found'          => __( 'No Tutorials found' ),
        'not_found_in_trash' => __( 'No Tutorials found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Tutorials'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds the data for a RCKTSHP Tutorial',
        'public'        => true,
        'menu_position' => 10,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'rewrite' => true,
        'supports'      => array( 'title', 'editor' ,'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields','post-formats'
        ),
        'has_archive'   => true,
        'menu_icon' => 'dashicons-welcome-widgets-menus',
        'slug'               =>'series'


    );
    register_post_type( 'tutorials', $args );
}


/* Functions to add custom meta values to teh tutorial */

add_action("admin_init", "admin_init");
add_action('save_post', 'save_meta');

function admin_init(){
    add_meta_box("prodInfo-meta", "Tutorial Details", "meta_options", "tutorials", "normal", "core");
}


function meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $time = $custom["time"][0];
    ?>

    <div class="large-6 columns tutorials-plugin-meta">
        <label>Time to Complete (hours): </label><input name="time" type='range' min=.25 max=8 value=1 step=.25 oninput="outputUpdate(value)" value="<?php echo $time; ?>" />
        <output for=fader id=volume></output>
        <script>
            function outputUpdate(vol) {
                document.querySelector('#volume').value = vol;
            }
        </script>
    </div>

    <div class="large-6 columns tutorials-plugin-meta">
        <label>Difficulty: </label><select name="difficulty" >
            <option value="beginner" selected>Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select>
    </div>

    <div class="large-6 columns tutorials-plugin-meta">
        <label>Featured Video: </label><input type="text" name="video" />
    </div>

    <div>

        <label>Step 1:</label><input type="text" name="step1" /></br>
        <label>Step 2:</label><input type="text" name="step2" /></br>
        <label>Step 3:</label><input type="text" name="step3" /></br>
        <label>Step 4:</label><input type="text" name="step4" /></br>
        <label>Step 5:</label><input type="text" name="step5" /></br>
        <label>Step 6:</label><input type="text" name="step6" /></br>
        <label>Step 7:</label><input type="text" name="step7" /></br>
        <label>Step 8:</label><input type="text" name="step8" /></br>
        <label>Step 9:</label><input type="text" name="step9" /></br>
        <label>Step 10:</label><input type="text" name="step10" /></br>

    </div>

    <?php

    function ravs_author_dropdown_list() {
        // query array
        $args = array(
            'role' => 'freelancer'
        );
        $users = get_users($args);
        if( empty($users) )
            return;
        echo '<label>Tutorial Author: </label>';
        echo'<select name="guest_author">';
        echo '<option value="">none</option>';
        foreach( $users as $user ){
            echo '<option value="'.$user->data->display_name.'">'.$user->data->display_name.'</option>';
        }
        echo'</select>';
    }

    ravs_author_dropdown_list();
}


function save_meta(){
    global $post;
    if(isset($_POST['time'])){
        update_post_meta($post->ID, "time", $_POST["time"]);
    }

    if(isset($_POST['difficulty'])){
        update_post_meta($post->ID, "dificulty", $_POST["difficulty"]);
    }
    if(isset($_POST['guest_author'])){
        update_post_meta($post->ID, "guest_author", $_POST["guest_author"]);
    }

    for($count = 1; $count <=10 ; $count++){
        $attr = 'step'.$count;
        if (isset($_POST[$attr]) && $_POST[$attr] !== ''){
            update_post_meta($post->ID, $attr, $_POST[$attr]);
        }
    }
}



/* Functions to add a custom taxonomy to the Tutorials *.

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
*/
function add_custom_taxonomies() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('series', 'tutorials', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Tutorial Series', 'taxonomy general name' ),
            'singular_name' => _x( 'Tutorial Series', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Series' ),
            'all_items' => __( 'All Series' ),
            'parent_item' => __( 'Parent Series' ),
            'parent_item_colon' => __( 'Parent Series:' ),
            'edit_item' => __( 'Edit Series' ),
            'update_item' => __( 'Update Series' ),
            'add_new_item' => __( 'Add New Series' ),
            'new_item_name' => __( 'New Series Name' ),
            'menu_name' => __( 'Tutorial Series' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'series', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );


?>
