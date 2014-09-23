
//ギャラリー生成前
$(function(){
		$.ajax({
			url: 'http://instass.xyz/photos.php',
			dataType: 'json',
			async: true,
			success: function(json){
				var html = '';
				for(var i=0; i<json.results.length;i++){
					html += '<section id ='+ json.results[i].id +'>' + '<span></span>' + '<img src="' + json.results[i].high_image.url +'">' + '</section>';
				$('#makegallery').html(html);
				$('#makegallery>section').addClass('box');
				$('#makegallery>section>img').attr('width', '100%');
				$('section>span').addClass('circle');
				}
			},
			error: function(html){
				alert('データの読み込みに失敗しました');
			}
		});
});
//ギャラリー生成後
$(function(){
    var username = window.location.pathname;
    username = username.split("/");
    username = username[1].split(".");
		$.ajax({
			url: 'http://instass.xyz/photos.php?username='+ username[0],
			dataType: 'json',
			async: true,
			success: function(json){
				var html = '';
				for(var i=0; i<json.results.length;i++){
					html += '<section id ='+ json.results[i].id +'>' +'<a href="' + json.results[i].high_image.url +'">' + '<img src="' + json.results[i].high_image.url +'">' + '</a>' + '</section>';
				$('#mygallery').html(html);
				$('#mygallery>section').addClass('box');

				$('section>a').attr('data-lightbox', 'sample');
				}
			},
			error: function(html){
				alert('データの読み込みに失敗しました');
			}
		});
});
$(function(){
//クリック順
		var i = 0;
		var photos = "";
	$(function(){

		$(document).on("click", "section", function(){
			if($('span',this).text()){
				if($('span',this).text() == i){
					$('span',this).text("").css('display', 'none');
					photos = photos.replace($(this).attr('id')+",", "");
					i -= 1;
				}
			return false;
			}else{
			$('span',this).text(i+1)
			.css('display', 'block');
			photos += ($(this).attr('id') + ",");
			console.log(photos);
			i++;
			}
		});
	});

//id順にソート
	$(function(){
	$(document).on("click", "#sort", function(){
		if(photos == ""){
			alert('写真を選択してください');
			return false;
		}else{
		$('form').append('<input type="hidden" name=photos value=' + photos + '>');
	$('span').css('display', 'none').text('');
	i=0;
	}
});
});

$(function(){
	$(document).on("click", "#reset", function(){
		if(!confirm("Galleryを破棄して、Instagramから写真を再度読み込みます。\nよろしいですか？")){
			return false;
		}
		
	});
});
});
