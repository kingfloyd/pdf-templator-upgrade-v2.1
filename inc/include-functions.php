<?php

// declare array and call it as global
$user_id = get_current_user_id();
$pdftvtpl2_allfields_defaults_option = get_option('pdftvtpl2_allfields_defaults'.$user_id);

	$pdftvtpl2_allfields = array(
	"first_name"=>"first name",
	"last_name"=>"last name",
	"email"=>"email",
	"company"=>"company name", 
	"company_number"=>"company number", 
	"phone_number"=>"phone number", 
	"mobile_number"=>"mobile number", 
	"fax_number"=>"fax number",
	"town"=>"town", 
	"city"=>"city", 
	"county"=>"county", 
	"address"=>"address", 
	"address_2"=>"address 2", 
	"website"=>"website", 
	"title"=>"title", 
	"office_phone"=>"office phone", 
	"industry"=>"industry", 
	"birthday"=>"birthday", 
	"date"=>"date" ); 


if(empty($pdftvtpl2_allfields_defaults_option)){
		
	$pdftvtpl2_allfields_defaults = array(
	"first_name"=>"Friend",
	"last_name"=>"",
	"email"=>"your email",
	"company"=>"your company", 
	"company_number"=>"your company number", 
	"phone_number"=>"your phone number", 
	"mobile_number"=>"your mobile number", 
	"fax_number"=>"your fax number",
	"town"=>"your town", 
	"city"=>"your city", 
	"county"=>"your county", 
	"address"=>"your address", 
	"address_2"=>"your address 2", 
	"website"=>"your website", 
	"title"=>"your title", 
	"office_phone"=>"your office phone", 
	"industry"=>"your industry", 
	"birthday"=>"your birthday", 
	"date"=>"your date" ); 
	
	
}else{
	
	$pdftvtpl2_allfields_defaults = $pdftvtpl2_allfields_defaults_option;
	
	
}	

	$pdftvtpl2_short = array(
	
	"first_name",
	"last_name",
	"email",
	"company", 
	"company_number", 
	"phone_number", 
	"mobile_number", 
	"fax_number",
	"town", 
	"city", 
	"county", 
	"address", 
	"address_2", 
	"website", 
	"title", 
	"office_phone", 
	"industry", 
	"birthday", 
	"date" 
	
	); 	
	
	$pdftvtpl2_allfields_default = array(
	"full_name"=>"YOURDATA",
	"email"=>"YOURDATA",
	"company"=>"YOURDATA", 
	"company_number"=>"YOURDATA", 
	"phone_number"=>"YOURDATA", 
	"mobile_number"=>"YOURDATA", 
	"fax_number"=>"YOURDATA",
	"town"=>"YOURDATA", 
	"city"=>"YOURDATA", 
	"county"=>"YOURDATA", 
	"address"=>"YOURDATA", 
	"address_2"=>"YOURDATA", 
	"website"=>"YOURDATA", 
	"title"=>"YOURDATA", 
	"office_phone"=>"YOURDATA", 
	"industry"=>"YOURDATA", 
	"birthday"=>"YOURDATA", 
	"date"=>"YOURDATA" ); 	
	
//load plugin style
function pdftvtpl2_styles() {

	if(is_page('create-newsletter')  or is_page('pdf-template-list')){
		
	wp_enqueue_style('thickbox');	
	//wp_enqueue_style('pdftvtpl2-bootstrap-style', pdftvtpl2_plugin_url."/assets/css/bootstrap.min.css");
	wp_enqueue_style('pdftvtpl2-main-style', pdftvtpl2_plugin_url."/assets/css/main.css");
	wp_enqueue_style('pdftvtpl2-jqueryui-style', pdftvtpl2_plugin_url."/assets/jquery-ui/jquery-ui.css");
	
	}
	 
}

//load plugin scripts
function pdftvtpl2_scripts() {

		if(is_page('create-newsletter') or is_page('pdf-template-list')){
			
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			//wp_enqueue_script( 'pdftvtpl2-bootstrap-js', pdftvtpl2_plugin_url."/assets/js/bootstrap.min.js", array('jquery'), '3.3.7', true );
			//wp_enqueue_script( 'pdftvtpl2-jquery-ui', pdftvtpl2_plugin_url."/assets/jquery-ui/jquery-ui.js", array('jquery'), '3.3.7', true );
					
		}
}


//check if radios is checked
function checked_radio($postradioval,$radioval){	
	if($postradioval===$radioval){		
		echo "checked";		
	}		
}

//select dropdown post meta checker
function get_selected_meta($valuemeta=null,$value=null){
	if($valuemeta==$value){				
		return "selected";		
	}else{		
		return "";		
	}
}

//get_pdfnewsletter_meta
function get_pdfnewsletter_meta($pid,$metakey){	
	return get_post_meta($pid,$metakey,true);			
}



function get_option_select_pdftemplator($name=null,$value=null){
	
	$optionval = get_option($name);
	
	
	if($optionval==$value){		
		
		echo "selected='selected'";
		
	}	
}


//ajax calls

function prefix_ajax_get_postid($ptype) {
    
	$ptype= $_REQUEST['post_type'];
	$myposts = get_posts( array( 'post_type' => $ptype ) ); 
	$html = "<form action='' method='post' id='getPostContent'>";
	$html .=  "<select id='readymadepost'><option>---Select One---</option>";

	foreach ( $myposts as $post ) : setup_postdata( $post );
	
	$html .= "<option value='".$post->ID."'>".get_the_title($post->ID)."</option>";
	
	endforeach; 
	wp_reset_postdata();
	 $html .= "</select>";
	 $html .= "&nbsp; &nbsp; <input class='btn-primary btn' id='contentAdder' type='button' name='' value='Add content to editor'>";
	 $html .= "</form?>";
	 
	 echo $html;
	 
	 
	die();	
}

function prefix_ajax_get_postcontent($ptype) {
    
	$pid = $_REQUEST['post_content'];
	
	$post = get_post($pid );
	
							
		echo $content   = $post->post_content;

	 
	die();	
}


function prefix_ajax_get_readymadecontent($cat) {
    //echo  $_REQUEST['article_size'];
$catid = $_REQUEST['catid'];
if(isset($_REQUEST['pagenum'])){
	
$pagenum = $_REQUEST['pagenum']*4;
$currpage = $_REQUEST['pagenum'];

}else{

$pagenum = 4;	
$currpage = 1;
	
}	
$args = array(
	'post_type' => 'pdfreadymadecontent',
	'tax_query' => array(
		array(
			'taxonomy' => 'pdfReadymade',
			'field'    => 'term_id',
			'terms'    => $catid,
		),	
		//article_size
	),	
	'meta_query' => array(
		array(
			'key'     => 'pdftpl2_article_size',
			'value'   => $_REQUEST['article_size'],
			'compare' => '=',
		),
	),	
	'posts_per_page' => $pagenum
);
$query = new WP_Query( $args );


$i = 0;

?>


<div class="col-md-12">
<?php if ( $query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<?php $size = get_post_meta($query->post->ID,'pdftpl2_article_size',true); ?>
		<div class="col-md-3 readymadepost" id="readymadepost<?php echo $query->post->ID; ?>" style="margin-bottom:10px; height:100%; cursor:pointer;">
			<div class="media" style="border: 1px solid; min-height:290px;">
			  <div class="" style="width:250px;">
				<a href="javascript:void(0);" >
				  <?php echo get_the_post_thumbnail($query->post->ID, array("200","200") ); ?>
				</a>
				
				<?php if($size=="All Sizes"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/allsize.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php }elseif($size=="Quarter Page"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/quarter-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php }elseif($size=="Half Page"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/half-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php } ?>
				
				
			  </div>
			  <div class="media-body" style="padding:10px;">
				<p class="media-heading"><b><?php echo get_the_title($query->post->ID); ?></b></p><br /><br />
				<?php echo  substr( strip_tags( get_the_excerpt($query->post->ID) ), 0, 40 )."..."; ?>
				<a href=""></a>
			  </div>
			</div>
		</div>	
		
	<?php $i++; ?>
	<?php if($i==4){ ?>
	</div>
	<div class="col-md-12">
	<?php $i=0; } ?>
	<?php  endwhile; ?>
	<?php
	
	if($query->max_num_pages!=$_REQUEST['pagenum']){
		
		if($query->max_num_pages>1){
		echo "<br /><br /><p align='center'><a href='javascript:void(0);' id='rdyviewerarticles' data-pagi='$currpage'>View More Articles>></a></p>";
		}
		
	}
	
	
	?>
	<!-- end of the loop -->
</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<div class="col-md-12"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></div>
<?php endif; ?>
<?php
	 
	die();	
}


function prefix_ajax_get_pdftpl2advertisement($cat) {
    //echo  $_REQUEST['article_size'];
$catid = $_REQUEST['catid'];
if(isset($_REQUEST['pagenum'])){
	
$pagenum = $_REQUEST['pagenum']*4;
$currpage = $_REQUEST['pagenum'];

}else{

$pagenum = 4;	
$currpage = 1;
	
}	
$args = array(
	'post_type' => 'pdfcr-advertisement',
	'tax_query' => array(
		array(
			'taxonomy' => 'pdftpl2advertisement',
			'field'    => 'term_id',
			'terms'    => $catid,
		),	
		//article_size
	),	
/* 	'meta_query' => array(
		array(
			'key'     => 'pdftpl2_article_size',
			'value'   => $_REQUEST['article_size'],
			'compare' => '=',
		),
	),	 */
	'posts_per_page' => $pagenum
);
$query = new WP_Query( $args );


$i = 0;

?>


<div class="col-md-12">
<?php if ( $query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<?php $size = get_post_meta($query->post->ID,'pdftpl2_article_size',true); ?>
		<div class="col-md-3 addvertisementpost" id="addvertisementpost<?php echo $query->post->ID; ?>" style="margin-bottom:10px; height:100%; cursor:pointer;">
			<div class="media" style="border: 1px solid; min-height:290px;">
			  <div class="" style="width:250px;">
				<a href="javascript:void(0);" >
				  <?php echo get_the_post_thumbnail($query->post->ID, array("200","200") ); ?>
				</a>
				
				<?php if($size=="All Sizes"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/allsize.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php }elseif($size=="Quarter Page"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/quarter-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php }elseif($size=="Half Page"){ ?>
				
				<img src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/half-page.png" style="position: absolute; transform: translate(79%,-156%); width: 100px;" />
				
				<?php } ?>
				
				
			  </div>
			  <div class="media-body" style="padding:10px;">
				<p class="media-heading"><b><?php echo get_the_title($query->post->ID); ?></b></p><br /><br />
				<?php echo  substr( strip_tags( get_the_excerpt($query->post->ID) ), 0, 40 )."..."; ?>
				<a href=""></a>
			  </div>
			</div>
		</div>	
		
	<?php $i++; ?>
	<?php if($i==4){ ?>
	</div>
	<div class="col-md-12">
	<?php $i=0; } ?>
	<?php  endwhile; ?>
	<?php
	
	if($query->max_num_pages!=$_REQUEST['pagenum']){
		
		if($query->max_num_pages>1){
		echo "<br /><br /><p align='center'><a href='javascript:void(0);' id='rdyviewerarticles' data-pagi='$currpage'>View More Articles>></a></p>";
		}
		
	}
	
	
	?>
	<!-- end of the loop -->
</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<div class="col-md-12"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></div>
<?php endif; ?>
<?php
	 
	die();	
}


function pdftpl2_excerpt_filter( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'pdftpl2_excerpt_filter', 999 );

function prefix_ajax_get_readymadeinnercontent($cat) {

 $readymadeid = $_POST['readymadeid'];
 
$content_post = get_post($readymadeid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);


	echo "<div class='readymadecontentAppend' style='display:none;'>";
	echo $content;
	echo "</div>";

	die();

}


function prefix_ajax_get_advertisementinnercontent($cat) {

 $add = $_POST['readymadeid'];
 
$content_post = get_post($add);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);


	echo "<div class='advertisementcontentAppend' style='display:none;'>";
	echo $content;
	echo "</div>";

	die();

}




function pdftemplator_enqueue() {
	
	if($_REQUEST['newsletter_id']!=""){
		
		$nid = $_REQUEST['newsletter_id'];
	}else{
		
		$nid = 1;
		
	}
	
	wp_enqueue_script( 'ajax-script', pdftvtpl2_plugin_url."/assets/js/main.js", array('jquery'), '3.3.7', true );
    wp_localize_script( 'ajax-script', 'main_script_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'PDFsite_url'=>site_url(),'generatehttpurl'=>generate_pdftvtpl2_url(),'step'=>'step'.$nid,'newsletter_id'=>$nid ) );
			
}


function generate_pdftvtpl2_url(){
	global $pdftvtpl2_allfields_default;
	
	global $post;
	
	$data = site_url()."/create-newsletter?newsletter_id=".$_REQUEST['newsletter_id']."&".http_build_query($pdftvtpl2_allfields_default);
	
	return $data;
	

}

function get_csv_listing_head(){
	
	
	$data =  get_post_meta($_REQUEST['newsletter_id'],'customer_list_head',true);
	//print_r($data);
	if(is_array($data)){
	return $data = site_url()."/create-newsletter?newsletter_id=".$_REQUEST['newsletter_id']."&".http_build_query($data);
	}
	
}

function get_csv_listing($newsletterID){
	
	print_r(get_post_meta($_REQUEST['newsletter_id'],'customer_list',true));
	
	
	
}

//proccess step 1 up to 4 form
function process__pdftemplate_form(){	

	$pid = $_POST['pid'];	
	$user_id = get_current_user_id();
	
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	
	if(isset($_POST['readymadeentry'])){
		
		$readymadeentry_request = $_POST['readymadeentry'];
		
		if(intval($readymadeentry_request)==1){			
			$readymadeentry_cost = 0.35;			
		}elseif(intval($readymadeentry_request)==2){			
			$readymadeentry_cost = 0.70;			
		}elseif(intval($readymadeentry_request)>=3){
			$readymadeentry_cost = 1.00;		
		}	
		
		update_post_meta($pid, 'readymadeentry_cost', $readymadeentry_cost);
				
	}
	
	
	$pricing__newsletter_pagenum = get_post_meta($pid,'pricing__newsletter_pagenum',true);
	$pdftvtpl2_printing_type = get_post_meta($pid,'pdftvtpl2_printing_type',true);
	$pdftvtpl2_delivery_type = get_post_meta($pid,'pdftvtpl2_delivery_type',true);
	$pdftvtpl2_delivery_class = get_post_meta($pid,'pdftvtpl2_delivery_class',true);
	$pdftvtpl2_promotional_leaflets = get_post_meta($pid,'pdftvtpl2_promotional_leaflets',true);
	$pdftvtpl2_accompanying_letter = get_post_meta($pid,'pdftvtpl2_accompanying_letter',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	
	
	$totalprice = floatval($pricing__newsletter_pagenum) + floatval($pdftvtpl2_printing_type) + floatval($pdftvtpl2_delivery_type) + floatval($pdftvtpl2_delivery_class) + floatval($pdftvtpl2_promotional_leaflets) + floatval($pdftvtpl2_accompanying_letter) + floatval($readymadeentry_cost);
	
	
	
	
	if($totalprice!=""){	
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));	
	}



	$totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');
	
	echo $submit_return = "<div class='alert-success alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Data saved!<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";
		
		
	if(isset($_POST['templateorfile'])){
		
		if($_POST['templateorfile']=="file"){
			
			update_post_meta($pid, 'saved_as_file', 1);	
			
			
		}
		
		if($_POST['templateorfile']=="template"){
			
			update_post_meta($pid, 'saved_as_template', 1);	
			
			
		}
		
		
	}	

	exit;
	
}



//process on radio select on step 3

function update_onradio(){
	
	
	$pid = $_POST['pid'];

	$user_id = get_current_user_id();
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	
	if(isset($_POST['readymadeentry'])){
		
		$readymadeentry_request = $_POST['readymadeentry'];
		
		if(intval($readymadeentry_request)==1){
			
			$readymadeentry_cost = 0.35;
			
		}elseif(intval($readymadeentry_request)==2){
			
			$readymadeentry_cost = 0.70;
			
		}elseif(intval($readymadeentry_request)>=3){

			$readymadeentry_cost = 1.00;
		
		}	
		
		update_post_meta($pid, 'readymadeentry_cost', $readymadeentry_cost);
		
		
	}
	
	if(isset($_POST['advertisemententry'])){
		
		$advertisemententry_request = $_POST['advertisemententry'];
		
		if(intval($advertisemententry_request)==1){
			
			$readymadeentry_cost = 0.35;
			
		}elseif(intval($advertisemententry_request)==2){
			
			$readymadeentry_cost = 0.70;
			
		}elseif(intval($advertisemententry_request)>=3){

			$readymadeentry_cost = 1.00;
		
		}	
		
		update_post_meta($pid, 'readymadeentry_cost', $readymadeentry_cost);
		
		
	}	
	
	$pricing__newsletter_pagenum = get_post_meta($pid,'pricing__newsletter_pagenum',true);
	$pdftvtpl2_printing_type = get_post_meta($pid,'pdftvtpl2_printing_type',true);
	$pdftvtpl2_delivery_type = get_post_meta($pid,'pdftvtpl2_delivery_type',true);
	$pdftvtpl2_delivery_class = get_post_meta($pid,'pdftvtpl2_delivery_class',true);
	$pdftvtpl2_promotional_leaflets = get_post_meta($pid,'pdftvtpl2_promotional_leaflets',true);
	$pdftvtpl2_accompanying_letter = get_post_meta($pid,'pdftvtpl2_accompanying_letter',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	
	
	$totalprice = floatval($pricing__newsletter_pagenum) + floatval($pdftvtpl2_printing_type) + floatval($pdftvtpl2_delivery_type) + floatval($pdftvtpl2_delivery_class) + floatval($pdftvtpl2_promotional_leaflets) + floatval($pdftvtpl2_accompanying_letter) + floatval($readymadeentry_cost);
	
	
	if($totalprice!=""){	
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));	
	}
	
	//echo $totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');
	echo number_format((float)$totalprice, 2, '.', '');

	exit;
	
}

//viewcsvlistbtn

function viewcsvlistbtn(){
	
$pid = $_POST['pid'];
	
$customer_list = get_post_meta($pid,'customer_list',true); /* echo "<pre>"; print_r($customer_list); echo "<pre>"; */ 
			
foreach($customer_list as $clist){ 
?>
		
	<li><input class="form-control" type="text" value="<?php echo site_url()."/create-newsletter?newsletter_id=".$pid."&".urldecode(http_build_query($clist))."&pdfpreview=1"; ?>" /></li>

<?php		
}

	
	
	exit;
	
}


//SUBMIT TO QUE



function submittoque(){
	
	
	$pid = $_POST['pid'];

	$user_id = get_current_user_id();
	global $current_user;
	get_currentuserinfo();	
	
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	

	$totalprice = number_format((float)get_post_meta($pid,'totalprice',true), 2, '.', '');



	/**
	 *  Example API POST call
	 *  Post a service to queue
	 */

	// type of service
	$service = 'autonewsletter';

	$data = array (
	 "partner_id" => $user_id,
	 "password" => '',
	 "deliver_to" => $current_user->user_firstname." ".$current_user->user_lastname,
	 "cost" => $totalprice,
	 "schedule" => date('m-d-y')
	);

	// api post url
	$url = 'http://connect.umbrellasupport.co.uk/'.$service.'/';

	// set up the curl resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	// execute the request
	$output = curl_exec($ch);

	// output the profile information - includes the header
	//echo '<pre>';
	
	$output = json_decode($output, true);
	

	if($output['success']==1){
	update_post_meta($pid, 'pdfgenerate', 1);
	}
	
	//echo($output) . PHP_EOL;
	//echo '</pre>';

	// close curl resource to free up system resources
	curl_close($ch);
	
	echo $submit_return = "<div class='alert-success alert returnDataprocess'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>Data submitted to que!<div id='hiddentotal' style='display:none;'>".$totalprice."</div></div>";

	
	exit;
	
}



// ADD NEW COLUMN
function ST4fim_columns_head($defaults) {
    $defaults['manufacturer_id'] = 'Manufacturer ID';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function ST4fim_columns_content($column_name, $post_ID) {
    if ($column_name == 'manufacturer_id') {
        $manufacturer_id = get_post_meta($post_ID,'manufacturer_id',true);
        if ($manufacturer_id) {
            echo $manufacturer_id;
        }
    }
}

add_filter('manage_toplevel_page_shopp-products_columns', 'ST4fim_columns_head', 10);
add_action('manage_shopp_product_posts_custom_column', 'ST4fim_columns_content', 10, 2);






function register_default_newsletter_shortcode_val(){
    add_menu_page( 
        __( 'Custom Menu Title', 'textdomain' ),
        'Newsletter Defaults',
        'manage_options',
        'pdftpl-default-news-values',
        'default_newsletter_shortcode_val',
        'dashicons-list-view',
        6
    ); 
}
add_action( 'admin_menu', 'register_default_newsletter_shortcode_val' );
 
/**
 * Display a custom menu page
 */
function default_newsletter_shortcode_val(){
	
	global $pdftvtpl2_allfields_defaults;

	$user_id = get_current_user_id();
	

	if(isset($_POST['pdftvtpl2_allfields_defaults_name'])){
		
	if ( !isset( $_POST['pdftvtpl2_allfields_defaults_name'] ) || !wp_verify_nonce( $_POST['pdftvtpl2_allfields_defaults_name'], 'pdftvtpl2_allfields_defaults' ) ) {

	   print 'Sorry, your nonce did not verify.';
	   exit;

	} else {
		
		 	
		unset($_POST['pdftvtpl2_allfields_defaults_name']);
		unset($_POST['_wp_http_referer']);
		unset($_POST['submit']);
		
		echo "<div class=\"notice notice-success is-dismissible\">
        <p>Option update done.</p>
		</div>";
		update_option( 'pdftvtpl2_allfields_defaults'.$user_id , $_POST );

	   // process form data
	}	
		
	}	
	$option = get_option('pdftvtpl2_allfields_defaults'.$user_id);
	
	
	
	
	
?>

<div class="wrap">
<h1>Default Newsletter Fields Value <a href="<?php echo site_url()."/create-newsletter/?newsletter_id=".$_GET['newsletter_id']; ?>">Back</a></h1>

<form method="post" action="">

    <table class="form-table">

        <?php if($option!=""){  ?>
				
			<?php 
			foreach($option as $key=>$val){
			?>  
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><input type="text" name="<?php echo $key; ?>" value="<?php echo $val; ?>" /></td>
			</tr>
			  <?php } ?>
			  
			<?php }else{ ?>

			<?php   foreach($pdftvtpl2_allfields_defaults as $key=>$val){ ?>	
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><input type="text" name="<?php echo $key; ?>" value="<?php echo $val; ?>" /></td>
			</tr>
			<?php } ?>	
			
		<?php } ?>	
		
		
    </table>
    <?php wp_nonce_field( 'pdftvtpl2_allfields_defaults', 'pdftvtpl2_allfields_defaults_name' ); ?>
    <?php submit_button(); ?>
	

</form>
</div>

<?php
}



function get_readymade_entry(){
	$pid= $_REQUEST['pid'];
	$readymadeentry = get_post_meta($pid,'readymadeentry',true);
	$readymadeentry_cost = get_post_meta($pid,'readymadeentry_cost',true);
	if($readymadeentry_cost==0){
		
		$readymadeentry_cost = '0.00';
		
	}else{
		
		$readymadeentry_cost = number_format((float)$readymadeentry_cost, 2, '.', '');
		
	}
	print_r('{"records":[{"count":"'.$readymadeentry.'","cost":"'.$readymadeentry_cost.'"}]}');
		
	
	die();
	
}


function get_advertisemet_entry(){
	$pid= $_REQUEST['pid'];
	$advertisemententry = get_post_meta($pid,'advertisemetentry',true);
	$advertisemententry_cost = get_post_meta($pid,'advertisemetentry_cost',true);
	if($advertisemententry_cost==0){
		
		$advertisemententry_cost = '0.00';
		
	}else{
		
		$advertisemententry_cost = number_format((float)$advertisemententry_cost, 2, '.', '');
		
	}
	print_r('{"records":[{"count":"'.$advertisemententry.'","cost":"'.$advertisemententry_cost.'"}]}');
		
	
	die();
	
}