var imgNum=1;
var offsBooL=true;
uploadImg();//多图上传
function uploadImg(){
    $(".upload-img-mutil input").change(function() {
        var that = $(this);
        console.log(that);
        var formdata = new FormData();
        formdata.append('file', this.files[0]);
        var str = '<div class="upload-img  upload-img-mutil left"><span class="image-item"></span><img src="http://127.0.0.1/static/doc/image/upload_image.png" alt=""><input type="file" name="images" style="opacity:0" accept="image/*" capture="camera"/><i class="iconfont icon-lajitong"></i><i class="iconfont icon-tianjia"></i><div class="over-cover"></div></div>';
        $.ajax({
            type: 'POST',
            url: upload_api,
            data: formdata,
            async: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            // headers: { 'X-CSRF-TOKEN': dataType },
            success: function (result) {
                console.log(result);
                if(result.status==0){
                    console.log(result);
                    that.data('name', result.data.filename);
                    that.css({'z-index': '0'});
                    console.log(that.parent());
                    that.parent().find(".icon-tianjia").hide();
                    that.parent().find("img").attr({'src': result.data.url});
                    that.parent().find(".image-item").attr({'src': result.data.filename});
                    imgNum=$('.upload-img-mutil').length;
                    that.parent().parent().parent().find(".upload-win").append(str);
                    image_show_bind();
                    uploadImg();

                }else{
                    layer.msg(result.msg, function(){
                    });
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(textStatus);
                console.log(errorThrown);
                console.log(XMLHttpRequest.responseText);
                var result = jQuery.parseJSON(XMLHttpRequest.responseText);
                console.log(result);

            },
        });
    });
}
image_show_bind();
function image_show_bind(){
    $(".upload-img").mouseover(function() {
        if ($('.upload-img-mutil').length > 1) {
            console.log($(this).find('.image-item').attr('src'));
            if ($(this).find('.image-item').attr('src')!=undefined) {
                $(this).find('.icon-lajitong').show();
                $(this).find('.over-cover').show();
            }
        }
        $(this).click(function () {
            if ($('.upload-img-mutil').length > 1) {
                if($(this).find('.image-item').attr('src')!=undefined){
                    $(this).remove();
                    return false;
                }
            }
        });
    });

    $('.upload-img').mouseout(function(){
        $('.icon-lajitong').hide();
        $('.over-cover').hide();
    });
}