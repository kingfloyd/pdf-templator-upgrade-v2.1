<?php


add_shortcode('pdftvtpl2_letter_tool', 'pdftvtpl2_letter_tool_func');
function pdftvtpl2_letter_tool_func() 
{ ?> 


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


<!-- letter tool -->

<script type="text/javascript" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/inc/letter-tool/assets/js/custom_letter_jquery.js"></script>

<script type="text/javascript" src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/inc/letter-tool/assets/js/custom_letter_js.js"></script>

    		
 <div class="container" > 
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<!-- tab step 1  -->
	    <li class="nav-item" id="letter-tool-tab-1" >
	    	<a class="nav-link " data-toggle="tab" href="#letter-tool-tab-1-content" role="tab" aria-controls="letter-tool-1-content">Step 1 >></a>
	  	</li>
		<!-- tab step 2 -->
	  	<li class="nav-item active" id="letter-tool-tab-2">
	    	<a class="nav-link active" data-toggle="tab" href="#letter-tool-tab-2-content" role="tab" aria-controls="letter-tool-2-content">Step 2 >></a> 
	  	</li>
		<!-- tab step 3 -->
	  	<li class="nav-item" id="letter-tool-tab-3" >
	    	<a class="nav-link" data-toggle="tab" href="#letter-tool-tab-3-content" role="tab" aria-controls="letter-tool-3-content">Step 3 >></a>
	  	</li>
		<!-- tab step 4 -->
	  	<li class="nav-item" id="letter-tool-tab-4" >
	    	<a class="nav-link" data-toggle="tab" href="#letter-tool-tab-4-content" role="tab" aria-controls="letter-tool-4-content">Step 4 >></a>
	  	</li> 
	</ul>

	<div class="tab-content">

		<!-- content step 1 -->
		<div class="tab-pane " id="letter-tool-tab-1-content" role="tabpanel">    
			<?php require_once("http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/inc/letter-tool/includes/views/step1/create-pages-options.php") ?>  
		</div>

		<!-- content step 2 -->
		<div class="tab-pane active" id="letter-tool-tab-2-content" role="tabpanel">
			 <?php require_once("http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/inc/letter-tool/includes/views/step2/compose-letter-tool.php") ?>  
		</div>

		<!-- content step 3 -->
		<div class="tab-pane" id="letter-tool-tab-3-content" role="tabpanel">
			<h1> Step 3  </h1>
		</div>

		<!-- content step 4 -->
		<div class="tab-pane" id="letter-tool-tab-4-content" role="tabpanel">
			<h1> Step 4 </h1>
		</div>

	</div>

	<script>
	  $(function () {
	    $('#myTab a:second').tab('show')
	  })
	</script>
</div>




<?php 
}



 