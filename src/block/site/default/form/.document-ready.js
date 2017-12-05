$(".form__control[type='tel']").mask("+7 (999) 999-99-99",{placeholder:"+7 (___) ___-__-__"});
$(".form__block").validationEngine(
	'attach', {
		promptPosition : "bottomLeft",
		scrollOffset: 200
	}
);
$('button[data-heading]').on('click', function(){
	var heading = $(this).attr("data-heading")
	$(".form__control.is--products").attr("value", heading);
});
//$(".form__control.is--products").attr("value", "1");