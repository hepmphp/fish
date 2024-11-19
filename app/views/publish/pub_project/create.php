<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
        <li class="cur"><a href="/publish/project/create">添加项目</a><em></em></li>
        <li  ><a href="/publish/project/create_user">项目用户</a><em></em></li>
    </ul>
    <div class="form-item">

        <div class="form-main">
            <div class="row">
                <div class="col" style="float: left">

                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">项目名称：</label>
                            <input type="text" class="form-control"  placeholder="项目名称" id="name" value="<?=$form['name']?>">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">项目类型：</label>
                            <select class="form-control" id="type">
                                <?php foreach ($config_type as $k=>$type){ ?>
                                    <option value="<?=$k?>"><?=$type['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">仓库地址：</label>
                            <textarea class="form-control" placeholder="仓库地址" id="repo_url" style="width:300px"><?=$form['repo_url']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">仓库账号：</label>
                            <input type="text" class="form-control" placeholder="仓库账号" id="repo_username" value="<?=$form['repo_username']?>">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">仓库密码：</label>
                            <input type="text" class="form-control" placeholder="仓库密码" id="repo_password" value="<?=$form['repo_password']?>">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">宿主目录：</label>
                            <input type="text" class="form-control" placeholder="宿主目录" id="rsync_local_www" value="<?=$form['rsync_local_www']?>" style="width:300px">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">备份目录：</label>
                            <input type="text" class="form-control" placeholder="备份目录" id="rsync_back_www"  value="<?=$form['rsync_back_www']?>" style="width:300px">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">线上保留版本数</label>
                            <input type="text" class="form-control" placeholder="线上保留版本数" id="keep_version_num"  value="<?=$form['keep_version_num']?>">
                        </div>
                    </div>

                </div>
                <div class="col" style="float: right">

                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">远程目录：</label>
                            <textarea   class="form-control" placeholder="远程目录" id="rsync_remote_www"   style="width:300px"><?=$form['rsync_remote_www']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">远程ip：</label>
                            <textarea   class="form-control" placeholder="远程ip" id="rsync_remote_hosts"   style="width:300px"><?=$form['rsync_remote_hosts']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">过滤列表：</label>
                            <textarea   class="form-control" placeholder="要过滤的文件列表" id="rsync_exclude"    style="width:300px"><?=$form['rsync_exclude']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">同步账号：</label>
                            <input type="text"  class="form-control" placeholder="同步账号" id="rsync_user" value="<?=$form['rsync_user']?>"  style="width:300px">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">同步前执行的任务：</label>
                            <textarea    class="form-control" placeholder="同步前执行的任务" id="before_deploy"  style="width:300px"><?=$form['before_deploy']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">同步后执行的任务：</label>
                            <textarea   class="form-control" placeholder="同步后执行的任务" id="after_deploy"  style="width:300px"><?=$form['after_deploy']?></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <?php if(isset($form['id'])){ ?>
            <button class="btn btn-info m-l-74" type="button" id="btn_project"> 确认修改</button>
            <?php }else{ ?>
            <button class="btn btn-info m-l-74" type="button" id="btn_project"> 确认添加</button>
            <?php }?>
        </div>


    </div>
    <?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>
    $('#btn_project').click(function(){
        var param = {
            name:$('#name').val(),
            type:$("#type").val(),
            repo_url:$('#repo_url').val(),
            repo_username:$("#repo_username").val(),
            repo_password:$('#repo_password').val(),
            rsync_local_www:$("#rsync_local_www").val(),
            rsync_back_www:$("#rsync_back_www").val(),
            keep_version_num:$('#keep_version_num').val(),
            rsync_remote_www:$('#rsync_remote_www').val(),
            rsync_remote_hosts:$("#rsync_remote_hosts").val(),
            rsync_exclude:$('#rsync_exclude').val(),
            rsync_user:$('#rsync_user').val(),
            before_deploy:$('#before_deploy').val(),
            after_deploy:$('#after_deploy').val()
        };
        if(window.location.search.match(/\?id=(\d+)/)){
            console.log("aaaaaa");
            param['id'] = window.location.search.match(/\?id=(\d+)/)[1];
            ajax_post('/api/publish/project/update',param);
        }else{
            ajax_post('/api/publish/project/create',param);
        }
    });
    function ajax_post(url,param,is_reload=false){
        layer.load(2);
        $.ajax({
            type:"POST",
            url: url,
            data:  param,
            timeout:"4000",
            dataType:'json',
            success: function(data){
                layer.closeAll('loading');
                if (data.status == 0) {
                    layer.alert(data.msg,{icon:1});
                }
                else {
                    layer.alert(data.msg,{icon:2});
                }
                if(is_reload==true){
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }
            }
        });
    }
</script>
</html>
