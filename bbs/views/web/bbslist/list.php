<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit" />
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区" />
    <meta name="description" content="WeCenter 社交化知识社区"  />
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include BBS_PATH.'views/web/common/header.php'?>

<body class="form-body">
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form">
            <div class="form-group">
                <label class="control-label">分类名称：</label><input id="name" name="name" class="form-control" type="text">
            </div>

    </div>
    <button class="btn btn-info m-l" type="button" onclick="search_list()"> 查询</button>

    <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add_user()">
    </form>
</div>
<div class="table-wrap">
    <table data-toggle="table" class="table-item table" >
        <thead>
        <tr>
            <th class="col-5">id</th>
            <th  class="col-5">名称</th>
            <th  class="col-5">父分类id</th>
            <th  class="col-5">父分类名称</th>
            <th  class="col-5">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td  class="col-5"></td>
            <td  class="col-5"></td>
            <td class="col-5"></td>
            <td  class="col-5"></td>
            <td class="col-5"></td>
            <td  class="col-5"></td>
            <td  class="col-5"></td>
            <td  class="col-5"></td>
        </tr>
        </tbody>
    </table>
</div>
</div>
</body>
<script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
<link href="<?=STATIC_URL?>js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=STATIC_URL?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script>

    $("#add_forum_list").click(function () {
        var name = $('#name').val();
        var parentid = $('#parentid').val();
        if (name == '') {
            layer.msg('分类名称不能为空', {icon: 2});
            return false;
        }

        var param = {
            name: name,
            parentid:parentid
        };
        console.log(param);
        $.ajax({
            type: 'POST',
            url: '/bbs.php/web/bbslist/create',
            data: param,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 0) {
                    layer.alert(data.msg, {icon: 1}, function () {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg, {icon: 2}, function () {
                        layer.closeAll();
                    });
                }
            }
        });
    });
</script>
</html>