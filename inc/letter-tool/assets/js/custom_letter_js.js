function letterTollNextStep(nextStepIndex) 
{
	// console.log("Test")
	// 
	console.log("index next page" + nextStepIndex)

	for(var i=1; i<5; i++) {
		$('#letter-tool-tab-'+i).attr('class', 'nav-item');
		$('#letter-tool-tab-'+i).attr('aria-expanded', false);
		$('#letter-tool-tab-'+i+'-content').attr('class', 'tab-pane');	
	}

	$('#letter-tool-tab-'+nextStepIndex).attr('class', 'nav-item active');
	$('#letter-tool-tab-'+nextStepIndex).attr('aria-expanded', true);
	$('#letter-tool-tab-'+nextStepIndex+'-content').attr('class', 'tab-pane active');
	
	
 
}