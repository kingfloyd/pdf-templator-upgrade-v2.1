<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function pdftpl2_add_custom_box($postType) {


				
			add_meta_box( 'metabox', __( 'Article Size', 'pdftpl2' ),  'pdftpl2_post_custom_box', $postType, 'side', 'high');

}

function pdftpl2_post_custom_box() {
	global $post;
?>
<input type="hidden" name="pdftpl2_noncename" id="pdftpl2_noncename" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ) ?>" />
<table>
    <tr>
        <td>
            <label for="pdftpl2_new_field"><?php echo __("Article Size:", 'pdftpl2' ) ?></label>
        </td>
	    <td>
			
			<select class="form-control" name="pdftpl2_article_size">
				<option <?php if(get_post_meta($post->ID, "pdftpl2_article_size", true)=="All Sizes"): echo "selected"; endif ?>>All Sizes</option>
				<option <?php if(get_post_meta($post->ID, "pdftpl2_article_size", true)=="Quarter Page"): echo "selected"; endif ?>>Quarter Page</option>
				<option <?php if(get_post_meta($post->ID, "pdftpl2_article_size", true)=="Half Page"): echo "selected"; endif ?>>Half Page</option>
			  </select>
      	</td>
   	</tr>
    <tr><td colspan="2"><br></td></tr>
</table>
<?php }


function pdftpl2_save_postdata( $post_id ) {

	if ( !wp_verify_nonce( sanitize_text_field($_POST['pdftpl2_noncename']), plugin_basename(__FILE__) )) {
    	return $post_id;
  	}

  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    	return $post_id;

	if ( 'page' == $_POST['post_type'] ) {
    	if ( !current_user_can( 'edit_page', $post_id ) )
     		 return $post_id;
  	} else {
    	if ( !current_user_can( 'edit_post', $post_id ) )
      		return $post_id;
  	}

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	if (!get_post_meta($post_id, "pdftpl2_article_size")) {
		add_post_meta($post_id, "pdftpl2_article_size", sanitize_text_field($_POST["pdftpl2_article_size"]));
  	}else{
  		update_post_meta($post_id, "pdftpl2_article_size", sanitize_text_field($_POST["pdftpl2_article_size"]));
  	}
	if ($_POST["pdftpl2_article_size"] == "") {
		  delete_post_meta($post_id, "pdftpl2_article_size");
	}

}



// Metabox
add_action('add_meta_boxes', 'pdftpl2_add_custom_box');
add_action('save_post', 'pdftpl2_save_postdata');