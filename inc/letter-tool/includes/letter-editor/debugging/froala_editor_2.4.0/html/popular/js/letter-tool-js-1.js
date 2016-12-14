 $(function(){ 


        $('#edit')
          .on('froalaEditor.initialized', function (e, editor) {  
             
            // append pages 
              $('.fr-toolbar').append("<input type='button' value='total page' id='lt-total-pages'>")
   
              var $teh = 0; // total editor height
              var $tph = 0;  // total page height
              var $tiv = 170; // total interval between editor and page heights
              var $tph = 220; 
              var $tphteh = 0; // difference between total editor height and total page height
              var $pageCounter = 1; // page counter 

              var top  = 0;
              var pageHeight = 0;

              var $pages = '{"attribute":[' +
                            '{"top":"100", "pageHeight":"100" },' +
                            '{"top":"100", "pageHeight":"100" },' +
                            '{"top":"200", "pageHeight":"200" },' +
                            '{"top":"300", "pageHeight":"300" },' +  
                            '{"top":"400", "pageHeight":"400" },' +  
                            '{"top":"500", "pageHeight":"500" }' +  
                          ']}'; 
              $pages = JSON.parse($pages); 
                  
 
              var $teh = $('.fr-element').height();
              console.log("heigh "  + $teh);
              
            // detect typing content textarea of if there is achanges 
            $(this).parents('form').on('keyup', function () { 


              pageTop =  $pages.attribute[$pageCounter].top; 
              pageHeight = $pages.attribute[$pageCounter].pageHeight;





            // get correct height of the textarea container 
              
              // add new page line when height is incremented
              var $teh = $('.fr-element').height(); 


      console.log( "top = " + pageTop + " page height " + pageHeight);
 


              if($teh > pageHeight) { 
 
                // Just create default line and position by index and array 
                // move total element height to next max height that the page line will add again
                $tph  = $teh; 
                console.log($tph + " + " + $tiv)
                $tph = $tph +$tiv; 
              

                    $("#letter-tool-page-line-separator-"+ $pageCounter).css({'top':pageTop+"px"});  


                // count total pages
                $pageCounter = $pageCounter + 1;   

                // open new page and add new page line 
                // $('.fr-element').append("<div id='letter-tool-page-line-separator-"+ $pageCounter+"' class='letter-tool-page-line-separator' style='top:"+pageTop+"px;  '> </div>");


           

                 // add total pages
                $('#lt-total-pages').val($pageCounter)  
                console.log("1  new page created");





              }  else {     
                    // Just remove default line and position by index and array


                  console.log("2. no new page created");
                  $tphteh = $tph - $teh;  
                  if( $tphteh > $tiv) { 
                    console.log("remove 1 page now ");   
                   $pageCounter = $pageCounter - 1;     
                    $('#letter-tool-page-line-separator-'+ $pageCounter).css({'border':'none', 'height':'0px', 'top': '0px'}); 



                      // remove div now 
                      // $('#letter-tool-page-line-separator-'+$pageCounter).css('display', 'none'); 
                      // decrement page with 1
                     
                      // backward with 1 for total element 
                      $tph  = $teh; 
                      $tph = $tph - $tiv;   
                  } 
                  // $tphteh = $teh  - $tph;  
                  // if($tphteh > $tiv) {  
                  //   $pageCounter = $pageCounter - 1; 
                  //   $('#letter-tool-page-line-separator-'+$pageCounter).css('display', 'none'); 
                  // } 
              }
 
              // print console
              console.log("teh"  + $teh + " tph " + $tph  + " page  " + $pageCounter + "  tphteh = " + $tphteh + "  tiv = " + $tiv);   
            });   
 



            // detect clicked next 
            $(this).parents('form').on('submit', function () {
              console.log($('#edit').val());
              return false;
            });  


          })
          .froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
      });