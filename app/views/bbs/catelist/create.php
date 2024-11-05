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
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="id">id</label>
            <div class="col-sm-4">
                <input id="id" name="id" type="text" value="<?=$form['id']?>" placeholder="id" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="fid">板块id</label>
            <div class="col-sm-4">
                <input id="fid" name="fid" type="text" value="<?=$form['fid']?>" placeholder="板块id" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="pid">父id</label>
            <div class="col-sm-4">
                <input id="pid" name="pid" type="text" value="<?=$form['pid']?>" placeholder="父id" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="subject">主题</label>
            <div class="col-sm-4">
                <input id="subject" name="subject" type="text" value="<?=$form['subject']?>" placeholder="主题" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="content">内容</label>
            <div class="col-sm-4">
                <input id="content" name="content" type="text" value="<?=$form['content']?>" placeholder="内容" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="created_time">发帖时间</label>
            <div class="col-sm-4">
                <input id="created_time" name="created_time" type="text" value="<?=$form['created_time']?>" placeholder="发帖时间" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="user_id">用户id</label>
            <div class="col-sm-4">
                <input id="user_id" name="user_id" type="text" value="<?=$form['user_id']?>" placeholder="用户id" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="username">用户名</label>
            <div class="col-sm-4">
                <input id="username" name="username" type="text" value="<?=$form['username']?>" placeholder="用户名" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="ip">用户ip</label>
            <div class="col-sm-4">
                <input id="ip" name="ip" type="text" value="<?=$form['ip']?>" placeholder="用户ip" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="modified_time">修改帖子时间</label>
            <div class="col-sm-4">
                <input id="modified_time" name="modified_time" type="text" value="<?=$form['modified_time']?>" placeholder="修改帖子时间" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="modified_username">修改帖子的用户</label>
            <div class="col-sm-4">
                <input id="modified_username" name="modified_username" type="text" value="<?=$form['modified_username']?>" placeholder="修改帖子的用户" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="modified_userid">修改贴子的用户id</label>
            <div class="col-sm-4">
                <input id="modified_userid" name="modified_userid" type="text" value="<?=$form['modified_userid']?>" placeholder="修改贴子的用户id" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="modified_ip">修改帖子的ip</label>
            <div class="col-sm-4">
                <input id="modified_ip" name="modified_ip" type="text" value="<?=$form['modified_ip']?>" placeholder="修改帖子的ip" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="total_reply">帖子回复数</label>
            <div class="col-sm-4">
                <input id="total_reply" name="total_reply" type="text" value="<?=$form['total_reply']?>" placeholder="帖子回复数" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">帖子状态</label>
            <div class="col-sm-4">
                <input id="status" name="status" type="text" value="<?=$form['status']?>" placeholder="帖子状态" class="form-control input-md">
            </div>
        </div>

    </div>
</div>

</body>
<?=\app\helpers\AppFormAsset::run_javascript_end()?>
</html>