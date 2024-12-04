<link href="<?= STATIC_URL ?>js/upload/css/image.css" rel="stylesheet">
<link href="<?= STATIC_URL ?>js/upload/css/iconfont.css" rel="stylesheet">

<div class="form-group" style="margin-left: 152px;">
    <label class="col-sm-2 control-label image_list_class">图片</label>
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
    var upload_api = "<?=SITE_URL?>/api/uploader/index";
    var avator = "<?=$form['avator']?>";
    var avator_url = "<?=$form['avator_url']?>";
    $('.image-item').attr('src',avator);
    $('.image-item').attr('value',avator_url);
    $('.pic_url').attr('src',avator_url);

    // $(".upload-win").append(str);
</script>
<script id="upload_js" src="<?= STATIC_URL ?>js/upload/js/uploader.js"></script>