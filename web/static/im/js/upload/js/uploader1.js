// 上传图片
var uploaderApi = '?r=api/upload-mutil/index';
var offsBooL=true;
uploadImgOne();//单图上传
uploadImg();//多图上传

function uploadImg(){
	$(".upload-img-mutil input").change(function() {
		var that=$(this);
		var formdata=new FormData();
		var group_name = $(that).parent().parent().find(".group_name").val();

		formdata.append('image',this.files[0]);
		formdata.append('group_name',group_name);
		var str='<div class="upload-img  upload-img-mutil  left"><span class="image-item" src=""></span><img src="" alt=""  class="pic_url"><input type="file" name="images" style="opacity:0" accept="image/*" capture="camera"/><i class="iconfont icon-lajitong"></i><i class="iconfont icon-tianjia"></i><div class="over-cover"></div></div>';
		$.ajax({
			type: 'POST',
			url: uploaderApi,
			data: formdata,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			// headers: { 'X-CSRF-TOKEN': dataType },
			success: function (result) {
				that.data('name',result.data.name);
				that.css({'z-index':'0'});
				that.parent().find(".icon-tianjia").hide();
				that.parent().find("img").attr({'src':result.data.url});
				that.parent().find(".image-item").attr({'src':result.data.file_path});
				that.parent().parent().parent().find(".upload-win").append(str);
				uploadImg();
			}
		});
		that.parent().parent().parent().find(".upload-img").mouseover(function(){
			if($(this).children('img').attr('src') !==''){
				$(this).children('.icon-lajitong').show();
				$(this).children('.over-cover').show();
			}
			$(this).children('.icon-lajitong').click(function(){
				$(this).parent().remove();
				if(offsBooL){
					offsBooL=false;
					setTimeout(function(){
					offsBooL=true;
					}, 50);
				}
			});
		});
		$('.upload-img').mouseout(function(){
			  $('.icon-lajitong').hide();
			  $('.over-cover').hide();
		});
	});
}

function uploadImgOne(){
    $(".upload-img-one input").change(function() {
        var that=$(this);
        var formdata=new FormData();
        var group_name = $(that).parent().parent().find(".group_name").val();
        formdata.append('image',this.files[0]);
        formdata.append('group_name',group_name);
        $.ajax({
            type: 'POST',
            url: uploaderApi,
            data: formdata,
            async: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            // headers: { 'X-CSRF-TOKEN': dataType },
            success: function (result) {
                that.data('name',result.data.name);
                that.css({'z-index':'0'});
				that.parent().find(".icon-tianjia").hide();
                that.parent().find("img").attr({'src':result.data.url});
                //that.parent().find(".image-item").attr({'src':result.data.file_path});
                that.parent().find(".image-item").attr({'value':result.data.file_path});
            }
        });

    });
}

//删除按钮
$(".upload-img").mouseover(function(){
    var that = $(this);
      if($(this).children('img').attr('src') !==''){
          $(this).children('input').css({'z-index':'0'});
          $(this).children('.icon-tianjia').hide();
          $(this).children('.icon-lajitong').show();
          $(this).children('.over-cover').show();

          $(this).children('.icon-lajitong').click(function(){
			  //单个图片
              if(that.siblings('.upload-img').length == 0){
                  that.children('input').css({'z-index':'6'});
                  that.children('.icon-tianjia').show();
                  that.children("img").attr({'src':''});
                  that.children(".image-item").attr({'value':''});

              }
              else
              {
                  $(this).parent().remove();
                  if(offsBooL){
                      offsBooL=false;
                      setTimeout(function(){
                          offsBooL=true;
                      }, 50);
                  }

              }
          });
      }
});
$('.upload-img').mouseout(function(){
	$('.icon-lajitong').hide();
	$('.over-cover').hide();
});
 
