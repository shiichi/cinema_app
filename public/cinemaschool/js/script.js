// JavaScript Document
//全ページ　上へスクロール
$(function() {
	var topBtn = $('#page-top');	
	topBtn.hide();
	//スクロールが100に達したらボタン表示
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
	//スクロールしてトップ
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});

//映画一覧　検索
var GuideSentence = 'タイトル名で検索する';
   function ShowFormGuide(obj) {
      if( obj.value == '' ) {
         obj.value = GuideSentence;
         obj.style.color = '#cacace';
      }
   }
   function HideFormGuide(obj) {
      if( obj.value == GuideSentence ) {
         obj.value='';
         obj.style.color = '#000000';
      }
   }
   