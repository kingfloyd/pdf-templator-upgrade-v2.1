<?php

global $post;
$pid = $_REQUEST['newsletter_id'];
$createpageid =  $post->ID;
if($_REQUEST['pdftvtpl2_newsletter_select_template']!=""){
	
$pid = $_REQUEST['pdftvtpl2_newsletter_select_template'];	
	
}


if(isset($_POST['goto_step2'])){
	
	$user_id = get_current_user_id();

	
	$my_post = array(
	'ID'           => $pid,
	'post_type'     => 'pdftvtpl2',
	'post_status'   => 'publish',
	'post_author'   => $user_id,
	);

	// Insert the post into the database.
	$pid = wp_update_post( $my_post );
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	update_post_meta($pid, 'step1', "true");
	update_post_meta($pid, 'step2', "true");
	
	$appendurl = "?newsletter_id=".$pid;
	
		if($_POST[PREMETA.'newsletter_template']!=""){
			
			$appendurl .= "&template=".$_POST[PREMETA.'newsletter_select_template'];
			
		}



	wp_redirect(get_the_permalink($createpageid )."/".$appendurl."&step2=true");

	$submit_return = "<div class='alert-success alert'>PDF Template saved!</div>";
	
	
}	


if(isset($_POST['save_for_later']) and $_POST['save_for_later']=="Save For Later"){
	
	$user_id = get_current_user_id();
	
/* 	$my_post = array(
      'ID'           => 37,
      'post_title'   => 'This is the post title.',
      'post_content' => 'This is the updated content.',
	);
	
	  wp_update_post( $my_post ); */
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	
	
	
	if(isset($_REQUEST['step1'])){
		
		$step = "&step1=true";
		update_post_meta($pid, 'step1', "true");
		
	}elseif(isset($_REQUEST['step2'])){
		
		$step .= "&step2=true";
		update_post_meta($pid, 'step2', "true");
		
	}elseif(isset($_REQUEST['step3'])){
		
		update_post_meta($pid, 'step3', "true");
		$step .= "&step3=true";
		
	}
	
	
	
	if($_REQUEST['pdftvtpl2_printing_type']=="Full Colour (£0.20)"){
		 
		$totalprice = 0.20;
		 
	 }	  
	 
	  
	  
	  //delivery type
	  //Self-Mailer (£0.10) A4 Transparent Wallet (£0.20)
	 if($_POST['pdftvtpl2_delivery_type']=="Self-Mailer (£0.10)"){
		 
		$totalprice = $totalprice + 0.10;
		
		
	 }elseif($_POST['pdftvtpl2_delivery_type']=="A4 Transparent Wallet (£0.20)"){	  
	 
		$totalprice = $totalprice + 0.20;
	 
	 }
	
	  	  
	  
	  //number of pages
	 if(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==4){
		 
		$totalprice = $totalprice + 0.60;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==8){
		 
		 $totalprice = $totalprice + 1.00;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==12){

		 $totalprice = $totalprice + 1.20;
		
	 }
	 
	 
	 //Delivery Class:
	 
	 if($_POST['pdftvtpl2_delivery_class']=="2nd Class Mail (£0.40)"){
		 
		 $totalprice = $totalprice + 0.40;
		 
	 }elseif($_POST['pdftvtpl2_delivery_class']=="1st Class Mail (£0.55)"){
	 
		$totalprice = $totalprice + 0.55;
	 
	}
	
	//Accompanying Letter:

	 if($_POST['pdftvtpl2_accompanying_letter']=="Yes (£0.15 Discount)"){
		 
		 $totalprice = $totalprice + 0.15;
		 
	 }
	 
	 
	 //Allow up to 2 Promotional Leaflets:

	 if($_POST['pdftvtpl2_promotional_leaflets']=="Yes (£0.20 Discount)"){
		 
		 $totalprice = $totalprice + 0.20;
		 
	 }	 
	
	if($totalprice!=""){	
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));	
	}
	$appendurl = "?newsletter_id=".$pid;


	$submit_return = "<div class='alert-success alert'>PDF Template saved!</div>";
	
	
}	



if(isset($_POST['save_for_later']) and $_POST['save_for_later']=="Continue"){
	
	$user_id = get_current_user_id();
	
/* 	$my_post = array(
      'ID'           => 37,
      'post_title'   => 'This is the post title.',
      'post_content' => 'This is the updated content.',
	);
	
	  wp_update_post( $my_post ); */
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	update_post_meta($pid, 'step2', "true");
	update_post_meta($pid, 'step3', "true");
	
	if(isset($_REQUEST['step1'])){
		
		$step = "&step1=true";
		
	}elseif(isset($_REQUEST['step2'])){
		
		$step .= "&step2=true";
		
	}elseif(isset($_REQUEST['step3'])){
		
		$step .= "&step3=true";
		
	}
	
	$appendurl = "?newsletter_id=".$pid;


	wp_redirect(get_the_permalink()."/".$appendurl."&step3=true");
	exit;


	$submit_return = "<div class='alert-success alert'>PDF Template saved!</div>";
	
	
}	

if(isset($_POST['last_step'])){
	
	$user_id = get_current_user_id();
	
/* 	$my_post = array(
      'ID'           => 37,
      'post_title'   => 'This is the post title.',
      'post_content' => 'This is the updated content.',
	);
	
	  wp_update_post( $my_post ); */
	  
	  
	  //printing type
	 if($_REQUEST['pdftvtpl2_printing_type']=="Full Colour (£0.20)"){
		 
		$totalprice = 0.20;
		 
	 }	  
	 
	  
	  
	  //delivery type
	  //Self-Mailer (£0.10) A4 Transparent Wallet (£0.20)
	 if($_POST['pdftvtpl2_delivery_type']=="Self-Mailer (£0.10)"){
		 
		$totalprice = $totalprice + 0.10;
		
		
	 }elseif($_POST['pdftvtpl2_delivery_type']=="A4 Transparent Wallet (£0.20)"){	  
	 
		$totalprice = $totalprice + 0.20;
	 
	 }
	
	  	  
	  
	  //number of pages
	 if(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==4){
		 
		$totalprice = $totalprice + 0.60;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==8){
		 
		 $totalprice = $totalprice + 1.00;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==12){

		 $totalprice = $totalprice + 1.20;
		
	 }
	 
	 
	 //Delivery Class:
	 
	 if($_POST['pdftvtpl2_delivery_class']=="2nd Class Mail (£0.40)"){
		 
		 $totalprice = $totalprice + 0.40;
		 
	 }elseif($_POST['pdftvtpl2_delivery_class']=="1st Class Mail (£0.55)"){
	 
		$totalprice = $totalprice + 0.55;
	 
	}
	
	//Accompanying Letter:

	 if($_POST['pdftvtpl2_accompanying_letter']=="Yes (£0.15 Discount)"){
		 
		 $totalprice = $totalprice + 0.15;
		 
	 }
	 
	 
	 //Allow up to 2 Promotional Leaflets:

	 if($_POST['pdftvtpl2_promotional_leaflets']=="Yes (£0.20 Discount)"){
		 
		 $totalprice = $totalprice + 0.20;
		 
	 }	 
	
	
	//echo $totalprice;
	
	
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	
	
	update_post_meta($pid, 'totalprice', number_format((float)$totalprice, 2, '.', ''));
	update_post_meta($pid, 'step3', "true");
	update_post_meta($pid, 'step4', "true");
	
	$appendurl = "?newsletter_id=".$pid;
	wp_redirect(get_the_permalink()."/".$appendurl."&step4=true");
	exit;

}	


if(isset($_POST['process'])){
	
	$user_id = get_current_user_id();
	
/* 	$my_post = array(
      'ID'           => 37,
      'post_title'   => 'This is the post title.',
      'post_content' => 'This is the updated content.',
	);
	
	  wp_update_post( $my_post ); */
	  
	
	
	
	foreach ($_POST as $key => $value) {
		update_post_meta($pid, $key, $value);
	}
	

	update_post_meta($pid, 'step4', "true");
	
	$submit_return = "<div class='alert-success alert'>PDF Template saved!</div>";

}	


if ( FALSE === get_post_status( $pid  ) ) {
  wp_redirect(site_url()."/404");
  exit;
}


$totalprice = get_post_meta($pid,'totalprice',true);

if($totalprice==""){
	
	
	 if(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==4){
		 
		$totalprice =  0.60;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==8){
		 
		 $totalprice = 1.00;
		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==12){

		 $totalprice =  1.20;
		
	 }	

}

$pdfpage_contents = get_post_meta($pid,'pdfpages_contents',true);
$pagesnum = count($pdfpage_contents);

?>


<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/jquery.gridster.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-csv-master/src/jquery.csv.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">

<link href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap-colorpicker.js"></script>



<style type="text/css">


.pdfnavigate .col-sm-1 b{
	font-size: 10px !important;
}

.modal-body {
    display: block;
    padding: 4%;
	width:100%;
}

.modal-header {
    border-bottom: 1px solid #eeeeee;
    display: block;
}


.modal-footer {
    display: block;
    padding: 10px 4%;
    text-align: right;
	width:100%;
}

.modal-dialog {
	background:none;
	border:none;
	top: 10% !important;
}
/*
.footer-social {
    background: #373737 none repeat scroll 0 0;
    float: left;
    height: 33px !important;
    text-align: right;
    width: 127px;
}
*/

body {
	
    font-family: "Verdana",Helvetica,Arial,sans-serif;
	font-size:13px;
	line-height: 1.231 !important;
	
}
ol, ul {
    margin-top: 0;
	margin-bottom: 0;
	list-style:none;
}

#header-right h2 img{

	-webkit-box-sizing: unset;
	-moz-box-sizing: unset;
	box-sizing: unset;
	
}


.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 16px;
    margin-bottom: 10px;
}


 * {
    -webkit-box-sizing: unset;
    -moz-box-sizing: unset;
    box-sizing: unset;
} 

.modal * {
-webkit-box-sizing: border-box !important;
-moz-box-sizing: border-box !important;
box-sizing: border-box !important;
}
</style>

<script type="text/javascript">
	var pdftvtpl2_plugin_url = '<?php echo pdftvtpl2_plugin_url; ?>';
	
	<?php foreach($pdfpage_contents as $i=>$val){ ?>
		var gridster<?php echo $i; ?>= '';
	<?php } ?>
	var pdfcr = jQuery.noConflict();
	pdfcr(document).ready(function () {
		
	pdfcr('.withcolor').colorpicker();
		
	  pdfcr(window).load(function() {
		pdfcr(".animatepdf").each(function(){
		  var pos = pdfcr(this).offset().top;

		  var winTop = pdfcr(window).scrollTop();
			if (pos < winTop + 1000) {
			  pdfcr(this).addClass("slide");
			}
		});
	  });		
				
		pdfcr('.datepicker').datepicker();
		
		//gridster start function
	
		
		<?php foreach($pdfpage_contents as $i=>$val){ ?>
		
		gridster<?php echo $i; ?> = null;
		
		gridster<?php echo $i; ?> = pdfcr("#pdf<?php echo $i; ?> ul").gridster({

            widget_base_dimensions: ['auto', 140],           
			
			min_rows:1,
			min_cols: 1,
			max_cols: 120,
			max_rows: 120,
			widget_margins: [5, 5],
			
			resize: {
				enabled: true,
					 stop: function (e, ui, $widget) {
						 

					var newDimensions = this.serialize($widget)[0]; 
						 
					var newHeight = this.resize_coords.data.height;
					var newWidth = this.resize_coords.data.width;
					//alert(newHeight+" == "+newWidth)
					//this.resize_last_sizex = 12;
					//alert(pdfcr(e.target).height())
					
					var borderifthereis = parseInt(pdfcr('.grid-content-wrap',$widget).css("border-left-width"))*2;
					var paddingifthereis = parseInt(pdfcr('.grid-content-wrap',$widget).css("padding-left"))*2;
						
						
					var perrow = 1155/8;
						
						
					var ctnh = pdfcr('.grid-content-wrap',$widget).height()/perrow;
						//alert(pdfcr('.grid-content-wrap',$widget).height()+"==== "+ctnh+" ==="+newDimensions.size_y)
					if(newDimensions.size_y>ctnh){
						
						ctnh = newDimensions.size_y;
						
					}
				
					pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr($widget),newDimensions.size_x,ctnh);
				
					if(borderifthereis){
						
					var contentWidth = pdfcr($widget).width()-borderifthereis-paddingifthereis;
					var contentheight =	pdfcr($widget).height()-borderifthereis-paddingifthereis;
					
					var cW = (contentWidth) / pdfcr($widget).width() * 100;
					var cH = (contentheight) / pdfcr($widget).height() * 100;
					//784 X 430
					//784 - 24 = 760
					
					//760 / 784 * 100
					
					//height: 94.4186%;
				    //width: 96.9388%;
					
					pdfcr('.grid-content-wrap',$widget).css({height:contentheight+"px",width:contentWidth+'px',padding:pdfcr('.grid-content-wrap',$widget).css("padding-left")+'px'})
									
					}
			
					
					//gridster<?php echo $i; ?>.resize_widget($widget,newDimensions.size_x,ctnh);
				
					
					
					
				// alert("New width: " + this.resize_last_sizex);
				// alert("New height: " + this.resize_last_sizey)
				
				}
			},avoid_overlapped_widgets: true,	
            shift_widgets_up: false,
            shift_larger_widgets_down: false,
            collision: {
                wait_for_mouseup: true
            }		

		}).data('gridster');
		
		
		
		pdfcr('#pdf<?php echo $i; ?> ul').css({'padding': '0'});		
		pdfcr('#pdf<?php echo $i; ?> .addnew').click(function(){		
			 
			var gridcontent = pdfcr('#pdfpagewrap'+localStorage.selectedpdf+' ul').height()+144;
			
			if(gridcontent>1162){
						
						alert("Sorry cannot add content. Content height exceed the current page content.");
						
			}else{
		
			gridster<?php echo $i; ?>.add_widget('<li data-sizey="2" data-sizex="120" data-col="3" data-row="1" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px; "></div></li>', 120, 1);	
			
			}
			
			
			
		})		
		pdfcr(document).on('click','#pdf<?php echo $i; ?> .close-grid',function(){
			
			gridster<?php echo $i; ?>.remove_widget( pdfcr(this).parent().parent() );
			
		});
		
		<?php } ?>
		
	
	});
</script>

<!--step1wrap -->
<div class="pdfformwrap hiddenwrap"  id="step1wrap">
		<div>
			<?php echo $submit_return; ?>

			<div class="form-group">
				<div class="col-sm-12">
					<?php if(get_the_title($pid)!=""){ ?>
					<h1><?php echo get_the_title($pid); ?><label>&nbsp;&nbsp;&nbsp;  
					
					<?php if((isset($_REQUEST['step1']) && $_REQUEST['step1']=="true") or (!isset($_REQUEST['step1']) and !isset($_REQUEST['step2']) and !isset($_REQUEST['step3']) and !isset($_REQUEST['step4']))){ ?>
					<a class="btn-danger btn" href="javascript:void(0);" data-toggle="modal" data-target="#pdftemplatelist">View Saved Template</a>&nbsp;&nbsp;&nbsp;<a class="btn-danger btn" href="<?php echo site_url()."/create-newsletter"; ?>">Create New</a>
					<?php } ?>
					
					</label></h1>
					<?php }else{ ?>
					<label>Choose Newsletter Name: &nbsp;&nbsp;&nbsp; <a class="btn-danger btn" href="<?php echo site_url()."/pdf-template-list"; ?>">View Saved Template</a></label><br /><br />
					<input type="text" class="form-control" required name="<?php echo PREMETA; ?>newsletter_title" />
					
					<?php } ?>
				</div>
			</div>	
			<div class="clearfix"></div>		


		</div>
	<form action="" method="POST" id="step1form"  widget-next="step2wrap" form-next="step2form" form-target="step1form">	
		<div class="form-group">
			<div class="col-sm-7">
				<label>Choose Newsletter Template:</label><br /><br />
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Blank Template"); ?> value="Blank Template">Blank Template  &nbsp;&nbsp;						
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 1"); ?> value="Version 1"> Version 1 &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 2"); ?>  value="Version 2"> Version 2 &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Saved Template"); ?> value="Saved Template">Saved Template &nbsp;&nbsp;<br /><br />
				
				<?php
					$args = array(
						'post_type'  => "pdftvtpl2",
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'author'=> get_current_user_id(),

					);

					$the_query = new WP_Query( $args );	
					
					if(get_post_meta($pid,PREMETA.'newsletter_template',true)==="Saved Template"){
						
						$showtemplate = "style='display:block;'";
						
						
					}else{
						$showtemplate ="style='display:none;'";
						
					}	
						
					echo "<select class='form-control' name='".PREMETA."newsletter_select_template' ".$showtemplate."  >";	
					echo "<option value=''>Select Template</option>";						
					echo "<option value='blank'>Blank Template</option>";					
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							
							$selected = get_selected_meta(get_post_meta($_REQUEST['newsletter_id'],PREMETA."newsletter_select_template",true),$the_query->post->ID);
							//echo get_post_meta($_REQUEST['newsletter_id'],PREMETA."newsletter_select_template",true);
							echo "<option value='".$the_query->post->ID."' ".$selected.">".get_the_title($the_query->post->ID)."</option>";
							
						}
						wp_reset_postdata();
					} else {
						echo "<h4>No saved pdf yet.</h4>";
					}
					echo "</select>";					

				?> 				
						

			</div>
		</div>
		<div class="clearfix"></div>
		<br /><br />	
		<div class="form-group">
			<div class="col-sm-12">
				<label>Choose Number of Pages:</label><br /><br />
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_pagenum'),"4"); ?> value="4">4 Pages (£0.60) &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_pagenum'),"8"); ?> value="8">8 Pages (£1.00) &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_pagenum'),"12"); ?> value="12">12 Pages (£1.20) 
			</div>
		</div>
		<div class="clearfix"></div>
		<br /><br />
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<input type="hidden" name="step1" value="true" />
		
		
		<div class="form-group">
			<button type="submit" name="step1button" class="btn btn-danger navigatebtn navigatebtnnext">next</button>
		</div>
	</form>
</div>
<!--- step2wrap-->
<div class="pdfformwrap hiddenwrap"  id="step2wrap">
<!-- 595 X 842 pixels size of a4 -->
	<form action="" method="POST" id="step2form" widget-next="step3wrap" form-next="step3form" form-target="step2form" >	
	<div class="row">
		<div class="col-sm-12">
			<div class="row pdfv2-pages-preview">
				
				<?php foreach($pdfpage_contents as $i=>$val){ ?>

					<?php if($i==1){ ?>
					<a href="javascript:void(0)" class="pdfnavigate">
						<div class="col-sm-1">
							<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">						
						   <b> Front Page</b>
						</div>
					</a>
					<?php }elseif($i==$pagesnum){ ?>
					<a href="javascript:void(0)" class="pdfnavigate">
						<div class="col-sm-1">
							<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">							
						   <b> Back Page</b>
						</div>	
					</a>		
					<?php }else{ ?>
					<a href="javascript:void(0)" class="pdfnavigate">
						<div class="col-sm-1">
							<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">							
						   <b> Page <?php echo $i; ?></b>
						</div>					
					</a>	
					<?php } ?>
					
				<?php } ?>
			</div>
		</div>
	</div>	
	<div class="row">	
		<div class="col-md-12">
		
		
		
			<!-- default value on page load -->
				<?php foreach($pdfpage_contents as $i=>$val){ ?>
				<?php // added so that the listing array will start from 1
				
				//$i = $i+1; ?>
				<div id="pdf<?php echo $i; ?>" class="pdf-page callgotopage<?php echo $i; ?>">
					<div style="text-align:center; width: 211mm;">
						<button class='btn btn-danger addnew' type="button">Add single grid</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddGrid">Multiple Grids</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddReadymade">Add Readymade Content</button>
						&nbsp;&nbsp;&nbsp;
						<?php if($i==1){ ?>
						<b> Front Page</b>
						<?php }elseif($i===$pagesnum){ ?>
						<b> Back Page</b>
						<?php }else{ ?>
						<b> Page <?php echo $i; ?></b> 
						<?php } ?>&nbsp;&nbsp;&nbsp;
						<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
					</div>
					<br>		    
					<div id="pdfpagewrap<?php echo $i; ?>" class="pdfwrapper gridster">
						<ul>
							<?php echo $val; ?>
			
						</ul>					
					</div>
				</div>
				
	
				
				<textarea style="display:none;" id="pdfcontent_input_holder<?php echo $i; ?>" name="pdfconverted_contents[<?php echo $i; ?>]" ></textarea>
				<textarea style="display:none;" id="pdfcontent_input<?php echo $i; ?>"  name="pdfpages_contents[<?php echo $i; ?>]"  ><?php echo $val; ?></textarea>
				<?php } ?>
	
			
		</div>
	</div>
		<div class="clearfix"></div>
		<br />
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<input type="hidden" name="step2" value="true" />
		<div class="form-group" style="width:211mm;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step1wrap"  class="btn btn-danger navigateback">Back</button>
			</div>			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step2button" class="btn btn-danger navigatebtn">Save Later</button>
			</div>		
			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step2button" class="btn btn-danger navigatebtn navigatebtnnext">next</button>
			</div>	
			<div class="clearfix"></div>	
		</div>	
		
	</form>
</div>
<!-------end step2 wrap -->
<!---step3wrap-->
<div class="pdfformwrap hiddenwrap"  id="step3wrap">
	<form action="" method="POST" id="step3form" widget-next="step4wrap" form-next="step4form" form-target="step3form">	
		<div class="col-md-12" style="text-align:right;">
			<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
		</div>		
		<div class="clear">
		</div><br /><br />
		<div class="form-group form-group2">
			<div class="col-sm-2">
				<img class="gotopage<?php echo $i; ?>" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/print.jpg">	
			</div>
			<div class="col-sm-9">
				<label>Printing Type:</label><br /><br />
				<input type="radio" required name="<?php echo PREMETA; ?>printing_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'printing_type'),"Black & White (£0.00)"); ?> value="Black & White (£0.00)"> Black & White (£0.00) &nbsp;&nbsp;
				<input type="radio" required name="<?php echo PREMETA; ?>printing_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'printing_type'),"Full Colour (£0.20)"); ?> value="Full Colour (£0.20)"> Full Colour (£0.20)		
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group form-group2">
			<div class="col-sm-2">
				<img class="gotopage<?php echo $i; ?>" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/delivery.jpg">	
			</div>		
			<div class="col-sm-9">
				<label>Delivery Type:</label><br /><br />
				<input type="radio" required name="<?php echo PREMETA; ?>delivery_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_type'),"Self-Mailer (£0.10)"); ?> value="Self-Mailer (£0.10)">Self-Mailer (£0.10) &nbsp;&nbsp;
				<input type="radio" required name="<?php echo PREMETA; ?>delivery_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_type'),"A4 Transparent Wallet (£0.20)"); ?> value="A4 Transparent Wallet (£0.20)">  A4 Transparent Wallet (£0.20)	
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>		
		<div class="form-group form-group2">
			<div class="col-sm-2">
				<img class="gotopage<?php echo $i; ?>" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/deliveryclass.jpg">	
			</div>		
			<div class="col-sm-9">
				<label>Delivery Class:</label><br /><br />
				<input type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"1st Class Mail (£0.55)"); ?> value="1st Class Mail (£0.55)">1st Class Mail (£0.55) &nbsp;&nbsp;
				<input type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"2nd Class Mail (£0.40)"); ?> value="2nd Class Mail (£0.40)"> 2nd Class Mail (£0.40)			
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group form-group2">
			<div class="col-sm-2">
				<img class="gotopage<?php echo $i; ?>" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/accompanyletter.jpg">	
			</div>		
			<div class="col-sm-9">
				<label>Accompanying Letter:</label><br /><br />
				<input type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"Yes (£0.15 Discount)"); ?> value="Yes (£0.15 Discount)">Yes (£0.15 Discount) &nbsp;&nbsp;
				<input type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"No (£0.00)"); ?> value="No (£0.00)">No (£0.00)				
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group form-group2">
			<div class="col-sm-2">
				<img class="gotopage<?php echo $i; ?>" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/leaflets.jpg">	
			</div>		
			<div class="col-sm-9">
				<label>Allow up to 2 Promotional Leaflets:</label><br /><br />
				<input type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"Yes (£0.20 Discount)"); ?> value="Yes (£0.20 Discount)">Yes (£0.20 Discount)&nbsp;&nbsp;
				<input type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"No (£0.00)"); ?> value="No (£0.00)">No (£0.00)				 
			</div>
			<div class="clearfix"></div>
		</div><br /><br />
		<div class="form-group">
			<div class="col-sm-12">
			
				
				<div class="alert alert-danger">
					<strong>Each Newsletter Cost:</strong> £<span class="ttalprice"><?php echo $totalprice; ?><span>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div>		
		
		
		
		<div class="form-group">
			<div class="col-sm-12">
				<label>I have read, understand and agree to the Terms: <input type="checkbox" required name="<?php echo PREMETA; ?>terms" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'terms'),"1"); ?> value="1"></label>
				 &nbsp;&nbsp;
				
			</div>
		</div>
		<div class="clearfix"></div>
		
				
		<hr style="border: 1px solid; color: #a2a2a2;" />
						
		
		<input type="hidden" name="step3" value="true" />
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<div class="form-group" style="width:211mm;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step2wrap" class="btn btn-danger navigateback">Back</button>
			</div>			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step3button" form-target="step3form" class="btn btn-danger navigatebtn">Save Later</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step3button" class="btn btn-danger navigatebtn navigatebtnnext">next</button>
			</div>	
			<div class="clearfix"></div>
		</div>			
		
		
	</form>
</div>
<!--end step3wrap -->
<!-- start step4wrap-->
<div class="pdfformwrap hiddenwrap"  id="step4wrap">
	<form action="" method="POST" id="step4form"  form-target="step4form">	
		<div class="col-md-12" style="text-align:right;">
			<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
		</div>		
		<div class="clear">
		</div><br /><br />	
		<div class="form-group">
			<div class="col-sm-6">
				<label>Customer List:</label><br /><br /> 
				<input type="radio" class="customerlist" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"csv"); ?> value="csv">Excel Spreadsheet &nbsp;&nbsp;
				<input type="radio" class="customerlist" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"http"); ?> value="http">HTTP Post<br /><br />
				<div class="customerlistsubinput">
				<?php if(get_post_meta($_REQUEST['newsletter_id'],PREMETA.'customer_list',true)=="csv"){ ?>				
					<?php if(get_post_meta($_REQUEST['newsletter_id'],'customer_list_head',true)!=""){?>
					<?php echo "There's a previous file uploaded change it?<br /><br /> " ?>		
					
					<input name="httpfile" type="text" value="<?php echo get_csv_listing_head(); ?>"><br /><br />
					<button type="button" class="btn alert-danger"  data-toggle="modal" data-target="#viewcsvlist" >View Csv List</button>
					<?php } ?>
					<!--<input type='file' name='filecsv' id='txtFileUpload' accept='.csv'  />-->
				<?php
					}else{
				?>
					<input name="httpfile" id="httpfield" type="text" value="<?php echo generate_pdftvtpl2_url(); ?>">
					<br />
				<?php	
						
					}

				?>	
				
				</div>
			</div>
		</div>
		<div class="clearfix"></div><br /><br />
		
		<div class="form-group">
			<div class="col-sm-6">
				<label>Print & Post Date: <?php echo get_post_meta($pid,'pdftvtpl2_print_post_date',true); ?></label><br />
				<input class="print_post_date" type="radio" required name="<?php echo PREMETA; ?>print_post_date" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'print_post_date'),"ASAP"); ?> value="ASAP">ASAP &nbsp;&nbsp;
				<input class="print_post_date" type="radio" required name="<?php echo PREMETA; ?>print_post_date" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'print_post_date'),"DATE"); ?> value="DATE">DD/MM/YYYY
			</div>
			<div class="clearfix"></div>
			<br />
			<div class="col-sm-6 pp_date">
			<?php if(get_post_meta($pid,'pp_date',true)){ ?>
				<input name="pp_date" type="date" class="datepicker" value="<?php echo get_post_meta($pid,'pp_date',true); ?>">
			<?php } ?>
			</div>
		</div>
		<div class="clearfix"></div><br />
		<div class="form-group">
			<div class="col-sm-12">
			
				
				<div class="alert alert-danger">
					<strong>Each Newsletter Cost:</strong> £<span class="ttalprice"><?php echo $totalprice; ?><span>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div><br />	
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<input type="hidden" name="step4" value="true" />
		<div class="form-group" style="width:211mm;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step3wrap"  class="btn btn-danger navigateback">Back</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<a target="_blank" href="<?php echo site_url(); ?>/create-newsletter/?newsletter_id=<?php echo $_REQUEST['newsletter_id']; ?>&pdfpreview=1" class="btn-danger btn">Preview</a>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step4button"  class="btn btn-danger navigatebtn">Save Later</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step4button" class="btn btn-danger navigatebtn">Save</button>
			</div>	
			<div class="clearfix"></div>
		</div>	
		<div class="csv-data-wrap" style="display:none;">
		</div>		
	</form>	
</div>

</form>
<?php new Zeraus\Template\V2\PopUpPageBuilder(); ?>	

<?php	

			$args = array(
				'post_type'  => "pdftvtpl2",
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'author'=> get_current_user_id(),

			);

			$the_query = new WP_Query( $args );	
	
?>


<div class="modal fade bs-example-modal-lg pdftemplatelist in" id="pdftemplatelist" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Saved Template</h4>
			</div>
			<div class="modal-body">
				
				<p>This text will be a description for the pdf template listing.</p>
				<div class="table-responsive pre-scrollable">         
				<table class="table" id="example">
				<thead>
				<tr>
				<th>List of Showing Listing</th>
				<th>Status</th>
				<th>Last modified</th>
				</tr>
				</thead>
				<tbody>

				<?php 

						
					if ( $the_query->have_posts() ) {
						$i = 0;
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							?>
						<tr <?php if($i % 2  == 0){ ?>class="warning"  <?php } ?>>
								<td> <a style="box-shadow:none;" href="<?php echo site_url()."/create-newsletter/?newsletter_id=".$the_query->post->ID; ?>"> <?php if(get_the_title()!=""){ echo get_the_title(); }else{ echo "(no title)";  } ?> </a> </td>
								<td><?php echo get_post_meta($post->ID, 'status', true); ?> --- </td>
								<?php 

									$date = new DateTime();

								?>
								<td> <?php echo  $date->format('F j, Y h:i:s a'); ?> </td>
								
								</td>
							</tr>
						<?php
						
						$i++;
						
						}
						
						wp_reset_postdata();
						} else {
							echo "<h4>No saved pdf yet.</h4>";
						}
				?>
				</tbody>
				</table>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
			</div>
		</div>
	</div>
</div>	

<?php
 // wp_head();
  //global $wp_scripts, $wp_styles;
  //var_dump( $wp_scripts );
  //var_dump( $wp_styles );
  //
?>