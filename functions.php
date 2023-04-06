<?php

add_action( 'wp_enqueue_scripts', 'gazkom_styles' );
add_action( 'wp_enqueue_scripts', 'gazkom_scripts' );
add_action('wp_print_styles', 'load_fonts');
add_action('admin_init','true_apply_tags_for_pages');


function gazkom_styles(){
    wp_enqueue_style( "gazkom_styles", get_stylesheet_uri() );
    wp_enqueue_style( "gaz_styles", get_template_directory_uri() . '/styles/gaz_style.css');
    
}
function gazkom_scripts(){
    
     //wp_enqueue_script("jquery");
     wp_enqueue_script( "tab", get_template_directory_uri() . '/scripts/tab.js', '', null, true);
    
}

function load_fonts()
{            
wp_register_style('et-googleFonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap'); 
wp_enqueue_style( 'et-googleFonts');        
}    


add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );

add_filter( 'nav_menu_link_attributes', 'nav_menu_link_attributes_filter', 10, 3 );

function nav_menu_link_attributes_filter($atts, $item, $args){
    if($args->menu === "main"){
        $atts['class'] = "header__nav-item";
        if($item->current){
            $atts['class'] .= " header__nav-item-active";
        }
    }
    return $atts;
}

function true_apply_tags_for_pages(){
    
	add_meta_box( 'tagsdiv-post_tag', 'Теги', 'post_tags_meta_box', 'page', 'side', 'normal',array(
		'__back_compat_meta_box' => false,
	) ); // сначала добавляем метабокс меток
	register_taxonomy_for_object_type('post_tag', 'page');
    
}
 

 
function true_expanded_request_post_tags($q) {
	if (isset($q['tag'])) // если в запросе присутствует параметр метки
		$q['post_type'] = array('post', 'page');
	return $q;
}
 
add_filter('request', 'true_expanded_request_post_tags');


if( 'disable_gutenberg' ){
	//remove_theme_support( 'core-block-patterns' ); // WP 5.5

	add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

	// отключим подключение базовых css стилей для блоков
	// ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
	remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

	// Move the Privacy Policy help notice back under the title field.
	add_action( 'admin_init', function(){
		remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
		add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
	} );
}

if ( function_exists( 'add_image_size' ) ) {	
	add_image_size( 'product-thumb', 200, 200, true);
}