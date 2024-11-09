<link href="<?= STATIC_URL ?>js/upload/css/image.css" rel="stylesheet">
<link href="<?= STATIC_URL ?>js/upload/css/iconfont.css" rel="stylesheet">

<div class="form-group">
    <label class="col-sm-1 control-label image_list_class">图片：</label>
    <div class="col-sm-4">
        <div class="upload-win">
            <div class="upload-img upload-img-mutil left">
                <img src="" alt=""  class="pic_url">
                <span class="image-item" src=""></span>
                <input type="file" name="images" class="images" style="opacity:0" accept="image/*" capture="camera">
                <i class="iconfont icon-lajitong"></i>
                <i class="iconfont icon-tianjia"></i>
                <div class="over-cover"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var upload_api = "<?='http://'.$_SERVER['HTTP_HOST'].'/api/uploader/index';?>";
   // var images_list = <?php echo json_encode($form['list_image_url']); ?>;
  //  var str='<div class="upload-img  upload-img-mutil left"><span class="image-item"></span><img src="" alt=""><input type="file" name="images" style="opacity:0" accept="image/*" capture="camera"/><i class="iconfont icon-lajitong"></i><i class="iconfont icon-tianjia"></i><div class="over-cover"></div></div>';
    console.log(images_list);
    $.each(images_list,function (i,v){
        $('.image-item').eq(i).attr('src',v);
        $('.image-item').eq(i).attr('value',v);
    });
    $.each(image_list_url,function (i,v){
        $('.pic_url').eq(i).attr('src',v);
    });
   // $(".upload-win").append(str);
</script>
<script id="upload_js" src="<?= STATIC_URL ?>js/upload/js/uploader.js"></script>