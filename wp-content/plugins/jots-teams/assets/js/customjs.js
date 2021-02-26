jQuery(function ($) {
	var datanum = 0;
	var $popimg = $('#popimg');
	var $textss = $('#popcon');
	var imgclone = $(".teamimage").clone();
	var textclone = $(".teaminfo").clone();
    $('.teamimage').click(function () {
        datanum = $(this).data('num');
        var imgsrc = $(this).attr('src');
        $('#popupteam').fadeIn(300);
        $popimg.attr('src', imgsrc);
		if($(this).siblings()[0]!==undefined){
			$textss.html($(this).siblings()[0].innerHTML);
		}
		else{
			$textss.text('')
		}
        $('#popupteam').css('display', 'block');

    })
	$('#prev').click(function () {
		--datanum;
		if (datanum < 0) {
			datanum = imgclone.length - 1;
		}
		$popimg.slideDown(3000);
		$popimg.attr('src', imgclone[datanum].src);
		if(textclone[datanum]!==undefined){
			$textss.html(textclone[datanum].innerHTML);
		}
		else{
			$textss.text('')
		}
	})
	$('#next').click(function () {
		++datanum;
		if (datanum >= imgclone.length) {
			datanum = 0;
		}
		$popimg.attr('src', imgclone[datanum].src);
		if(textclone[datanum]!==undefined){
			$textss.html(textclone[datanum].innerHTML);
		}
		else{
			$textss.text('')
		}

	})
    $('#close').click(function () {
        $('#popupteam').css('display', 'none');
    })
});