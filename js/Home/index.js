$(function(){

	$('.mdl-card__title, .mdl-card__title-text').mouseenter(function(){
		console.log('hover!');
		var title = $(this);
		var content = title.parent().find('.mdl-card__supporting-text');
		
		content.slideDown();
	});
	$('.mdl-card__title, .mdl-card__title-text').mouseleave(function(){
		console.log('leave!');
		console.log('hover!');
		var title = $(this);
		var content = title.parent().find('.mdl-card__supporting-text');
		
		content.slideUp();
	});

});