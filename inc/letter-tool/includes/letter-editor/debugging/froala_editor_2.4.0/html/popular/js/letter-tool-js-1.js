 $(function(){  
        $('#edit').on('froalaEditor.initialized', function (e, editor) {    
            // append pages 
            $('.fr-toolbar').append("<input type='button' value='1' id='lt-total-pages'>") 

            var $teh = 0; // total editor height
            var $tph = 0;  // total page height
            var $tiv = 200; // total interval between editor and page heights
            var $tph = 220; 
            var $tphteh = 0; // difference between total editor height and total page height
            var $pageCounter = 1; // page counter 
            var $maxPageHeightPrev = 0; // preview max height of the page

            var top  = 0;
            var pageHeight = 0; // page max page height to match with element

            var maxPageHeight = 0;
            var maxPages = 0;
            var $contentPrev = '';

            var $pages = 
                    '{"attribute":[' +
                        '{"top":"150", "pageHeight":"100" },' + // index 0 
                        '{"top":"280", "pageHeight":"200" },' + // index 1
                        '{"top":"480", "pageHeight":"400" },' + // index 2
                        '{"top":"680", "pageHeight":"600" },' +  // index 3
                        '{"top":"880", "pageHeight":"800" },' +  // index 4
                        '{"top":"1080", "pageHeight":"1000" }' +  // index 4
                   '],"settings" : [' +
                        '{"maxPage":4}' +
                   ']}';

            $pages = JSON.parse($pages);  

            var $teh = $('.fr-element').height();
            
            console.log("initialized editor height "  + $teh);
              
            // detect typing content textarea of if there is achanges 
            $(this).parents('form').on('keyup', function () {


                pageTop =  getPageTop(); //$pages.attribute[$pageCounter].top;
                pageHeight = getPageHeightSpecific();  //$pages.attribute[$pageCounter].pageHeight;
                maxPageHeight = getMaxPageHeight(); // $tiv * $pageCounter;
                $maxPageHeightPrev = getMaxPageHeightPrev(); // maxPageHeight - getTotalIntervalForPageAndEditor();
     
                // get correct height of the textarea container 
              
                // add new page line when height is incremented
                //var $teh = $('.fr-element').height();

                //console.log("max page " + getMaxPages() + "counter " + $pageCounter +  " top = " + pageTop + " page height " + pageHeight + " maxPageHeight " + maxPageHeight + " teh " + $teh + " max prev height " + $maxPageHeightPrev + " next increment number " + incrementPageNumberCheck());

                //console.log("history: " +  getEditorContent() );


                //console.log("replace content of edit now");
                //$('.fr-element').html("testset set setsetset");

                if(getTotalEditorHeight() >  getPageHeightSpecific() ) {

                    if(incrementPageNumberCheck() >  getMaxPages()) {

                        alert("nah! max pages reached, change reverted!");

                        // update restore content from previous
                        restoreContentPreviousHistory();

                    } else {

                        // Just create default line and position by index and array
                        // move total element height to next max height that the page line will add again
                        addPageLine();

                        // count total pages
                        incrementPageNumber();

                        console.log(" new page created counter " + getPageCounter());

                        // add total pages
                        recordTotalPageInHeader();
                    }


                }  else {      

                    // Just remove default line and position by index and array 
                    console.log(" if(" + getTotalEditorHeight() + "  < " +getMaxPageHeightPrev() + ") { remove latest page. } ");

                    if(getTotalEditorHeight() <  getMaxPageHeightPrev()) {

                        // decrement page with 1 because remove 1
                        decrementPageNumber();

                        // hide page line
                        removePageLine();

                        // add page number 
                        recordTotalPageInHeader();
                    }
                }

                // if passed all the validation then save current content and this will served  as history
                setContentHistory();

            });





            function incrementPageNumberCheck() {
                return $pageCounter + 1;
            }
            function incrementPageNumber() {
                $pageCounter = $pageCounter + 1;
                return $pageCounter;
            }
            function decrementPageNumberCheck() {
                return $pageCounter - 1;
            }
            function decrementPageNumber() {
                $pageCounter = $pageCounter - 1;
                return $pageCounter;
            }
            function recordTotalPageInHeader(){
                $('#lt-total-pages').val($pageCounter)
            }
            function removePageLine() {
                console.log("remove last page counter this page = #letter-tool-page-line-separator-"+ $pageCounter);
                $('#letter-tool-page-line-separator-'+ $pageCounter).css({  'top': '0px', 'display': 'none'});
            }
            function addPageLine() {
                $("#letter-tool-page-line-separator-"+ $pageCounter).css({'top':getPageTop()+"px", 'display':'block'});
            }

            function getMaxPageHeight() {
                return  $tiv * $pageCounter;
            }
            function getMaxPageHeightPrev() {
                return  getMaxPageHeight() - getTotalIntervalForPageAndEditor();
            }
            function getTotalEditorHeight() {
                return  $('.fr-element').height();
            }
            function getPageHeightSpecific() {

                return $pages.attribute[$pageCounter].pageHeight;
            }
            function getMaxPages() {
                return $pages.settings[0].maxPage;
            }
            function getPageTop() {
                return $pages.attribute[$pageCounter].top;
            }
            function getTotalIntervalForPageAndEditor(){
                return $tiv;
            }
            function getPageCounter() {
                return $pageCounter;
            }
            function getEditorContent() {
                return $('.fr-element').html();

            }
            function setContentHistory() {
                $contentPrev = getEditorContent();
            }
            function getContentHistory() {
                return $contentPrev;
            }
            function updateEditorContent(content) {
                $('.fr-element').html(content);
            }
            function restoreContentPreviousHistory() {
                updateEditorContent(getContentHistory())
            }





            // detect clicked next 
            $(this).parents('form').on('submit', function () {
                console.log($('#edit').val());
                return false;
            });   
        }).froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
    });