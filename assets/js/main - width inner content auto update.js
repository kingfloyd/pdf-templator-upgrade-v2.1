var currentLI = '';
var selectedpdf = '';
var globaleditorpointer = '';
localStorage.setItem("selectedpdf", 0);

var formselected = '';

if(localStorage.getItem(my_ajax_object.step)==null){
	
	localStorage.setItem(my_ajax_object.step, "step2wrap");
	
	
}
pdfcr(function(){
			
			
        pdfcr('.hiddenwrap').hide();			
		pdfcr('#'+localStorage.getItem(my_ajax_object.step)).show();
		pdfcr('.navistep li').removeClass('active');
		pdfcr('.navistep li.'+localStorage.getItem(my_ajax_object.step)).addClass('active');
		
		
		pdfcr(document).on('click','.navigateback',function(){
			
			var prevstep = pdfcr(this).attr("data-prev-step");
			
			pdfcr('.navistep li').removeClass('active');
			pdfcr('.pdfformwrap').hide();			
			pdfcr('#'+prevstep).show();	
			pdfcr('.navistep .'+prevstep).addClass("active");
			localStorage.setItem(my_ajax_object.step, prevstep);	
			
			
		})
			
		
		//alert(localStorage.step)
		pdfcr('.navistep a').click(function(){
			
			pdfcr('.returnDataprocess').remove();
			var stepselect = pdfcr(this).attr('step-value');
			if(!pdfcr(this).parent().hasClass('disabled')){
				
			
			pdfcr('.navistep li').removeClass('active');
			 pdfcr(this).parent().addClass("active");
			pdfcr('.pdfformwrap').hide();
			pdfcr('#'+stepselect).show();
			
			localStorage.setItem(my_ajax_object.step, stepselect);
			
			}
			
		})
		
		
		
		pdfcr(document).on('click','form button',function(){
			
			if(pdfcr(this).text()=="Save Later" || pdfcr(this).text()=="Save" ){
			pdfcr(this).before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">')
			}
			 pdfcr('form button').removeAttr("clicked")
			 pdfcr(this).attr("clicked", "true");
			
		})		
		//step 1,3,4 form
		pdfcr('#step1form,#step3form,#step4form').submit(function(event){
			
			var thispage = pdfcr(this);		
			pdfcr('.returnDataprocess').remove();
			var formtarget = pdfcr(this).attr('form-target');
			
			if(pdfcr(this).attr('form-target')!=""){
				
				
				if(pdfcr('.navigatebtn[clicked=true]',this).html()=="next"){				
				
					var nextstep = pdfcr(this).attr('widget-next');
					var nextform = pdfcr(this).attr('form-next');
					
					
					
					pdfcr('.navistep .'+nextstep).removeClass('disabled');
					
					pdfcr('.pdfformwrap').hide();
					pdfcr("#"+nextstep).show();
					localStorage.setItem(my_ajax_object.step, nextstep);
					pdfcr('.navistep li').removeClass('active');
					pdfcr('.navistep .'+nextstep).addClass("active");
					
					pdfcr('.loadingImg').remove();
					
				}				
				
			}
			

			pdfcr.ajax({
				url: my_ajax_object.ajax_url,
				type: pdfcr(this).attr("method"),
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function (datas)
				{   
				pdfcr('.loadingImg').remove();
				pdfcr('#'+formtarget).before(datas);	
			
				//if(pdfcr('.navigatebtn[clicked=true]',thispage).html()!="next"){		
					//pdfcr("html, body").animate({ scrollTop:pdfcr('.returnDataprocess').position().top+'px' });
				//}				
			
				pdfcr('.ttalprice').html(pdfcr('#hiddentotal').html());
				
				
				}


			});   			
			
			return false;
		})
		//step 1,3,4 form end
		
		pdfcr('#step2form').submit(function(event){

			pdfcr('.returnDataprocess').remove();
			var formtarget = pdfcr(this).attr('form-target');	

			var thispage = pdfcr(this);			
		
			if(pdfcr(this).attr('form-target')!=""){
				
				
				if(pdfcr('.navigatebtn[clicked=true]',this).html()=="next"){				
	
					var nextstep = pdfcr(this).attr('widget-next');
					var nextform = pdfcr(this).attr('form-next');
					
					
					
					pdfcr('.navistep .'+nextstep).removeClass('disabled');
					
					pdfcr('.pdfformwrap').hide();
					pdfcr("#"+nextstep).show();
					localStorage.setItem(my_ajax_object.step, nextstep);
					
					pdfcr('.navistep li').removeClass('active');
					pdfcr('.navistep .'+nextstep).addClass("active");
					
					pdfcr('.loadingImg').remove();
					
				}				
				
			}		
		
			pdfcr('.pdf-page').each(function(ind,val){
				
				
				var contentholder = '';
				
				pdfcr('#pdfpagewrap'+ind+' ul li').each(function(){
					
					
					var attributes = pdfcr(this).prop("attributes");
					var attrr = '';
					var classs = '';
					var htmlbackground = pdfcr(this).css("backgroundColor");
					var htmlposition = pdfcr(this).css("position");
					var htmltop = pdfcr(this).css("top");
					var htmlleft = pdfcr(this).css("left");
					var htmlwidth = pdfcr(this).width();
					var htmlheight = pdfcr(this).height();
					var htmlcontent = pdfcr(this).html()
					var htmlclass = pdfcr(this).attr("class");

					pdfcr.each(attributes, function() {
						
						if(this.name=="style"){
						attrr += this.name+"='"+this.value+" position:"+htmlposition+"; top:"+htmltop+"; left:"+htmlleft+"; width:"+htmlwidth+"px; height:"+htmlheight+"px;' ";
						}
						
						if(this.name=="class"){
						classs += this.name+"='"+this.value+"' ";	
						}
						
						
						
					});

					//alert(attributes)
					
					contentholder += "<div "+classs+" "+attrr+">"+htmlcontent+"</div>";
							//alert(htmlbackground)	
							
							//alert(contentholder)
				})
				//converted			
				pdfcr('#pdfcontent_input_holder'+ind).val(contentholder);
				pdfcr('#pdfcontent_input'+ind).val(pdfcr('#pdfpagewrap'+ind+' ul').html());
			
				
			})		
		
				
		

			pdfcr.ajax({
				url: my_ajax_object.ajax_url,
				type: pdfcr(this).attr("method"),
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function (datas)
				{   
						
				pdfcr('.loadingImg').remove();	
				pdfcr('#'+formtarget).before(datas);
					
					if(pdfcr('.navigatebtn[clicked=true]',thispage).html()!="next"){		
						pdfcr("html, body").animate({ scrollTop:pdfcr('.returnDataprocess').position().top+'px' });
					}
					
				}


			});   			
			
			return false;
		})		
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		pdfcr('.pdfnavigate div:first').css('border','1px solid red');

		//gridster end function
		
		
		pdfcr(document).on('mouseenter','.gridster ul li', function (event) {
		pdfcr('.pdftv2-column-content-edit',this).show();
		}).on('mouseleave','.gridster ul li',  function(){
			
			   pdfcr('.pdftv2-column-content-edit',this).hide();
			
		});		
				

		//click the button settings
		pdfcr(document).on('click','.pdftv2-button-column-settings',function(){	
					
			 globaleditorpointer = pdfcr(this).parent().parent();						
		})

		pdfcr(document).on('click','#pdftv2-settings-editing-done',function(){
			
			
			var gridbordersize = pdfcr('input[name=gridbordersize]:checked').val();
			var gridbordertype = pdfcr('#gridbordertype').val();
			var gridbordercolor = pdfcr('#gridbordercolor').val();
			var gridborder = gridbordersize+'px '+gridbordertype+' '+gridbordercolor;
				//alert(gridborder)
				
			if(pdfcr('#gridbackground-image').val()!=""){
			var bgimage = "url("+pdfcr('#gridbackground-image').val()+") no-repeat scroll 0px 0px / cover";
			}else{
			var bgimage = pdfcr('#gridbackground-color').val();	
				
			}				
			
			if(gridbordersize==""){
				
				gridborder = "";
				
			}else{
				
				gridborder = 'border:'+gridborder;
				
			}
				
			if(pdfcr('#gridpadding').val()==""){
				
				var attrStyle ='background:'+bgimage+'; color:'+pdfcr('#gridtext-color').val()+'; ';
				
				
				pdfcr('.foredit .grid-content-wrap').attr("style",gridborder);
				pdfcr(globaleditorpointer).attr("style",attrStyle);
				
				
				
			}else{
				
				var attrStyle ='background:'+bgimage+'; color:'+pdfcr('#gridtext-color').val()+';';
				
				
				 
				pdfcr('.foredit .grid-content-wrap').attr("style",'padding:'+pdfcr('#gridpadding').val()+'px;'+gridborder);
				pdfcr(globaleditorpointer).attr("style",attrStyle);
				
				
			
			}	
			
			//784/120 = 7 equi 6.53
			
			
			var borderifthereis = parseInt(pdfcr('.foredit .grid-content-wrap').css("border-left-width"))*2;
			var paddingifthereis = parseInt(pdfcr('.foredit .grid-content-wrap').css("padding-left"))*2;
			
			if(gridbordersize==null){
				
				gridbordersize = 0;
				
			}else{
			gridbordersize = gridbordersize*2
				
			var contentWidth = pdfcr(".foredit").width()-gridbordersize;
			var contentheight =	pdfcr(".foredit").height()-gridbordersize;
			
			var cW = contentWidth / pdfcr(".foredit").width() * 100;
			var cH = contentheight / pdfcr(".foredit").height() * 100;
			
			alert(cW)
			
			pdfcr(".foredit .grid-content-wrap").css({height:cH+"%",width:cW+"%"})
			
			

					
				var contentWidth = pdfcr('.foredit').width()-gridbordersize-paddingifthereis;
				var contentheight =	pdfcr('.foredit').height()-gridbordersize-paddingifthereis;
				
				var cW = (contentWidth) / pdfcr('.foredit').width() * 100;
				var cH = (contentheight) / pdfcr('.foredit').height() * 100;
				//784 X 430
				//784 - 24 = 760
				
				//760 / 784 * 100
				
				//height: 94.4186%;
				//width: 96.9388%;
				
				pdfcr('.foredit .grid-content-wrap').css({height:contentheight+"px",width:contentWidth+"px",padding:pdfcr('.foredit .grid-content-wrap').css("padding-left")+'px'})
								
				
			
			
			
				
			}
			

			
			
			
			/*
			var calculatenewidth = eval(parseInt(pdfcr(globaleditorpointer).width())+parseInt(gridbordersize));
			var getmodifiedsizewithpad = Math.round(calculatenewidth/6.533333333333333);
			
			if(getmodifiedsizewithpad>120){
				
				var getmodifiedsizewithpadadjusted = Math.round(getmodifiedsizewithpad-120);
				

				var newsize = 120 - getmodifiedsizewithpadadjusted;
				
				if(Math.round(newsize)==116 || Math.round(newsize)==118){
					
					newsize = 117;
					
				}
				
				pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr(".foredit"),newsize,2);
			}
			*/
			//alert(getmodifiedsizewithpad+" "+getmodifiedsizewithpadadjusted+" "+newsize)
			
			
			
			//alert(attrStyle)
				
		})		
		
		
		//click the button EDIT
		pdfcr(document).on('click','.pdftv2-column-content-edit,.pdftv2-button-column-settings',function(){	
					
			globaleditorpointer = pdfcr(this).parent().parent();	
			pdfcr(".gridster ul li").removeClass("foredit");
			globaleditorpointer.addClass("foredit");
				
		})

		pdfcr(document).on('click','#pdftv2-popup-wp-editor-editing-done',function(){		
			
			 pdfcr('.grid-content-wrap',globaleditorpointer).html(tinyMCE.activeEditor.getContent());
			 
			var newcontent = pdfcr(".foredit .grid-content-wrap").height()
			
			if(newcontent>1162){
					pdfcr('.grid-content-wrap',globaleditorpointer).html("");
					pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr(".foredit"),120,2);
					alert("Sorry cannot add content. Content height exceed the current page content.");
					
			}else{
	
				var rW = (newcontent)/65;
				var rH = (newcontent)/144;
				//alert(rdymdcontentWidth+" "+rW+" "+rH)
				
				if(rW>120){
					
					rW = 120
				}
				if(rH > 120){
					
					rH = 120;
					
				}
							
							
				if(rH>globaleditorpointer.attr('data-sizey')){			
							
				pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr(".foredit"),globaleditorpointer.attr('data-sizex'),rH);
			
				}
			}
			
			 //alert(pdfcr(".foredit .grid-content-wrap").height());
			//console.log(pdfcr(tinyMCE.activeEditor.getContainer()))				
		})			
		
		pdfcr(document).on('click','.pdfaddrow',function(){						
			 
			selectedpdf = pdfcr(this).attr('data-pdfselected');

			
		})		
		
		pdfcr(document).on('click','.clumn',function(){	
			
			var selectedcol = pdfcr(this).attr('selected-col').replace('col-sm-','');;
				
			var rowarray = selectedcol.split("-");
			
			var selectedpd = selectedpdf.split('pdf');
			var datus = eval('gridster'+selectedpd[1]);		
			var newlist = '';
			
			pdfcr.each(rowarray, function( index, value ) {
			
			
				
				datus.add_widget('<li data-sizey="2" data-sizex="120" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" ></div></li>', parseInt(value), 1);			
				
	
			});								
			
		})
		
		// form submut function
		pdfcr('#pdfpageform').submit(function(){
			
			pdfcr('.pdf-page').each(function(ind,val){
				
				
				var contentholder = '';
				
				pdfcr('#pdfpagewrap'+ind+' ul li').each(function(){
					
					
					var attributes = pdfcr(this).prop("attributes");
					var attrr = '';
					var classs = '';
					var htmlbackground = pdfcr(this).css("backgroundColor");
					var htmlposition = pdfcr(this).css("position");
					var htmltop = pdfcr(this).css("top");
					var htmlleft = pdfcr(this).css("left");
					var htmlwidth = pdfcr(this).width();
					var htmlheight = pdfcr(this).height();
					var htmlcontent = pdfcr(this).html()
					var htmlclass = pdfcr(this).attr("class");

					pdfcr.each(attributes, function() {
						
						if(this.name=="style"){
						attrr += this.name+"='"+this.value+" position:"+htmlposition+"; top:"+htmltop+"; left:"+htmlleft+"; width:"+htmlwidth+"px; height:"+htmlheight+"px;' ";
						}
						
						if(this.name=="class"){
						classs += this.name+"='"+this.value+"' ";	
						}
						
						
						
					});

					
					
					contentholder += "<div "+classs+" "+attrr+">"+htmlcontent+"</div>";
							//alert(htmlbackground)	
							
							//alert(contentholder)
				})
				//converted			
				pdfcr('#pdfcontent_input_holder'+ind).val(contentholder);
				pdfcr('#pdfcontent_input'+ind).val(pdfcr('#pdfpagewrap'+ind+' ul').html());
			
				
			})
		
			//return false;
		})
		
		//editor retainer
		
		
		pdfcr(document).on('click','.pdftv2-column-content-edit',function(){
			
			var editoval = pdfcr(this).parent().parent().find('.grid-content-wrap').html();

			 tinyMCE.activeEditor.setContent(editoval);

		})
		
		
		//gridster.remove_widget( pdfcr('.gridster li').eq(3) );\
		
				  pdfcr(window).scroll(function(){
					
					  if (pdfcr(this).scrollTop() > 727) {
						  pdfcr('.pdfv2-pages-preview').addClass('fixedTop');
						  //pdfcr('.navbar').addClass('fixedTopnavbar');
					  } else {
						  pdfcr('.pdfv2-pages-preview').removeClass('fixedTop');
						  //pdfcr('.navbar').removeClass('fixedTopnavbar');
					  }
				  });	
		
		
		pdfcr('.pdf-page').hide();
		pdfcr('#pdf1').show();
			
	
	
	pdfcr(document).on('change','#specific-readymadecat',function(){
		
			pdfcr.post(
				my_ajax_object.ajax_url, 
				{
					'action': 'get_readymadecontent',
					'catid':   pdfcr(this).val()
				}, 
				function(response){
					
					
					pdfcr('.listcontainer').html(response);
				}
			);
	})	
	
/* 	
	pdfcr(document).on('change','#specific-ptype',function(){
		
			pdfcr.post(
				my_ajax_object.ajax_url, 
				{
					'action': 'get_postid',
					'post_type':   pdfcr(this).val()
				}, 
				function(response){
					
					pdfcr('.posts-wrapper').html(response);
				}
			);
	})
	pdfcr(document).on('click','#contentAdder',function(){
		
			var content = pdfcr('#readymadepost').val();
			
			pdfcr.post(
				my_ajax_object.ajax_url, 
				{
					'action': 'get_postcontent',
					'post_content':  content
				}, 
				function(response){
					
					tinyMCE.get('mycustomeditor2').setContent(response);
					
					pdfcr('#postEditor').show();
					
				}
			);
			

	}) */
	
	pdfcr(document).on('click','#addgridcontent',function(){
		
		
		var selectedpd = selectedpdf.split('pdf');
		var datus = eval('gridster'+selectedpd[1]);		
		datus.remove_all_widgets();

		datus.add_widget('<li data-sizey="2" data-sizex="120" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" >'+tinyMCE.get('mycustomeditor2').getContent()+'</div></li>', 120, 120);	
		
		
	})

	pdfcr(document).on('click','.pdfnavigate',function(){


		var pdfnavigate_val =  pdfcr('img',this).attr('class');
		var pdfnavigate_val = pdfnavigate_val.split('gotopage');
		pdfcr('.pdf-page').hide();
		pdfcr('#pdf'+pdfnavigate_val[1]).fadeIn(1000);
		localStorage.selectedpdf = pdfnavigate_val[1];
		
	})
	

	
	pdfcr(document).on('click','.pdfnavigate',function(){
	
		pdfcr('.pdfnavigate div').css('border','1px solid #000');
		pdfcr('div',this).css('border','1px solid red');	
		
	})
	
	pdfcr(document).on('click','.customerlist',function(){
					
		if(pdfcr(this).val()=="csv"){
			
			var filefields = "<input type='file' name='filecsv' id='txtFileUpload' accept='.csv' /><br />";
			pdfcr('.customerlistsubinput').html(filefields);
		}else{

			var httpfields = "<input type='text' name='httpfile' id='httpfield' value='"+my_ajax_object.generatehttpurl+"' />";
			pdfcr('.customerlistsubinput').html(httpfields);			
			
		}
					
		
	})
	
	pdfcr(document).on('click','.print_post_date',function(){
					
		if(pdfcr(this).val()=="DATE"){
			
			var filefields = "<br /><input type='date' name='pp_date' data-provide='datepicker' class='datepicker' /><br />";
			pdfcr('.pp_date').html(filefields);
			
			pdfcr('.datepicker').datepicker();

		}else{

			pdfcr('.pp_date input[name=pp_date]').remove();
		}
					
		
	})	
	

	

	pdfcr(document).ready(function() {

		// The event listener for the file upload
		//document.getElementById('txtFileUpload').addEventListener('change', upload, false);

		pdfcr(document).on('change','#txtFileUpload',upload);
		
		// Method that checks that the browser supports the HTML5 File API
		function browserSupportFileUpload() {
			var isCompatible = false;
			if (window.File && window.FileReader && window.FileList && window.Blob) {
			isCompatible = true;
			}
			return isCompatible;
		}

		// Method that reads and processes the selected file
		function upload(evt) {
		if (!browserSupportFileUpload()) {
			alert('The File APIs are not fully supported in this browser!');
			} else {
				var data = null;
				var file = evt.target.files[0];
				var reader = new FileReader();
				reader.readAsText(file);
				reader.onload = function(event) {
					var csvData = event.target.result;
					data = pdfcr.csv.toArrays(csvData);
					if (data && data.length > 0) {
					  alert('Imported -' + data.length + '- rows successfully!');
					  alert(generateTable(data))
					  pdfcr('.csv-data-wrap').html(generateTable(data));
					} else {
						alert('No data to import!');
					}
				};
				reader.onerror = function() {
					alert('Unable to read ' + file.fileName);
				};
			}
		}
		
		
		
		pdfcr('.list-group-item').click(function(){
			
			var txtarea = tinyMCE.get('mycustomeditor').getContent();
			
			//alert(txtarea);
			
			
			var text = pdfcr(this).attr('data-value');
			
			tinyMCE.get('mycustomeditor').execCommand('mceInsertContent', false, text);
	
			
			
		})
		
		pdfcr('select[name=pdftvtpl2_newsletter_template]').val("");
		pdfcr('select[name=pdftvtpl2_newsletter_template]').hide();		
		
		pdfcr('input[name=pdftvtpl2_newsletter_template]').click(function(){
			
			if(pdfcr(this).val()=="Saved Template"){
				
				
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').show();
				
			}else{
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').val("");
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').hide();
			}
			
		})		
		
		pdfcr('input[name=pdftvtpl2_newsletter_template]').ready(function(){
			/* alert(pdfcr(this).val())
			if(pdfcr(this).val()=="Saved Template"){			
				
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').show();
				
			}else{
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').val("");
				pdfcr('select[name=pdftvtpl2_newsletter_select_template]').hide();
			}
			 */
		})				
		
		pdfcr(document).on('click','#pdftv2-settings-preview',function(){
			
			
			
			
			var gridbordersize = pdfcr('input[name=gridbordersize]:checked').val();
			var gridbordertype = pdfcr('#gridbordertype').val();
			var gridbordercolor = pdfcr('#gridbordercolor').val();
			var gridborder = gridbordersize+'px '+gridbordertype+' '+gridbordercolor;
				//alert(gridborder)
			var elementHeight = globaleditorpointer.height();
			var elementWidth = globaleditorpointer.width();
		
			if(pdfcr('#gridbackground-image').val()!=""){
			var bgimage = "url("+pdfcr('#gridbackground-image').val()+") no-repeat scroll 0 0 / cover ";
			}else{
			var bgimage = '';	
				
			}

			if(pdfcr('#gridpadding').val()==""){

				pdfcr('.settings-preview-div').css({'width':elementWidth+'px','height':elementHeight+'px','margin':'0 auto'});
				pdfcr('.settings-preview-div').css({'background':bgimage+pdfcr('#gridbackground-color').val(),'color':pdfcr('#gridtext-color').val(),'border':gridborder});
				pdfcr('.settings-preview-div').html(globaleditorpointer.html());
				pdfcr('.settings-preview-div .settings-wrap').remove();
				
			}else{
				
				
				pdfcr('.settings-preview-div').css({'width':elementWidth+'px','height':elementHeight+'px','margin':'0 auto'});
				pdfcr('.settings-preview-div').css({'background':bgimage+pdfcr('#gridbackground-color').val(),'color':pdfcr('#gridtext-color').val(),'padding':pdfcr('#gridpadding').val()+"px",'border':gridborder});
				pdfcr('.settings-preview-div').html(globaleditorpointer.html());
				pdfcr('.settings-preview-div .settings-wrap').remove();
				
			}	
			
			
			
		})
		

		
		
		
	});	

	pdfcr(document).on('click','.readymadepost',function(){
		
		var rdyid = pdfcr(this).attr("id").split("readymadepost")[1];
		
		pdfcr('.addreadyselector').val(rdyid);
		
		pdfcr('.listcontainer .media').css('border','1px solid #000');
		
		pdfcr(this).parent().parent().css('border','1px solid red');
		
		
	})
	
	pdfcr(document).on('dblclick','.readymadepost',function(){
		
		
		var readymadeid = pdfcr('.addreadyselector').val();
		if(readymadeid!=""){
			pdfcr.post(
				my_ajax_object.ajax_url, 
				{
					'action': 'get_readymadeinnercontent',
					'readymadeid':   readymadeid
				}, 
				function(response){
					//calculate
					pdfcr('.readymadecontentAppend').remove();
					pdfcr('body').append(response);
				
					var rdymdcontentHeight = pdfcr('.readymadecontentAppend').height();
					var rdymdcontentWidth = pdfcr('.readymadecontentAppend').width();
					
					var selectedpd = selectedpdf.split('pdf');
					var datus = eval('gridster'+selectedpd[1]);		
					var defaultheightpdf = 1155;					
					var gridcontent = pdfcr('#pdfpagewrap'+selectedpd[1]+' ul').height();
					
					var totalnewcontentheight = eval(rdymdcontentHeight+gridcontent);
										//alert(totalnewcontentheight)
					if(totalnewcontentheight>1155){
						
						alert("Sorry cannot add content. Content height exceed the current page content.");
						
					}else{
						//1155
						var rW = (rdymdcontentWidth)/7;
						var rH = (totalnewcontentheight)/140;
						//alert(rdymdcontentWidth+" "+rW+" "+rH)
						
						if(rW>120){
							
							rW = 120
						}
						if(rH > 120){
							
							rH = 120;
							
						}
						
						//alert(Math.round(rH))
						
						datus.add_widget('<li class=" /*no-resize static*/" data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', 120, rH);	
						
						
						
						 pdfcr('#pdfAddReadymade').modal('toggle');
					}
	
					
				}
			);		
		}else{
			
			alert("Please select content first.");
			
		}
		
		
		
	})	

	
	
	pdfcr(document).on('click','.addreadymadebtn',function(){
			
		var readymadeid = pdfcr('.addreadyselector').val();
		if(readymadeid!=""){
			pdfcr.post(
				my_ajax_object.ajax_url, 
				{
					'action': 'get_readymadeinnercontent',
					'readymadeid':   readymadeid
				}, 
				function(response){
					//calculate
					pdfcr('.readymadecontentAppend').remove();
					pdfcr('body').append(response);
				
					var rdymdcontentHeight = pdfcr('.readymadecontentAppend').height();
					var rdymdcontentWidth = pdfcr('.readymadecontentAppend').width();
					
					var selectedpd = selectedpdf.split('pdf');
					var datus = eval('gridster'+selectedpd[1]);		
					var defaultheightpdf = 1162;					
					var gridcontent = pdfcr('#pdfpagewrap'+selectedpd[1]+' ul').height();
					
					var totalnewcontentheight = eval(rdymdcontentHeight+gridcontent);
										//alert(totalnewcontentheight)
					if(totalnewcontentheight>1162){
						
						alert("Sorry cannot add content. Content height exceed the current page content.");
						
					}else{
						//1155
						var rW = (rdymdcontentWidth)/65;
						var rH = (totalnewcontentheight)/144;
						//alert(rdymdcontentWidth+" "+rW+" "+rH)
						
						if(rW>12){
							
							rW = 12
						}
						if(rH > 8){
							
							rH = 8;
							
						}
						
						datus.add_widget('<li class=" /*no-resize static*/" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', parseInt(rW), parseInt(rH));	
						
						 pdfcr('#pdfAddReadymade').modal('toggle');
					}
	
					
				}
			);		
		}else{
			
			alert("Please select content first.");
			
		}
		
		
	})
	
	//on modal close default
	pdfcr('#pdfAddReadymade').on('hidden.bs.modal', function () {
	   pdfcr('.addreadyselector').val("");
	   pdfcr('.listcontainer .media').css('border','1px solid #000');
	})	
	
	pdfcr(document).on('click','.gs-resize-handle',function(e){

		currentLI = pdfcr(this).parent();
		
	})
	
		pdfcr('#backgroundurlwraP').hide();
		pdfcr('#backgrounduploadwraP').hide()	
	
	pdfcr(document).on('click','input[name=Gridbgimage]',function(){
		
		if(pdfcr(this).val()=="url"){
			pdfcr('#backgroundurlwraP').show();
			pdfcr('#backgrounduploadwraP').hide();
		}else{
			pdfcr('#backgroundurlwraP').hide();
			pdfcr('#backgrounduploadwraP').show();
		}
		
		
	})	
	
	
	
	
/* 	
	//add pup up image
	
    pdfcr('#uploadimg').click(function() {
		
        input_selection = "2";

        tb_show('Upload a logo', my_ajax_object.PDFsite_url+'/wp-admin/media-upload.php?type=file&tab=type&TB_iframe=true&post_id=0', false);

        pdfcr("#TB_iframeContent").load(function(){
           pdfcr("#TB_iframeContent").contents().find('#tab-library').remove();
        })
        return false;
    });
	
    // Display the Image link in TEXT Field.parent()
    window.send_to_editor = function(html) {
        var image_url = pdfcr(html).attr('href');
       
        alert("File Added.")
        pdfcr('#gridbackground-image').val(image_url);




        tb_remove();
    }		 */
	var file_frame; 
	
	// attach a click event (or whatever you want) to some element on your page
	pdfcr( '#uploadimg' ).on( 'click', function( event ) {
		event.preventDefault();

        // if the file_frame has already been created, just reuse it
		if ( file_frame ) {
			file_frame.open();
			return;
		} 

		file_frame = wp.media.frames.file_frame = wp.media({
			title: pdfcr( this ).data( 'uploader_title' ),
			button: {
				text: pdfcr( this ).data( 'uploader_button_text' ),
			},
			multiple: false // set this to true for multiple file selection
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			// do something with the file here
			pdfcr( '#frontend-button' ).hide();
			pdfcr( '#gridbackground-image' ).val(attachment.url);
			pdfcr( '#uploadedtext' ).text(attachment.url);
		});

		file_frame.open();
	});

function generateTable(data) {
      var html = '';

      if(typeof(data[0]) === 'undefined') {
        return null;
      }

      if(data[0].constructor === String) {
        html += '<tr>\r\n';
        for(var item in data) {
          html += '<td>' + data[item] + '</td>\r\n';
        }
        html += '</tr>\r\n';
      }

      if(data[0].constructor === Array) {
		  var iterate = 0;
		  var head_array = [];
		  var iterate_cm_list = 0;
		  var iterate_inside = 0;
        for(var row in data) {
          //html += '<tr>\r\n';
		  
		  if(iterate>0){
			  
			
 			for(var item in data[row]) {
				
				html += '<input name="customer_list['+iterate_cm_list+']['+head_array[iterate_inside]+']" value="' + data[row][item] + '">';
				iterate_inside++;
				
			}	      
			iterate_inside = 0;
			iterate_cm_list++;
			
		  }else{	
			
			var head_ind = 0;
			for(var item in data[row]) {
				html += '<input name="customer_list_head[' + data[row][item].toLowerCase().replace(' ', '_') + ']" value="' + data[row][item].toLowerCase().replace(' ', '_') + '">';
				head_array[head_ind] = data[row][item].toLowerCase().replace(' ', '_');
				
				head_ind++;
			}			  
						  
			  
		  }
		  
         // html += '</tr>\r\n';
		  
		  iterate++;
        }
      }

      if(data[0].constructor === Object) {
        for(var row in data) {
          html += '<tr>\r\n';
          for(var item in data[row]) {
            html += '<td>' + item + ':' + data[row][item] + '</td>\r\n';
          }
          html += '</tr>\r\n';
        }
      }
      
      return html;
}	
	
});
