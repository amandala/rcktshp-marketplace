<?php


// //////////////////////////
// Freelancerr theme Actions
// Since version 1.0
// //////////////////////////


// Jobthemes style changer
if (!function_exists('jt_style_changer')):
	function jt_style_changer()
	{
		// turn off stylesheets if customers want to use child themes
		wp_enqueue_style('styles', get_stylesheet_uri());
		wp_enqueue_style('at-color', get_stylesheet_directory_uri() . '/styles/' . get_option('jt_colors') , false);
		if (file_exists(get_stylesheet_directory() . '/styles/custom.css')) wp_enqueue_style('at-colors', get_stylesheet_directory_uri() . '/styles/' . get_option('jt_colors') , false);
	}
endif;
add_action('wp_enqueue_scripts', 'jt_style_changer', 11);


// Enqueue js scripts
function responsivemenu_scripts()
{
	
  wp_enqueue_script('tinynav', get_stylesheet_directory_uri() . '/includes/js/tinynav.js', array('jquery'), '1.0');

  wp_enqueue_script('jcarousellite', get_stylesheet_directory_uri() . '/includes/js/jcarousellite.js', array('jquery'), '1.1');

}

add_action('wp_enqueue_scripts', 'responsivemenu_scripts');

/**
 * Outputs the formatted project budget (post meta).
 */
function the_hrb_project_budgets( $project = '',  $before = '', $after = '' ) {
	global $post;

	$project = $project ? $project : $post;

	$budget_currency = $project->_hrb_budget_currency;

	$budget_type = $project->_hrb_budget_type;
	$budget_price = $project->_hrb_budget_price;

	if ( empty( $budget_price ) ) {
		$budget_price = 0;
	}

	$f_budget_price = appthemes_get_price( $budget_price, $budget_currency );

	if ( 'fixed' == $budget_type ) {
		$budget = sprintf( '%s', $f_budget_price );
	} else {
		$hours = $project->_hrb_hourly_min_hours;
		$budget = sprintf( __( '%s  <a class="hourl">(%d %s)</a>', APP_TD ), $f_budget_price, $hours, _n( 'hour', 'hours', $hours ) );
	}
	echo $before . $budget . $after;
}


// Load responsive style
function responsive_style()
{
	wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/styles/responsive.css', false, '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'responsive_style', 11);


/*
* Retrieves the user main navigation links.
*/
function get_the_nw_user_nav_links()
{
	global $current_user;
	if (!is_user_logged_in()) {
		$user_links = array(
			'register' => array(
				'name' => __('Sign Up', APP_TD) ,
				'url' => get_the_hrb_site_registration_url() ,
				'class' => 'logged-out-button',
			) ,
			'login' => array(
				'name' => __('Login', APP_TD) ,
				'url' => get_the_hrb_site_login_url() ,
				'class' => 'logged-out-button',
			) ,

		);
	}

	// hide registration link if not enabled
	if (!get_option('users_can_register')) {
		unset($user_links['register']);
	}
	return apply_filters('hrb_user_nav_links', $user_links);
}


/**
 * Outputs the user main navigation links.
 */
function the_nw_user_nav_links()
{
	$user_links = get_the_nw_user_nav_links();
	$defaults = array(
		'align' => '',
		'class' => '',
		'name' => 'item',
	);

	if(!is_user_logged_in()){
		foreach($user_links as $link) {
			 echo "<a class='logged-in' href='".$link['url']."'>".$link['name']."</a>";
		};
	}

	else{
		$user_links = array(
            'favorites' => array(
                'name' => __('Favorites', APP_TD) ,
                'url' => hrb_get_dashboard_url_for('projects', 'favorites') ,
                'class' => 'fi-heart',
            ) ,
            'user' => array(
                'name' => sprintf(__('Dashboard', APP_TD) , $current_user->display_name) ,
                'url' => hrb_get_dashboard_url_for('projects') ,
                'align' => 'left',
                'class' => 'fi-wrench',
                'title' => __('Dashboard', APP_TD) ,
            ) ,
        	'logout' => array(
	            'name' => __('LOG OUT', APP_TD),
	            'url' => wp_logout_url() ,
	            'class' => '',
            ) ,

         );

	if(is_user_logged_in()){ ?>


			<li><?php echo "<a href='".hrb_get_dashboard_url_for('notifications') ."'><i class='fa fa-bell-o'>".appthemes_get_user_total_unread_notifications(get_current_user_id())."</i></a>";?></li>
			<li class="has-dropdown"><?php the_hrb_user_gravatar( get_current_user_id(), 30 ); ?>
				<ul class="dropdown">
				<?php
					foreach ($user_links as $link) {
					   echo "<li><a href='".$link['url']."'>".$link['name']."</a></li>";
					}
				?>
				</ul>
			</li>

    <?php }
	}
}



// Freelancerr theme logo
function nw_display_logo()
{
	$header_image = '' != get_header_image() ? get_header_image() : get_stylesheet_directory_uri() . '/images/logo.png';
?>
	<?php
	if (get_option('use_logo') != 'No') {
?>

							<a href="<?php
		echo home_url('/'); ?>" title="<?php
		bloginfo('description'); ?>">
								<img src="<?php
		if (get_option('logo_url')) echo get_option('logo_url');
		else {
			bloginfo('stylesheet_directory'); ?>/images/logo.png<?php
		} ?>" alt="<?php
		bloginfo('name'); ?>" /></a>
						<?php
	}
	else { ?>

							<h1><a href="<?php
		echo esc_url(home_url('/')); ?>"><?php
		bloginfo('name'); ?></a></h1>
							<div class="description">
							<?php
		bloginfo('description'); ?></div>

						<?php
	} ?>
	
<?php
}



// new categories lists for v 1.1
function nw_categories_list($args, $terms_args = array())
{
	$defaults = array(
		'menu_cols' => 2,
		'menu_depth' => 3,
		'menu_sub_num' => 3,
		'cat_parent_count' => false,
		'cat_child_count' => false,
		'cat_hide_empty' => false,
		'cat_nocatstext' => true,
		'taxonomy' => 'category',
	);
	$options = wp_parse_args((array)$args, $defaults);
	$terms_defaults = array(
		'hide_empty' => false,
		'hierarchical' => true,
		'pad_counts' => true,
		'show_count' => true,
		'orderby' => 'name',
		'order' => 'ASC',
		'child_of' => 0,
		'description' => 'Custom Theme Posts',
		// 'number' => 10,
	);
	$terms_args = wp_parse_args((array)$terms_args, $terms_defaults);
	// get all terms for the taxonomy
	$terms = get_terms($options['taxonomy'], $terms_args);
	$cats = array();
	$subcats = array();
	$cat_menu = '';
	if (empty($terms)) {
		return '';
	}
	// separate into cats and subcats arrays
	foreach($terms as $key => $value) {
		if ($value->parent == $terms_args['child_of']) {
			$cats[$key] = $terms[$key];
		}
		else {
			$subcats[$key] = $terms[$key];
		}
		unset($terms[$key]);
	}
	$i = 0;
	$cat_cols = $options['menu_cols']; // menu columns
	$total_main_cats = count($cats); // total number of parent cats
	$cats_per_col = ceil($total_main_cats / $cat_cols); // parent cats per column
	$first = ' first';
	// loop through all the cats
	foreach($cats as $cat) {
		if (($i % $cats_per_col) == 0) {
			$cat_menu.= '<div class="catcol' . $first . '">';
			$cat_menu.= '<ul class="maincat-list">';
		}
		$first = '';
		// only show the total count if option is set
		$show_count = $options['cat_parent_count'] ? '<span class="cat-item-count">(' . $cat->count . ')</span>' : '';
		$cat_menu.= '<li class="maincat cat-item-' . $cat->term_id . '"><a href="' . get_term_link($cat, $options['taxonomy']) . '" title="' . esc_attr($cat->description) . '">' . $cat->name . '</a> ' . $show_count . ' <div class="clear"></div>' . esc_attr($cat->description) . ' ';
		if ($options['menu_sub_num'] > 0) {
			// create child tree
			$temp_menu = appthemes_create_child_list($subcats, $options['taxonomy'], $cat->term_id, 0, $options['menu_depth'], $options['menu_sub_num'], $options['cat_child_count'], $options['cat_hide_empty']);
			if ($temp_menu) {
				$cat_menu.= $temp_menu;
			}
			if (!$temp_menu && !$options['cat_nocatstext']) {
				$cat_menu.= '<ul class="subcat-list"><li class="cat-item">' . __('No categories', APP_TD) . "</li>\r\n</ul>\r\n";
			}
		}
		$cat_menu.= "</li>\r\n";
		$i++;
		if (($i % $cats_per_col) == 0 || $i >= $total_main_cats) {
			$cat_menu.= "</ul>\r\n";
			$cat_menu.= "</div><!-- /catcol -->\r\n";
		}
	}
	return $cat_menu;
}




// Display the categories list -not used !!!
function get_the_nw_project_categories_list($options = '')
{
	global $hrb_options;
	if (!$options) {
		$options = 'categories_dir';
	}
	$options = $hrb_options->$options;
	$args = array(
		'menu_cols' => 1,
		'menu_depth' => $options['depth'],
		'menu_sub_num' => 0,
		'cat_parent_count' => $options['count'],
		'cat_child_count' => $options['count'],
		'cat_hide_empty' => $options['hide_empty'],
		'cat_nocatstext' => true,
		'taxonomy' => HRB_PROJECTS_CATEGORY,
	);
	$args = apply_filters('hrb_project_categories_list', $args);
	return nw_categories_list($args, array(
		'pad_counts' => false,
		'hrb_post_status' => 'publish',
		'hrb_post_type' => HRB_PROJECTS_PTYPE
	));
}




/**
 * Outputs the projects categories list.
 */
function the_nw_project_categories_list($options = '')
{
	echo get_the_nw_project_categories_list($options);
}
// New project loop - for new home layouts
function nw_loop_projects()
{
	global $hrb_options;
	if (!$hrb_options->projects_frontpage) {
		return;
	}
	$args = array(
		'posts_per_page' => 1000,
		'meta_key' => HRB_ITEM_FEATURED_HOME,
		'hrb_orderby' => 'default',
		'hrb_include_empty' => true,
		'hrb_meta_multi_orderby' => array(
			'meta_value_num' => 'desc',
			'date' => 'desc',
		) ,
	);
	$template_vars = array(
		'projects' => hrb_get_projects($args) ,
	);
	appthemes_load_template('featured-' . project . '.php', $template_vars);
}




// This child theme uses wp_nav_menu() in three locations.//added top nav//
register_nav_menus(array(
	'top' => __('Top Bar Menu', APP_TD) ,
));



// Hide admin bar => Optional
add_filter('show_admin_bar', '__return_false');



/**
 * Outputs the main navigation menu below the site title.
 */
function the_nw_nav_menu()
{
	wp_nav_menu(array(
		'menu_id' => 'navigations',
		'theme_location' => 'header',
		'container_class' => 'left',
		'container' => false,
		'items_wrap' => '<ul id="%1$s">%3$s</ul>',
		'fallback_cb' => false
	));
}



// Custom header options for theme options
add_action('wp_head', 'custom_head');
function custom_head()
{
?>

<?php
	// get the header options
	get_template_part(header, options); ?> 

<?php
}
// Change the layout of vantage/boxed and full width
function add_vt_layout()
{
	echo '<div class="layouty">';

?>




<?php
}
add_action('appthemes_before', 'add_vt_layout');
function add_vt_layout_end()
{
	echo '</div>';
}




add_action('appthemes_after', 'add_vt_layout_end');