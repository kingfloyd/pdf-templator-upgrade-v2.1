var currentLI = '';
var selectedpdf = '';
var globaleditorpointer = '';
localStorage.setItem("selectedpdf", 0);

var formselected = '';

if(localStorage.getItem(main_script_object.step)==null){

	localStorage.setItem(main_script_object.step, "step2wrap");


}
pdfcr(function(){

        pdfcr('.hiddenwrap').hide();
		pdfcr('#'+localStorage.getItem(main_script_object.step)).show();
		pdfcr('.navistep li').removeClass('active');
		pdfcr('.navistep li.'+localStorage.getItem(main_script_object.step)).addClass('active');


		pdfcr(document).on('click','.navigateback',function(){

			var prevstep = pdfcr(this).attr("data-prev-step");

			pdfcr('.navistep li').removeClass('active');
			pdfcr('.pdfformwrap').hide();
			pdfcr('#'+prevstep).show();
			pdfcr('.navistep .'+prevstep).addClass("active");
			localStorage.setItem(main_script_object.step, prevstep);


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

			localStorage.setItem(main_script_object.step, stepselect);

			}

		})



		pdfcr(document).on('click','form button',function(){

			pdfcr('.loadingImg').remove();



			if(pdfcr(this).text()=="Save Later" || pdfcr(this).text()=="Save" || pdfcr(this).text()=="Submit to Que" ){


			pdfcr(this).before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">');

			}
			 pdfcr('form button').removeAttr("clicked")
			 pdfcr(this).attr("clicked", "true");

		})
		//step 1,3,4 form
		pdfcr('#step1form,#step3form,#step4form').submit(function(event){
			pdfcr('#viewcsvlistbtn').show();
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
					localStorage.setItem(main_script_object.step, nextstep);
					pdfcr('.navistep li').removeClass('active');
					pdfcr('.navistep .'+nextstep).addClass("active");

					pdfcr('.loadingImg').remove();

				}

			}

			var formdata = new FormData(this);
			formdata.append('readymadeentry', pdfcr('.readymadeentry').length);
			formdata.append('advertisemententry', pdfcr('.advertisemententry').length);

			pdfcr.ajax({
				url: main_script_object.ajax_url,
				type: pdfcr(this).attr("method"),
				data: formdata,
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
				pdfcr(".genericsave").popover('hide');


				}


			});

			return false;
		})
		//step 1,3,4 form end

		pdfcr('#step2form').submit(function(event){
			//alert(pdfcr('input[name=templateorfile]:checked').val())

			//pdfcr('#step2form .navigatebtnlater').before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">');

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
					localStorage.setItem(main_script_object.step, nextstep);

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



					contentholder += "<div "+classs+" "+attrr+">"+htmlcontent+"</div>";
							//alert(htmlbackground)

							//alert(contentholder)
				})
				//converted
				pdfcr('#pdfcontent_input_holder'+ind).val(contentholder);
				pdfcr('#pdfcontent_input'+ind).val(pdfcr('#pdfpagewrap'+ind+' ul').html());


			})

			var quarterpage = 0;
			var halfpage = 0;
			var fullpage = 0;

			pdfcr('.gridster div[advert-size]').each(function(){

				if(pdfcr(this).attr('advert-size')=="Quarter Page"){
					quarterpage = quarterpage + 1;
				}
				if(pdfcr(this).attr('advert-size')=="Half Page"){
					halfpage = halfpage + 1;
				}
				if(pdfcr(this).attr('advert-size')=="Full Page"){
					fullpage = fullpage + 1;
				}



			})
			//alert(quarterpage);
			var formdata = new FormData(this);
			formdata.append('readymadeentry', pdfcr('.readymadeentry').length);
			formdata.append('advertisemententry', pdfcr('.advertisemententry').length);

			formdata.append('quarterpage', quarterpage);
			formdata.append('halfpage', halfpage);
			formdata.append('fullpage', fullpage);


			pdfcr.ajax({
				url: main_script_object.ajax_url,
				type: pdfcr(this).attr("method"),
				data: formdata,
				processData: false,
				contentType: false,
				success: function (datas)
				{

				pdfcr('.loadingImg').remove();
				pdfcr('#'+formtarget).before(datas);

				if(pdfcr('.navigatebtn[clicked=true]',thispage).html()!="next"){
					pdfcr("html, body").animate({ scrollTop:pdfcr('.returnDataprocess').position().top+'px' });
				}

				pdfcr('.ttalprice').html(pdfcr('#hiddentotal').html())
				pdfcr(".genericsave").popover('hide');

				}


			});

			return false;
		})




		pdfcr(document).on('click','#step3form .step3radio',function(){


			pdfcr('#step3form .navigatebtnlater').before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">');

			var formdata = new FormData(document.getElementById('step3form'));

			formdata.delete('action');
			formdata.append('action', 'update_onradio');
			formdata.append('readymadeentry', pdfcr('.readymadeentry').length);
			formdata.append('advertisemententry', pdfcr('.advertisemententry').length);

			pdfcr.ajax({
				url: main_script_object.ajax_url,
				type: pdfcr('#step3form').attr("method"),
				data: formdata,
				processData: false,
				contentType: false,
				success: function (datas)
				{


				pdfcr('.loadingImg').remove();
				pdfcr('.ttalprice').html(datas);


				}


			});


		})




		pdfcr(document).on('click','#step4form .submittoque',function(){

			pdfcr('.returnDataprocess').remove();
			pdfcr('.loadingImg').remove();
			pdfcr('#step4form .navigatebtnlater').before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">');

			var formdata = new FormData(document.getElementById('step4form'));

			formdata.delete('action');
			formdata.append('action', 'submittoque');
			formdata.append('readymadeentry', pdfcr('.readymadeentry').length);
			formdata.append('advertisemententry', pdfcr('.advertisemententry').length);

			pdfcr.ajax({
				url: main_script_object.ajax_url,
				type: pdfcr('#step3form').attr("method"),
				data: formdata,
				processData: false,
				contentType: false,
				success: function (datas)
				{


				pdfcr('.loadingImg').remove();
				//alert(datas)
				pdfcr('#step4form').before(datas);

				if(pdfcr('.navigatebtn[clicked=true]',thispage).html()!="next"){
					pdfcr("html, body").animate({ scrollTop:pdfcr('.returnDataprocess').position().top+'px' });
				}

				}


			});


		})


		pdfcr(document).on('click','#step4form #viewcsvlistbtn',function(){

			pdfcr('.loadingImg').remove();
			pdfcr(this).before('<img class="loadingImg" style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/loading.gif">');

			var formdata = new FormData(document.getElementById('step4form'));

			formdata.delete('action');
			formdata.append('action', 'viewcsvlistbtn');

			pdfcr.ajax({
				url: main_script_object.ajax_url,
				type: pdfcr('#step3form').attr("method"),
				data: formdata,
				processData: false,
				contentType: false,
				success: function (datas)
				{


				pdfcr('.loadingImg').remove();

				pdfcr('#viewcsvlist .modal-body .pre-scrollable').html(datas);
				//alert(datas)
				//pdfcr('#step4form').before(datas);


				}


			});


		})




		pdfcr('.pdfnavigate .navipager div:first').css('border','1px solid red');

		//gridster end function


		pdfcr(document).on('mouseenter','.gridster ul li', function (event) {
		pdfcr('.pdftv2-column-content-edit',this).show();
		}).on('mouseleave','.gridster ul li',  function(){

			   pdfcr('.pdftv2-column-content-edit',this).hide();

		});


		//click the button settings
		pdfcr(document).on('click','.pdftv2-button-column-settings',function(){

			 globaleditorpointer = pdfcr(this).parent().parent();

			 pdfcr('#textboxwidth span').html(globaleditorpointer.width());
			 pdfcr('#textboxheight span').html(globaleditorpointer.height());



		})

		pdfcr(document).on('change','select[name=textboxsizetype]',function(){

			//alert(pdfcr(':selected',this).val());

			if(pdfcr(':selected',this).val()=="mm"){



				pdfcr('#textboxwidth span').html(Math.round(globaleditorpointer.width()*0.264583333));
				pdfcr('#textboxheight span').html(Math.round(globaleditorpointer.height()*0.264583333));

			}
			if(pdfcr(':selected',this).val()=="px"){

				pdfcr('#textboxwidth span').html(globaleditorpointer.width());
				pdfcr('#textboxheight span').html(globaleditorpointer.height());



			}

		})

		pdfcr(document).on('click','#pdftv2-settings-editing-done',function(){


			var gridbordersize = pdfcr('input[name=gridbordersize]:checked').val();
			var gridbordertype = pdfcr('input[name=gridbordertype]:checked').val();
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

				var attrStyle ='background:'+bgimage+'; color:'+pdfcr('#gridtext-color').val()+'; '+gridborder;

				pdfcr(globaleditorpointer).attr("style",attrStyle);

			}else{
<<<<<<< HEAD
				
				//784/12 = 6.5333
				
			
				
=======

				//784/12 = 6.5333



>>>>>>> origin/master
				var attrStyle ='background:'+bgimage+'; color:'+pdfcr('#gridtext-color').val()+'; '+gridborder;



				pdfcr('.grid-content-wrap',globaleditorpointer).attr("style",'padding:'+pdfcr('#gridpadding').val()+'px;');
				pdfcr(globaleditorpointer).attr("style",attrStyle);

			}
				//alert(pdfcr(".foredit").outerWidth( true )+"asdasasdsad")

			if(parseInt(pdfcr(".foredit").outerWidth( true ))>784){
				var perblock = 784/12;
<<<<<<< HEAD
				
				var newperblock = pdfcr(".foredit").outerWidth( true )/12;
				
=======

				var newperblock = pdfcr(".foredit").outerWidth( true )/12;

>>>>>>> origin/master
				//alert(perblock+" "+newperblock+" "+pdfcr(".foredit").outerWidth( true )+" "+784);

				var deductvar = pdfcr(".foredit").outerWidth( true )-784;
				var deductvar2 = (784-deductvar)/perblock;

				var currenty = pdfcr(".foredit").attr('data-sizey');

				pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr(".foredit"),Math.round(deductvar2),currenty);
			}
				//alert(deductvar2);


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
					pdfcr(".gridster ul").data('gridster').resize_widget(pdfcr(".foredit"),12,2);
					alert("Sorry cannot add content. Content height exceed the current page content.");

			}else{

				var rW = (newcontent)/65;
				var rH = (newcontent)/144;
				//alert(rdymdcontentWidth+" "+rW+" "+rH)
<<<<<<< HEAD
				
				if(rW>12){
					
					rW = 12
				}
				if(rH > 12){
					
					rH = 12;
					
=======

				if(rW>12){

					rW = 12
				}
				if(rH > 12){

					rH = 12;

>>>>>>> origin/master
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
<<<<<<< HEAD
			
			
				
				datus.add_widget('<li data-sizey="2" data-sizex="12" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" ></div></li>', parseInt(value), 1);			
				
	
			});								
			
=======



				datus.add_widget('<li data-sizey="2" data-sizex="12" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" ></div></li>', parseInt(value), 1);


			});

>>>>>>> origin/master
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



	pdfcr(document).on('change','#specific-readymadecat,#pdftpl_article_size',function(){
			//alert(pdfcr('#pdftpl_article_size').val())
			pdfcr.post(
				main_script_object.ajax_url,
				{
					'action': 'get_readymadecontent',
					'article_size': pdfcr('#pdftpl_article_size').val(),
					'catid':   pdfcr('#specific-readymadecat').val()
				},
				function(response){


					pdfcr('.listcontainer').html(response);
				}
			);
	})
	//advertisement
	pdfcr(document).on('change','#specific-advertisement,#pdftpl_advertisement_size',function(){
			//alert(pdfcr('#pdftpl_article_size').val())
			pdfcr.post(
				main_script_object.ajax_url,
				{
					'action': 'get_pdftpl2advertisement',
					'advert_size': pdfcr('#pdftpl_advertisement_size').val(),
					'catid':   pdfcr('#specific-advertisement').val()
				},
				function(response){


					pdfcr('.listcontaineradvertisement').html(response);
				}
			);
	})



	pdfcr(document).on('click','#addgridcontent',function(){


		var selectedpd = selectedpdf.split('pdf');
		var datus = eval('gridster'+selectedpd[1]);
		datus.remove_all_widgets();

<<<<<<< HEAD
		datus.add_widget('<li data-sizey="2" data-sizex="12" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" >'+tinyMCE.get('mycustomeditor2').getContent()+'</div></li>', 12, 12);	
		
		
=======
		datus.add_widget('<li data-sizey="2" data-sizex="12" data-col=""  data-row="" style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div><div style="float: right;" class="pdftv2-column-content-edit" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor"><img style="cursor:pointer;height: 20px;margin: 5px;" src="'+pdftvtpl2_plugin_url+'/assets/img/edit-icon.png"></div></div><div class="grid-content-wrap" style="padding:10px;" >'+tinyMCE.get('mycustomeditor2').getContent()+'</div></li>', 12, 12);


>>>>>>> origin/master
	})

	pdfcr(document).on('click','.pdfnavigate',function(){

		pdfcr('#pdf-pagertitle').html(pdfcr('b',this).text());
		var pdfnavigate_val =  pdfcr('img',this).attr('class');
		var pdfnavigate_val = pdfnavigate_val.split('gotopage');
		pdfcr('.pdf-page').hide();
		pdfcr('#pdf'+pdfnavigate_val[1]).fadeIn(1000);
		localStorage.selectedpdf = pdfnavigate_val[1];

	})


	pdfcr(document).on('click','#rdyviewerarticles',function(){

		//alert( eval(parseInt(pdfcr('#rdyviewerarticles').attr('data-pagi'))+1))

			pdfcr.post(
				main_script_object.ajax_url,
				{
					'action': 'get_readymadecontent',
					'catid':   pdfcr('#specific-readymadecat').val(),
					'article_size': pdfcr('#pdftpl_article_size').val(),
					'pagenum': eval(parseInt(pdfcr('#rdyviewerarticles').attr('data-pagi'))+1)
				},
				function(response){


					pdfcr('.listcontainer').html(response);
				}
			);

	})



	pdfcr(document).on('click','.pdfnavigate',function(){

		pdfcr('.navipager .pdfnavigate div').css('border','1px solid #000');
		pdfcr('div',this).css('border','1px solid red');

	})

	pdfcr(document).on('click','.customerlist',function(){

		if(pdfcr(this).val()=="csv"){

			var filefields = "<input type='file' name='filecsv' id='txtFileUpload' accept='.csv' /><br />";
			pdfcr('.customerlistsubinput').html(filefields);
		}else{

			var httpfields = "<input type='text' class='form-control' name='httpfile' id='httpfield' value='"+main_script_object.generatehttpurl+"' />";
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
					 // alert(generateTable(data))
					  pdfcr('.csv-data-wrap').html(generateTable(data));

					  pdfcr('.customerlistsubinput').html('<button style="display:none;" type="button" id="viewcsvlistbtn" class="btn alert-danger"  data-toggle="modal" data-target="#viewcsvlist" >View Csv List</button>');

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

			//alert(pdfcr( ".foredit" ).length);


			var gridbordersize = pdfcr('input[name=gridbordersize]:checked').val();
			var gridbordertype = pdfcr('input[name=gridbordertype]:checked').val();
			var gridbordercolor = pdfcr('#gridbordercolor').val();
			var gridborder = gridbordersize+'px '+gridbordertype+' '+gridbordercolor;
				//alert(gridbordertype)
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

		pdfcr('.media',this).css('border','1px solid red');


	})

	//for advertisement
	pdfcr(document).on('click','.addvertisementpost',function(){

		var rdyid = pdfcr(this).attr("id").split("addvertisementpost")[1];

		pdfcr('.addreadyselectoradvert').val(rdyid);

		pdfcr('.listcontainer .media').css('border','1px solid #000');

		pdfcr('.media',this).css('border','1px solid red');


	})



	pdfcr(document).on('dblclick','.readymadepost',function(){


		var readymadeid = pdfcr('.addreadyselector').val();
		if(readymadeid!=""){
			pdfcr.post(
				main_script_object.ajax_url,
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
<<<<<<< HEAD
						
						if(rW>12){
							
							rW = 12
						}
						if(rH > 12){
							
							rH = 12;
							
=======

						if(rW>12){

							rW = 12
						}
						if(rH > 12){

							rH = 12;

>>>>>>> origin/master
						}

						//alert(Math.round(rH))
<<<<<<< HEAD
						
						datus.add_widget('<li class=" /*no-resize static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap readymadeentry" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', 12, rH);	
						
						
						
=======

						datus.add_widget('<li class=" /*no-resize static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap readymadeentry" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', 12, rH);



>>>>>>> origin/master
						 pdfcr('#pdfAddReadymade').modal('toggle');
					}


				}
			);
		}else{

			alert("Please select content first.");

		}



	})


	//for advertisement function


	pdfcr(document).on('dblclick','.addvertisementpost',function(){

		var advertSize = pdfcr(this).attr('advert-size');

		var readymadeid = pdfcr('.addreadyselectoradvert').val();
		if(readymadeid!=""){
			pdfcr.post(
				main_script_object.ajax_url,
				{
					'action': 'get_advertisementinnercontent',
					'readymadeid':   readymadeid
				},
				function(response){
					//calculate
					pdfcr('.advertisementcontentAppend').remove();
					pdfcr('body').append(response);

					var rdymdcontentHeight = pdfcr('.advertisementcontentAppend').height();
					var rdymdcontentWidth = pdfcr('.advertisementcontentAppend').width();

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
<<<<<<< HEAD
						
						if(rW>12){
							
							rW = 12
						}
						if(rH > 12){
							
							rH = 12;
							
=======

						if(rW>12){

							rW = 12
						}
						if(rH > 12){

							rH = 12;

>>>>>>> origin/master
						}

						//alert(Math.round(rH))
<<<<<<< HEAD
						
						datus.add_widget('<li class="no-resize /*static*/" data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button></div><div class="grid-content-wrap advertisemententry" advert-size="'+advertSize+'" style="padding:10px;" >'+pdfcr('.advertisementcontentAppend').html()+'</div></li>', 12, rH);	
						
						
						
=======

						datus.add_widget('<li class="no-resize /*static*/" data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button></div><div class="grid-content-wrap advertisemententry" advert-size="'+advertSize+'" style="padding:10px;" >'+pdfcr('.advertisementcontentAppend').html()+'</div></li>', 12, rH);



>>>>>>> origin/master
						 pdfcr('#pdfAddAdvertisement').modal('toggle');
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
				main_script_object.ajax_url,
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
<<<<<<< HEAD
						
						if(rW>12){
							
							rW = 12
						}
						if(rH > 12){
							
							rH = 12;
							
=======

						if(rW>12){

							rW = 12
						}
						if(rH > 12){

							rH = 12;

>>>>>>> origin/master
						}

						//alert(Math.round(rH))
<<<<<<< HEAD
						
						datus.add_widget('<li class=" /*no-resize static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap readymadeentry" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', 12, rH);	
						
						
						
=======

						datus.add_widget('<li class=" /*no-resize static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button><div style="float:right" title="edit main body style" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" data-target="#pdftv2-column-settings-edit" data-toggle="modal"><img style="height: 20px; margin: 3px;" src="'+pdftvtpl2_plugin_url+'/assets/img/settings-icon.png"></div></div><div class="grid-content-wrap readymadeentry" style="padding:10px;" >'+pdfcr('.readymadecontentAppend').html()+'</div></li>', 12, rH);



>>>>>>> origin/master
						 pdfcr('#pdfAddReadymade').modal('toggle');
					}


				}
			);
		}else{

			alert("Please select content first.");

		}


	})


	//advertisement functions
	pdfcr(document).on('click','.addadvertisementbtn',function(){



		var readymadeid = pdfcr('.addreadyselectoradvert').val();

		var advertSize = pdfcr('#addvertisementpost'+readymadeid).attr('advert-size');

		if(readymadeid!=""){
			pdfcr.post(
				main_script_object.ajax_url,
				{
					'action': 'get_advertisementinnercontent',
					'readymadeid':   readymadeid
				},
				function(response){
					//calculate
					pdfcr('.advertisementcontentAppend').remove();
					pdfcr('body').append(response);

					var rdymdcontentHeight = pdfcr('.advertisementcontentAppend').height();
					var rdymdcontentWidth = pdfcr('.advertisementcontentAppend').width();

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
<<<<<<< HEAD
						
						if(rW>12){
							
							rW = 12
						}
						if(rH > 12){
							
							rH = 12;
							
=======

						if(rW>12){

							rW = 12
						}
						if(rH > 12){

							rH = 12;

>>>>>>> origin/master
						}

						//alert(Math.round(rH))
<<<<<<< HEAD
						
						datus.add_widget('<li class="no-resize /* static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button></div><div class="grid-content-wrap advertisemententry" advert-size="'+advertSize+'" style="padding:10px;" >'+pdfcr('.advertisementcontentAppend').html()+'</div></li>', 12, rH);	
						
						
						
=======

						datus.add_widget('<li class="no-resize /* static*/ " data-col=""  data-row=""  style="background: rgb(255, 255, 199);"  ><div class="settings-wrap"><button style="float: right;"  class="close-grid" type="button">x</button></div><div class="grid-content-wrap advertisemententry" advert-size="'+advertSize+'" style="padding:10px;" >'+pdfcr('.advertisementcontentAppend').html()+'</div></li>', 12, rH);



>>>>>>> origin/master
						 pdfcr('#pdfAddAdvertisement').modal('toggle');
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
	   pdfcr('.addreadyselectoradvert').val("");

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


	var file_frame;

	// attach a click event for pop up media

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
	//generate csv table
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

}); //jeuqery document dom end

//start angular calls

var app = angular.module('pdftpl2App', []);

app.controller('pdftpl2Ctrl', function($scope, $http) {
    $scope.count = 0;
	$scope.count2 = 0;
	$scope._hideObj = true;
	$scope.myfunction = function(){



	}

	$scope.init = function(){

		setTimeout(function(){
			//alert("fdsfsd")
	    if(pdfcr('#step2wrap').is(":visible")){

		    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_pdftpl_a4a5'}}).then(function(response) {
		        //$scope.readyMadeEntry = response.data;
				//$scope._hideObj = false;
					if(response.data==""){
						pdfcr('#delivery_a4a5').modal(  {backdrop: 'static', keyboard: false, show: true});
					}

		    });


			//alert(localStorage.getItem(main_script_object.step));

		}
		},500);

	}

	//on button click
	$scope.loadreadymadecontent = function(){

		setTimeout(function(){
			//alert("fdsfsd")
	    if(pdfcr('#step2wrap').is(":visible")){

		    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_pdftpl_a4a5'}}).then(function(response) {
		        //$scope.readyMadeEntry = response.data;
				//$scope._hideObj = false;
					if(response.data==""){
						pdfcr('#delivery_a4a5').modal(  {backdrop: 'static', keyboard: false, show: true});
					}

		    });


			//alert(localStorage.getItem(main_script_object.step));

		}
		},500);

	    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_advertisement_entry'}}).then(function(response) {
	        $scope.advertisementEntry = response.data.records;
			$scope._hideObj = false;
	    });

	    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_readymade_entry'}}).then(function(response) {
	        $scope.readyMadeEntry = response.data.records;
			$scope._hideObj = false;
	    });


	}
	//on page load
    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_readymade_entry'}}).then(function(response) {
        $scope.readyMadeEntry = response.data.records;
		$scope._hideObj = false;
    });

    $http({method:'post',url:main_script_object.ajax_url,params:{pid:main_script_object.newsletter_id,action:'get_advertisement_entry'}}).then(function(response) {
        $scope.advertisementEntry = response.data.records;
		$scope._hideObj = false;
    });
});
