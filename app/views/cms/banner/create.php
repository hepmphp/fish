<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">名称</label>
            <div class="col-sm-4">
                <input id="name" name="name" type="text" value="<?=$form['name']?>" placeholder="名称" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">域名</label>
            <div class="col-sm-4">
                <input id="domain" name="domain" type="text" value="<?=$form['name']?>" placeholder="域名" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">图像地址</label>
            <div class="col-sm-4">
                <span>
                       <image src="<?=$form['image_url']?>" id="list_image" style="height: 60px;width: 60px;"></image>
                      <input id="image_url" name="image_url" type="text" value="<?=$form['']?>" placeholder="图像地址" class="form-control input-md">
                       <button type="button" class="btnImg btn btn-success" onclick="add_bannner_image()">浏览</button>
                </span>

            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <option value="0"  <?=$form['status']==0?'selected':''?>>正常</option>
                    <option value="-1"  <?=$form['status']==-1?'selected':''?>>删除</option>
                </select>
            </div>
        </div>

    </div>
</div>
<script src="<?=STATIC_URL?>js/ckfinder/ckfinder.js?<?=rand()?>"></script>
<script>
    function add_bannner_image(){
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    $('#image_url').val(file.getUrl());
                    $('#image_url').attr('src',file.getUrl()).show();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    // var output = $( '#list_image_url' );
                    // output.value = evt.data.resizedUrl;
                    $('#image_url').val(file.resizedUrl());
                    $('#image_url').attr('src',file.resizedUrl()).show();
                } );
            }
        } );
    }
</script>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</body>
</html>