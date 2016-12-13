<?php

function pdftvtpl2_do_shortcode(){
	ob_start();


	if(!is_user_logged_in()){

	if ( $GLOBALS['pagenow'] === 'wp-login.php' ) {}else{


		
		if(is_page('create-newsletter')){
		
			wp_redirect( wp_login_url(site_url('create-newsletter')) );
			exit;
		
		}
		
	}	


	}	
	
	$pid = $_REQUEST['newsletter_id'];
	
	$step1 = (get_post_meta($pid,'step1',true) ?: 'javascript:void(0);');
	$step2 = (get_post_meta($pid,'step2',true) ?: 'javascript:void(0);');
	$step3 = (get_post_meta($pid,'step3',true) ?: 'javascript:void(0);');
	$step4 = (get_post_meta($pid,'step4',true) ?: 'javascript:void(0);');
	
	
	$disabled1 = "disabled";
	$disabled2 = "disabled";
	$disabled3 = "disabled";
	$disabled4 = "disabled";
	
	if($step1=="true"){
		//$step1 = get_the_permalink($post->ID).'?newsletter_id='.$pid.'&step1=true';
		$disabled1 = "";
	}
	if($step2=="true"){
		//$step2 = get_the_permalink($post->ID).'?newsletter_id='.$pid.'&step2=true';
		$disabled2 = "";
	}
	if($step3=="true"){
		//$step3 = get_the_permalink($post->ID).'?newsletter_id='.$pid.'&step3=true';
		$disabled3 = "";
	}	
	if($step4=="true"){
		//$step4 = get_the_permalink($post->ID).'?newsletter_id='.$pid.'&step4=true';
		$disabled4 = "";
	}	
		
	?>
	<style>
	  .animatepdf {visibility:hidden;} 
	  .slide {
		  /*animation-name: slide;
		  -webkit-animation-name: slide;
		  animation-duration: 1s;
		  -webkit-animation-duration: 1s;*/
		  visibility: visible;
	  }
	  @keyframes slide {
		0% {
		  opacity: 0;
		  transform: translateY(70%);
		} 
		100% {
		  opacity: 1;
		  transform: translateY(0%);
		}
	  }
	  @-webkit-keyframes slide {
		0% {
		  opacity: 0;
		  -webkit-transform: translateY(70%);
		} 
		100% {
		  opacity: 1;
		  -webkit-transform: translateY(0%);
		}
	  }
	</style>
	
	<div class="animatepdf" ng-app="pdftpl2App" ng-controller="pdftpl2Ctrl">

	
	<?php
	if(isset($_REQUEST['newsletter_id'])){
		
		
	?>
	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel navistep" >
                <li class="active step1wrap <?php echo $disabled2;  ?>" ng-click="loadreadymadecontent();">
				<a href="javascript:void(0);" step-value="step1wrap">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Choose Newsletter Type</p>
                </a></li>
                <li class="step2wrap <?php echo $disabled2;  ?>" ng-click="loadreadymadecontent();">
				<a href="javascript:void(0);" step-value="step2wrap" >	
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Add Content & Images</p>
                </a></li>
                <li class="step3wrap <?php echo $disabled3;  ?>" ng-click="loadreadymadecontent();">
				<a href="javascript:void(0);" step-value="step3wrap" >
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text"> Print & Post Choices </p>
                </a></li>
                <li class="step4wrap <?php echo $disabled4;  ?>" ng-click="loadreadymadecontent();">
				<a href="javascript:void(0);" step-value="step4wrap" >
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Add Customer List </p>
                </a></li>				
            </ul>
        </div>
	</div>

	<?php	
		
		include('update-view.php');
		
	}else{
		
		include('default-view.php');
		
	}	
	
	echo "</div>";
	
	  $output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;
}



function pdftvtpl2_listing_do_shortcode(){
	
	
			$args = array(
				'post_type'  => "pdftvtpl2",
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'author'=> get_current_user_id(),

			);

			$the_query = new WP_Query( $args );	
	
?>
	<p>This text will be a description for the pdf template listing.</p>
	<div class="table-responsive">         
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


		//}else{ ?> 

	<?php //} ?>


	</tbody>
	</table>
	</div>


<?php
	
	
	
}

?>