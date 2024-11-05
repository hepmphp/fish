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
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?php \app\helpers\AppFormAsset::run()?>
</head>
<body>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="id">用户ID</label>
            <div class="col-sm-4">
                <input id="id" name="id" type="text" value="<?=$form['id']?>" placeholder="用户ID" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="username">用户名字</label>
            <div class="col-sm-4">
                <input id="username" name="username" type="text" value="<?=$form['username']?>" placeholder="用户名字" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="email">Email地址</label>
            <div class="col-sm-4">
                <input id="email" name="email" type="text" value="<?=$form['email']?>" placeholder="Email地址" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="password">随机密码</label>
            <div class="col-sm-4">
                <input id="password" name="password" type="text" value="<?=$form['password']?>" placeholder="随机密码" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <input id="status" name="status" type="text" value="<?=$form['status']?>" placeholder="状态" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="groupid">当前用户组ID</label>
            <div class="col-sm-4">
                <input id="groupid" name="groupid" type="text" value="<?=$form['groupid']?>" placeholder="当前用户组ID" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="regdate">注册时间</label>
            <div class="col-sm-4">
                <input id="regdate" name="regdate" type="text" value="<?=$form['regdate']?>" placeholder="注册时间" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="groups">用户附加组的ID缓存字段</label>
            <div class="col-sm-4">
                <input id="groups" name="groups" type="text" value="<?=$form['groups']?>" placeholder="用户附加组的ID缓存字段" class="form-control input-md">
            </div>
        </div>

    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>