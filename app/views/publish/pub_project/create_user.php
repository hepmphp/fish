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
        <li><a href="/publish/project/index?iframe=1">项目列表</a><em></em></li>
        <li><a href="/publish/project/create">添加项目</a><em></em></li>
        <li  class="cur"><a href="/publish/project_member/index">项目用户</a><em></em></li>
    </ul>
    <div class="form-item">

        <form class="form-inline clearfix" role="form">
            <div class="form-group">
                <label class="control-label">项目：</label>
                <select class="form-control" id="project_id">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">用户id：</label>
                <select class="form-control" id="admin_id">
                    <option value=""></option>
                </select>
            </div>
            <button class="btn btn-info m-l" type="button" id="btn_add"> 添加</button>

            <div class="form-group">
                <label class="control-label">名称：</label>
                <input type="text" class="form-control" id="name">
            </div>

            <button class="btn btn-info m-l" type="button" id="btn_search"> 查询</button>

        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="">
            <thead>
            <tr>
                <th>id</th>
                <th>项目id</th>
                <th>项目名称</th>
                <th>管理员id</th>
                <th>管理员名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
</html>