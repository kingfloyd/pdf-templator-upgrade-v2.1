
<?php

	if(isset($_POST['goto_step2'])){
		
		
		
		
		
		$user_id = get_current_user_id();

		
		$my_post = array(
		'post_title'    =>	$_REQUEST[PREMETA.'newsletter_title'],
		'post_type'     => 'pdftvtpl2',
		'post_status'   => 'publish',
		'post_author'   => $user_id,
		);

		// Insert the post into the database.
		$pid = wp_insert_post( $my_post );
		
		?>

			<script>
			localStorage.setItem("step<?php echo $pid; ?>", "step2wrap");
			//alert(localStorage.getItem("step<?php echo $pid; ?>"));
	
			</script>

		<?php	
		
		foreach ($_POST as $key => $value) {
			update_post_meta($pid, $key, $value);
		}
		
		
	 if(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==4){
		 
		 
		update_post_meta($pid, 'pricing__newsletter_pagenum', 0.60); 

		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==8){
		 
		 update_post_meta($pid, 'pricing__newsletter_pagenum', 1.00); 

		 
	 }elseif(get_post_meta($pid,'pdftvtpl2_newsletter_pagenum',true)==12){
		 
		update_post_meta($pid, 'pricing__newsletter_pagenum', 1.20);

		
	 }		
		
		
		
		$array_initial_val = array();
		
		$totalelements = $_POST['pdftvtpl2_newsletter_pagenum'];
		
		for($i=1;$i<=$totalelements;$i++){
			
			$array_initial_val[$i] = '<li class="gs-w" data-sizey="2" data-sizex="120" data-col="1" data-row="1" style="background: rgb(255, 255, 199) none repeat scroll 0% 0%; margin-top: auto; margin-bottom: auto; position: absolute; top: 5px; left: 5px;">							
										<div class="settings-wrap">
											<button style="float: right;"  class="close-grid" type="button">x</button>
											<div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal">
												<img style="height: 20px; margin: 3px;" src="'.pdftvtpl2_plugin_url.'/assets/img/settings-icon.png">
											</div>									
											<div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"> 
												<img style="cursor:pointer;height: 16px; margin: 5px;" src="'.pdftvtpl2_plugin_url.'/assets/img/edit-icon.png">
											</div>								
										</div>
										<div class="grid-content-wrap" style="padding: 10px;">								
										</div>								
									</li>';
									
			$array_initial_val2[$i] = '<div class="gs-w" data-sizey="2" data-sizex="120" data-col="3" data-row="1" style="padding: 10px; background: rgb(255, 255, 199) none repeat scroll 0% 0%; margin-top: auto; margin-bottom: auto; min-height: auto; position:absolute; top:5px; left:5px; width:762px; height:265px;">						
										<div class="grid-content-wrap">								
										</div>								
									</div>';									
				
			
		}
		
		
		if($_POST[PREMETA.'newsletter_select_template']!=""){
			
			$pdfpages_contents = get_post_meta($_POST[PREMETA.'newsletter_select_template'], 'pdfpages_contents', true);
			$pdfconverted_contents = get_post_meta($_POST[PREMETA.'newsletter_select_template'], 'pdfconverted_contents', true);
			
			if($pdfpages_contents!=""){
				
				update_post_meta($pid, 'pdfpages_contents', $pdfpages_contents);
				
			}else{
				
				update_post_meta($pid, 'pdfpages_contents', $array_initial_val);
				
			}
			
			if($pdfconverted_contents!=""){
				
				update_post_meta($pid, 'pdfconverted_contents', $pdfconverted_contents);
				
			}else{
				
				update_post_meta($pid, 'pdfconverted_contents', $array_initial_val2);
				
			}			
			
			
		}else{
		
			update_post_meta($pid, 'pdfpages_contents', $array_initial_val);
			update_post_meta($pid, 'pdfconverted_contents', $array_initial_val2);
		
		}
		
		
		update_post_meta($pid, 'step1', "true");
		update_post_meta($pid, 'step2', "true");
		
		$appendurl = "?newsletter_id=".$pid;
		
/* 		if($_POST[PREMETA.'newsletter_template']!=""){
			
			$appendurl .= "&template=".$_POST[PREMETA.'newsletter_select_template'];
			
		} */
		//echo get_the_permalink()."".$appendurl;
		//wp_redirect(get_the_permalink()."/".$appendurl);
		
		echo "<script type='text/javascript'>  window.location='".site_url()."/create-newsletter/".$appendurl."';  </script>";
		
		exit;
		$submit_return = "<div class='alert-success alert'>PDF Template saved!</div>";
		
		
	}	
?>	

<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/jquery.gridster.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-csv-master/src/jquery.csv.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap.min.js"></script>
<style type="text/css">

input[type=radio]{
	
	margin-right: 7px;
	vertical-align: -2px;	
	
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
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}
</style>
<script type="text/javascript">
	//localStorage.step = "step1wrap";
	var pdftvtpl2_plugin_url = '<?php echo pdftvtpl2_plugin_url; ?>';

	var pdfcr = jQuery.noConflict();
	pdfcr(document).ready(function () {
		
		
		pdfcr('input[name=neworsaved]').click(function(){
			
			
			if(pdfcr(this).val()=="new"){
				
				pdfcr('.new-content-fields').show();
				pdfcr('.saved-content-fields').hide();
				
						
			}else{
				pdfcr('.saved-content-fields').show();
				pdfcr('.new-content-fields').hide();
				
			}
		

		
		})
		
		
		
	  		
	  pdfcr('.navistep li').addClass('disabled');
	  pdfcr(window).load(function() {
		pdfcr(".animatepdf").each(function(){
		  var pos = pdfcr(this).offset().top;

		  var winTop = pdfcr(window).scrollTop();
			if (pos < winTop + 1000) {
			  pdfcr(this).addClass("slide");
			}
		});
	  });				
		//gridster start function
		

		

	});
</script>



<form action="" method="post" id="pdfpageform">

<div class="pdftvtpl2_step1">
	<div class="row">
		<?php echo $submit_return; ?>
		<div class="form-group">
			<div class="col-sm-7">
				<label>Please Choose</label><br /><br />
				<input type="radio" name="neworsaved" value="new" autocomplete="off" />New &nbsp;&nbsp;&nbsp; <input type="radio" name="neworsaved" value="saved" autocomplete="off" />Saved
			</div>
		</div><br /><br /><br />
		
		<div class="saved-content-fields" style="display:none;">
			<div class="form-group">
				<div class="col-sm-7">		
				
			<?php
				$args = array(
					'post_type'  => "pdftvtpl2",
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'author'=> get_current_user_id(),
					'meta_query' => array(
						array(
							'key'     => 'saved_as_file',
							'value'   => 1
						),
					)

				);

				$the_query = new WP_Query( $args );	
					
				echo "<select class='form-control' name='".PREMETA."newsletter_select_template' onchange='this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);' >";	
				echo "<option value=''>Select Template</option>";										
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						
						echo "<option value='".site_url('create-newsletter')."?newsletter_id=".$the_query->post->ID."'>".get_the_title($the_query->post->ID)."</option>";
						
					}
					wp_reset_postdata();
				} else {
					echo "<h4>No saved pdf yet.</h4>";
				}
				echo "</select>";					

			?> 

				</div>
			</div>
		</div>
		
		
		<div class="new-content-fields" style="display:none;">
			<div class="form-group">
				<div class="col-sm-7">
					<?php if(isset($_POST[PREMETA.'newsletter_title'])){ ?>
					<h1><?php echo $_POST[PREMETA.'newsletter_title']; ?> <!--<label>&nbsp;&nbsp;&nbsp; <x<a class="btn-danger btn" href="javascript:void(0);" data-toggle="modal" data-target="#pdftemplatelist">View Saved Template</a></label>--></h1>
					<input type="hidden" value="<?php echo $_POST[PREMETA.'newsletter_title'] ?>" name="<?php echo PREMETA; ?>newsletter_title" />
					<?php }else{ ?>
					<label>Choose Newsletter Name: 12 &nbsp;&nbsp;&nbsp; <!--<a class="btn-danger btn" href="javascript:void(0);" data-toggle="modal" data-target="#pdftemplatelist">View Saved Template</a>--></label><br /><br />
					<div class="col-sm-7" style="padding:0;">
						<input type="text" required class="form-control" name="<?php echo PREMETA; ?>newsletter_title" />
					</div><br /><br />
					<?php } ?>
				</div>
			</div>	
			<div class="clearfix"></div>
			<br /><br />
			<div class="form-group">





				<div class="col-sm-7">
					<label>Choose Newsletter Template:</label><br /><br />
					<?php require('letter-tool/includes/views/step1/letter-tool-choose-document.php') ?>
				</div>







				<div class="col-sm-7" style="display:none">
					<label>Choose Newsletter Template:</label><br /><br />
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Blank Template"); ?> value="Blank Template" autocomplete="off">Blank Template  &nbsp;&nbsp;						
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 1"); ?> value="Version 1" autocomplete="off"> Version 1 &nbsp;&nbsp;
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 2"); ?>  value="Version 2" autocomplete="off"> Version 2 &nbsp;&nbsp;
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Saved Template"); ?> value="Saved Template" autocomplete="off">Saved Template &nbsp;&nbsp;<br /><br />
					<div class="col-md-4 col-md-offset-7 ">
					<?php
						$args = array(
							'post_type'  => "pdftvtpl2",
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'author'=> get_current_user_id(),
							'meta_query' => array(
								array(
									'key'     => 'saved_as_template',
									'value'   => 1
								),
							)							

						);

						$the_query = new WP_Query( $args );	
							
						echo "<select style='display:none;' class='form-control' name='".PREMETA."newsletter_select_template' /*onchange='this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);'*/ >";	
						echo "<option value=''>Select Template</option>";										
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								
								echo "<option value='".$the_query->post->ID."'>".get_the_title($the_query->post->ID)."</option>";
								
							}
							wp_reset_postdata();
						} else {
							echo "<h4>No saved pdf yet.</h4>";
						}
						echo "</select>";					

					?> 				
					</div>		

				</div>




			</div>
			<div class="clearfix"></div>
			<br />
			<div class="form-group" style="display:none">
				<div class="col-sm-12">
					<label>Choose Number of Pages:</label><br /><br />
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio($_POST['pdftvtpl2_newsletter_pagenum'],"4"); ?> value="4" checked>4 Pages (£0.60)
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio($_POST['pdftvtpl2_newsletter_pagenum'],"8"); ?> value="8">8 Pages (£1.00)
					<input type="radio" required name="<?php echo PREMETA; ?>newsletter_pagenum" <?php checked_radio($_POST['pdftvtpl2_newsletter_pagenum'],"12"); ?> value="12">12 Pages (£1.20) 
				</div>
			</div><br /><br />	
			<?php if(isset($_POST['continue']) or get_post_meta($pid,'continue_step',true)!=""):
				?>
			<div class="form-group">
				<div class="col-sm-12">
					<label>Delivery Class:</label><br /><br />
					<input type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"4"); ?> value="1st Class Mail (£0.55) ">1st Class Mail (£0.55) 
					<input type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"8"); ?> value="2nd Class Mail (£0.40)"> 			
				</div>
			</div><br /><br />	
			<div class="form-group">
				<div class="col-sm-12">
					<label>Accompanying Letter:</label><br /><br />
					<input type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"4"); ?> value="Yes (£0.15 Discount)">Yes (£0.15 Discount) 
					<input type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"8"); ?> value="No (£0.00)">No (£0.00)
					
				</div>
			</div><br /><br />	
			<div class="form-group">
				<div class="col-sm-12">
					<label>Allow up to 2 Promotional Leaflets:</label><br /><br />
					<input type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"4"); ?> value="Yes (£0.20 Discount)">Yes (£0.20 Discount)
					<input type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"8"); ?> value="No (£0.00)">No (£0.00)
					 
				</div>
			</div><br /><br />	
			<div class="form-group">
				<div class="col-sm-12">
					<label>Each Newsletter Cost: £<input type="text" name="<?php echo PREMETA; ?>each_newsletter_cost"></label><br /><br />
				</div>
			</div><br /><br />			
			
			<div class="form-group">
				<div class="col-sm-12">
					<label>Customer List</label> 
					<input type="radio" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"csv"); ?> value="Yes (£0.20 Discount)">Excel Spreadsheet 
					<input type="radio" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"http"); ?> value="No (£0.00)">HTTP Post
				</div>
			</div><br /><br />
			
			<div class="form-group">
				<div class="col-sm-12">
					<label>Print & Post Date</label> 
					<input type="radio" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"csv"); ?> value="Yes (£0.20 Discount)">ASAP 
					<input type="radio" required name="<?php echo PREMETA; ?>customer_list" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'customer_list'),"http"); ?> value="No (£0.00)">DD/MM/YYYY
				</div>
			</div><br /><br />
								
			<?php  endif; ?>	
			<br /><br />
			<div class="form-group">
				<div class="col-sm-12">
				<button type="submit" name="goto_step2" class="btn btn-danger" value="next" >next</button>
				</div>
			</div>			
					
		</div>	

	</div>
</div>	
<br /><br />
<div class="pdftvtpl2_step2">
<!-- 595 X 842 pixels size of a4 -->
	<?php if($pagesnum>1){ ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="row pdfv2-pages-preview">
				
				<?php for($i=0;$i<=$pagesnum;$i++){ ?>
					<?php if($i==0){ ?>
					<div class="col-sm-1">
						<a href="javascript:void(0)" class="pdfnavigate"><img class="gotopage<?php echo $i; ?>" style="width:20px" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/microsoft-doc.png"></a>
						<br>
					   <b> Front Page</b>
					</div>
					<?php }elseif($i==$pagesnum){ ?>
					<div class="col-sm-1">
						<a href="javascript:void(0)" class="pdfnavigate"><img class="gotopage<?php echo $i; ?>" style="width:20px" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/microsoft-doc.png"></a>
						<br>
					   <b> Back Page</b>
					</div>					
					<?php }else{ ?>
					<div class="col-sm-1">
						<a href="javascript:void(0)" class="pdfnavigate"><img class="gotopage<?php echo $i; ?>" style="width:20px" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/microsoft-doc.png"></a>
						<br>
					   <b> Page <?php echo $i; ?></b>
					</div>					
					<?php } ?>
					
				<?php } ?>
			</div>
		</div>
	</div>	
	<div class="row">	
		<div class="col-md-12">
		
		
			<?php if(isset($_POST['pdfpages_contents'])) {  ?>
			<!-- if form is submitted and pages are with value -->	
				<?php $pagepdf_contents = $_POST['pdfpages_contents']; $i=0; ?>
				<?php foreach($pagepdf_contents as $pagepdf_content){ ?>
				<div id="pdf<?php echo $i; ?>" class="pdf-page callgotopage<?php echo $i; ?>">
					<div>
						<button class='btn btn-danger addnew' type="button">Add single grid</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddGrid">Add Columns</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddReadymade">Add Readymade Content</button>
						&nbsp;&nbsp;&nbsp;
						<?php if($i==0){ ?>
						<b> Front Page</b>
						<?php }elseif($i==$pagesnum){ ?>
						<b> Back Page</b>
						<?php }else{ ?>
						<b> Page <?php echo $i; ?></b> 
						<?php } ?>
					</div>
					<br>		    
					<div id="pdfpagewrap<?php echo $i; ?>" class="pdfwrapper gridster">
						<ul>
							
							<?php echo  stripslashes($pagepdf_content); ?>
							
						</ul>					
					</div>
				</div>
				<input id="pdfcontent_input_holder<?php echo $i; ?>" type="hidden" name="pdfconverted_contents[]" value="" />
				<input id="pdfcontent_input<?php echo $i; ?>" type="hidden" name="pdfpages_contents[]" value="" />
				<?php $i++; } ?>			
			
			
			<?php }else{ ?>
			<!-- default value on page load -->
				<?php for($i=0;$i<=$pagesnum;$i++){ ?>
				<div id="pdf<?php echo $i; ?>" class="pdf-page callgotopage<?php echo $i; ?>">
					<div>
						<button class='btn btn-danger addnew' type="button">Add single grid</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddGrid">Add Columns</button>
						<button data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddReadymade">Add Readymade Content</button>
						<?php if($i==0){ ?>
						<b> Front Page</b>
						<?php }elseif($i==$pagesnum){ ?>
						<b> Back Page</b>
						<?php }else{ ?>
						<b> Page <?php echo $i; ?></b> 
						<?php } ?>
					</div>
					<br>		    
					<div id="pdfpagewrap<?php echo $i; ?>" class="pdfwrapper gridster">
						<ul>
							<li data-sizey="2" data-sizex="120" data-col="3" data-row="1">						
									<div class="settings-wrap">
										<button style="float: right;"  class="close-grid" type="button">x</button>
										<div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal">
											<img style="height: 20px; margin: 3px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/settings-icon.png">
										</div>									
										<div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"> 
											<img style="cursor:pointer;height: 16px; margin: 5px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/edit-icon.png">
										</div>								
									</div>
									<div class="grid-content-wrap">								
									</div>
								
							</li>
			
						</ul>					
					</div>
				</div>
				<input id="pdfcontent_input_holder<?php echo $i; ?>" type="hidden" name="pdfconverted_contents[]" value="" />
				<input id="pdfcontent_input<?php echo $i; ?>" type="hidden" name="pdfpages_contents[]" value="" />
				<?php } ?>
				
			<?php } ?>	
			
		</div>
	</div><br /><br />
	<div class="row">
		<!--<div class="col-md-3">
			<input class="btn-danger btn" type="button" value="Preview">
		</div>-->
		<div class="col-md-3">
			<input class="btn-danger btn" name="save_for_later" type="submit" value="Save to continue">
		</div>
		<!--<div class="col-md-3">
			<input class="btn-danger btn" type="button" value="Continue">
		</div>	-->
	</div>	
	<?php } ?>	
</div>





<input type="hidden" name="<?php echo PREMETA; ?>noncename" id="pdftvtpl2_noncename" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ) ?>" />
</form>
<?php new Zeraus\Template\V2\PopUpPageBuilder(); ?>	
	

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