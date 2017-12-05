if(screenJS.device()) {
	$('.faq-panel__block').removeAttr('id');
} else {
	$('.faq-panel__block').attr('id', 'faq-list'); 
}