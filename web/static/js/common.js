/*根据浏览器大小改变*/
function demo(){
$(".Business-back").height($(window).height()-60);
$(".Business-right").width($(".Business-back").width() - 180);
$(".left-Catalog").height($(".Business-left").height() - 140)
$(".Business-right").removeClass('transition');
$(".Business-left").removeClass('transition');
if ($(".Business-left").hasClass("left_0")) {
$(".Business-right").width($(".Business-back").width() - 180);      
}else if ($(".Business-left").hasClass("left_275")){
 $(".Business-right").width($(".Business-back").width() - 45);       
}

}
$(document).ready(function() {
	demo();
});
 $(window).resize(function(){
	demo();
});


/*退出账号*/
$(function(){
	$('.user-item').click(function(){
		$('.user-con').slideToggle();
	})
})
/*左侧导航*/
$(".list-teggol").on("click",function () {
$('.Computer-infor').hide();
$('.ssion-dd').stop();
$(this).parent().siblings('dt').removeAttr('id');
if($(this).parent().attr('id')=='open'){
    $(this).parent().removeAttr('id').siblings('dd').slideUp();
}else{
    $(this).parent().attr('id','open').next().slideToggle().siblings('dd').slideUp().siblings('dt');
}
});

$(".fa-database").click(function() {
	$(this).siblings('.Computer-infor').toggle();
})
/*iframe 链接*/
$(".J_menuItem").on('click',function(){
var url = $(this).attr('href');
$("#J_iframe").attr('src',url);
$(this).parent('li').addClass('on').siblings('li').removeClass('on');
$(this).parents('.nav-toggle').siblings().find('li').removeClass('on');
$(this).parents('.leftnav-view').siblings('.nav-open').addClass('selected');
$(this).parents('.nav-toggle').siblings().find('.nav-open').removeClass('selected');
return false;
});
/*左侧栏目 滑动*/
$(function(){
	$(".Slide-left").click(function(){
		$(".Business-right").addClass('transition');
		$(".Business-left").addClass('transition');
	 if($(".Business-left").hasClass("left_0")) {
	   $(".Business-left").removeClass("left_0").addClass("left_275"); 
	   $(".Business-right").width($(".Business-back").width() - 45);
	   $(".Slide-left").addClass('shift');
		}else if ($(".Business-left").hasClass("left_275")){
        $(".Business-left").removeClass("left_275").addClass("left_0"); 
       $(".Business-right").width($(".Business-back").width() - 180); 
       $(".Slide-left").removeClass('shift');
		}

	})
})
/*$(function(){
setTimeout(function(){
$(".Business-right").addClass('transition');
$(".Business-left").addClass('transition');
$(".Business-left").removeClass("left_0").addClass("left_275"); 
$(".Business-right").width($(".Business-back").width() - 45); 
$(".Slide-left").addClass('shift'); 
},2000);
})*/
$(function(){
	$('.nav-open').click(function(){
		$(this).next('ul').slideToggle();
	})
})



