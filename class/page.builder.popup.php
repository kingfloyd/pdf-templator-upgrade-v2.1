<?php

namespace Zeraus\Template\V2;


class PopUpPageBuilder extends PageBuilder{
    function __construct()
    {
        parent::__construct();
        $this->loadPopup();
    }

    public function loadPopup() {
        $this->showColumn();
        $this->showReadyMadeTemplate();
        $this->previewToPage();
        $this->saveForLater();
        $this->pdfContinue();
        $this->showGridContent();
        $this->showDeleteRow();
        $this->showDeleteColumn();
        $this->showColumnDelete();
        $this->showColumnSettings();
		//$this->pdftemplatelist();
		$this->viewcsvlist();
		$this->viewdefaultvalues();
		$this->showReadyAdvertisementTemplates();
    }

    public function showTextEditor(){}
    public function showImageEditor(){}
    public function showColumn()
    {?>

        <div class="modal fade bs-example-modal-lg pdfAddGrid" id="pdfAddGrid" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content" id="addNewColumnPopup">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Select your grid:</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row clumn" selected-col="col-sm-120" data-dismiss="modal">
                            <div class="col-sm-12">.col-sm-12</div>
                        </div>

                        <div class="row clumn" selected-col="col-sm-60-60" data-dismiss="modal">
                            <div class="col-sm-6">.col-sm-6</div>
                            <div class="col-sm-6">.col-sm-6</div>
                        </div>

                        <div class="row clumn" selected-col="col-sm-40-40-40" data-dismiss="modal">
                            <div class="col-sm-4">.col-sm-4</div>
                            <div class="col-sm-4">.col-sm-4</div>
                            <div class="col-sm-4">.col-sm-4</div>
                        </div>

                        <div class="row clumn" selected-col="col-sm-30-60-30" data-dismiss="modal">
                            <div class="col-sm-3">.col-sm-3</div>
                            <div class="col-sm-6">.col-sm-6</div>
                            <div class="col-sm-3">.col-sm-3</div>
                        </div>


                        <div class="row clumn" selected-col="col-sm-40-80" data-dismiss="modal" >
                            <div class="col-sm-4">.col-sm-4</div>
                            <div class="col-sm-8">.col-sm-8</div>
                        </div>

                        <div class="row clumn" selected-col="col-sm-80-40" data-dismiss="modal" >
                            <div class="col-sm-8">.col-sm-8</div>
                            <div class="col-sm-4">.col-sm-4</div>
                        </div>

                        <br>
                        <!--<div class="row">
                            <div class="col-sm-12"> Editor </div>
                        </div>-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <?php
    }
    public function showReadyMadeTemplate()
    {?>
        <div class="modal fade bs-example-modal-lg" id="pdfAddReadymade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Readymade Content</h4>
						<p>Sample description</p>
                    </div>
                    <div class="modal-body">
                        <?php $post_types = get_post_types(); ?>
						
				<div class="form-group">
				 
				   <div class="row">
					  <div class="col-sm-6">
						 <label for="email">Readymade Content Categories</label>					  
							<?php

							$terms = get_terms( 'pdfReadymade', array(
								'orderby'    => 'count',
								'hide_empty' => 0,
								'number' => 8
								
							) );


							?>
							 
				  
						  <select id="specific-readymadecat" class="form-control" name="watermarkposttype" <?php if(get_option('imgws_watermark_post_type')=="specific_post"): echo "style='display:block;'"; endif; ?> autocomplete='off'>
							<option>---Select One---</option>
							<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){  ?>
							<?php   foreach ( $terms as $term ) { ?>
							<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							
							
								<?php } ?>
							<?php } ?>
							<option value="Most Popular Articles">Most Popular Articles</option>
						  </select>					  
					  
					  </div>
					  <div class="col-sm-6 readymadebtn-wrapper">
						 <label for="email">Article Size</label>
						  <select class="form-control" id="pdftpl_article_size" name="article_size" autocomplete='off'>
							<option>All Sizes</option>
							<option>Quarter Page</option>
							<option>Half Page</option>
						  </select>								
					  </div>	
					  <div class="clearfix"></div><br />
					  <div class="listcontainer">
					  </div>	 
					<div class="clearfix"></div>
				  </div>
				</div>						

						
						
                    </div>
                    <div class="modal-footer">
						<input type="button" class="btn btn-danger addreadymadebtn" value="Insert Content" />
						<input type="hidden"  class="addreadyselector" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
       <?php
    }
	 public function showReadyAdvertisementTemplates()
    {?>
        <div class="modal fade bs-example-modal-lg" id="pdfAddAdvertisement" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Advertisement Content</h4>
						<p>Sample description</p>
                    </div>
                    <div class="modal-body">
                        <?php $post_types = get_post_types(); ?>
						
				<div class="form-group">
				 
				   <div class="row">
					  <div class="col-sm-6">
						 <label for="email">Advertisement Content Categories</label>					  
							<?php

							$terms = get_terms( 'pdftpl2advertisement', array(
								'orderby'    => 'count',
								'hide_empty' => 0,
								'number' => 8
								
							) );


							?>
							 
				  
						  <select id="specific-advertisement" class="form-control" name="watermarkposttype" <?php if(get_option('imgws_watermark_post_type')=="specific_post"): echo "style='display:block;'"; endif; ?> autocomplete='off'>
							<option>---Select One---</option>
							<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){  ?>
							<?php   foreach ( $terms as $term ) { ?>
							<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							
							
								<?php } ?>
							<?php } ?>
							<option value="Most Popular Articles">Most Popular Articles</option>
						  </select>					  
					  
					  </div>
					  <!--<div class="col-sm-6 readymadebtn-wrapper">
						 <label for="email">Article Size</label>
						  <select class="form-control" id="pdftpl_article_size" name="article_size" autocomplete='off'>
							<option>All Sizes</option>
							<option>Quarter Page</option>
							<option>Half Page</option>
						  </select>								
					  </div>-->	
					  <div class="clearfix"></div><br />
					  <div class="listcontaineradvertisement">
					  </div>	 
					<div class="clearfix"></div>
				  </div>
				</div>						

						
						
                    </div>
                    <div class="modal-footer">
						<input type="button" class="btn btn-danger addadvertisementbtn" value="Insert Content" />
						<input type="hidden"  class="addreadyselectoradvert" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
       <?php
    }
    public function showGridContent()
    {
        ?>
        <div class="modal fade bs-example-modal-lg pdftv2-wp-editor in" id="pdftv2-wp-editor" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" style="min-height:600px; max-width:960px; width:100%;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please edit your content below..</h4>
                    </div>
                    <div class="modal-body" style="padding-top: 0px;padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-sm-9 pdftv2-popup-textarea-div">
                                <?php
                                    $content = 'This is the content';
									$settings = array( 'textarea_rows' => 9,'editor_height'=>300, 'media_buttons' => true );
                                    $editor_id = 'mycustomeditor';
                                    wp_editor( $content, $editor_id, $settings );
                                ?>
                            </div>
                            <div class="col-sm-3 pdftv2-popup-shortcodes pre-scrollable" >
                                <ul class="list-group">
								<?php
								
								global $pdftvtpl2_short;
								
								foreach($pdftvtpl2_short as $shortfield){
									
								?>
									<li class="list-group-item" style="cursor:pointer;" data-value="<?php echo "{".$shortfield."}" ?>"><?php echo $shortfield; ?></li> 	
								<?php
									
								}
								
								
								
								?>
										
								<!--							
								<?php $headerstofields = get_post_meta($_REQUEST['newsletter_id'],'customer_list_head',true); ?>
								<?php if(is_array($headerstofields) or $headerstofields!=""){ ?>
								
									<?php foreach($headerstofields as $headerstofield): ?>											
									
										<li class="list-group-item" style="cursor:pointer;" data-value="{<?php echo $headerstofield; ?>}"><?php echo $headerstofield; ?></li>                                    										
										
									<?php endforeach; ?>
									
								<?php }elseif(get_post_meta($_REQUEST['newsletter_id'],'httpfile',true)!=""){ ?>
									
								<?php 
										$parts = parse_url(get_post_meta($_REQUEST['newsletter_id'],'httpfile',true));
										parse_str($parts['query'], $queryGET);
								?>		
										<?php if(is_array($queryGET) or $queryGET!=""){ ?>

										<?php foreach($queryGET as $queryGETKey=>$queryGETVal): ?>												
											
										<li class="list-group-item" style="cursor:pointer;" data-value="{<?php echo $queryGETVal; ?>}"><?php echo $queryGETKey; ?></li>               	
											
										<?php endforeach ?>
									
										<?php } ?>
								
										
								<?php } ?>
									-->
                                </ul>
                            </div>
							<div class="col-sm-3 col-md-offset-9">
								<p align="center">
								<a href="javascript:void(0);"  type="button"  data-toggle="modal" data-target="#viewdefaultvalues" >View Default Values></a>
								</p>
							</div>
							<div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="pdftv2-popup-wp-editor-editing-done" type="button" class="btn-lg btn-info" data-dismiss="modal">Save Change</button>
                    </div>
                </div>
            </div>
        </div>

		<div class="modal fade bs-example-modal-lg viewdefaultvalues in" id="viewdefaultvalues" role="dialog">
			<div class="modal-dialog modal-lg" style="max-width:700px;">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Default Values</h4>
						<?php
						if( current_user_can('editor') || current_user_can('administrator') ) {  
						echo "<a href='".site_url()."/wp-admin/admin.php?page=pdftpl-default-news-values&newsletter_id=".$_GET['newsletter_id']."'>Click Here to Edit default values</a>";
						}
						
						?>
					</div>
					<div class="modal-body">
						
						<table class="table">
							<tr><td><b>Custom Field</b></td><td><b>Default Value</b></td></tr>
							<?php 
							global $pdftvtpl2_allfields_defaults;
							foreach($pdftvtpl2_allfields_defaults as $key=>$val){
								
								
							echo "<tr><td>".$key."</td><td>".$val."</td></tr>";	
								
								
								
								
								
							}
							
							
							
							?>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>		
		
        <?php
    }
    public function showColumnDelete(){
        ?>

        <div class="modal fade bs-example-modal-lg pdftv2-column-delete in" id="pdftv2-column-delete" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Are you sure you want to delete this column?</h5>
                    </div>
                    <div class="modal-body" style="text-align: right">
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button> &nbsp;&nbsp;
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteRowYes">Yes</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
    public function showDeleteRow()
    {
        ?>
        <div class="modal fade bs-example-modal-lg deleteRow in" id="deleteRow" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Are you sure you want to delete this row?</h5>
                    </div>
                    <div class="modal-body" style="">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteRowYes">Yes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button> &nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function showDeleteColumn()
    {
        ?>
        <div class="modal fade bs-example-modal-lg deleteColumn in" id="deleteColumn" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title">Are you sure you want to delete this column?</h5>
                    </div>
                    <div class="modal-body" style="">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"  id="deleteColYes">Yes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button> &nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function previewPageToPdf() {}
    public function previewToPage()
    { ?>
        <div class="modal fade bs-example-modal-lg" id="pdfPreview" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal. pdfPreview</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    public function saveForLater()
    {?>

        <div class="modal fade bs-example-modal-lg" id="pdfSaveForLater" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal. pdfSaveForLater</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
     <?php
    }
    public function pdfContinue()
    {?>
        <div class="modal fade bs-example-modal-lg" id="pdfContinue" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal. pdfContinue</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    public function showColumnSettings ()
    {
        ?>
            <div class="modal fade bs-example-modal-lg pdftv2-column-settings-edit in" id="pdftv2-column-settings-edit" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width:800px;">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Text Box Settings</h4>
                        </div>
                        <div class="modal-body">
						<div class="form-group col-md-6">
							<label for="email">Text Box Size:</label>
							<div class="clearfix"></div>
							<div class="row">
								<div id="textboxwidth" class="col-md-4">
									Width: <span></span>
								</div>
								<div id="textboxheight" class="col-md-4">
									Height: <span></span>
								</div><br /><br />
								<div class="col-md-12">
									<select class="form-control" name="textboxsizetype">
										<option></option>
										<option value="mm">millimetres</option>
										<option value="px">pixels</option>
										<!--
										
										784 / 120 =  6.533333333333333
										-->
									</select>
								</div>								 
							</div>		
										
						</div>	
						<div class="form-group col-md-6">
							<label for="gridbackground-color">Text Box Color:</label>
							<div class="input-group colorpicker-component withcolor"> 
								<input type="text" value="#00AABB" id="gridtext-color" class="form-control" />
								<span class="input-group-addon"><i></i></span> 
							</div>			
						</div>						
						
						<div class="clearfix"></div>
						  <!--<div class="form-group col-md-12">
							<label for="email">Grid Background Color:</label>
							<input  class="form-control"style="width: 15%;"  type="color" name="favcolor" id="gridbackground-color" value="#ffffc7">
						  </div>-->
						  
						  
						<div class="form-group col-md-6" style="padding-right:0;"> 
							<label for="email">Text Box Background Image:</label><br /><br />
							Url&nbsp;<input type="radio" name="Gridbgimage" value="url" autocomplete="off" /> &nbsp;&nbsp; Upload&nbsp;<input name="Gridbgimage" type="radio" value="upload" autocomplete="off" />
						</div>
						<div class="form-group col-md-6">
							<label for="email">Text Box Background Color:</label>
							<div class="input-group colorpicker-component withcolor"> 
								<input type="text" value="#00AABB" id="gridbackground-color" class="form-control" />
								<span class="input-group-addon"><i></i></span> 
							</div>			
						</div>						
						<div class="clearfix"></div> 
						 <div id="backgroundurlwraP" class="form-group col-md-6" style="padding-right:0;">
							<input  class="form-control" type="text" name="favcolor" id="gridbackground-image" value="" placeholder="sample: http://sample.com/images/img1.jpg">
							<small>Only JPG, PNG and GIF files allowed.</small>
						 </div>		
						 <div id="backgrounduploadwraP" class="form-group col-md-12" style="padding-left:0;">		
							<label for="email"></label>
							<button class="btn btn-danger" type="button" name="buttonimage" id="uploadimg">Upload image</button>
							<span id="uploadedtext"></span>
						  </div><br />	
						  
						  
						  
						  
						<div class="clearfix"></div> 

						<div class="clearfix"></div> 
						<!--<div class="form-group col-md-12">
						<label for="email">Grid Text Color:</label>
						 <input  class="form-control"style="width: 15%;"  type="color" name="gridtext" id="gridtext-color" value="#000000">
						</div>-->

						<div class="form-group col-md-6">
						<label for="email">Block Padding:</label>
						 <input  class="form-control" type="number" name="gridpadding" id="gridpadding" value="" placeholder="sample: 10">
						</div>
						<div class="form-group col-md-6">
							<label for="gridbordercolor">Grid Border Color:</label>
							<div class="input-group colorpicker-component withcolor"> 
								<input type="text" value="#00AABB" id="gridbordercolor" class="form-control" />
								<span class="input-group-addon"><i></i></span> 
							</div>			
						</div>
						<div class="clearfix"></div> 

						 
						  <!--<div class="form-group col-md-12">
							<label for="email">Grid Border Color:</label>
							<input  class="form-control"style="width: 15%;"  type="color" name="bordercolor" id="gridbordercolor" value="">
						  </div>-->
						  <div class="form-group col-md-6">
							<label for="email">Grid Border Type:</label><br /><br />
							<div class="clearfix"></div>
							 <!--<select class="form-control" id="gridbordertype">
								<option>none</option>
								<option>dotted</option>
								<option>solid</option>
								<option>double</option>
								<option>dashed</option>
								<option>inset</option>
								<option>outset</option>								
							 </select>-->
								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;" >
									<input type="radio" name="gridbordertype" id="gridbordertype" checked value="" autocomplete="off" /><br /><br />
									</div>							
									<div class="form-group col-md-11" style="padding:0;">
									<div style="text-align:left;">None</div>
									</div>

								</div>
								<div class="clearfix"></div>
								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
									<input type="radio" name="gridbordertype" id="gridbordertype" value="dotted" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
									<div style="border-top:12px dotted #000"></div><br /><br />
									</div>
								</div>							
								<div class="clearfix"></div>
								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
										<input type="radio" name="gridbordertype" id="gridbordertype" value="solid" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
										<div style="border-top:12px solid #000"></div><br /><br />
									</div>
								</div>							
								<div class="clearfix"></div>							
								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
										<input type="radio" name="gridbordertype" id="gridbordertype" value="double" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
										<div style="border-top:12px double #000"></div><br /><br />
									</div>
								</div>							
								<div class="clearfix"></div>									

								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
										<input type="radio" name="gridbordertype" id="gridbordertype" value="dashed" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
										<div style="border-top:12px dashed #000"></div><br /><br />
									</div>
								</div>							
								<div class="clearfix"></div>							

								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
										<input type="radio" name="gridbordertype" id="gridbordertype" value="inset" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
										<div style="border-top:12px inset #000"></div><br /><br />
									</div>
								</div>
								<div>
									<div class="form-group col-md-1" style="width:5%; padding:0;">
										<input type="radio" name="gridbordertype" id="gridbordertype" value="outset" autocomplete="off" />
									</div>
									<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
										<div style="border-top:12px outset #000"></div><br /><br />
									</div>
								</div>				
								<div class="clearfix"></div>								 
						  </div>							  
						  

						  <div class="form-group col-md-6">
							<label for="email">Grid Border Size:</label><br /><br />
							<div class="clearfix"></div>
							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;" >
								<input type="radio" name="gridbordersize" id="gridbordersize" checked value="" autocomplete="off" /><br /><br />
								</div>							
								<div class="form-group col-md-11" style="padding:0;">
								<div style="text-align:left;">None</div>
								</div>

							</div>
							<div class="clearfix"></div>
							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;">
								<input type="radio" name="gridbordersize" id="gridbordersize" value="1" autocomplete="off" />
								</div>
								<div class="form-group col-md-11" style="padding:0; padding-top:9px;">
								<div style="border-top:1px solid #000"></div><br /><br />
								</div>
							</div>							
							<div class="clearfix"></div>
							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;">
									<input type="radio" name="gridbordersize" id="gridbordersize" value="3" autocomplete="off" />
								</div>
								<div class="form-group col-md-11" style="padding:0; padding-top:9px;">
									<div style="border-top:4px solid #000"></div><br /><br />
								</div>
							</div>							
							<div class="clearfix"></div>							
							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;">
									<input type="radio" name="gridbordersize" id="gridbordersize" value="6" autocomplete="off" />
								</div>
								<div class="form-group col-md-11" style="padding:0; padding-top:7px;">
									<div style="border-top:6px solid #000"></div><br /><br />
								</div>
							</div>							
							<div class="clearfix"></div>									

							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;">
									<input type="radio" name="gridbordersize" id="gridbordersize" value="9" autocomplete="off" />
								</div>
								<div class="form-group col-md-11" style="padding:0; padding-top:6px;">
									<div style="border-top:9px solid #000"></div><br /><br />
								</div>
							</div>							
							<div class="clearfix"></div>							

							<div>
								<div class="form-group col-md-1" style="width:5%; padding:0;">
									<input type="radio" name="gridbordersize" id="gridbordersize" value="12" autocomplete="off" />
								</div>
								<div class="form-group col-md-11" style="padding:0; padding-top:4px;">
									<div style="border-top:12px solid #000"></div><br /><br />
								</div>
							</div>							
							<div class="clearfix"></div>							
						  </div>						  
						  						  
	
						 
							<div class="clearfix"></div>

                        </div>
                        <div class="modal-footer">
							<button type="button" class="btn btn-default" id="pdftv2-settings-preview" data-toggle="modal" data-target="#pdftv2-column-settings-preview">Preview</button>
							
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="pdftv2-settings-editing-done">Done</button>
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="modal fade bs-example-modal-lg pdftv2-column-settings-preview in" id="pdftv2-column-settings-preview" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Grid Settings Preview</h4>
                        </div>
                        <div class="modal-body">
							
							<div class="settings-preview-div">
							Sample Text
							</div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
                        </div>
                    </div>
                </div>
            </div>			
			
        <?php
    }
	
	
	public function viewcsvlist(){
	
	?>	
        <div class="modal fade bs-example-modal-lg" id="viewcsvlist" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Csv Url List</h4>
                    </div>
                    <div class="modal-body">
                        <div class="pre-scrollable">
							<ul>
								<li style="text-align:center; "><img style="height: 20px; margin: 4px;" src="<?php echo pdftvtpl2_plugin_url; ?>/assets/img/loading.gif" /></li>
							</ul>
						</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>		
		
	<?php
		
	}
	
	public function viewdefaultvalues(){
		
	?>		
		
     	
	
	<?php	
	}

}