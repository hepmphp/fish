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
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<body class="form-body">
<div class="form-wrapper" style="padding-top: 0">
    <ul class="list-inline page-tab clearfix">
         <li ><a href="/publish/task/index?iframe=1">任务列表</a><em></em></li>
        <li   class="cur"><a href="/publish/task/apply?iframe=1">发布申请</a><em></em></li>
         <li ><a href="/publish/task/publish?iframe=1">任务发布</a><em></em></li>
        <li ><a href="/publish/task/rollback?iframe=1">任务回滚</a><em></em></li>
        <li ><a href="//127.0.0.1:3000" target="_blank">git仓库</a><em></em></li>
    </ul>
    <div class="form-item">
        <div class="form-main">
            <div class="form-inline">
                <div class="form-group">
                    <label class="control-label">项目：</label>
                    <select class="form-control" id="project_id">
                        <?php foreach ($project_list as $k=>$project){?>
                        <option value="<?=$project['id']?>"><?=$project['name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="form-inline">
                <div class="form-group">
                    <label class="control-label">文件：</label>
                    <textarea class="form-control" placeholder="要上线的文件列表,全量上线填*即可" id="file_list"  ><?=$form['file_list']?></textarea>
                </div>
            </div>

            <div class="form-inline">
                <div class="form-group">
                    <label class="control-label">备注：</label>
                    <textarea class="form-control"  placeholder="发布备注" id="comment"><?=$form['comment']?></textarea>
                </div>
            </div>
            <?php if(isset($form['id'])){ ?>
                <button class="btn btn-info m-l-74" type="button" id="btn_publish"> 确认修改</button>
            <?php }else{?>
                <button class="btn btn-info m-l-74" type="button" id="btn_publish"> 确认添加</button>
            <?php }?>
        </div>


    </div>

</div>
</body>
<script>
    $('#btn_publish').click(function() {
        var param = {
            project_id: $('#project_id').val(),
            project_name: $('#project_id').find("option:selected").text(),
            file_list: $('#file_list').val(),
            comment: $('#comment').val(),
        };
        if (window.location.search.match(/\?id=(\d+)/)) {
            param['id'] = window.location.search.match(/\?id=(\d+)/)[1];
            ajax_post('/api/publish/task/create', param);
        } else {
            ajax_post('/api/publish/task/create', param);
        }
    });
</script>
</html>