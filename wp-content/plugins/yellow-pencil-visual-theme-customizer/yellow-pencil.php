<?php
/*
Plugin Name: WaspThemes - Yellow Pencil Lite
Plugin URI: http://waspthemes.com/yellow-pencil
Description: Easily customize WordPress themes, live. Google Fonts, Backgrounds, Animations and more! The best wordpress customizer plugin. 
Version: 5.4.5
Author: WaspThemes
Author URI: http://www.waspthemes.com
*/


/* ---------------------------------------------------- */
/* Basic 												*/
/* ---------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// Check if lite version or not.
if(strstr(__FILE__,"yellow-pencil-visual-theme-customizer")){
	$lite_dir = __FILE__;
	$pro_dir = str_replace("yellow-pencil-visual-theme-customizer", "waspthemes-yellow-pencil", __FILE__);
}else{
	$pro_dir = __FILE__;
	$lite_dir = str_replace("waspthemes-yellow-pencil", "yellow-pencil-visual-theme-customizer", __FILE__);
}

// Checking.
$pro_exists = file_exists($pro_dir);
$lite_exists = file_exists($lite_dir);

// If pro version is there?
if($pro_exists == true && $lite_exists == true){

	if(!function_exists("deactivate_plugins")){
		require_once(ABSPATH .'wp-admin/includes/plugin.php');
	}

	deactivate_plugins(plugin_basename($lite_dir)); // Deactive lite version.
}

// Editor uri.
function yp_uri(){
	if(current_user_can("edit_theme_options") == true){
		return admin_url('admin.php?page=yellow-pencil-editor');
	}elseif(defined('WT_DEMO_MODE')){
		return add_query_arg(array('yellow_pencil' => 'true'),get_home_url().'/');
	}
}


/* ---------------------------------------------------- */
/* Define 												*/
/* ---------------------------------------------------- */
define( 'WT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'YP_MODE', "min"); // min & dev.
define( 'YP_VERSION', "5.4.5");


// For 5.2.2 version database update.
function yp_plugin_database_update(){

	global $table_prefix;

	if(get_option("yp_522_v_update_status") != 'true'){

		global $wpdb;
		$wpdb->update(''.$table_prefix.'postmeta', array('meta_key' => "_wt_css"), array('meta_key'=> "wt_css"));
		$wpdb->update(''.$table_prefix.'postmeta', array('meta_key' => "_wt_styles"), array('meta_key'=> "wt_styles"));

		$wpdb->update(''.$table_prefix.'options', array('option_name' => "yp_username"), array('option_name'=> "username"));
		$wpdb->update(''.$table_prefix.'options', array('option_name' => "yp_apikey"), array('option_name'=> "apikey"));
		$wpdb->update(''.$table_prefix.'options', array('option_name' => "yp_purchase_code"), array('option_name'=> "purchase_code"));
		add_option("yp_522_v_update_status","true");

		delete_option("yp_521_v_update_status"); // delete old.

	}

}

add_action("init","yp_plugin_database_update");


/* ---------------------------------------------------- */
/* Adding info to header								*/
/* ---------------------------------------------------- */
function yp_info_in_header(){
	echo '<meta name="generator" content="Customized By Yellow Pencil Plugin" />' . "\n";
}
remove_action('wp_head', 'wp_generator');
add_action( 'wp_head', 'yp_info_in_header' );


function yp_add_animation(){

	if(current_user_can("edit_theme_options") == true){

		$css = wp_strip_all_tags($_POST['yp_anim_data']);
		$name = wp_strip_all_tags($_POST['yp_anim_name']);

		if(!update_option("yp_anim_".$name,$css)){
			add_option("yp_anim_".$name,$css);
		}

	}

}

add_action( 'wp_ajax_yp_add_animation', 'yp_add_animation' );


/* ---------------------------------------------------- */
/* Load Translation Text Domain							*/
/* ---------------------------------------------------- */
function yp_plugin_lang() {
	load_plugin_textdomain( 'yp', false, dirname(plugin_basename( __FILE__ )) . '/languages' ); 
}
add_action( 'plugins_loaded', 'yp_plugin_lang' );


add_filter( 'plugin_action_links', 'yp_customize_link', 10, 2 );

function yp_customize_link($links,$file){

    if($file == plugin_basename(dirname(__FILE__) . '/yellow-pencil.php')){
        $in = '<a style="color:rgb(64, 113, 64);" href="'.admin_url('themes.php?page=yellow-pencil').'">' . __('Customize','yp') . '</a>';
        array_unshift($links, $in);
    }
    return $links;
}



/* ---------------------------------------------------- */
/* UPDATE API											*/
/* ---------------------------------------------------- */
$yp_part_of_theme = get_site_option( 'YP_PART_OF_THEME' );
if(defined("WTFV") == true && empty($yp_part_of_theme) == true){

	// Clean version number
	function yp_version($v){
	    $v = preg_replace('/[^0-9]/s', '', $v);
	    if(strlen($v) == 2){
	        return $v."0";
	    }elseif(strlen($v) == 1){
	        return $v."00";
	    }else{
	        return $v;
	    }
	}

	// Need include plugin.php file
	if(!function_exists("get_plugin_data")){
		require_once(ABSPATH .'wp-admin/includes/plugin.php');
	}

	// Plugin version
	$yp_plugin_data = get_plugin_data( __FILE__ );
	define("YP_PLUGIN_VERSION",yp_version($yp_plugin_data['Version']));

	// include update api.
	require_once(WT_PLUGIN_DIR.'/library/php/update-api.php');
	
}


function yp_load_fonts(){
	$css = yp_get_css(true);
	yp_get_font_families($css);
}


/* ---------------------------------------------------- */
/* Getting font familys by CSS OUTPUT					*/
/* ---------------------------------------------------- */
function yp_get_font_families($css){
	
	$protocol = is_ssl() ? 'https' : 'http';
	
	preg_match_all('/font-family:(.*?);/', $css, $r);

	foreach($r['1'] as &$k){
		$k = yp_font_name($k);
	}
	
	foreach(array_unique($r['1']) as $family){
		
		$id = str_replace("+", "-", strtolower($family));

		$id = str_replace("\\", "", $id);

		if($id == 'arial' || $id == 'helvetica' || $id == 'georgia' || $id == 'serif' || $id == 'helvetica-neue' || $id == 'times-new-roman' || $id == 'times' || $id == 'sans-serif' || $id == 'arial-black' || $id == 'gadget' || $id == 'impact' || $id == 'charcoal' || $id == 'tahoma' || $id == 'geneva' || $id == 'verdana' || $id == 'inherit'){
			return false;
		}

		if($id == '' || $id == ' '){
			return false;
		}

		// Getting fonts from google api.
		wp_enqueue_style($id, esc_url(''.$protocol.'://fonts.googleapis.com/css?family='.$family.':300,300italic,400,400italic,500,500italic,600,600italic,700,700italic'));	
		
	}
	
}



/* ---------------------------------------------------- */
/* Getting Only Font Name From CSS Source				*/
/* ---------------------------------------------------- */
function yp_font_name($k){
	
	$k = str_replace("font-family:","",$k);
	
	$k = str_replace('"',"",$k);
	$k = str_replace("'","",$k);
	
	$k = str_replace(" ","+",$k);
	
	$k = str_replace("+!important","",$k);
	
	$k = str_replace("!important","",$k);
	
	if(strstr($k,",")){
		$array = explode(",",$k);
		return $array[0];
	}else{
		return $k;
	}

}



/* ---------------------------------------------------- */
/* Checking true or false								*/
/* ---------------------------------------------------- */
function yp_check_let(){
	
	// If Demo Mode
	if(defined("WT_DEMO_MODE") == true && isset($_GET['yellow_pencil_frame']) == true){
		return true;
	}
	
	// If user can.
	if(current_user_can("edit_theme_options") == true){
		return true;
	}else{
		return false;
	}
	
}


/* ---------------------------------------------------- */
/* Checking true or false								*/
/* ---------------------------------------------------- */
function yp_check_let_frame(){
	
	// If Demo Mode
	if(defined("WT_DEMO_MODE") == true && isset($_GET['yellow_pencil_frame']) == true){
		return true;
	}
	
	// Be sure, user can.
	if(current_user_can("edit_theme_options") == true && isset($_GET['yellow_pencil_frame']) == true){
		return true;
	}else{
		return false;
	}
	
}



function yp_getting_last_post_title(){
	$last = wp_get_recent_posts(array("numberposts" => 1,"post_status" => "publish"));

	if(isset($last['0']['ID'])){
		$last_id = $last['0']['ID'];
	}else{
		return false;
	}

	$title = get_the_title($last_id);

	if(strstr($title," ")){
		$words = explode(" ", $title);
		return $words[0];
	}else{
		return $title;
	}

}

// Clean protocol
function yp_urlencode($v){
	$v = explode("://",urldecode($v));
	return urlencode($v[1]);
}


/* ---------------------------------------------------- */
/* Register Admin Script								*/
/* ---------------------------------------------------- */
function yp_enqueue_admin_pages($hook){

	wp_enqueue_style( 'wp-color-picker' ); 

	// Options page.
	if('settings_page_yp-options' == $hook){
		wp_enqueue_style('yellow-pencil-admin', plugins_url( 'css/options.css' , __FILE__ ));
	}
	
	// Post pages.
    if ( 'post.php' == $hook ) {
    	if(current_user_can("edit_theme_options") == true){
        	wp_enqueue_script('yellow-pencil-admin', plugins_url( 'js/admin.js' , __FILE__ ), 'jquery', '1.0', TRUE);
		}
    }

    // Admin css
    wp_enqueue_style('yellow-pencil-admin', plugins_url( 'css/admin.css' , __FILE__ ));
	
}
add_action( 'admin_enqueue_scripts', 'yp_enqueue_admin_pages' );




/* ---------------------------------------------------- */
/* Register Plugin Styles For Iframe					*/
/* ---------------------------------------------------- */
function yp_styles_frame() {
		
	$protocol = is_ssl() ? 'https' : 'http';

	// Google web fonts.
	wp_enqueue_style('yellow-pencil-font', ''.$protocol.'://fonts.googleapis.com/css?family=Open+Sans:400,600,800');	
	
	wp_enqueue_style('yellow-pencil-frame', plugins_url( 'css/frame.css' , __FILE__ ));
	
	// animate library.
	wp_enqueue_style('yellow-pencil-animate', plugins_url( 'library/css/animate.css' , __FILE__ ));
	
}




/* ---------------------------------------------------- */
/* Adding Link To Admin Appearance Menu					*/
/* ---------------------------------------------------- */
function yp_menu() {
	add_theme_page('Yellow Pencil', 'Yellow Pencil', 'edit_theme_options', 'yellow-pencil', 'yp_menu_function',999);
}



/* ---------------------------------------------------- */
/* Appearance page Loading And Location					*/
/* ---------------------------------------------------- */
function yp_menu_function(){

	$yellow_pencil_uri = yp_uri();
	
	// Background
	echo '<div class="yp-bg"></div>';
	
	// Loader
	echo '';
	
	// Background and loader CSS
	echo '<style>html,body{display:none;}</style>';
	
	// Location..
	echo '<script type="text/javascript">window.location = "'.add_query_arg(array('href' => yp_urlencode(get_home_url().'/')),$yellow_pencil_uri).'";</script>';
	
	// Die
	exit;
	
}

add_action('admin_menu', 'yp_menu');


function yp_get_short_title($title){

	$title = ucfirst(strip_tags($title));

	if($title == ''){
		$title = 'Untitled';
	}

	if(strlen($title) > 18){
		return mb_substr($title,0,18,'UTF-8').'..';
	}else{
		return $title;
	}

}

function yp_get_long_tooltip_title($title){

	$title = ucfirst(strip_tags($title));

	if($title == '' || strlen($title) < 18){
		return false;
	}

	if(strlen($title) > 18){
		return $title;
	}

}


/* ---------------------------------------------------- */
/* Register Yellow Pencil 								*/
/* ---------------------------------------------------- */
function yp_yellow_penci_bar() {

	$yellow_pencil_uri = yp_uri();

	$liveLink = add_query_arg(array('yp_live_preview' => 'true'),esc_url($_GET['href']));

	if(isset($_GET['yp_id'])){
		$liveLink = add_query_arg(array('yp_id' => $_GET['yp_id']),esc_url($liveLink));
	}elseif(isset($_GET['yp_type'])){
		$liveLink = add_query_arg(array('yp_type' => $_GET['yp_type']),esc_url($liveLink));
	}

	$liveLink = str_replace("#038;yp_live_preview", "&amp;yp_live_preview", $liveLink);
	
    echo "<div class='yp-select-bar yp-disable-cancel'>
		<div class='yp-editor-top'>
		
			<a href='".esc_url($_GET['href'])."' class='wf-close-btn-link'><span data-toggle='tooltip' data-placement='left' title='".__('Close Editor','yp')."' class='dashicons dashicons-no-alt yp-close-btn'></span></a>

			<a class='yp-button yp-save-btn'>".__('Save','yp')."</a>

			<a data-toggle='tooltip' data-placement='bottom' title='".__('Reset Changes','yp')."' class='yp-button-reset'></a>

			<a target='_blank' data-href='".$liveLink."' data-toggle='tooltip' data-placement='bottom' title='".__('Live Preview','yp')."' class='yp-button-live'></a>
			
			<div class='yp-clearfix'></div>
			
		</div>";
		
		// Set variables.
		$tag_id = null;
		$category_id = null;
		$last_post_id = null;
		$last_portfolio_id = null;
		$last_page_id = null;
		
		// Getting tags
		$tags = get_tags(array('orderby' => 'count', 'order' => 'DESC','number'=> 1 ));
		if(empty($tags) == false){
			$tag_id = $tags[0];
		}
		
		// Getting categories
		$categories = get_categories(array('orderby' => 'count', 'order' => 'DESC','number'=> 1 ));
		if(empty($categories) == false){
			$category_id = $categories[0];
		}
		
		// Set null to variables.
		$category_page = '';
		$homepage = '';
		$global_current_page = '';
		$global_current_page_url = '';
		$tag_page = '';
		$is_type = '';
		$is_id = '';
		$all_singles = '';
		$all_pages = '';
		$gb_category_active = false;
		$gb_tag_active = false;
		$editingHas = '0';
		
		// Checking if its is a type
		if(isset($_GET['yp_type'])){
			$is_type = $_GET['yp_type'];
		}
		
		// Checking if its id.
		if(isset($_GET['yp_id'])){
			$is_id = $_GET['yp_id'];
		}
		
		// Getting current URL
		if(is_ssl()){
			$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}else{
			$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
	
		// Category Page
		if($category_id != '' && $category_id != null){
			
			$url = add_query_arg(array('href' => yp_urlencode(get_term_link($category_id))),$yellow_pencil_uri);
			
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
				$gb_category_active = true;
			}
			
			$category_page = '<li'.$active.'><a href="'.esc_url($url).'">'.__("Category Page","yp").'</a></li>';
			
		}

		// if is global, try to add current page to global section.
		if(isset($_GET['yp_id']) == false && isset($_GET['yp_type']) == false){

			$postid = url_to_postid(esc_url($_GET['href']));

			if($postid != null){

				$url = add_query_arg(array('href' => yp_urlencode(get_permalink($postid))),$yellow_pencil_uri);

				$global_current_page = '<li class="active"><a data-toggle="tooltip" data-placement="left" title="'.yp_get_long_tooltip_title(get_the_title($postid)).'" href="'.esc_url($url).'">'.yp_get_short_title(get_the_title($postid)).'</a></li>';
				$global_current_page_url = esc_url($url);

			}else if($gb_category_active == false && $gb_tag_active == false){

				$global_current_page = '<li class="active"><a>Unknown Page</a></li>';
				$global_current_page_url = '';

			}

		}

		// tag Page
		if($tag_id != '' && $tag_id != null){
			
			$url = add_query_arg(array('href' => yp_urlencode(get_term_link($tag_id))),$yellow_pencil_uri);
			
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
				$gb_tag_active = true;
			}
			
			$tag_page = '<li'.$active.'><a href="'.esc_url($url).'">'.__("Tag Page","yp").'</a></li>';
			
		}
		
		// Home Page
		if($global_current_page_url != $url){
			$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_home_url().'/'))),$yellow_pencil_uri);
				
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$global_current_page = '';
				$editingHas = '1';
			}
				
			$homepage = '<li'.$active.'><a href="'.esc_url($url).'">'.__("Home","yp").'</a></li>';

		}

		
		// Getting pages with custom templates.
		$args = array(
			'posts_per_page' => 8,
			"post_status" => "publish",
		    'post_type' => 'page',
		    'meta_query' => array(
		        array(
		            'key' => '_wp_page_template',
		            'value' => 'default',
					'compare' => '!='
				)
			)
		);

		$other_pages = get_posts($args);
		$c = 1;
		$current_pages_id = array();
		foreach($other_pages as $page){

			$c++;

			array_push($current_pages_id, $page->ID);
			
			$url = add_query_arg(array('href' => yp_urlencode(get_permalink($page->ID)), 'yp_id' => $page->ID),$yellow_pencil_uri);
			
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
			}

			$title = $page->post_title;

			if($title == '' || $title == ' '){
				$title = 'Untitled';
			}
		
			$all_pages .= '<li'.$active.' id="page-'.esc_attr($page->ID).'-btn"><a data-toggle="tooltip" data-placement="left" title="'.yp_get_long_tooltip_title($title).'" href="'.esc_url($url).'">'.yp_get_short_title($title).'</a></li>';
			
		}

		// First get pages with templates,
		// if there not more 6 page templates,
		// so show normal pages.
		if($c < 6){
			// Getting all pages.
			$args = array(
				'posts_per_page' => (6-$c),
				"post_status" => "publish",
			    'post_type' => 'page',
			    'exclude' => $current_pages_id
			);

			$other_pages = get_posts($args);

			foreach($other_pages as $page){

				$url = add_query_arg(array('href' => yp_urlencode(get_permalink($page->ID)), 'yp_id' => $page->ID),$yellow_pencil_uri);
				
				$active = '';
				if($current_url == $url){
					$active = ' class="active" ';
					$editingHas = '1';
				}

				$title = $page->post_title;

				if($title == '' || $title == ' '){
					$title = 'Untitled';
				}
				
				$all_pages .= '<li'.$active.' id="page-'.esc_attr($page->ID).'-btn"><a data-toggle="tooltip" data-placement="left" title="'.yp_get_long_tooltip_title($title).'" href="'.esc_url($url).'">'.yp_get_short_title($title).'</a></li>';
				
			}

		}

		// Search Page.
		$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_home_url()).'/?s='.yp_getting_last_post_title().'').'&yp_type=search'),$yellow_pencil_uri);
		$active = '';
		if($current_url == $url){
			$active = ' class="active" ';
			$editingHas = '1';
		}
		$all_singles .= '<li'.$active.' id="search-page-btn"><a href="'.esc_url($url).'">'.__("Search","yp").'</a></li>';

		// 404 Page.
		$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_home_url()).'/?p=987654321').'&yp_type=404'),$yellow_pencil_uri);
		$active = '';
		if($current_url == $url){
			$active = ' class="active" ';
			$editingHas = '1';
		}
		$all_singles .= '<li'.$active.' id="error-page-btn"><a href="'.esc_url($url).'">404</a></li>';

		// tag Page.
		if($tag_id != '' && $tag_id != null){
			$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_term_link($tag_id))).'&yp_type=tag'),$yellow_pencil_uri);
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
			}
			$all_singles .= '<li'.$active.' id="tag-page-btn"><a href="'.esc_url($url).'">'.__("Tag","yp").'</a></li>';
		}

		// Category Page.
		if($category_id != '' && $category_id != null){
			$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_term_link($category_id))).'&yp_type=category'),$yellow_pencil_uri);
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
			}
			$all_singles .= '<li'.$active.' id="category-page-btn"><a href="'.esc_url($url).'">'.__("Category","yp").'</a></li>';
		}

		// Author Page.
		$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_author_posts_url("1"))).'&yp_type=author'),$yellow_pencil_uri);
		$active = '';
		if($current_url == $url){
			$active = ' class="active" ';
			$editingHas = '1';
		}
		$all_singles .= '<li'.$active.' id="author-page-btn"><a href="'.esc_url($url).'">'.__("Author","yp").'</a></li>';


		// Home Page.
		$frontpage_id = get_option('page_on_front');
		if($frontpage_id == 0 || $frontpage_id == null){
			$url = add_query_arg(array('href' => yp_urlencode(esc_url(get_home_url().'/')).'&yp_type=home'),$yellow_pencil_uri);
			$active = '';
			if($current_url == $url){
				$active = ' class="active" ';
				$editingHas = '1';
			}
			$all_pages .= '<li'.$active.' id="page-page-home-btn"><a href="'.esc_url($url).'">'.__("Home Page","yp").'</a></li>';
		}


		$post_types = get_post_types(array(
		   'public'   => true,
		   '_builtin' => false
		));

		// Adding default post types.
		array_push($post_types, 'post');
		array_push($post_types, 'page');

		$pi = 0;
		foreach ($post_types as $post_type){

			$pi++;

				if($pi < 7){

				if($post_type == 'page'){
					$last_post = wp_get_recent_posts(array("post_status" => "publish","meta_key" => "_wp_page_template", "meta_value" => "default", "numberposts" => 1, "post_type" => $post_type));
				}else{
					$last_post = wp_get_recent_posts(array("post_status" => "publish","numberposts" => 1, "post_type" => $post_type));
				}

				if(empty($last_post) == false){

					$last_post_id = $last_post['0']['ID'];

					$url = add_query_arg(array('href' => yp_urlencode(get_permalink($last_post_id)), 'yp_type' => $post_type),$yellow_pencil_uri);

					$active = '';
					if(isset($_GET['yp_type'])){
						if($_GET['yp_type'] == $post_type){
						$active = ' class="active" ';
						$editingHas = '1';
						}
					}

					$all_singles .= '<li'.$active.' id="single-'.esc_attr($post_type).'-page-btn"><a href="'.esc_url($url).'">'.ucfirst($post_type).'</a></li>';

				}

			}

		}
		
		// Show editing page on all pages list.
		if(isset($_GET['yp_id'])){
			if($editingHas == '0'){
				$url = add_query_arg(array('href' => yp_urlencode(get_permalink($is_id)), 'yp_id' => $is_id),$yellow_pencil_uri);

				$title = get_the_title($is_id);

				if($title == '' || $title == ' '){
					$title = 'Untitled';
				}

				$all_pages .= '<li class="active" id="page-'.$is_id.'-btn"><a data-toggle="tooltip" data-placement="left" title="'.yp_get_long_tooltip_title($title).'" href="'.esc_url($url).'">'.yp_get_short_title($title).'</a></li>';
			}
		}elseif(isset($_GET['yp_type'])){
			if($editingHas == '0'){

				// Getting last post for current post type.
				if($is_type == 'page'){
					$last_post = wp_get_recent_posts(array("post_status" => "publish","meta_key" => "_wp_page_template", "meta_value" => "default", "numberposts" => 1, "post_type" => $is_type));
				}else{
					$last_post = wp_get_recent_posts(array("post_status" => "publish","numberposts" => 1, "post_type" => $is_type));
				}

				$last_post_id = $last_post['0']['ID'];

				$url = add_query_arg(array('href' => yp_urlencode(get_permalink($last_post_id)), 'yp_type' => $is_type),$yellow_pencil_uri);

				$title = $is_type;

				if($title == '' || $title == ' '){
					$title = 'Untitled';
				}

				$all_singles .= '<li class="active" id="page-'.$last_post_id.'-btn"><a data-toggle="tooltip" data-placement="left" title="'.yp_get_long_tooltip_title($title).'" href="'.esc_url($url).'">'.yp_get_short_title($title).'</a></li>';

			}
		}


		// Markup For Global Page Links etc.
		$other_pages = '<div class="yp-other-pages">
		<span data-toggle="popover" class="yp-start-info" title="'.__("Global Customize","yp").'" data-placement="left" data-content="'.__("Global changes will be loading on every page. Global customize ideal to edit 'Header', 'Footer', 'General Site Design' etc.","yp").'">'.__('Global Customize','yp').':</span>
		
		<ul class="yp-ul-global-list">'.$category_page.''.$homepage.''.$global_current_page.''.$tag_page.'</ul>';
		
		if($all_pages != '' && $all_pages != null){
		$other_pages .= '<span class="yp-other-other-pages yp-start-info" data-toggle="popover" title="'.__("Customize One Page","yp").'" data-placement="left" data-content="'.__("Use following links for apply changes to just one page.","yp").'">'.__('Customize One Page','yp').':</span>
		
		<ul class="yp-ul-all-pages-list">'.$all_pages.'</ul>'; }
		
		$other_pages .= '<span class="yp-start-info yp-other-other-pages" data-toggle="popover" title="'.__("Customize Templates","yp").'" data-placement="left" data-content="'.__("Use following links for edit Templates. Sample: 'all single posts', 'all product pages' etc.","yp").'">'.__('Customize Templates','yp').':</span>
		
		<ul class="yp-ul-single-list">'.$all_singles.'</ul></div>';
		

		// Default.
		echo '<div class="yp-no-selected"><div class="yp-hand"></div><div class="yp-hand-after"></div>'.__('Click on any element that you want to customize!','yp').' '.$other_pages.'<div class="yp-tip"><span class="dashicons dashicons-arrow-right"></span> '.__("Press to H key for hiding plugin panel.","yp").'</div></div>';
		

		// Options
		include( WT_PLUGIN_DIR . 'options.php' );
		
		
	echo "</div>";
	
}


/* ---------------------------------------------------- */
/* Getting Custom Animations Codes						*/
/* ---------------------------------------------------- */
function yp_get_custom_animations(){

	$all_options =  wp_load_alloptions();
	foreach($all_options as $name => $value){
		if(stristr($name, 'yp_anim')){

			echo '<style id="yp-animate-'.strtolower(str_replace("yp_anim_","",$name)).'">'.stripslashes(yp_css_prefix($value)).str_replace("keyframes", "-webkit-keyframes", stripslashes(yp_css_prefix($value))).'</style>';

		}
	}

}


/* ---------------------------------------------------- */
/* Getting CSS Codes									*/
/* ---------------------------------------------------- */
/*
	
	yp_get_css(false) : echo output CSS
	yp_get_css(true) : return just CSS Codes.

*/
function yp_get_css($r = false){
	
	global $post;
	
	$return = '<style id="yellow-pencil">';
	$onlyCSS = '';
	
	$get_type_option = '';
	$get_post_meta = '';
	
	global $wp_query;
	if(isset($wp_query->queried_object)){
		$id = @$wp_query->queried_object->ID;
	}else{
		$id = null;
	}

	if(class_exists( 'WooCommerce')){
		if(is_shop()){
			$id = wc_get_page_id('shop');
		}
	}
	
	$get_option = get_option("wt_css");
	if($id != null){
		$get_type_option = get_option("wt_".get_post_type($id)."_css");
		$get_post_meta = get_post_meta($id, '_wt_css', true);
	}
	
	if($get_option == 'false'){
		$get_option = false;
	}
	
	if($get_type_option == 'false'){
		$get_type_option = false;
	}
	
	if($get_post_meta == 'false'){
		$get_post_meta = false;
	}
	
	if(empty($get_option) == false){
		$return .= "\r\n/* CSS Created By Yellow Pencil Plugin */ \r\n".$get_option;
		$onlyCSS .= $get_option;
	}
	
	if(empty($get_type_option) == false){
		$return .= $get_type_option;
		$onlyCSS .= $get_type_option;
	}
	
	if(empty($get_post_meta) == false){
		$return .= $get_post_meta;
		$onlyCSS .= $get_post_meta;
	}

	if(is_author()){
		$return .= get_option("wt_author_css");
		$onlyCSS .= get_option("wt_author_css");
	}elseif(is_tag()){
		$return .= get_option("wt_tag_css");
		$onlyCSS .= get_option("wt_tag_css");
	}elseif(is_category()){
		$return .= get_option("wt_category_css");
		$onlyCSS .= get_option("wt_category_css");
	}elseif(is_404()){
		$return .= get_option("wt_404_css");
		$onlyCSS .= get_option("wt_404_css");
	}elseif(is_search()){
		$return .= get_option("wt_search_css");
		$onlyCSS .= get_option("wt_search_css");
	}

	// home.
	if(is_front_page() && is_home()){
		$return .= get_option("wt_home_css");
		$onlyCSS .= get_option("wt_home_css");
	}
	
	$return .= '</style>';
	
	
	if($return != '<style id="yellow-pencil"></style>' && $r == false){
		echo stripslashes(yp_css_prefix(yp_animation_prefix(yp_hover_focus_match($return))));
	}
	
	if($r == true){
		return $onlyCSS;
	}
	
}

// Don't load if editor page.
if(isset($_GET['yellow_pencil_frame']) == false && isset($_GET['yp_live_preview']) == false){
	add_action('wp_head','yp_get_css',9999);
}

// Adding custom animations.
if(isset($_GET['yellow_pencil_frame']) == false){
	add_action('wp_head','yp_get_custom_animations',9999);
}


function yp_get_live_css(){

	$css = get_option('yp_live_view_css_data');

	if(empty($css)){
		return $css;
	}

	return stripslashes(yp_css_prefix(yp_animation_prefix(yp_hover_focus_match($css))));

}


function yp_load_fonts_for_live(){
	$css = yp_get_live_css();
	yp_get_font_families($css);
}

// Get live preview.
function yp_get_live_preview(){

	$css = yp_get_live_css();

	if(empty($css) == false){

		$css = '<style id="yp-live-preview">'.$css.'</style>';

		if($css != '<style id="yp-live-preview"></style>'){
			echo $css;
		}

	}

}

// Live preview
if(isset($_GET['yp_live_preview']) == true){
	add_action('wp_head','yp_get_css_backend',9999);
	add_action('wp_head','yp_get_live_preview',9999);
}



/* ---------------------------------------------------- */
/* Hover/Focus System									*/
/* ---------------------------------------------------- */
/*
	Replace 'body.yp-selector-hover' to hover.
	replace 'body.yp-selector-focus' to focus.
*/
function yp_hover_focus_match($data){

	preg_match_all('@body.yp-selector-(.*?){@si',$data,$keys);
	
	foreach($keys[1] as $key){
		$dir = 'body.yp-selector-'.$key;

		
		$dirt = 'body.yp-selector-'.$key.':'.substr($key, 0, 5);		
		
		$dirt = str_replace('body.yp-selector-hover','body',$dirt);
		$dirt = str_replace('body.yp-selector-focus','body',$dirt);
		$data = (str_replace($dir,$dirt,$data));
	}
	
	$data = str_replace('.yp-selected','',$data);
	
	return $data;
	
}



/* ---------------------------------------------------- */
/* Adding Prefix To Some CSS Rules						*/
/* ---------------------------------------------------- */
function yp_css_prefix($outputCSS){
	
	$outputCSS = preg_replace('@-webkit-(.*?):(.*?);@si',"",$outputCSS);

	// Adding automatic prefix to output CSS.
	$CSSPrefix = array(
		"border-radius",
		"border-top-left-radius",
		"border-top-right-radius",
		"border-bottom-left-radius",
		"border-bottom-right-radius",
		"animation-fill-mode",
		"animation-duration",
		"animation-name",
		"filter",
		"box-shadow",
		"box-sizing",
		"transform",
		"transition"
	);
		
	foreach($CSSPrefix as $prefix){
		$outputCSS = preg_replace('@'.$prefix.':(.*?);@si',"".$prefix.":$1;\r	-moz-".$prefix.":$1;\r	-webkit-".$prefix.":$1;",$outputCSS);
	}
	
	return $outputCSS;
	
}


/* ---------------------------------------------------- */
/* Prefix for Animations								*/
/* ---------------------------------------------------- */
function yp_animation_prefix($outputCSS){
	
	$outputCSS = str_replace(".yp_focus:focus",":focus",$outputCSS);
	$outputCSS = str_replace(".yp_focus:hover",":focus",$outputCSS);
		
	$outputCSS = str_replace(".yp_hover:hover",":hover",$outputCSS);
	$outputCSS = str_replace(".yp_hover:focus",":hover",$outputCSS);
		
	$outputCSS = str_replace(".yp_onscreen:hover",".yp_onscreen",$outputCSS);
	$outputCSS = str_replace(".yp_onscreen:focus",".yp_onscreen",$outputCSS);
		
	$outputCSS = str_replace(".yp_click:hover",".yp_click",$outputCSS);
	$outputCSS = str_replace(".yp_click:focus",".yp_click",$outputCSS);
	
	$outputCSS = str_replace(".yp_hover",":hover",$outputCSS);
	$outputCSS = str_replace(".yp_focus",":focus",$outputCSS);
	
	return $outputCSS;
	
}


/* ---------------------------------------------------- */
/* Adding no-index meta to head for demo mode.			*/
/* ---------------------------------------------------- */
function yp_head_meta(){
	echo '<meta name="robots" content="noindex">' . "\n";
}


/* ---------------------------------------------------- */
/* Showing CSS data	Backend								*/
/* ---------------------------------------------------- */
function yp_get_css_backend(){
	
	global $post;
	
	$get_type_option = '';
	$get_post_meta = '';
	
	global $wp_query;
	if(isset($wp_query->queried_object)){
		$id = @$wp_query->queried_object->ID;
	}else{
		$id = null;
	}
	
	$id_is = isset($_GET['yp_id']);
	$type_is = isset($_GET['yp_type']);
	
	$return = '<style>';
	
	$get_option = get_option("wt_css");
	if($id != null){
		$get_type_option = get_option("wt_".get_post_type($id)."_css");
		$get_post_meta = get_post_meta($id, '_wt_css', true);
	}
	
	if($get_option == 'false'){
		$get_option = false;
	}
	
	if($get_type_option == 'false'){
		$get_type_option = false;
	}
	
	if($get_post_meta == 'false'){
		$get_post_meta = false;
	}
	
	if(empty($get_option) == false){
		
		if($id_is == true || $type_is == true){
			$return .= $get_option;
		}
		
	}
	
	if(empty($get_type_option) == false){
		
		if($type_is == false){
			$return .= $get_type_option;
		}
		
	}
	
	if(empty($get_post_meta) == false){
		
		if($id_is == false){
			$return .= $get_post_meta;
		}
		
	}

	if($type_is == false){

		if(is_author()){
			$return .= get_option("wt_author_css");
		}elseif(is_tag()){
			$return .= get_option("wt_tag_css");
		}elseif(is_category()){
			$return .= get_option("wt_category_css");
		}elseif(is_404()){
			$return .= get_option("wt_404_css");
		}elseif(is_search()){
			$return .= get_option("wt_search_css");
		}

		// home.
		if(is_front_page() && is_home()){
			$return .= get_option("wt_home_css");
		}

	}
	
	$return .= '</style>';
	
	
	if($return != '<style></style>'){
		echo stripslashes($return);
	}
	
}


if(isset($_GET['yellow_pencil_frame']) == true){
	add_action('wp_head','yp_get_css_backend',9998);
	add_action('wp_head','yp_head_meta');
}




/* ---------------------------------------------------- */
/* Backend CSS Codes									*/
/* ---------------------------------------------------- */
function yp_editor_styles(){
		
	global $post;
	
	$get_type_option = '';
	$get_post_meta = '';
	
	global $wp_query;
	if(isset($wp_query->queried_object)){
		$id = @$wp_query->queried_object->ID;
	}else{
		$id = null;
	}
	
	$id_is = isset($_GET['yp_id']);
	$type_is = isset($_GET['yp_type']);
	
	$return = '<div class="yp-styles-area">';
	
	$get_option = get_option("wt_styles");
	if($id != null){
		$get_type_option = get_option("wt_".get_post_type($id)."_styles");
		$get_post_meta = get_post_meta($id, '_wt_styles', true);
	}
	
	if(empty($get_option) == false){
		
		if($id_is == false && $type_is == false){
			$return .= $get_option;
		}
		
	}
	
	if(empty($get_type_option) == false){
		
		if($type_is == true){
			$return .= $get_type_option;
		}
		
	}
	
	if(empty($get_post_meta) == false){
		
		if($id_is == true){
			$return .= $get_post_meta;
		}
		
	}

	if($type_is == true){

		$type = $_GET['yp_type'];

		if($type == 'author'){
			$return .= get_option("wt_author_styles");
		}

		if($type == 'tag'){
			$return .= get_option("wt_tag_styles");
		}

		if($type == 'category'){
			$return .= get_option("wt_category_styles");
		}

		if($type == '404'){
			$return .= get_option("wt_404_styles");
		}

		if($type == 'search'){
			$return .= get_option("wt_search_styles");
		}

		if($type == 'home'){
			$return .= get_option("wt_home_styles");
		}


	}

	$return .= '</div>';

	$animations = '';

	$all_options =  wp_load_alloptions();
	foreach($all_options as $name => $value){
		if(stristr($name, 'yp_anim')){
			$animations .= $value;
		}
	}

	$return .= '<div class="yp-animate-data"><style>'.$animations.'</style></div>';

	echo stripslashes($return);
	
}

// Load just if editor page.
if(isset($_GET['yellow_pencil_frame']) == true){
	add_action('wp_footer','yp_editor_styles');
}



/* ---------------------------------------------------- */
/* Include options Library								*/
/* ---------------------------------------------------- */
include_once( WT_PLUGIN_DIR . 'base.php' );


/*-------------------------------------------------------*/
/*	Ajax Save											 */
/*-------------------------------------------------------*/
function yp_preview_data_save(){
	
	if(current_user_can("edit_theme_options") == true){

		$css = wp_strip_all_tags($_POST['yp_data']);

		if(!update_option('yp_live_view_css_data', $css)){
			add_option('yp_live_view_css_data',$css);
		}

	}
	
	die();
	
}

add_action( 'wp_ajax_yp_preview_data_save', 'yp_preview_data_save' );


/*-------------------------------------------------------*/
/*	Ajax Save											 */
/*-------------------------------------------------------*/
function yp_ajax_save(){
	
	if(current_user_can("edit_theme_options") == true){

		$css = wp_strip_all_tags($_POST['yp_data']);
		
		$styles = $_POST['yp_editor_data'];

		$styles = str_replace("YP|@", "<", $styles);
		$styles = str_replace("YP@|", ">", $styles);
		
		$id = '';
		
		$type = '';
		
		if(isset($_POST['yp_id'])){
			$id = $_POST['yp_id'];
		}
		
		if(isset($_POST['yp_stype'])){
			$type = $_POST['yp_stype'];
			if(count(explode("#",$type)) == 2){
				$type = explode("#",$type);
				$type = $type[0];
			}
		}
		
		if($id == 'undefined'){$id = '';}
		if($type == 'undefined'){$type = '';}
		if($css == 'undefined'){$css = '';}
		
		if($id == '' && $type == ''){
			
			// CSS Data
			if(empty($css) == false){
				if(!update_option ('wt_css', $css)){
					add_option('wt_css',$css);
				}
			}else{
				delete_option('wt_css');
			}
			
			// Styles
			if(empty($css) == false){
				if(!update_option ('wt_styles', $styles)){
					add_option('wt_styles',$styles);
				}
			}else{
				delete_option('wt_styles');
			}
			
		}elseif($type == ''){
		
			// CSS Data
			if(empty($css) == false){
				if(!update_post_meta ($id, '_wt_css', $css)){
					add_post_meta($id,'_wt_css',$css, true);
				}
			}else{
				delete_post_meta($id,'_wt_css');
			}
			
			// Styles
			if(empty($css) == false){
				if(!update_post_meta ($id, '_wt_styles', $styles)){
					add_post_meta($id,'_wt_styles',$styles, true);
				}
			}else{
				delete_post_meta($id,'_wt_styles');
			}
			
		}else{

			// CSS Data
			if(empty($css) == false){
				if(!update_option ('wt_'.$type.'_css', $css)){
					add_option('wt_'.$type.'_css',$css);
				}
			}else{
				delete_option('wt_'.$type.'_css');
			}
			
			// Styles
			if(empty($css) == false){
				if(!update_option ('wt_'.$type.'_styles', $styles)){
					add_option('wt_'.$type.'_styles',$styles);
				}
			}else{
				delete_option('wt_'.$type.'_styles');
			}
			
		}
	
	}
	
	die();
	
}

add_action( 'wp_ajax_yp_ajax_save', 'yp_ajax_save' );



/* ---------------------------------------------------- */
/* Getting arrow icon markup							*/
/* ---------------------------------------------------- */
function yp_arrow_icon(){
	return "<span class='dashicons yp-arrow-icon dashicons-arrow-up'></span><span class='dashicons yp-arrow-icon dashicons-arrow-down'></span>";
}


/* ---------------------------------------------------- */
/* Getting theme name or page name						*/
/* ---------------------------------------------------- */
function yp_customizer_name(){
	
	if(isset($_GET['yp_id']) == true){
		
		// The id.
		$id = $_GET['yp_id'];
		
		$title = get_the_title($id);
		$slug = ucfirst(get_post_type($id));
		
		if(strlen($title) > 14){

			return '"'.mb_substr($title,0,14,'UTF-8').'..'.'" '.$slug.'';
		}else{
			if($title == ''){
				$title = 'Untitled';
			}
			return '"'.$title.'" '.$slug.'';
		}
		
	}elseif(isset($_GET['yp_type']) == true){
		
		// The id.
		$type = ucfirst($_GET['yp_type']);
		
		if($type == 'Page' || $type == 'Author' || $type == 'Search' || $type == '404' || $type == 'Category'){
			$title = ''.$type.' '.__("Template","yp").'';
		}else{
			$title = ''.__("Single","yp").' '.$type.' '.__("Template","yp").'';
		}

		if($type == 'Home'){
			$title = __('Home Page','yp');
		}

		if($type == 'Page'){
			$title = __('Default Page Template','yp');
		}
		
		return $title;
		
	}else{
		
		$yp_theme = wp_get_theme();

		// Replace 'theme' word from theme name.
		$name = str_replace(' theme', '', $yp_theme->get('Name'));
		$name = str_replace(' Theme', '', $name);
		$name = str_replace('theme', '', $name);
		$name = str_replace('Theme', '', $name);

		// Keep it short.
		if(strlen($name) > 10){
			return '"'.mb_substr($name,0,10,'UTF-8').'.." '.__("Theme",'yp').' (Global)';
		}else{
			if($name == ''){
				$name = __('Untitled','yp');
			}
			return '"'.$name.'" '.__("Theme",'yp').'  (Global)';
		}
		
	}
	
}



/* ---------------------------------------------------- */
/* Adding style for wp-admin-bar						*/
/* ---------------------------------------------------- */
function yp_yellow_pencil_style() {
  echo '<style>#wp-admin-bar-yellow-pencil > .ab-item:before{content: "\f309";top:2px;}#wp-admin-bar-yp-update .ab-item:before{content: "\f316";top:3px;}</style>';
}



/* ---------------------------------------------------- */
/* Adding link to wp-admin-bar							*/
/* ---------------------------------------------------- */
function yp_yellow_pencil_edit_admin_bar( $wp_admin_bar ){
	
	$id = null;
	global $wp_query;
	$yellow_pencil_uri = yp_uri();
	
	if(isset($_GET['page_id'])){
		$id = $_GET['page_id'];
	}elseif(isset($_GET['post']) && is_admin() == true){
		$id = $_GET['post'];
	}elseif(isset($wp_query->queried_object) == true){
		$id = @$wp_query->queried_object->ID;
	}
	
	$args = array(
		'id'    => 'yellow-pencil',
		'title' => __('Edit With Yellow Pencil','yp'),
		'href'  => '',
		'meta'  => array( 'class' => 'yellow-pencil' )
	);
	$wp_admin_bar->add_node( $args );

	$args = array();

	// Since 4.5.2
	// category,author,tag, 404 and archive page support.
	$status = get_post_type($id);
	$key = get_post_type($id);
	$go_link = get_permalink($id);

	if(is_author()){
		$status = __('Author','yp');
		$key = 'author';
		$id = $wp_query->query_vars['author'];
		$go_link = get_author_posts_url($id);
	}elseif(is_tag()){
		$status = __('Tag','yp');
		$key = 'tag';
		$id = $wp_query->query_vars['tag_id'];
		$go_link = get_tag_link($id);
	}elseif(is_category()){
		$status = __('Category','yp');
		$key = 'category';
		$id = $wp_query->query_vars['cat'];
		$go_link = get_category_link($id);
	}elseif(is_404()){
		$status = '404';
		$key = '404';
		$go_link = esc_url(get_home_url().'/?p=987654321');
	}elseif(is_archive()){
		$status = __('Archive','yp');
		$key = 'archive';
	}elseif(is_search()){
		$status = __('Search','yp');
		$key = 'search';
		$go_link = esc_url(get_home_url().'/?s='.yp_getting_last_post_title().'');
	}

	// Blog
	if(is_front_page() && is_home()){
		$status = __('Home Page','yp');
		$key = 'home';
		$go_link = esc_url(get_home_url().'/');
	}elseif ( is_front_page() == false && is_home() == true ) {
		$status = __('Page','yp');
	}

	if(class_exists( 'WooCommerce' )){
		if(is_shop()){
			$id = wc_get_page_id('shop');
			$status = __('Page','yp');
			$key = 'page';
			$go_link = esc_url(get_permalink($id));
		}
	}

	if($go_link == ''){
		global $wp;
		$key = '';
		$go_link = add_query_arg($wp->query_string, '', home_url( $wp->request ));
	}

	

	// fix a small bug.
	if($id == 0){
		$id = null;
	}

	// Edit theme
	array_push($args,array(
		'id'		=>	'yp-edit-theme',
		'title'		=>	__('Global Customize','yp'),
		'href'		=>	add_query_arg(array('href' => yp_urlencode($go_link)),$yellow_pencil_uri),
		'parent'	=>	'yellow-pencil',
	));

	// Edit All similar
	if($key != 'home' && $key != 'archive' && $key != ''){

		if($key != '404' && $key != 'search'){
			$s = '\'s';
			$all = 'All ';
		}else{
			$s = '';
			$all = '';
		}

		array_push($args,array(
			'id'     	=> 'yp-edit-all',
			'title'		=>	''.__("Edit",'yp').' '.ucfirst($status).' '.__("Template",'yp').'',
			'href'		=>	add_query_arg(array('href' => yp_urlencode($go_link), 'yp_type' => $key),$yellow_pencil_uri),
			'parent' 	=> 'yellow-pencil',
			'meta'   	=> array( 'class' => 'first-toolbar-group' ),
		));

	}
	
	// Edit it.
	if($key != 'search' && $key != 'archive' && $key != 'tag' && $key != 'category' && $key != 'author' && $key != '404' && $key != ''){
		
		if($key == 'home'){

			array_push($args,array(
				'id'		=>	'yp-edit-it',
				'title'		=>	''.__("Edit Only","yp").' '.ucfirst($status).'',
				'href'		=>	add_query_arg(array('href' => yp_urlencode($go_link), 'yp_type' =>  $key),$yellow_pencil_uri),
				'parent'	=>	'yellow-pencil',
			));
		}else{
			
			array_push($args,array(
				'id'		=>	'yp-edit-it',
				'title'		=>	''.__("Edit This",'yp').' '.ucfirst($status).'',
				'href'		=>	add_query_arg(array('href' => yp_urlencode($go_link), 'yp_id' =>  $id),$yellow_pencil_uri),
				'parent'	=>	'yellow-pencil',
			));

		}

		
	}
		
	// Add to wpadminbar
	for($a=0;$a<sizeOf($args);$a++){
		$wp_admin_bar->add_node($args[$a]);
	}
	

}


/* ---------------------------------------------------- */
/* Adding body class									*/
/* ---------------------------------------------------- */
function yp_body_class($classes) {
	
	$classes[] = 'yp-yellow-pencil wt-yellow-pencil';

	if(current_user_can("edit_theme_options") == false){
		if(defined("WT_DEMO_MODE")){
			$classes[] = 'yp-yellow-pencil-demo-mode';
		}
	}
	
	if(defined("WT_DISABLE_LINKS")){
		$classes[] = 'yp-yellow-pencil-disable-links';
	}

	if(!defined('WTFV')){
		$classes[] = 'wtfv';
	}

	return $classes;
	
}


/* ---------------------------------------------------- */
/* Install the plugin									*/
/* ---------------------------------------------------- */
function yp_init(){
	
	// See Developer Documentation for more info.
	if(defined("WT_DEMO_MODE")){
		include( WT_PLUGIN_DIR . 'demo_mode.php' );
	}
	
	// Iframe Settings.
	// Disable admin bar in iframe
	// Add Classes to iframe body.
	// Add Styles for iframe.
	if(yp_check_let_frame()){
		show_admin_bar(false);
		add_filter('body_class', 'yp_body_class');
		add_action( 'wp_enqueue_scripts', 'yp_styles_frame' );
	}
	
	// If yellow pencil is active and theme support;
	// Adding Link to #wpadminbar.
	if(yp_check_let()){

		// If not admin page, Add Customizer link.
		if(is_admin() === false){
			add_action( 'admin_bar_menu', 'yp_yellow_pencil_edit_admin_bar', 999 );

			// Adding CSS helper for admin bar link.
			add_action('wp_head', 'yp_yellow_pencil_style');

		}

	}
	
	// Getting Current font families.
	if(is_admin() === false){
		add_action('wp_enqueue_scripts','yp_load_fonts');
	}

	// Live preview
	if(isset($_GET['yp_live_preview']) == true){
		add_action('wp_enqueue_scripts','yp_load_fonts_for_live');
	}

}

add_action("init","yp_init");



/* ---------------------------------------------------- */
/* Uploader Style 										*/
/* ---------------------------------------------------- */
function yp_uploader_style(){

	echo '<style>
		tr.url,tr.post_content,tr.post_excerpt,tr.field,tr.label,tr.align,tr.image-size,tr.post_title,tr.image_alt,.del-link,#tab-type_url{display:none !important;}
		.media-item-info > tr > td > p:last-child,.savebutton,.ml-submit{display:none !important;}
		#filter{display:none !important;}
		.media-item .describe input[type="text"], .media-item .describe textarea{width:334px;}
		div#media-upload-header{
		}
	</style>';

}

if(isset($_GET['yp_uploader'])){
	if($_GET['yp_uploader'] == 1){
		add_action('admin_head','yp_uploader_style');
	}
}



/* ---------------------------------------------------- */
/* CSS library for Yellow Pencil						*/
/* ---------------------------------------------------- */
function yp_register_styles() {

	// Animate library.
	if(strstr(yp_get_css(true),"animation-name:")){
		wp_enqueue_style('yellow-pencil-animate', plugins_url( 'library/css/animate.css' , __FILE__ ));
	}

	// Animate library for live preview
	if(isset($_GET['yp_live_preview']) == true){

		$css = yp_get_live_css();

		if(strstr($css,"animation-name:")){
			wp_enqueue_style('yellow-pencil-animate', plugins_url( 'library/css/animate.css' , __FILE__ ));
		}

	}
	
}



/* ---------------------------------------------------- */
/* Jquery plugins for CSS Engine						*/
/* ---------------------------------------------------- */
function yp_register_scripts() {
	
	$outputCSS = yp_get_css(true);
	$needCSSEngine = false;
	
	// Yellow Pencil Library Helper.
	if(strstr($outputCSS,"animation-name:") == true || isset($_GET['yellow_pencil_frame']) == true || isset($_GET['yp_live_preview']) == true){
		wp_enqueue_script('yellow-pencil-library', plugins_url( 'library/js/yellow-pencil-library.js' , __FILE__ ), 'jquery', '1.0', TRUE);
		$needCSSEngine = true;
	}
	
	// Background Parallax
	if(strstr($outputCSS,"background-parallax:") == true || isset($_GET['yellow_pencil_frame']) == true || isset($_GET['yp_live_preview']) == true){
		wp_enqueue_script('yellow-pencil-background-parallax', plugins_url( 'library/js/parallax.js' , __FILE__ ), 'jquery', '1.0', TRUE);
		$needCSSEngine = true;
	}
	
	// CSS Engine for special CSS rules.
	// example: my-css-rule:data("value");
	if($needCSSEngine == true){
		wp_enqueue_script('yellow-pencil-css-engine', plugins_url( 'library/js/css-engine.js' , __FILE__ ), 'jquery', '1.0', TRUE);
	}
	
	// Jquery
	if($needCSSEngine == true){
		wp_enqueue_script( 'jquery' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'yp_register_styles' );
add_action( 'wp_enqueue_scripts', 'yp_register_scripts' );


/* ---------------------------------------------------- */
/* Scripts area for YP									*/
/* ---------------------------------------------------- */
function yp_scripts_areas() {
    
	if(isset($_GET['yellow_pencil_frame']) == true){

		// Be sure, iframe loaded.
		echo "<script>window.loadChecker = 0;

		function yp_check_class(element, cls) {
		    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}

		function yp_check_load(){

			setTimeout(function(){

				if(typeof parent.yellow_pencil_main != 'function'){
					self.parent.location.reload();
				}else{
					if(yp_check_class(document.body,'yp-yellow-pencil-loaded') == false && window.loadChecker == 0){
						parent.yellow_pencil_main();
						window.loadChecker = 1;
					}
				}

			},50);

		}

		window.onload = yp_check_load();</script>";
		
		// script area enough for yellow pencil.
		for ($i = 1; $i <= 50; $i++) {
			echo "<script class='yellow-pencil-scripts'></script>\r";
		}
		
	}

}
add_action( 'wp_footer', 'yp_scripts_areas', 9999);



/* ---------------------------------------------------- */
/* Iframe Admin Page									*/
/* ---------------------------------------------------- */
function yp_yellow_pencil_editor() {

    $hook = add_submenu_page(null, __('Yellow Pencil Editor','yp'), __('Yellow Pencil Editor','yp'), 'edit_theme_options', 'yellow-pencil-editor','yp_editor_func');

}

add_action('admin_menu', 'yp_yellow_pencil_editor');

function yp_editor_func(){
	
}

add_action('load-admin_page_yellow-pencil-editor', 'yp_frame_output');



/* ---------------------------------------------------- */
/* Iframe Source 										*/
/* ---------------------------------------------------- */
function yp_frame_output(){

$protocol = is_ssl() ? 'https' : 'http';

$protocol = $protocol.'://';

?><!DOCTYPE html><html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="robots" content="noindex">
	<title>Yellow Pencil</title>
	<link rel="icon" type="image/ico" href="<?php echo esc_url(plugins_url( 'images/favicon.png' , __FILE__ )); ?>"/>
	<link rel='stylesheet' href='<?php echo esc_url(includes_url( 'css/dashicons.min.css' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo $protocol; ?>fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=latin,latin-ext' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/contextmenu.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/nouislider.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/iris.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/bootstrap-tooltip.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/sweetalert.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />
	<link rel='stylesheet' href='<?php echo esc_url(plugins_url( 'css/yellow-pencil.css?ver='.YP_VERSION.'' , __FILE__ )); ?>' type='text/css' />	
	<script src='<?php echo esc_url(includes_url( 'js/jquery/jquery.js' , __FILE__ )); ?>'></script>
	<script type="text/javascript">
	var protocol = "<?php if(is_ssl()){echo 'https';}else{echo 'http';} ?>";
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	var siteurl = "<?php echo get_site_url(); ?>";
	var l18_saving = "<?php _e('Saving','yp'); ?>";
	var l18_back_to_menu = "<?php _e('Back to menu','yp'); ?>";
	var l18_close_editor = "<?php _e('Close Editor','yp'); ?>";
	var l18_saving = "<?php _e('Saving','yp'); ?>";
	var l18_save = "<?php _e('Save','yp'); ?>";
	var l18_saved = "<?php _e('Saved','yp'); ?>";
	var l18_demo_alert = "<?php _e('Saving is disabled in demo mode.','yp'); ?>";
	var l18_live_preview = "<?php _e('Live preview disabled in demo mode.','yp'); ?>";
	var l18_clear = "<?php _e('Clear','yp'); ?>";
	var l18_footer = "<?php _e('Footer','yp'); ?>";
	var l18_content = "<?php _e('Content','yp'); ?>";
	var l18_topbar = "<?php _e('Top Bar','yp'); ?>";
	var l18_simple_title = "<?php _e('Basic selector','yp'); ?>";
	var l18_clean_selector = "<?php _e('Alternative Class selector','yp'); ?>";
	var l18_simple_sharp_selector = "<?php _e('Simple selector','yp'); ?>";
	var l18_sharp_selector = "<?php _e('Sharp selector','yp'); ?>";

	var l18_animation_notice = "<?php _e('Animation property not working, please set \'block\' option for display property from extra section.','yp'); ?>";
	var l18_margin_notice = "<?php _e('Margin property may not work, please set \'block\' or \'inline-block\' option for display property from extra section.','yp'); ?>";
	var l18_padding_notice = "<?php _e('Padding property may not work, please set \'block\' or \'inline-block\' option for display property from extra section. If work please don\'t care this notice.','yp'); ?>";
	var l18_border_width_notice = "<?php _e('Border width property must be minimum 1px.','yp'); ?>";
	var l18_bg_img_notice = "<?php _e('There already have a background image, you must disable background image for background color work.','yp'); ?>";
	var l18_bg_img_notice_two = "<?php _e('Set a background image for using this feature.','yp'); ?>";
	var l18_shadow_notice = "<?php _e('You must choose a color for shadow.','yp'); ?>";
	var l18_border_style_notice = "<?php _e('Border style property is hidden or none, please select solid, dotted or dashed for showing the border.','yp'); ?>";
	var l18_logo = "<?php _e('Logo','yp'); ?>";
	var l18_google_map = "<?php _e('Google Map','yp'); ?>";
	var l18_entry_title_link = "<?php _e('Entry Title Link','yp'); ?>";
	var l18_category_link = "<?php _e('Category Link','yp'); ?>";
	var l18_tag_link = "<?php _e('Tag Link','yp'); ?>";
	var l18_widget = "<?php _e('Widget','yp'); ?>";
	var l18_font_awesome_icon = "<?php _e('Font Awesome Icon','yp'); ?>";
	var l18_submit_button = "<?php _e('Submit Button','yp'); ?>";
	var l18_menu_item = "<?php _e('Menu Item','yp'); ?>";
	var l18_post_meta_division = "<?php _e('Post Meta Division','yp'); ?>";
	var l18_comment_reply_title = "<?php _e('Comment Reply Title','yp'); ?>";
	var l18_login_info = "<?php _e('Login Info','yp'); ?>";
	var l18_allowed_tags = "<?php _e('Allowed Tags','yp'); ?>";
	var l18_post_title = "<?php _e('Post Title','yp'); ?>";
	var l18_comment_form = "<?php _e('Comment Form','yp'); ?>";
	var l18_widget_title = "<?php _e('Widget title','yp'); ?>";
	var l18_tag_cloud = "<?php _e('Tag Cloud','yp'); ?>";
	var l18_row = "<?php _e('Row','yp'); ?>";
	var l18_button = "<?php _e('Button','yp'); ?>";
	var l18_lead = "<?php _e('Lead','yp'); ?>";
	var l18_well = "<?php _e('Well','yp'); ?>";
	var l18_accordion_toggle = "<?php _e('Accordion Toggle','yp'); ?>";
	var l18_accordion_content = "<?php _e('Accordion Content','yp'); ?>";
	var l18_alert_division = "<?php _e('Alert Division','yp'); ?>";
	var l18_footer_content = "<?php _e('Footer Content','yp'); ?>";
	var l18_global_section = "<?php _e('Section','yp'); ?>";
	var l18_menu_link = "<?php _e('Menu Link','yp'); ?>";
	var l18_submenu = "<?php _e('Sub Menu','yp'); ?>";
	var l18_show_more_link = "<?php _e('Show More Link','yp'); ?>";
	var l18_wrapper = "<?php _e('Wrapper','yp'); ?>";
	var l18_article_title = "<?php _e('Article title','yp'); ?>";
	var l18_column = "<?php _e('Column','yp'); ?>";
	var l18_post_division = "<?php _e('Post Division','yp'); ?>";
	var l18_content_division = "<?php _e('Content Division','yp'); ?>";
	var l18_entry_title = "<?php _e('Entry Title','yp'); ?>";
	var l18_entry_content = "<?php _e('Entry Content','yp'); ?>";
	var l18_entry_footer = "<?php _e('Entry Footer','yp'); ?>";
	var l18_entry_header = "<?php _e('Entry Header','yp'); ?>";
	var l18_enter_time = "<?php _e('Entry Time','yp'); ?>";
	var l18_post_edit_link = "<?php _e('Post Edit Link','yp'); ?>";
	var l18_post_thumbnail = "<?php _e('Post Thumbnail','yp'); ?>";
	var l18_thumbnail = "<?php _e('Thumbnail','yp'); ?>";
	var l18_thumbnail_image = "<?php _e('Thumbnail Image','yp'); ?>";
	var l18_edit_link = "<?php _e('Edit Link','yp'); ?>";
	var l18_comments_link_division = "<?php _e('Comments Link Division','yp'); ?>";
	var l18_site_description = "<?php _e('Site Description','yp'); ?>";
	var l18_post_break = "<?php _e('Post Break','yp'); ?>";
	var l18_paragraph = "<?php _e('Paragraph','yp'); ?>";
	var l18_line_break = "<?php _e('Line Break','yp'); ?>";
	var l18_horizontal_rule = "<?php _e('Horizontal Rule','yp'); ?>";
	var l18_link = "<?php _e('Link','yp'); ?>";
	var l18_list_item = "<?php _e('List Item','yp'); ?>";
	var l18_unorganized_list = "<?php _e('Unorganized List','yp'); ?>";
	var l18_image = "<?php _e('Image','yp'); ?>"; 
	var l18_bold_tag = "<?php _e('Bold Tag','yp'); ?>";
	var l18_italic_tag = "<?php _e('Italic Tag','yp'); ?>";
	var l18_strong_tag = "<?php _e('Strong Tag','yp'); ?>";
	var l18_blockquote = "<?php _e('Block Quote','yp'); ?>";
	var l18_preformatted = "<?php _e('Preformatted','yp'); ?>";
	var l18_table = "<?php _e('Table','yp'); ?>";
	var l18_table_row = "<?php _e('Table Row','yp'); ?>";
	var l18_table_data = "<?php _e('Table Data','yp'); ?>";
	var l18_header_division = "<?php _e('Header Division','yp'); ?>";
	var l18_footer_division = "<?php _e('Footer Division','yp'); ?>";
	var l18_section = "<?php _e('Section','yp'); ?>";
	var l18_form_division = "<?php _e('Form Division','yp'); ?>";
	var l18_centred_block = "<?php _e('Centred block','yp'); ?>";
	var l18_definition_list = "<?php _e('Definition list','yp'); ?>";
	var l18_definition_term = "<?php _e('Definition term','yp'); ?>";
	var l18_definition_description = "<?php _e('Definition description','yp'); ?>";
	var l18_header = "<?php _e('Header','yp'); ?>";
	var l18_level = "<?php _e('Level','yp'); ?>";
	var l18_smaller_text = "<?php _e('Smaller text','yp'); ?>";
	var l18_text_area = "<?php _e('Text Area','yp'); ?>";
	var l18_body_of_table = "<?php _e('Body Of Table','yp'); ?>";
	var l18_head_of_table = "<?php _e('Head Of Table','yp'); ?>";
	var l18_foot_of_table = "<?php _e('Foot of table','yp'); ?>";
	var l18_underline_text = "<?php _e('Underline text','yp'); ?>";
	var l18_span = "<?php _e('Span','yp'); ?>";
	var l18_quotation = "<?php _e('Quotation','yp'); ?>";
	var l18_citation = "<?php _e('Citation','yp'); ?>";
	var l18_expract_of_code = "<?php _e('Extract of code','yp'); ?>";
	var l18_navigation = "<?php _e('Navigation','yp'); ?>";
	var l18_label = "<?php _e('Label','yp'); ?>";
	var l18_time = "<?php _e('Time','yp'); ?>";
	var l18_division = "<?php _e('Division','yp'); ?>";
	var l18_caption_of_table = "<?php _e('Caption Of table','yp'); ?>";
	var l18_input = "<?php _e('Input','yp'); ?>";
	var l18_sure = "<?php _e('Are you sure you want to leave the page without saving?','yp'); ?>";
	var l18_reset = "<?php _e('Do you want reset current options?','yp'); ?>";
	var l18_process = "<?php _e('CSS styles are processing. Please be patient and wait until process end.','yp'); ?>";
	var l18_cantUndo = "<?php _e('You can\'t undo the changes while creating a new animation. Click \"eye icon\" if you want to disable any option.','yp'); ?>";
	var l18_cantUndoAnimManager = "<?php _e('You can\'t undo the changes while animation manager on.','yp'); ?>";
	var l18_cantEditor = "<?php _e('You can\'t use the CSS editor while creating a new animation.','yp'); ?>";
	var l18_allScenesEmpty = "<?php _e('All scenes are empty.','yp'); ?>";

	var l18_create = "<?php _e('Create','yp'); ?>";
	var l18_CreateAnimate = "<?php _e('Create New Animation','yp'); ?>";
	var l18_cancel = "<?php _e('Cancel','yp'); ?>";
	var l18_scene = "<?php _e('SCENE','yp'); ?>";
	var l18_closeAnim = "<?php _e('Do you want to close animation creator?','yp'); ?>";
	var l18_setAnimName = "<?php _e('Please set animation name for creating.','yp'); ?>";
	var l18_animExits = "<?php _e('This animation name already exists, please try another one.','yp'); ?>";
	var l18_notjustit = "<?php _e('Not possible, Can\'t select just this element. Please add a custom id or class to this element.','yp'); ?>";

	var l18_notice = "<i class='yp-notice-icon'></i><?php _e('Notice','yp'); ?>";
	var l18_warning = "<i class='yp-notice-icon'></i><?php _e('Warning','yp'); ?>";

	var l18_none = "Default value for this rule";
	var l18_picker = "Active and move cursor to on any element. (Picker not work with images)";
	</script>
</head>
<?php

	$classes[] = 'yp-yellow-pencil wt-yellow-pencil yp-metric-disable yp-body-selector-mode-active';

	if(current_user_can("edit_theme_options") == false){
		if(defined("WT_DEMO_MODE")){
			$classes[] = 'yp-yellow-pencil-demo-mode';
		}
	}
	
	if(defined("WT_DISABLE_LINKS")){
		$classes[] = 'yp-yellow-pencil-disable-links';
	}

	if(!defined('WTFV')){
		$classes[] = 'wtfv';
	}

	$classesReturn = '';

	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {
	    $classes[] = 'browser_chrome';
	}

	foreach ($classes as $class){
		$classesReturn .= ' '.$class;
	}

	$classesReturn = trim($classesReturn);

?>
<body class="<?php echo $classesReturn; ?>">

	<?php

		$frameLink = esc_url(urldecode($_GET['href']));

		if(empty($frameLink)){
			$frameLink = urldecode($_GET['href']);
		}

		if(isset($_GET['yp_type'])){

			$type = $_GET['yp_type'];
			$frame = add_query_arg(array('yellow_pencil_frame' => 'true','yp_type' => $type),$frameLink);
		
		}elseif(isset($_GET['yp_id'])){

			$id = $_GET['yp_id'];
			$frame = add_query_arg(array('yellow_pencil_frame' => 'true','yp_id' => $id),$frameLink);
		
		}else{

			$frame = add_query_arg(array('yellow_pencil_frame' => 'true'),$frameLink);
		
		}

	?>
	
	<?php

		$protocol = is_ssl() ? 'https' : 'http';

		$frameNew = esc_url($frame,array($protocol));

		if(empty($frameNew) == true && strstr($frame,'://') == true){
			$frameNew = explode("://",$frame);
			$frameNew = $protocol.'://'.$frameNew[1];
		}elseif(empty($frameNew) == true && strstr($frame,'://') == false){
			$frameNew = $protocol.'://'.$frame;
		}

	?>
	<iframe id="iframe" class="yellow_pencil_iframe" data-href="<?php echo $frameNew; ?>"></iframe>

	<style id="yp-animate-helper"></style>

	<div class="yp-animate-manager">

		<h3 class="animation-manager-empty">There is no animation on this page.<small>Select an element to add animation.</small></h3>

		<div class="yp-anim-list-menu"><ul></ul></div>

		<div class="yp-anim-control-overflow">
			<div class="yp-anim-controls">
				<div class="yp-anim-control-left">
					<div class="yp-anim-manager-control">
						<a class="yp-anim-control-btn yp-anim-control-close" data-toggle='tooltipAnim' data-placement='top' title='Close'><span class="dashicons dashicons-no-alt"></span></a>
						<a class="yp-anim-control-btn yp-anim-control-pause" data-toggle='tooltipAnim' data-placement='top' title='Stop'><span class="dashicons dashicons-controls-pause"></span></a>
						<a class="yp-anim-control-btn yp-anim-control-play" data-toggle='tooltipAnim' data-placement='top' title='Play'><span class="dashicons dashicons-controls-play"></span></a>
						<span class="yp-anim-current-duration"><span class="yp-counter-min">00</span>:<span class="yp-counter-second">00</span>.<span class="yp-counter-ms">00</span></span>
					</div>
				</div>
				<div class="yp-anim-control-right">
					<div class="yp-anim-playing-border"></div>
					<div class="yp-anim-metric">
					</div>
				</div>
				<div class="yp-clearfix"></div>
			</div>
		</div>

		<div class="yp-animate-manager-inner">

			<div class="yp-anim-left-part-column"></div>
			<div class="yp-anim-right-part-column">
				<div class="yp-anim-playing-over"></div>
				<div class="yp-anim-playing-border"></div>
			</div>
			<div class="yp-clearfix"></div>

		</div>

	</div>

	<div class="responsive-bottom-handle"></div>
	<div class="responsive-right-handle"></div>

	<div id="responsive-size-text"><span class="support-icon" data-toggle='tooltip' data-placement='right' title='Slowly resize your website width and be sure its looks good on all sizes. Golden rule is percentage. Use % instead of PX for width and such properties.'>?</span> Customizing for <span class="device-size"></span>px and <span class="media-control" data-code="max-width">below</span> screen sizes. <span class="device-name"></span></div>

	<?php yp_yellow_penci_bar(); ?>
	
	<div class="top-area-btn-group">

		<a target="blank" class="yellow-pencil-logo" href="http://waspthemes.com/yellow-pencil"></a>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Toggle Aiming Mode','yp'); ?>' class="top-area-btn yp-selector-mode active"><span class="aiming-icon"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Single Selector Tool','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Select only one element','yp'); ?></span>' class="top-area-btn yp-sharp-selector-btn"><span class="sharp-selector-icon"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('CSS Editor','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('shortcut: É','yp'); ?></span>' class="top-area-btn css-editor-btn"><span class="dashicons dashicons-edit"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Responsive Mode','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Edit to any screen size','yp'); ?></span>' class="top-area-btn yp-responsive-btn active"><span class="dashicons dashicons-smartphone"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Search Selector Tool','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Shortcut: F','yp'); ?></span>' class="top-area-btn yp-button-target active"><span class="dashicons dashicons-search"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Measuring Tool','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Shortcut: R','yp'); ?></span>' class="top-area-btn yp-ruler-btn"><span class="ruler-icon"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Wireframe','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Ideal for editing the sizes.','yp'); ?></span>' class="top-area-btn yp-wireframe-btn"><span class="dashicons dashicons-align-left"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Design Information','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Typography, sizes and others','yp'); ?></span>' class="top-area-btn info-btn"><span class="dashicons dashicons-info"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Animation Manager','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Control Animations.','yp'); ?></span>' class="top-area-btn animation-manager-btn"><span class="dashicons dashicons-randomize"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Undo','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Hold CTRL + Z key down','yp'); ?></span>' class="top-area-btn top-area-center undo-btn"><span class="undo-icon"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Redo','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Hold CTRL + Y key down','yp'); ?></span>' class="top-area-btn redo-btn"><span class="redo-icon"></span></div>

		<div data-toggle='tooltip-bar' data-placement='right' title='<?php _e('Full-screen','yp'); ?> <span class="yp-tooltip-shortcut"><?php _e('Switch to full-screen','yp'); ?></span>' class="top-area-btn fullscreen-btn"><span class="dashicons dashicons-editor-contract"></span><span class="dashicons dashicons-editor-expand"></span></div>

	</div>

	<img class="metric" src="<?php echo esc_url(plugins_url( 'images/metric.png' , __FILE__ )); ?>" />

	<div class="metric-left-border"></div>
	<div class="metric-top-border"></div>
	<div class="metric-top-tooltip">Y: <span></span> px</div>
	<div class="metric-left-tooltip">X: <span></span> px</div>

	<div class="advanced-info-box">
		<div class="advanced-close-link"><span class="dashicons dashicons-arrow-left-alt2"></span></div>
		<div class="advanced-info-box-menu">
			<span class="advance-info-btns element-btn">Element</span> <span class="advance-info-btns typography-btn">Typography</span> <span class="advance-info-btns advanced-btn">Advanced</span>
		</div>
		<div class="advanced-info-box-inner">

			<div class="typography-content advanced-info-box-content">

				<h3>Color Scheme</h3>
				<div class="info-color-scheme-list">
				</div>

				<h3 class="no-top">Basic</h3>
				<ul class="info-basic-typography-list">
				</ul>

				<h3>Font Families</h3>
				<ul class="info-font-family-list">
				</ul>

				<h3>Animations</h3>
				<ul class="info-animation-list">
				</ul>

			</div>

			<div class="element-content advanced-info-box-content">

				<div class="info-element-selected-section">

					<div class="info-element-selector-section">
						<h3 class="no-top">CSS Selector</h3>
						<ul class="info-element-selector-list">
						</ul>
					</div>
					
					<h3>General</h3>
					<ul class="info-element-general">
					</ul>

					<div class="info-element-classes-section">
						<h3>Classes</h3>
						<ul class="info-element-class-list">
						</ul>
					</div>

					

					<h3>DOM Code</h3>
					<textarea disabled="disabled" class="info-element-dom"></textarea>
				</div>

				<p class="info-no-element-selected">Please select one element to show informations.</p>

			</div>

			<div class="advanced-content advanced-info-box-content">
				<h3>Dimensions</h3>
				<ul class="info-basic-size-list">
				</ul>
				<h3>All Ids</h3>
				<ul class="info-global-id-list">
				</ul>
				<h3>All Classes</h3>
				<ul class="info-global-class-list">
				</ul>
			</div>

		</div>
	</div>

	<div class="yp-iframe-loader"></div>

	<div id="image_uploader">
		<iframe data-url="<?php echo admin_url('media-upload.php?type=image&TB_iframe=true&reauth=1&yp_uploader=1'); ?>"></iframe>
	</div>
	<div id="image_uploader_background"></div>

	<p class="yp-target-helper-note"><?php _e("Press Enter to continue. ESC Cancel.","yp"); ?></p>
	<input type='text' class='yp-button-target-input' placeholder='<?php _e('Selector Search tool','yp'); ?>.' id='yp-button-target-input' />
	<ul id="yp-target-dropdown"><li>a</li></ul>
	<div id="target_background"></div>

	<div id="leftAreaEditor">
		<div id="cssData"></div>
		<div id="cssEditorBar"><span title="Fullscreen" class="dashicons yp-css-fullscreen-btn dashicons-editor-code"></span><a target="_blank" title="CSS Sources" href="<?php echo admin_url('options-general.php?page=yp-options'); ?>"><span class="yp-source-page-link dashicons dashicons-admin-settings"></span></a><span data-toggle='tooltip' data-placement='right' title='<?php _e('Hide','yp'); ?> <span class="yp-tooltip-shortcut">shortcut: ESC</span>' class="dashicons yp-css-close-btn dashicons-no-alt "></span></div>
	</div>

	<div class="yp-popup-background"></div>
	<div class="yp-info-modal">
		<div class="yp-info-modal-top"></div>
		<div class="yp-info-modal-top-inner">
			<h2><?php _e("Changes not saved. Upgrade Pro!","yp"); ?></h2>
			<p><?php _e("You are using some premium features. Disable premium features or upgrade to Pro version.","yp"); ?></p>
		</div>
		<ul>
			<li><?php _e("600+ Font families","yp"); ?></li>
			<li><?php _e("50+ CSS Animations","yp"); ?></li>
			<li><?php _e("300+ Background patterns","yp"); ?></li>
			<li><?php _e("Drag & Drop feature","yp"); ?></li>
			<li><?php _e("Live Resizer feature","yp"); ?></li>
			<li><?php _e("Unlock all features","yp"); ?></li>
			<li><?php _e("Money back guarantee","yp"); ?></li>
			<li><?php _e("Lifetime license & Free updates","yp"); ?></li>
		</ul>

		<div class="yp-action-area">
			<a class="yp-info-modal-close"><?php _e("Maybe Later","yp"); ?></a>
			<a class="yp-buy-link" target="_blank" href="http://waspthemes.com/yellow-pencil/buy"><?php _e("Get Premium","yp"); ?></a>
			<p class="yp-info-last-note">Money back guarantee. You can request a refund at any time!</p>
		</div>
	</div>
	
	<div class="yp_debug"></div>

	<div class="anim-bar">
		<div class="anim-bar-title">
			<div class="anim-title"><?php _e("Animation Scenes","yp"); ?></div>
			<div class="yp-anim-save yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="<?php _e("Done","yp"); ?>"><span class="dashicons dashicons-flag"></span></div>
			<div class="yp-anim-play yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="<?php _e("Play","yp"); ?>"><span class="dashicons dashicons-controls-play"></span></div>
			<div class="yp-anim-cancel yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="<?php _e("Cancel","yp"); ?>"><span class="dashicons dashicons-no-alt"></span></div>
			<div class="yp-clearfix"></div>
		</div>
		<div class="scenes">
			<div class="scene scene-active scene-1" data-scene="scene-1"><p><?php _e("SCENE","yp"); ?> 1 <span><input autocomplete="off" type='text' value='0' /></span></p></div>
			<div class="scene scene-2" data-scene="scene-2"><p><?php _e("SCENE","yp"); ?> 2 <span><input type='text' autocomplete="off" value='100' /></span></p></div>
			<div class="scene scene-add"><span class="dashicons dashicons-plus"></span></div>
			<div class="yp-clearfix"></div>
		</div>
	</div>

	<script src='<?php echo esc_url(plugins_url( 'js/contextmenu.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(plugins_url( 'js/nouislider.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/core.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/widget.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/mouse.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/slider.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/draggable.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/resizable.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/menu.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(includes_url( 'js/jquery/ui/autocomplete.min.js' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(plugins_url( 'js/iris.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(plugins_url( 'js/bootstrap-tooltip.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(plugins_url( 'library/js/css-engine.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script type='text/javascript' src='<?php echo esc_url(plugins_url( 'library/ace/ace.js' , __FILE__ )); ?>'></script>
	<script type='text/javascript' src='<?php echo esc_url(plugins_url( 'library/ace/ext-language_tools.js' , __FILE__ )); ?>'></script>

	<script src='<?php echo esc_url(plugins_url( 'js/sweetalert.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	<script src='<?php echo esc_url(plugins_url( 'js/yellow-pencil-'.YP_MODE.'.js?ver='.YP_VERSION.'' , __FILE__ )); ?>'></script>
	</body>
	</html><?php exit;

}



/* ---------------------------------------------------- */
/* Adding link to plugins page 							*/
/* ---------------------------------------------------- */
if(!defined('WTFV')){

	add_filter('plugin_row_meta', 'yp_plugin_links', 10, 2);

	function yp_plugin_links($links, $file){

		if ( $file == plugin_basename(dirname(__FILE__).'/yellow-pencil.php') ) {
			$links[] = '<a href="http://waspthemes.com/yellow-pencil/buy">' . __('Get Premium', 'yp') . '</a>';
		}

		return $links;

	}

}


function yp_encode( $value ) {

  $func = 'base64' . '_encode';
  return $func( $value );
  
}

function yp_decode( $value ) {

  $func = 'base64' . '_decode';
  return $func( $value );
  
}

// Getting all plugin options by prefix
function yp_get_all_options($prefix = '', $en = false){

	global $wpdb;
	$ret = array();
	$options = $wpdb->get_results($wpdb->prepare("SELECT option_name,option_value FROM {$wpdb->options} WHERE option_name LIKE %s",$prefix.'%'),ARRAY_A);

	if(!empty($options)){
		foreach ($options as $v) {
			if(strstr($v['option_name'],'wt_theme') == false && strstr($v['option_name'],'wt_available_version') == false && strstr($v['option_name'],'wt_last_check_version') == false){
				if($en == true){
					$ret[$v['option_name']] = yp_encode(stripslashes($v['option_value']));
				}else{
					$ret[$v['option_name']] = stripslashes($v['option_value']);
				}
			}
		}
	}

	return (!empty($ret)) ? $ret : false;

}

// Getting all post meta data by prefix.
function yp_get_all_post_options($prefix = '', $en = false){

	global $wpdb;
	$ret = array();
	$options = $wpdb->get_results($wpdb->prepare("SELECT post_id,meta_key,meta_value FROM {$wpdb->postmeta} WHERE meta_key LIKE %s",$prefix.'%'),ARRAY_A);

	if(!empty($options)){
		foreach ($options as $v) {
			if($en == true){
				$ret[$v['post_id'].".".$v['meta_key']] = yp_encode(stripslashes($v['meta_value']));
			}else{
				$ret[$v['post_id'].".".$v['meta_key']] = stripslashes($v['meta_value']);
			}
	}
	}

	return (!empty($ret)) ? $ret : false;

}

// Creating a json data.
function yp_get_export_data(){

	$allData = array();
	$postmeta_CSS = yp_get_all_post_options('_wt_css',true);
	$postmeta_HTML = yp_get_all_post_options('_wt_styles',true);
	$option_Data = yp_get_all_options('wt_',true);
	$option_Anims = yp_get_all_options('yp_anim',true);

	if(is_array($postmeta_CSS)){
		array_push($allData,$postmeta_CSS);
	}

	if(is_array($postmeta_HTML)){
		array_push($allData,$postmeta_HTML);
	}

	if(is_array($option_Data)){
		array_push($allData,$option_Data);
	}

	if(is_array($option_Anims)){
		array_push($allData,$option_Anims);
	}

	if(empty($allData) == false){
		$data = array_values($allData);	
		$jsonData = json_encode($data);
		return $jsonData;
	}

	return false;

}

// Creating all CSS.
function yp_get_export_css(){

	$allData = array();
	$postmeta_CSS = yp_get_all_post_options('_wt_css',false);
	$option_Data = yp_get_all_options('wt_',false);
	$option_Anims = yp_get_all_options('yp_anim',false);

	if(is_array($postmeta_CSS)){
		array_push($allData,$postmeta_CSS);
	}

	if(is_array($option_Data)){
		array_push($allData,$option_Data);
	}

	if(is_array($option_Anims)){
		array_push($allData,$option_Anims);
	}

	if(empty($allData) == false){
		$data = array_values($allData);

		$output = null;
		$table = array();
		$tableIndex = 0;
		foreach ($data as $nodes){
			foreach ($nodes as $key => $css){
			$tableIndex++;

				// If post meta
				if(strstr($key, '._')){

					$keyArray = explode(".", $key);
					$postID = $keyArray[0];
					$title = '"'.ucfirst(get_the_title($postID)).'" '.ucfirst(get_post_type($postID)).' Style';

				}else{

					if($key == 'wt_css'){
						$title = 'Global Styles';
					}else if($key == 'wt_author_css'){
						$title = 'Author Page Styles';
					}else if($key == 'wt_category_css'){
						$title = 'Category Page Styles';
					}else if($key == 'wt_tag_css'){
						$title = 'Tag Page Styles';
					}else if($key == 'wt_404_css'){
						$title = '404 Error Page Styles';
					}else if($key == 'wt_search_css'){
						$title = 'Search Page Styles';
					}else if($key == 'wt_home_css'){
						$title = 'Home Page Styles';
					}

					else if(strstr($key, 'yp_anim')){
						$title = str_replace("yp_anim_", "", $key);
						$title = $title." Animate";
					}else if(strstr($key, 'wt_') && strstr($key, '_css')){
						$title = str_replace("wt_", "", $key);
						$title = str_replace("_css", "", $title)." Template Style";
					}

				}

				if(!strstr($key, '_styles')){
					$len = 48-(strlen($title)+2);
					$extra = null;

					for ($i=1; $i < $len; $i++){
						$extra .= ' ';
					}

					array_push($table, ucfirst($title));
					$output .= "/*-----------------------------------------------*/\r\n";
					$output .= "/*  ".ucfirst($title)."".$extra."*/\r\n";
					$output .= "/*-----------------------------------------------*/\r\n";
					$output .= $css."\r\n\r\n\r\n";

				}

			}
		}

	}

	$tableList = null;
	foreach ($table as $key => $value) {
		$tableList .= "    ".sprintf("%02d", $key+1).". ".$value."\r\n";
	}



	$allOutPut = "/*\r\n    Following CSS codes created by Yellow Pencil plugin.\r\n";
	$allOutPut .= "    PS: Don't add following codes into your theme because all styles will work as global.\r\n*/\r\n\r\n\r\n";
	$allOutPut .= "/*  T A B L E   O F   C O N T E N T S\r\n";
	$allOutPut .= "    ........................................................................\r\n\r\n";
	$allOutPut .= $tableList;
	$allOutPut .= "\r\n*/\r\n\r\n\r\n";
	$allOutPut .= $output;

	return $allOutPut;

}

// Import json data.
function yp_import_data($json){

	$json = stripslashes($json);

	if(empty($json)){
		return false;
	}

	$array = json_decode($json,true);

	foreach ($array as $nodes){

		foreach ($nodes as $key => $value){

			$value = yp_decode($value);

			// If post meta
			if(strstr($key, '._')){

				$keyArray = explode(".", $key);
				$postID = $keyArray[0];
				$metaKey = $keyArray[1];

				if(!add_post_meta($postID, $metaKey,$value,true)){
				   update_post_meta($postID,$metaKey,$value);
				}

			}else{ // else option
				if(!update_option($key,$value)){
					add_option($key,$value);
				}
			}

		}

	}

}


/* ---------------------------------------------------- */
/* Adding YP Source Page 	 							*/
/* ---------------------------------------------------- */
add_action('admin_menu', 'register_yp_source_page');

function register_yp_source_page() {
	add_submenu_page( 'options-general.php', __('Yellow Pencil Source','yp'), __('Yellow Pencil Source','yp'), 'edit_theme_options', 'yp-options', 'yp_options' );
}


/* ---------------------------------------------------- */
/* Export CSS as style.css 	 							*/
/* ---------------------------------------------------- */
if(isset($_GET['yp_exportCSS'])){

	if($_GET['yp_exportCSS'] == 'true'){

	$data = yp_get_export_css();

	header('Content-Disposition: attachment; filename="style-'.strtolower(date("Y-M-d")).'.css"');
	header("Content-type: text/css; charset: UTF-8");
	header('Content-Length: ' . strlen($data));
	header('Connection: close');

	echo $data;

	die();

	}

}


/* ---------------------------------------------------- */
/* YP Source Page 	 									*/
/* ---------------------------------------------------- */
function yp_options() {

	// Can?
	if(current_user_can("edit_theme_options") == true){

		// Reset global data.
		if(isset($_GET['yp_reset_global'])){
			delete_option('wt_css');
			delete_option('wt_styles');
		}

		if(isset($_GET['yp_delete_animate'])){
			delete_option($_GET['yp_delete_animate']);
		}

		// Reset Post type.
		if(isset($_GET['yp_reset_type'])){
			delete_option('wt_'.$_GET['yp_reset_type'].'_css');
			delete_option('wt_'.$_GET['yp_reset_type'].'_styles');
		}

		// Reset by id.
		if(isset($_GET['yp_reset_id'])){
			delete_post_meta($_GET['yp_reset_id'],'_wt_css');
			delete_post_meta($_GET['yp_reset_id'],'_wt_styles');
		}

		// Updated.
		if(isset($_GET['yp_reset_global']) || isset($_GET['yp_reset_id']) || isset($_GET['yp_reset_type']) || isset($_GET['yp_delete_animate'])){
			echo "<script type='text/javascript'>window.location = '".admin_url('options-general.php?page=yp-options&yp_updated=true')."';</script>";
		}

		// Import the data
		if(isset($_POST['yp_json_import_data'])){

			$data = $_POST['yp_json_import_data'];

			if(empty($data) == false){
				yp_import_data($data);
			}

		}

	}

	// Updated message.
	if(isset($_GET['yp_updated'])){
		?>
			<div id="message" class="updated">
		        <p><strong><?php _e('Settings saved.') ?></strong></p>
		    </div>
		<?php
	}

	?>

	<div class="wrap">
	 
		<h2>Yellow Pencil CSS Source</h2>

		<p><?php _e('You will see all customized pages at below. You can delete and customize to them.','yp'); ?></p>

		<div class="yp-code-group">

		<ul>

			<?php $count = 0; if(get_option("wt_css") != ''){ $count = 1; ?>
				<li>
						<span class="yp-title"><?php _e('Global','yp'); ?></span>
						<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_global=true'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>

						<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(get_home_url().'/')); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>

						<span class="yp-clearfix"></span>
					</li>
			<?php } ?>

			<?php

				$post_types = get_post_types();
				foreach ($post_types as $post_type){

					if(get_option("wt_".$post_type."_css") != ''){

					$count = 1;

					$last_post = wp_get_recent_posts(array("post_status" => "publish","numberposts" => 1, "post_type" => $post_type));
					if(empty($last_post) == false){
						$last_post_id = $last_post['0']['ID'];
					}
				?>
					<li>
						<span class="yp-title"><?php _e('Single','yp'); ?> <?php echo ucfirst($post_type); ?> <?php _e('Template','yp'); ?></span>
						<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type='.$post_type.''); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>

						<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(get_the_permalink($last_post_id)).'&yp_type='.$post_type.''); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>

						<span class="yp-clearfix"></span>
					</li>

				<?php
					}

				}
			?>

			<?php if(get_option("wt_home_css") != ''){

			$frontpage_id = get_option('page_on_front');
			if($frontpage_id == 0 || $frontpage_id == null){ ?>
			<li>
				<span class="yp-title">Home Page</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=home'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_home_url().'/')).'&yp_type=home'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } } ?>

			<?php if(get_option("wt_search_css") != ''){ ?>
			<li>
				<span class="yp-title">Search Template</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=search'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_home_url().'/?s='.yp_getting_last_post_title().'')).'&yp_type=search'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } ?>

			<?php if(get_option("wt_404_css") != ''){ ?>
			<li>
				<span class="yp-title">404 Template</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=404'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_home_url().'/?p=987654321')).'&yp_type=404'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } ?>

			<?php if(get_option("wt_tag_css") != ''){ ?>
			<?php

			$tag_id = '';
			$tags = get_tags(array('orderby' => 'count', 'order' => 'DESC','number'=> 1 ));
			if(empty($tags) == false){
				$tag_id = $tags[0];
			}

			?>
			<li>
				<span class="yp-title">Tag Template</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=tag'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_tag_link($tag_id))).'&yp_type=tag'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } ?>

			<?php if(get_option("wt_category_css") != ''){ ?>
			<?php

			$cat_id = '';
			$cats = get_categories(array('orderby' => 'count', 'order' => 'DESC','number'=> 1 ));
			if(empty($cats) == false){
				$cat_id = $cats[0];
			}

			?>
			<li>
				<span class="yp-title">Category Template</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=category'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_category_link($cat_id))).'&yp_type=category'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } ?>

			<?php if(get_option("wt_author_css") != ''){ ?>
			<li>
				<span class="yp-title">Author Template</span>
				<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_type=author'); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
				<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(esc_url(get_author_posts_url(1))).'&yp_type=author'); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>
				<span class="yp-clearfix"></span>
			</li>
			<?php } ?>

			<?php

				global $wpdb;
				$querystr = "SELECT * FROM `$wpdb->postmeta` WHERE `meta_key` LIKE '_wt_css'";
				$pageposts = $wpdb->get_results($querystr, OBJECT);

				if($pageposts):

					global $post;

					foreach ($pageposts as $post):

					$id = $post->post_id;
					$title = "'".ucfirst(get_the_title($id))."'";

					if($title == "''"){
						$title = '(Unknown)';
					}

					if(get_post_meta($id, '_wt_css', true) != ''){
					$count = 1;
					?>

						<li>
							<span class="yp-title"><?php echo $title; ?> <?php echo ucfirst(get_post_type($id)); ?></span>
							<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_reset_id='.$id.''); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>

							<a class="yp-customize" href="<?php echo admin_url('admin.php?page=yellow-pencil-editor&href='.yp_urlencode(get_the_permalink($id)).'&yp_id='.$id.''); ?>"><span class="dashicons dashicons-edit"></span> <?php _e('Customize','yp'); ?></a>

							<span class="yp-clearfix"></span>
						</li>

					<?php
					}

					endforeach;

				endif;
				wp_reset_query();

			?>

			<?php

				if(0 == $count){
					echo '<li>'.__("No CSS Source! First, customize something on your website.","yp").'</li>';
				}

			?>

		</ul>

		<?php if($count > 0){ ?>
		<p><a href="<?php echo admin_url('options-general.php?page=yp-options&yp_exportCSS=true'); ?>" class="button">Download</a> all style codes as ready to use.</p>	
		<?php } ?>

		</div>

		<hr style="margin-top: 50px;margin-bottom: 25px;">

		<h2>Custom Animations</h2>

		<p><?php _e('You will see all custom animations pages at below. You can delete and customize to them.','yp'); ?></p>

		<div class="yp-code-group">

		<ul>

			<?php

				$countAnim = 0;

				$all_options =  wp_load_alloptions();
				foreach($all_options as $name => $value){
					if(stristr($name, 'yp_anim')){
						$countAnim = $countAnim+1;
						$name = str_replace("yp_anim_", "", $name);
						?>
						<li>
						<span class="yp-title"><?php echo ucwords(strtolower($name)); ?></span>
						<a class="yp-remove" onclick="return confirm('<?php _e("Are you sure?","yp"); ?>')" href="<?php echo admin_url('options-general.php?page=yp-options&yp_delete_animate=yp_anim_'.$name.''); ?>"><span class="dashicons dashicons-no"></span> <?php _e('Delete','yp'); ?></a>
						<span class="yp-clearfix"></span>
						</li>
						<?php
					}
				}

				if(0 == $countAnim){
					echo '<li>'.__("No custom animations! First, create several animations!","yp").'</li>';
				}

			?>
			

		</ul>

		
		</div>

		<hr style="margin-top: 50px;margin-bottom: 25px;">

		<h2>Export</h2>
		<p>Copy what appears to be a random string of alpha numeric characters into this textarea<br />and paste to Import textarea on another web site.</p>
		<div class="yp-export-section">
			<textarea rows="6" class="yp-admin-textarea"><?php echo yp_get_export_data(); ?></textarea>
		</div>

		<hr style="margin-top: 50px;margin-bottom: 25px;">

		<h2>Import</h2>
		<p>Paste your exported data into this textarea and click "Import Styles" button.</p>
		<form method="POST">
			<div class="yp-import-section">
				<textarea name="yp_json_import_data" rows="6" class="yp-admin-textarea"></textarea>
			</div>
			<input type="submit" class="button-primary" value="Import Styles" />
		</form>

		</div>
	<?php

}


// @WaspThemes.
// Coded With Love..


register_activation_hook( __FILE__, 'welcome_screen_activate' );
function welcome_screen_activate() {
  set_transient( '_welcome_screen_activation_redirect', true, 30 );
}

add_action( 'admin_init', 'welcome_screen_do_activation_redirect' );
function welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to bbPress about page
  wp_safe_redirect( add_query_arg( array( 'page' => 'yp-welcome-screen' ), admin_url( 'index.php' ) ) );

}

add_action('admin_menu', 'welcome_screen_pages');

function welcome_screen_pages() {
  add_dashboard_page(
    'Welcome To Yellow Pencil',
    'Welcome To Yellow Pencil',
    'read',
    'yp-welcome-screen',
    'yp_welcome_screen_content'
  );
}

function yp_welcome_screen_content(){
  ?>
  <div class="wrap yp-page-welcome about-wrap">
	<h1>Welcome to Yellow Pencil <?php echo YP_VERSION; ?></h1>

	<div class="about-text">
		Congratulations! You are about to use most powerful design tool for WordPress ever - Yellow Pencil Style Editor Plugin by WaspThemes.</div>
	<div class="wp-badge yp-badge">Version <?php echo YP_VERSION; ?></div>
	<p>
		<a href="<?php echo admin_url('themes.php?page=yellow-pencil'); ?>" class="button button-primary button-large">let's start!</a>
	</p>
	<h2 class="nav-tab-wrapper">
			<a href="<?php echo admin_url('index.php?page=yp-welcome-screen'); ?>" class="nav-tab<?php if(isset($_GET['tab']) == false){ ?> nav-tab-active<?php } ?>">Hello</a>
			<a href="<?php echo admin_url('index.php?page=yp-welcome-screen&tab=resources'); ?>" class="nav-tab<?php if(isset($_GET['tab']) == true){ ?> nav-tab-active<?php } ?>">Resources</a>
	</h2>

	<?php if(isset($_GET['tab']) == false){ ?>
	<div class="yp-welcome-tab">

		<img class="yp-featured-img" src="<?php echo WT_PLUGIN_URL; ?>images/promo.png" />

		<div class="yp-right-content">
			<h3>Front-End Design Tool For WordPress!</h3>
			<p>Yellow Pencil is advanced visual CSS style editor wordpress plugin that you can customize your website in real-time with a few clicks. Yellow Pencil works with any theme and plugin.</p>

			<p>Today become a professional web designer and personalizing your website in a few mins!</p>

			<h3>What's New?</h3>
			Take a look to <a href="http://waspthemes.com/yellow-pencil/inc/changelog.txt" target="_blank">changelog</a> for see all details about new updates.
		</div>
		<div class="clear"></div>

	</div>
	<?php }else{ ?>
	<div class="yp-welcome-tab">

		<div class="yp-resources-left">
			<h3>Resources</h3>
			<ul>
				<li><a href="http://waspthemes.com/yellow-pencil/" target="_blank">Official Website</a></li>
				<li><a href="http://waspthemes.com/yellow-pencil/inc/Documentation/" target="_blank">Documentation</a></li>
				<li><a href="https://www.youtube.com/channel/UCKGdPyfmphEdBWPXR91GnYQ" target="_blank">Tutorials</a></li>
				<li><a href="http://waspthemes.com/yellow-pencil/inc/changelog.txt" target="_blank">Changelogs</a></li>
				<li><a href="https://www.facebook.com/waspthemes/" target="_blank">Facebook page</a></li>
				<li><a href="https://waspthemes.ticksy.com/" target="_blank">Official support</a></li>
			</ul>
		</div>

		<div class="yp-resources-right">
			<h3>Versions</h3>
			
			<ul>
				<li><a href="https://wordpress.org/plugins/yellow-pencil-visual-theme-customizer/" target="_blank">Get Lite Version (Free)</a></li>
				<li><a href="http://codecanyon.net/item/yellow-pencil-visual-customizer-for-wordpress/11322180?ref=WaspThemes" target="_blank">Get Pro Version</a></li>
			</ul>

			<h3>Licenses</h3>
			
			<ul>
				<li><a href="http://themeforest.net/licenses/terms/regular" target="_blank">Regular Licence</a></li>
				<li><a href="http://themeforest.net/licenses/terms/extended" target="_blank">Extended Licence</a></li>
			</ul>

		</div>
		<div class="clear"></div>

	</div>
	<?php } ?>

	<?php if(isset($_GET['tab']) == false){ ?>
	<div class="yp-welcome-feature feature-section">

		<div class="yp-column">
			<img class="yp-img-center" src="<?php echo WT_PLUGIN_URL; ?>images/promo-1.png">
			
			<div class="yp-feature-column">
				<h4>Customize Your Website!</h4>
				<p>Edit colors, fonts, sizes and others with a few click for all screen sizes. <a href="<?php echo admin_url('themes.php?page=yellow-pencil'); ?>">start to visual customizing</a>.</p>
			</div>

		</div>

		<div class="yp-column">
			<img class="yp-img-center" src="<?php echo WT_PLUGIN_URL; ?>images/promo-2.png">
			
			<div class="yp-feature-column">
				<h4>Manage Style Sources</h4>
				<p>Keep site design in your control, You always can manage style sources from <a href="<?php echo admin_url('options-general.php?page=yp-options'); ?>">this page</a>.</p>
			</div>

		</div>

		<div class="yp-column">
			<img class="yp-img-center" src="<?php echo WT_PLUGIN_URL; ?>images/promo-3.png">
			
			<div class="yp-feature-column">
				<h4>Help & Support!</h4>
				<p>You must read all plugin documentation for learn how this works, Only 3 mins to read! <a target="_blank" href="http://waspthemes.com/yellow-pencil/inc/Documentation/">plugin docs</a>.</p>
			</div>

		</div>

		<div class="clear"></div>

	</div>

	<p class="yp-thank-you">Thank you for choosing Yellow Pencil,<br>Made By WaspThemes.</p>
	<?php } ?>

</div>
  <?php
}

add_action( 'admin_head', 'welcome_screen_remove_menus' );
function welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'yp-welcome-screen' );
}