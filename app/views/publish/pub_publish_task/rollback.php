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
        <li  ><a href="/publish/task/apply?iframe=1">发布申请</a><em></em></li>
        <li ><a href="/publish/task/publish?iframe=1">任务发布</a><em></em></li>
        <li  class="cur"><a href="/publish/task/rollback?iframe=1">任务回滚</a><em></em></li>
    </ul>
    <div class="form-item">
        <div class="form-main">
            <div class="row">
                <div class="col" style="float:left">
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">项目：</label>
                            <select class="form-control" id="project_id" disabled="">
                                <?php foreach ($project_list as $k=>$project){?>
                                    <option value="<?=$project['id']?>"><?=$project['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">类型：</label>
                            <select class="form-control" id="rollback_type">
                                <option value="0">请选择</option>
                                <option value="1">备份还原</option>
                                <option value="2">git_tag</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">标签/目录：</label>
                            <select class="form-control" id="tags">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">备注：</label>
                            <textarea class="form-control" placeholder="发布备注" id="comment"></textarea>
                        </div>
                    </div>

                    <button class="btn btn-info m-l-74" type="button" id="btn_rollback">回滚</button>
                </div>
                <div class="col" style="float:right">
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">远程ip：</label>
                            <textarea class="form-control" placeholder="" id="rsync_remote_hosts" readonly=""><?=$project['rsync_remote_hosts']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">远程目录：</label>
                            <textarea class="form-control" placeholder="" id="rsync_remote_www" readonly=""><?=$project['rsync_remote_www']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">本地路径：</label>
                            <textarea class="form-control" placeholder="" id="rsync_local_www" readonly=""><?=$project['rsync_local_www']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>