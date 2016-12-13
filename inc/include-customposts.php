<?php
// Pdf Template
function pdftvtpl2_posts() 
{
  $labels = array(
    'name' => _x('Pdf Template', 'post type general name'),
    'singular_name' => _x('Pdf Template', 'post type singular name'),
    'add_new' => _x('Add New', 'Pdf Template'),
    'add_new_item' => __('Add New Pdf Template'),
    'edit_item' => __('Edit Pdf Template'),
    'new_item' => __('New Pdf Template'),
    'all_items' => __('All Pdf Template'),
    'view_item' => __('View Pdf Template'),
    'search_items' => __('Search Pdf Template'),
    'not_found' =>  __('No Pdf Template found'),
    'not_found_in_trash' => __('No Pdf Template found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Pdf Template'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 4,
	'menu_icon' => 'dashicons-list-view',
    'supports' => array('title')
  ); 
  register_post_type('pdftvtpl2',$args);
  

  $labels = array(
    'name' => _x( 'Pdf Template Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Pdf Template Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Pdf Template Type' ),
    'all_items' => __( 'All Pdf Template Type' ),
    'parent_item' => __( 'Parent Pdf Template Type' ),
    'parent_item_colon' => __( 'Parent Pdf Template Type:' ),
    'edit_item' => __( 'Edit Pdf Template Type' ), 
    'update_item' => __( 'Update Pdf Template Type' ),
    'add_new_item' => __( 'Add New Pdf Template Type' ),
    'new_item_name' => __( 'New Pdf Template Type Name' ),
    'menu_name' => __( 'Pdf Template Type' ),
  ); 	
  register_taxonomy('Pdf Template-type', 'Pdf Template', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pdftvtpl2-taxonomy' ),
  ));
  
  flush_rewrite_rules();
  

	$labels = array(
    'name' => _x('Readymade Content', 'post type general name'),
    'singular_name' => _x('Readymade Content', 'post type singular name'),
    'add_new' => _x('Add New', 'Readymade Content'),
    'add_new_item' => __('Add New Readymade Content'),
    'edit_item' => __('Edit Readymade Content'),
    'new_item' => __('New Readymade Content'),
    'all_items' => __('All Readymade Content'),
    'view_item' => __('View Readymade Content'),
    'search_items' => __('Search Readymade Content'),
    'not_found' =>  __('No Readymade Content found'),
    'not_found_in_trash' => __('No Readymade Content found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Readymade Content'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => 4,
	'menu_icon' => 'dashicons-list-view',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
  ); 
  register_post_type('pdfreadymadecontent',$args);
  

  $labels = array(
    'name' => _x( 'Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Readymade Content Category' ),
    'all_items' => __( 'All Readymade Content Category' ),
    'parent_item' => __( 'Parent Readymade Content Category' ),
    'parent_item_colon' => __( 'Parent Readymade Content Category:' ),
    'edit_item' => __( 'Edit Readymade Content Category' ), 
    'update_item' => __( 'Update Readymade Content Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Readymade Content Category Name' ),
    'menu_name' => __( 'Category' ),
  ); 	
  register_taxonomy('pdfReadymade', 'pdfreadymadecontent', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pdfreadymadecontent-taxonomy' ),
  ));
  
  flush_rewrite_rules();  
  
  

	$labels = array(
    'name' => _x('Advertisement', 'post type general name'),
    'singular_name' => _x('Advertisement', 'post type singular name'),
    'add_new' => _x('Add New', 'Advertisement'),
    'add_new_item' => __('Add New Advertisement'),
    'edit_item' => __('Edit Advertisement'),
    'new_item' => __('New Advertisement'),
    'all_items' => __('All Advertisement'),
    'view_item' => __('View Advertisement'),
    'search_items' => __('Search Advertisement'),
    'not_found' =>  __('No Advertisement found'),
    'not_found_in_trash' => __('No Advertisement found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Advertisement'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => 4,
	'menu_icon' => 'dashicons-list-view',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
  ); 
  register_post_type('pdfcr-advertisement',$args);
  

  $labels = array(
    'name' => _x( 'Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Advertisement Category' ),
    'all_items' => __( 'All Advertisement Category' ),
    'parent_item' => __( 'Parent Advertisement Category' ),
    'parent_item_colon' => __( 'Parent Advertisement Category:' ),
    'edit_item' => __( 'Edit Advertisement Category' ), 
    'update_item' => __( 'Update Advertisement Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Advertisement Category Name' ),
    'menu_name' => __( 'Category' ),
  ); 	
  register_taxonomy('pdftpl2advertisement', 'pdfcr-advertisement', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pdfcr-advertisement-taxonomy' ),
  ));
  
  flush_rewrite_rules();  
    
  
}

?>