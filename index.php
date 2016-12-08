<?php
/**
 * Plugin Name: PDF Templator Upgrade V2
 * Plugin URI: http://zerausmindtech.epizy.com/
 * Description: Tool to create templates to turn into pdfs
 * Version: 1.0
 * Author: Floyd Patulot
 * Author URI: http://zerausmindtech.epizy.com/
 * License: All rights reserved??
 */

/**
 * This is the main dir path of the plugin
 */
define('pdftvtpl2_plugin_path', plugin_dir_path( __FILE__ )); // Example: /home/user/var/www/wordpress/wp-content/plugins/my-plugin/

define('PREMETA','pdftvtpl2_');
/**
 * This is the main dir path of the plugin
 */
define('pdftvtpl2_plugin_url', get_site_url() . '/wp-content/plugins/pdf-templator-upgrade-v2.1'); // Example: /home/user/var/www/wordpress/wp-content/plugins/my-plugin/

/**
 * Here you can setup settings of the plugin
 */
if(!function_exists('wp_get_current_user')) {include(ABSPATH . "wp-includes/pluggable.php");}


function pdftvtpl2__plugin_activate() {
			//page to be created when install
			global $wpdb;

			
			//create parent post
			
			// Gather post data.
			$my_post = array(
			'post_title'    => "Create Newsletter",
			'post_type'     => 'page',
			//'post_name'     => $slug,
			'post_content'  => '[PDFTVTPL2]',
			'post_status'   => 'publish',
			'post_author'   => get_current_user_id(),
			);

			// Insert the post into the database.
			$parentpost_id = wp_insert_post( $my_post );	
			
			update_option( PREMETA.'news_letter_page', $parentpost_id);
			
			if($parentpost_id !=""){

				$parentpost = get_post($parentpost_id); 
				$slug = $parentpost->post_name;
				$allpid[] = $slug;


			}			
			
						
			$pages_to_create = array('Pdf Template List');
			foreach($pages_to_create as $page){
				
				$slug = "".seoUrlfshen(strtolower($page));

				$postID = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='$slug'");

				if ($postID == '') {

					// Gather post data.
					$my_post = array(
					'post_title'    => 'Pdf Template List',
					'post_type'     => 'page',
					//'post_name'     => $slug,
					'post_parent' => $parentpost_id,
					'post_content'  => '[PDFTVTPL2_LISTING]',
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id(),
					);

					// Insert the post into the database.
					
					
					/* $post_id = wp_insert_post( $my_post );

					if($post_id!=""){

						$post = get_post($post_id); 
						$slug = $post->post_name;
						$allpid[] = $slug;


					} */

				}


			}


  /* activation code here */
  
  

  
  
}


register_activation_hook( __FILE__, 'pdftvtpl2__plugin_activate' );

register_uninstall_hook(__FILE__, 'pdftvtpl2__plugin_deactivate');

function pdftvtpl2__plugin_deactivate(){
		
	wp_delete_post( get_option(PREMETA.'news_letter_page') );
	delete_option( PREMETA.'news_letter_page' );
	
	die(get_option(PREMETA.'news_letter_page'));
	
}






/**
 * Require template
 */
require_once ("inc.functions.php");



function seoUrlfshen($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}




