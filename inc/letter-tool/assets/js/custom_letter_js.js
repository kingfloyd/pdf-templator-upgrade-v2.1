/**
 *  Hit next button and proceed to next tab 
 */
function letterTollNextStep(nextStepIndex) 
{  
	// trigger next step 1,2,3,4
	letterToolTriggerNext(nextStepIndex)  
	// step 1 checked next  
	
	// step 2 checked next
	// step 3 checked next
	// step 4 checked next 
} 
function letterToolTriggerNext(nextStepIndex) { 
	for(var i=1; i<5; i++) {
		$('#letter-tool-tab-'+i).attr('class', 'nav-item');
		$('#letter-tool-tab-'+i).attr('aria-expanded', false);
		$('#letter-tool-tab-'+i+'-content').attr('class', 'tab-pane');	
	}  
	$('#letter-tool-tab-'+nextStepIndex).attr('class', 'nav-item active');
	$('#letter-tool-tab-'+nextStepIndex).attr('aria-expanded', true);
	$('#letter-tool-tab-'+nextStepIndex+'-content').attr('class', 'tab-pane active');  
}