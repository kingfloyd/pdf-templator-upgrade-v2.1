<?php


/**
 * This is to only get the validated array key
 *
 * @param $data
 * @param $dataAccept
 * @return array
 */


/**
 *
 */

define('helper_print_r', true);

define('helper_print', true);

if(!function_exists('helper_array_accept_with_key_only')) {

    function helper_array_accept_with_key_only($data, $dataAccept)
    {
        $dataFinal = [];
        foreach ($data as $key1 => $dataArray) {
            foreach ($dataArray as $key2 => $val2) {
                if (in_array($key2, $dataAccept)) {
                    $dataFinal[$key1][$key2] = $val2;
                }
            }
        }
        return $dataFinal;
    }
}

if(!function_exists('helper_print_pre')) {
    function helper_print_pre($data)
    {
        if(helper_print_r == true) {
            print "<pre>";
            print_r($data);
            print "</pre>";
        }
    }
}

if(!function_exists('helper_print')) {
    function helper_print($data)
    {
        if (helper_print == true) {
            print $data;
        }
    }
}


/**
 * This will allow the pdf preview
 *
 * @var $content this is the html content of the page
 * @var $extraCSS main array value
 * @var $extraCSS[extrastyling] this is the css of the pdf.
 * @var $extraCSS[wattermark] this is the watermark displayed in the pdf large text slant position.
 * @VAR $extraCSS[dont] not sure for this.
 */
if(!function_exists('helper_html_to_pdf_preview')){

    function helper_html_to_pdf_preview($content, $extraCSS) {

        // fill in the blanks?
        $content = fill_in_the_blanks_ext($content);

        // use short code?
        $content = do_shortcode($content);

        // create pdf from template
        $mpdf=new mPDF();
        $mpdf->debug=false;

        if($extraCSS['dont']!='') {
            $dont=explode(",",$extraCSS['dont']);
        }

        $ctnt = explode("===ENDPAGE===",$content);

        if(count($ctnt)==0) {
            $ctnt[0] = $content;
        }

        $i=0;

        foreach($ctnt as $index => $page) {

            // set header of the pdf
            $html = '<!DOCTYPE>
                <html>

                <head xmlns="http://www.w3.org/1999/xhtml">

                <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" >

                <link  type="text/css" href="/wp-includes/css/editor.min.css"  rel="stylesheet" />

                <link href="/wp-content/plugins/pdf-templator/css/style.css"  rel="stylesheet" type="text/css" />

                <style>
                        body {
                            width:210mm;
                            font-family:sans;
                            font-size:13px;
                        }
                    '.$extraCSS['extrastyling'].'
                </style>

                </head>
                    <body >';

            // create water marks in pdf
            if($extraCSS['wattermark']!="") {

                $mpdf ->SetWatermarkText($extraCSS['wattermark']);

                if(isset($dont) && in_array($i,$dont)) {

                    $mpdf ->showWatermarkText = false;
                    $html.= wpautop($page);
                    $html.="</body></html>";
                    $mpdf->addPage();
                    $mpdf->WriteHTML($html);

                } else {

                    $mpdf ->showWatermarkText = true;
                    $html.= wpautop($page);;
                    $html.="</body></html>";
                    $mpdf->addPage();
                    $mpdf->WriteHTML($html);

                }
            } else {

                $mpdf ->showWatermarkText = true;
                $html.= wpautop($page);;
                $html.="</body></html>";
                $mpdf->addPage();
                $mpdf->WriteHTML($html);

            }
            $i++;
        }

        if($_REQUEST['uid']!='') {
            // if this is the user's post request
        } else {

            $mpdf->Output();

        }
        exit;

    }
}



if(!function_exists('helper_html_to_pdf_preview_floyd')){

    function helper_html_to_pdf_preview_floyd($pdfconverted_contents, $extraCSS) {
		
		
		if($_REQUEST['pdfpreview']===1){
			
			
			
		}
		
		$allpages = count($pdfconverted_contents)-1;
        $mpdf=new mPDF('utf-8', 'A4');
        $mpdf->debug=false;

            // set header of the pdf
            $html = '<!DOCTYPE>
                <html>

                <head xmlns="http://www.w3.org/1999/xhtml">

                <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" >



					<style>
					
							.gs-w{
								
								margin:0;
								padding:0;
								
								
							}
							body {
								width:1000px;
								font-family:sans;
								font-size:13px;
							}
							
				
							
						'.$extraCSS['extrastyling'].'
						
							.settings-wrap{
								
								display:none;
							}			

							/* =WordPress Core
							-------------------------------------------------------------- */
							.alignnone {
								margin: 5px 20px 20px 0;
							}

							.aligncenter,
							div.aligncenter {
								display: block;
								margin: 5px auto 5px auto;
							}

							.alignright {
								float:right;
								margin: 5px 0 20px 20px;
							}

							.alignleft {
								float: left;
								margin: 5px 20px 20px 0;
							}

							a img.alignright {
								float: right;
								margin: 5px 0 20px 20px;
							}

							a img.alignnone {
								margin: 5px 20px 20px 0;
							}

							a img.alignleft {
								float: left;
								margin: 5px 20px 20px 0;
							}

							a img.aligncenter {
								display: block;
								margin-left: auto;
								margin-right: auto
							}

							.wp-caption {
								background: #fff;
								border: 1px solid #f0f0f0;
								max-width: 96%; /* Image does not overflow the content area */
								padding: 5px 3px 10px;
								text-align: center;
							}

							.wp-caption.alignnone {
								margin: 5px 20px 20px 0;
							}

							.wp-caption.alignleft {
								margin: 5px 20px 20px 0;
							}

							.wp-caption.alignright {
								margin: 5px 0 20px 20px;
							}

							.wp-caption img {
								border: 0 none;
								height: auto;
								margin: 0;
								max-width: 98.5%;
								padding: 0;
								width: auto;
							}

							.wp-caption p.wp-caption-text {
								font-size: 11px;
								line-height: 17px;
								margin: 0;
								padding: 0 4px 5px;
							}

							/* Text meant only for screen readers. */
							.screen-reader-text {
								clip: rect(1px, 1px, 1px, 1px);
								position: absolute !important;
								height: 1px;
								width: 1px;
								overflow: hidden;
							}

							.screen-reader-text:focus {
								background-color: #f1f1f1;
								border-radius: 3px;
								box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
								clip: auto !important;
								color: #21759b;
								display: block;
								font-size: 14px;
								font-size: 0.875rem;
								font-weight: bold;
								height: auto;
								left: 5px;
								line-height: normal;
								padding: 15px 23px 14px;
								text-decoration: none;
								top: 5px;
								width: auto;
								z-index: 100000; /* Above WP toolbar. */
							}
							
.wawa{
background: rgb(0, 0, 0) url("http://localhost/wp-content/uploads/2016/11/Desert.jpg") no-repeat scroll 0px 0px / cover ; 

}
					</style>
					<link rel="stylesheet" type="text/css" href="'.pdftvtpl2_plugin_url.'"/assets/css/demo.css">
					<link rel="stylesheet" type="text/css" href="'.pdftvtpl2_plugin_url.'"/assets/css/jquery.gridster.min.css">
					<link rel="stylesheet" type="text/css" href="'.pdftvtpl2_plugin_url.'"/assets/css/bootstrap.min.css">
					<link rel="stylesheet" type="text/css" href="'.pdftvtpl2_plugin_url.'"/assets/css/main.css">
                </head>
                    <body >';

				
				//ob_start();
				?>

				



				<?php 
				
				foreach($pdfconverted_contents as $i=>$val){
					/* $html .="							
							
							
							<div class='gs-w'  style='padding: 10px; background: rgb(0, 0, 0) url(http://localhost/wp-content/uploads/2016/11/Jellyfish.jpg) no-repeat scroll 0px 0px / cover ; margin-top: auto; margin-bottom: auto; position: absolute; top: 5px; left: 5px; min-height: auto; color: rgb(0, 0, 0); position:absolute; top:5px; left:5px; width:762px; height:700px;' ><p>JAYMAR!!!!!!!!!!!!!!!!!!{company number}{company number}{company number}{company number}</p></div>	
									
									
									
									
									
									
									
									
									
									
									
									
						"; */
					//$html .="<div class='wawa'>asdsadsadsa</div>";
					
					
					
						
					
					
				$pattern = "/url\(.*?g'\)/ig";
				
				if(preg_match($pattern, $val, $matches)){
					
					$html .= $matches;  
				}else{
					//$html .= "wala";  
					
				}
				
					
									
					$html .= get_pdf_filtered_contents($val);  
					//$html .= get_pdf_filtered_contents_default($html);  
					if($allpages !=$i){
					$html .= "<pagebreak />";
					}
				}


				?>				
				
				
				<?php
				//$html  .= ob_get_clean();		










		   // create water marks in pdf
            if($extraCSS['wattermark']!="") {

                $mpdf ->SetWatermarkText($extraCSS['wattermark']);
				$mpdf ->showWatermarkText = true;
				$html.= wpautop($page);;
				$html.="</body></html>";
				$mpdf->addPage();
				$mpdf->WriteHTML($html);

                
            } else {

                //$mpdf ->showWatermarkText = true;
                $html.= wpautop($page);;
                $html.="</body></html>";
                $mpdf->addPage();
                $mpdf->WriteHTML($html);

            }
        

        if($_REQUEST['uid']!='') {
            // if this is the user's post request
        } else {
		ob_clean();
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="pdftemplate.pdf"');
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
					
				$mpdf->Output('pdftemplate.pdf','I');

        }
        exit;

    }
}


function get_pdf_filtered_contents_default($val){
	
	global $pdftvtpl2_allfields_defaults;
	
	$pregmatch = preg_match("/{(.*)}/",$val, $matches);
	$newval = $matches[0];
	foreach($pdftvtpl2_allfields_defaults as $key=>$value){
		
		$key = "{".$key."}";
		
		if (strpos($val , $key ) !== false) {
		
			$newval = str_replace($key, $value,$newval );
		
		}
		
	}
	return $newval;

}

function get_pdf_filtered_contents($val){
	
	global $pdftvtpl2_allfields_defaults;
	
		foreach($_REQUEST as $key=>$valrequest){
			

			$key = str_replace(' ', '_', $key);
			$shortcode = "{".$key."}";
			$val = str_replace($shortcode, $valrequest, $val);
			
			 
		}
		
		//$pregmatch = preg_match("/{(.*)}/",$val, $matches);
		//$newval = $matches[0];
		foreach($pdftvtpl2_allfields_defaults as $key=>$value){
			
			$key = "{".$key."}";
			
			if (strpos($val , $key ) !== false) {
			
				$val = str_replace($key, $value,$val );
			
			}
			
		}		
		
		return $val;


        /* $seller_email = get_post_meta($pid,'seller_email',true);
        $seller_name = get_post_meta($pid,'seller_name',true);
        $seller_address = get_post_meta($pid,'seller_address',true);
        $seller_name = get_post_meta($pid,'seller_name',true);
        $seller_number =  get_post_meta($pid,'seller_number',true);
        $showing_dates = get_post_meta($pid, 'showing_date', true);


		$date = explode("|", $showing_dates);
        $showing_start_and_end_time  = $date[0];
        $showing_date = $date[1];

		$datewithfrom = date("F d l Y", strtotime($showing_date)) . " from " .$showing_start_and_end_time;
		$showing_instruction =  get_post_meta($pid,'showing_instructions',true);
        $showing_agent_phone =  get_post_meta($pid,'showing_agent_phone',true);
		 $showing_agent_email = get_post_meta($pid,'showing_agent_email',true);
         $showing_agent_name = get_post_meta($pid,'showing_agent_name',true);

		 $optionval = get_option($optionkey);

		 $optionval = str_replace("{sellername}", $seller_name, $optionval);
		 $optionval = str_replace("{email}", "black", $optionval);
		 $optionval = str_replace("{phonenumber}", "black", $optionval);
		 $optionval = str_replace("{selleraddress}", $seller_address, $optionval);
		 $optionval = str_replace("{showinginstruction}", $showing_instruction, $optionval);
		 $optionval = str_replace("{showing_date_inc_startend}", $datewithfrom, $optionval);
		 $optionval = str_replace("{agentname}", $showing_agent_name, $optionval);
		 $optionval = str_replace("{agentphonenumber}", $showing_agent_phone, $optionval);
		 $optionval = str_replace("{sellername}", $seller_name, $optionval);
		 $optionval = str_replace("{agentemail}", $showing_agent_email, $optionval);
		 $optionval = str_replace("{feedbackurl}", SITEURL."/feedback/?pid=$pid", $optionval);
		 $optionval = str_replace("{respond_link}", SITEURL."/schedule-response/?pid=".$pid, $optionval);

		 return $optionval; */


}


function fill_in_the_blanks_ext($content) {
    $data = $_REQUEST;

    foreach($data as $id=> $value) {
        $content = str_replace('{'.$id.'}',$value,$content);
    }
    return $content;
}
