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
    <?=\app\helpers\AppFormAsset::run()?>
</head>
<body>
<div class="container col-sm-12">
    <form class="form-horizontal" style="margin-top: 15px">
        <input type="hidden" name="id" id="id" value="<?=$form['id']?>">
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="name">账号:</label>
            <div class="col-md-4">
                <input id="username" name="username" value="<?=$form['username']?>" type="text" placeholder="账号" class="form-control input-md">

            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="model">姓名</label>
            <div class="col-md-4">
                <input id="realname" name="realname"  value="<?=$form['realname']?>" type="text" placeholder="姓名" class="form-control input-md">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="action">密码</label>
            <div class="col-md-4">
                <input id="password" name="password"  value="" type="password" placeholder="密码" class="form-control input-md">

            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="action">确认密码</label>
            <div class="col-md-4">
                <input id="re_password" name="re_password" type="password" value="" type="text" placeholder="确认密码" class="form-control input-md">

            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="status">所属分组</label>
            <div class="col-md-4">
                <select id="group_id" name="group_id" class="form-control">
                    <?php
                    foreach($user_group as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['group_id']){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="action">用户默认进入页面</label>
            <div class="col-md-4">
                <input id="admin_url" name="admin_url"  value="" type="text" placeholder="" class="form-control input-md" value="<?=$form['admin_url']?>">

            </div>
        </div>


    </form>
</div>
</body>
<?=\app\helpers\AppFormAsset::run_javascript_end()?>
</html>