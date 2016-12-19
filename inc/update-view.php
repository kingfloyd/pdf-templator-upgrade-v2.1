<?php

global $post;
$pid = $_REQUEST['newsletter_id'];
$createpageid =  $post->ID;
if($_REQUEST['pdftvtpl2_newsletter_select_template']!=""){
	
$pid = $_REQUEST['pdftvtpl2_newsletter_select_template'];	
	
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
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/src/1.12.4-jquery.min.js.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-csv-master/src/jquery.csv.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap.min.js"></script>
<link href="<?php echo pdftvtpl2_plugin_url; ?>assets/css/src/3.5.0-octicons.min.css" rel="stylesheet">

<link href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/angularjs-v1.4.8.js"></script>





<!--Jesus js-->

<link rel="stylesheet" type="text/css" href="<?php print pdftvtpl2_plugin_url; ?>/assets/css/letter-tool.css" />
<script src="<?php print pdftvtpl2_plugin_url; ?>/assets/js/letter-tool-editor.js" type="text/javascript" ></script>
<script src="<?php print pdftvtpl2_plugin_url; ?>/assets/js/letter-tool.js" type="text/javascript"  > </script>



<style type="text/css">

.form-group2 .col-sm-9{
	
	padding-top:15px;
	
}

.popover-title{
	
	margin:0 !important;
	
}

input[type=radio]{
	
	margin-right: 7px;
	vertical-align: -2px;	
	
}

.pdfnavigate .col-sm-1 b{
	font-size: 10px !important;
}
.gs-w{
	
box-sizing: border-box !important;
-moz-box-sizing: border-box !important;
-webkit-box-sizing: border-box !important;	
	
	
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
		console.log("pdfcr is ready");
		
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
					
					
					var perrow = 1155/8;
									
					var ctnh = pdfcr('.grid-content-wrap',$widget).height()/perrow;
					//alert(ctnh)
					if(newDimensions.size_y>ctnh){
						
						ctnh = newDimensions.size_y;
						
					}
					
					gridster<?php echo $i; ?>.resize_widget($widget,newDimensions.size_x,ctnh)


					if(parseInt(pdfcr($widget).outerWidth( true ))>784){
						var perblock = 784/120;
						
						var newperblock = pdfcr($widget).outerWidth( true )/120;
						
						//alert(perblock+" "+newperblock+" "+pdfcr($widget).outerWidth( true )+" "+784);
						
						var deductvar = pdfcr($widget).outerWidth( true )-784;
						var deductvar2 = (784-deductvar)/perblock;
						
						var currenty = pdfcr($widget).attr('data-sizey');
						
						pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr($widget),Math.round(deductvar2),currenty);
					}					
					
				
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
		
		// pdfcr('[data-toggle="popover"]').popover();   
		
		pdfcr(".genericsave").popover({
		placement: 'top',
		html: 'true',
		title : '<label>Save as</label>',
		content : '<input type="radio" name="templateorfile" value="template" />Template &nbsp;&nbsp;&nbsp; <input type="radio" name="templateorfile" value="file" />File <br /><br /><p align="center"><input type="submit" name="submit" class="btn danger" value="submit" /></p>'
		});

		
		pdfcr(document).on('click', function (e) {
			pdfcr('.genericsave').each(function () {
				// hide any open popovers when the anywhere else in the body is clicked
				if (!pdfcr(this).is(e.target) && pdfcr(this).has(e.target).length === 0 && pdfcr('.popover').has(e.target).length === 0) {
					pdfcr(this).popover('hide');
					
				}
			});
		});			

	});
</script>

<div class="wholewrapper">






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
					<label>Choose Newsletter Name: 2 &nbsp;&nbsp;&nbsp; <a class="btn-danger btn" href="<?php echo site_url()."/pdf-template-list"; ?>">View Saved Template</a></label><br /><br />
					<input type="text" class="form-control" required name="<?php echo PREMETA; ?>newsletter_title" />
					
					<?php } ?>
				</div>
			</div>	
			<div class="clearfix"></div>		


		</div>
	<form action="" method="POST" id="step1form"  widget-next="step2wrap" form-next="step2form" form-target="step1form">


			<br><br><br>
		<h3> Testingasdas asd asd </h3>


		<div class="form-group">
			<div class="col-sm-7">
				<label>Choose Newsletter Template: 11</label><br /><br />
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Blank Template"); ?> value="Blank Template">Blank Template  &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 1"); ?> value="Version 1"> Version 1 &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Version 2"); ?>  value="Version 2"> Version 2 &nbsp;&nbsp;
				<input disabled type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Saved Template"); ?> value="Saved Template">Saved Template &nbsp;&nbsp;<br /><br />

				<?php

					//echo get_post_meta($pid,'saved_as_file',true)."-------------------------------------";

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
		<div class="form-group" >
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
			<div class="col-sm-12">
				<h1 align="center" id="pdf-pagertitle">Front Page 3 1 2</h1>
			</div>
			
			<div class="row pdfv2-pages-preview">
				<div class="navipager" style="display: table; margin: 0 auto;">



					<?php
					foreach($pdfpage_contents as $i=>$val) {
						print strip_tags($val);
					}


					$pdfpage_contents = [1=>'<ul style="height: 295px; min-width: 100%; max-width: 100%; position: relative; padding: 0px;">
							<li class="gs-w" data-sizey="2" data-sizex="120" data-col="1" data-row="1" style="background: none 0% 0% repeat scroll rgb(255, 255, 199); margin-top: auto; margin-bottom: auto; position: absolute; top: 5px; left: 5px; min-height: auto;">
										<div class="settings-wrap">
											<button style="float: right;" class="close-grid" type="button">x</button>
											<div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal">
												<img style="height: 20px; margin: 3px;" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/settings-icon.png">
											</div>
											<div style="float: right; display: none;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor">
												<img style="cursor:pointer;height: 16px; margin: 5px;" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/edit-icon.png">
											</div>
										</div>
										<div class="grid-content-wrap" style="padding: 10px;">
										</div>
									<span class="gs-resize-handle gs-resize-handle-both"></span></li>
						</ul>', 2=>'<ul style="height: 295px; min-width: 100%; max-width: 100%; position: relative; padding: 0px;">
							<li class="gs-w" data-sizey="2" data-sizex="120" data-col="1" data-row="1" style="background: none 0% 0% repeat scroll rgb(255, 255, 199); margin-top: auto; margin-bottom: auto; position: absolute; top: 5px; left: 5px; min-height: auto;">
										<div class="settings-wrap">
											<button style="float: right;" class="close-grid" type="button">x</button>
											<div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal">
												<img style="height: 20px; margin: 3px;" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/settings-icon.png">
											</div>
											<div style="float: right; display: none;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor">
												<img style="cursor:pointer;height: 16px; margin: 5px;" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/edit-icon.png">
											</div>
										</div>
										<div class="grid-content-wrap" style="padding: 10px;">
										</div>
									<span class="gs-resize-handle gs-resize-handle-both"></span></li>
						</ul>'];

					$pagesnum = 2;

					?>
					<?php foreach($pdfpage_contents as $i=>$val) { ?>

						<?php if($i==1){ ?>
						<a href="javascript:void(0)" class="pdfnavigate">
							<div class="col-sm-1">
								<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">						
							   <b> Front Page 3</b>
							</div>
						</a>
						<?php }elseif($i==$pagesnum){ ?>
						<a href="javascript:void(0)" class="pdfnavigate">
							<div class="col-sm-1">
								<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">							
							   <b> Back Page 3</b>
							</div>	
						</a>		
						<?php }else{ ?>
						<a href="javascript:void(0)" class="pdfnavigate">
							<div class="col-sm-1">
								<img class="gotopage<?php echo $i; ?>" style="width:100%; margin-left:4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/page-img.png">							
							   <b> Page 3<?php echo $i; ?></b>
							</div>	
							<?php if($i==6 && $pagesnum>8){ ?>	</div><div class="navipager" style="display: table; margin: 0 auto;"> <?php } ?>
						</a>	
						<?php } ?>
						
					<?php } ?>
				</div>
			</div>
		</div>
	</div>	
	<div class="row">	
		<div class="col-md-12">
		
		
			<div style="display: table;margin: 0 auto;">
			<!-- default value on page load -->
				<?php foreach($pdfpage_contents as $i=>$val){ ?>
				<?php // added so that the listing array will start from 1
				
				//$i = $i+1; ?>
				<div id="pdf<?php echo $i; ?>" class="pdf-page callgotopage<?php echo $i; ?>">
					<div style="text-align:center; width: 211mm;">
						<button class='btn btn-danger addnew' type="button" id="lt-add-editor-content">Add Text Box</button>


						<button class="lt-hide-element" data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddAdvertisement">Add Adverisement</button>
						<button class="lt-hide-element"  data-pdfselected="pdf<?php echo $i; ?>" type='button' class='btn btn-danger pdfaddrow' data-toggle="modal" data-target="#pdfAddReadymade">Add Readymade Content</button>


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
	</div>
		<div class="clearfix"></div>
		<br />
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<input type="hidden" name="step2" value="true" />
		<div class="form-group" style="width:211mm; margin:0 auto;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step1wrap"  class="btn btn-danger navigateback">Back</button>
			</div>			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type='button' class='btn btn-danger genericsave' >Save</button>
				
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step2button" class="btn btn-danger navigatebtn" ng-click="loadreadymadecontent();">Save Later</button>
			</div>		
			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step2button" class="btn btn-danger navigatebtn navigatebtnnext" ng-click="loadreadymadecontent();">next</button>
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
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>printing_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'printing_type'),"0.00"); ?> value="0.00"> Black & White (£0.00) &nbsp;&nbsp;
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>printing_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'printing_type'),"0.20"); ?> value="0.20"> Full Colour (£0.20)		
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
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>delivery_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_type'),"0.10"); ?> value="0.10">Self-Mailer (£0.10) &nbsp;&nbsp;
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>delivery_type" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_type'),"0.20"); ?> value="0.20">  A4 Transparent Wallet (£0.20)	
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
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"0.55"); ?> value="0.55">1st Class Mail (£0.55) &nbsp;&nbsp;
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>delivery_class" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'delivery_class'),"0.40"); ?> value="0.40"> 2nd Class Mail (£0.40)			
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
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"0.15"); ?> value="0.15">Yes (£0.15) &nbsp;&nbsp;
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>accompanying_letter" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'accompanying_letter'),"0.00"); ?> value="0.00">No (£0.00)				
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
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"0.20"); ?> value="0.20">Yes (£0.20 Discount)&nbsp;&nbsp;
				<input class="step3radio" type="radio" required name="<?php echo PREMETA; ?>promotional_leaflets" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'promotional_leaflets'),"0.00"); ?> value="0.00">No (£0.00)				 
			</div>
			<div class="clearfix"></div>
		</div><br /><br />
		<div class="form-group">
			<div class="col-sm-12">
			
				
				<div class="alert alert-danger">
					<strong>Each Newsletter Cost:</strong> £<span class="ttalprice"><?php echo  number_format((float)$totalprice, 2, '.', ''); ?><span>
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
		<div class="form-group" style="width:211mm; margin:0 auto;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step2wrap" class="btn btn-danger navigateback">Back</button>
			</div>			
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type='button' class='btn btn-danger genericsave' >Save</button>
				
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step3buttonLater" form-target="step3form" class="btn btn-danger navigatebtn navigatebtnlater" ng-click="loadreadymadecontent();">Save Later</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step3button" class="btn btn-danger navigatebtn navigatebtnnext" ng-click="loadreadymadecontent();">next</button>
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
					<?php //echo "There's a previous file uploaded change it?<br /><br /> " ?>		
					
					<!--<input name="httpfile" type="text" value="<?php echo get_csv_listing_head(); ?>"><br /><br />-->
					<button id="viewcsvlistbtn" type="button" class="btn alert-danger"  data-toggle="modal" data-target="#viewcsvlist" >View Csv List</button>
					<?php } ?>
					<!--<input type='file' name='filecsv' id='txtFileUpload' accept='.csv'  />-->
				<?php
					}else{
				?>
					<input name="httpfile" class="form-control" id="httpfield" type="text" value="<?php echo generate_pdftvtpl2_url(); ?>">
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

	<div class="form-group" ng-hide="_hideObj">
		<div class="col-sm-12">
			<div class="alert alert-danger" ng-repeat="x in readyMadeEntry">
				<strong>{{ x.count }}x Readymade Article(s):</strong> £<span class="rdymdeprice">{{ x.cost   }}<span>
			</div>
			
		</div>
	</div>	
	
	<div class="form-group" ng-hide="_hideObj">
		<div class="col-sm-12">
			<div class="alert alert-success" ng-repeat="x in advertisementEntry" ng-if="x.count != 0">
				<strong>{{x.count}}x {{x.name}} Advertisement:</strong> £<span class="rdymdeprice">{{ x.cost   }}<span>
			</div>
			
		</div>
	</div>		

		<div class="clearfix"></div><br />
		<div class="form-group">
			<div class="col-sm-12">
			
				
				<div class="alert alert-danger">
					<strong>Each Newsletter Cost:</strong> £<span class="ttalprice"><?php echo  number_format((float)$totalprice, 2, '.', ''); ?><span>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div><br />	
		<input type="hidden" name="action" value="process__pdftemplate_form" />
		<input type="hidden" name="pid" value="<?php echo $_REQUEST['newsletter_id']; ?>" />
		<input type="hidden" name="step4" value="true" />
		<div class="form-group" style="width:211mm; margin:0 auto;">
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="navigateback" data-prev-step="step3wrap"  class="btn btn-danger navigateback">Back</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type='button' class='btn btn-danger genericsave' >Save</button>
				
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="submit" name="step4button"  class="btn btn-danger navigatebtn" ng-click="loadreadymadecontent();">Save Later</button>
			</div>		
			<div class="col-md-3" style="padding:0; text-align:center;">
				<button type="button" name="step4button" class="btn btn-danger navigatebtn submittoque" ng-click="loadreadymadecontent();">Submit to Que</button>
			</div>	
			<div class="clearfix"></div>
		</div>	
		<div class="csv-data-wrap" style="display:none;">
		</div>		
	</form>	
</div>

<!--end wholewrap-->
</div>
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