<link href="<?= STATIC_URL ?>js/upload/css/image.css" rel="stylesheet">
<link href="<?= STATIC_URL ?>js/upload/css/iconfont.css" rel="stylesheet">

<div class="form-group" style="margin-left: 156px;">
    <label class="col-sm-2 control-label image_list_class">图片：</label>
    <div class="col-sm-4" style="width: 500px;">
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
    var upload_api = "<?=SITE_URL.'im.php/api/uploader/index';?>";
    var avatar = "<?=($form['avatar']); ?>";
    var avatar_url = "<?=($form['avatar_url']); ?>";
    if(avatar==''){
        avatar_url = 'http://127.0.0.1/static/admin/images/upload_image.png';
    }
    $('.image-item').attr('src',avatar);
    $('.image-item').attr('value',avatar_url);
    $('.pic_url').attr('src',avatar_url);

   // $(".upload-win").append(str);
</script>
<script id="upload_js" src="<?= STATIC_URL ?>js/upload/js/uploader.js"></script>