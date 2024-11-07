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

<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tabbable">
                        <ul class="nav nav-tabs aw-nav-tabs active">
                            <h2><i class="icon icon-setting"></i> 添加论坛分类</h2>
                        </ul>
                    </div>

                    <div class="tab-content clearfix">
                        <div class="aw-mod">
                            <div class="mod-body" style="width: 600px;margin-left: 30px;">
                                <div class="aw-mod aw-user-setting-bind">
                                        <div class="mod-body">

                                            <select id="parentid" name="parentid" style="font-size: 25px;width: 300px;margin-top: 30px;">
                                                    <option value="0">请选择</option>
                                                    <?=$config_menu?>
                                            </select>
                                        </div>
                                </div>
                            </div>

                            <div class="mod-body" style="width: 600px;margin-left: 30px;margin-top: 30px;">
                                <div class="aw-mod aw-user-setting-bind">
                                    <div class="mod-body">
                                         <input  type="text" id="name" name="name" placeholder="分类名称" style="width: 300px;font-size: 25px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mod-footer clearfix">
                                <a href="javascript:;" class="btn btn-large btn-success pull-right" id="add_forum_list" style=" margin-right: 1000px;margin-top: 30px">添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
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