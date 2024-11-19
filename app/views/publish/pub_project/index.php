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
<div class="form-wrapper" style="padding-top: 0px;">
    <ul class="list-inline page-tab clearfix">
        <li class="cur"><a href="/publish/project/index?iframe=1">项目列表</a><em></em></li>
        <li><a href="/publish/project/create">添加项目</a><em></em></li>
        <li><a href="/publish/project/create_user">项目用户</a><em></em></li>
    </ul>
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
                    <div class="form-group">
            <label class="control-label">管理员id：</label>
            <input placeholder="文本" class="form-control" name="admin_id" id="admin_id" value="<?=$form['admin_id']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">项目名称：</label>
            <input placeholder="文本" class="form-control" name="name" id="name" value="<?=$form['name']?>" type="text">
        </div>
        <div class="form-group">
        <label class="control-label">类型：</label>
        <select id="type" name="type" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_type as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['type'] &&is_numeric($form['type'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
	    </div>        <div class="form-group">
        <label class="control-label">状态：</label>
        <select id="status" name="status" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_status as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status'] &&is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
	    </div>
        <div class="form-group">
            <label class="control-label">添加时间：</label>
            <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_addtime" type="text" value="<?=$form['begin_addtime']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_addtime" type="text" value="<?=$form['end_addtime']?>">
            </span>
        </div>
            <div class="form-group">
            <label class="control-label">修改时间：</label>
            <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_edittime" type="text" value="<?=$form['begin_edittime']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_edittime" type="text" value="<?=$form['end_edittime']?>">
            </span>
        </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>管理员id</th>
                <th>项目名称</th>
                <th>类型</th>
                <th>状态</th>
                <th>仓库地址</th>
                <th>仓库用户名</th>
                <th>仓库密码</th>
                <th>本地路径</th>
                <th>远程路径</th>
                <th>本地备份路径</th>
                <th>同步账号</th>
                <th>同步的主机ip地址</th>
                <th>保留的版本数</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            </tbody>
        </table>
    </div>
    <?php \app\helpers\PageWidget::run();?>
</div>

<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>

<script>
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
    };

    function search_list(){
                    var search_param= {
                        page: 1,
                        per_page :100,
                    
						id: $('#id').val(),
						admin_id: $('#admin_id').val(),
						name: $('#name').val(),
						type: $('#type').val(),
						status: $('#status').val(),
						repo_type: $('#repo_type').val(),
						repo_url: $('#repo_url').val(),
						repo_username: $('#repo_username').val(),
						repo_password: $('#repo_password').val(),
						rsync_local_www: $('#rsync_local_www').val(),
						rsync_remote_www: $('#rsync_remote_www').val(),
						rsync_back_www: $('#rsync_back_www').val(),
						rsync_user: $('#rsync_user').val(),
						rsync_remote_hosts: $('#rsync_remote_hosts').val(),
						rsync_exclude: $('#rsync_exclude').val(),
						before_deploy: $('#before_deploy').val(),
						after_deploy: $('#after_deploy').val(),
						audit: $('#audit').val(),
						keep_version_num: $('#keep_version_num').val(),
						addtime: $('#addtime').val(),
						edittime: $('#edittime').val(),

            };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +
            
'<td>[id]</td>'+
'<td>[admin_id]</td>'+
'<td>[name]</td>'+
'<td>[type]</td>'+
'<td>[status]</td>'+
'<td>[repo_url]</td>'+
'<td>[repo_username]</td>'+
'<td>[repo_password]</td>'+
'<td>[rsync_local_www]</td>'+
'<td>[rsync_remote_www]</td>'+
'<td>[rsync_back_www]</td>'+
'<td>[rsync_user]</td>'+
'<td>[rsync_remote_hosts]</td>'+
'<td>[keep_version_num]</td>'+
'<td>[addtime]</td>'+
            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/publish/project/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																																																															
replace(/\[id\]/g, d.id).
replace('[admin_id]', d.admin_id).
replace('[name]', d.name).
replace('[type]', d.type).
replace('[status]', d.status).
replace('[repo_type]', d.repo_type).
replace('[repo_url]', d.repo_url).
replace('[repo_username]', d.repo_username).
replace('[repo_password]', d.repo_password).
replace('[rsync_local_www]', d.rsync_local_www).
replace('[rsync_remote_www]', d.rsync_remote_www).
replace('[rsync_back_www]', d.rsync_back_www).
replace('[rsync_user]', d.rsync_user).
replace('[rsync_remote_hosts]', d.rsync_remote_hosts).
replace('[rsync_exclude]', d.rsync_exclude).
replace('[before_deploy]', d.before_deploy).
replace('[after_deploy]', d.after_deploy).
replace('[audit]', d.audit).
replace('[keep_version_num]', d.keep_version_num).
replace('[addtime]', d.addtime).
replace('[edittime]', d.edittime)
                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $(".table").bootstrapTable('resetView');
                // window.console.clear();

            } else {
                layer.alert(data.msg);
            }

        });
    }

</script>
<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>


var urls = {
    create_url:'/api/publish/project/create',
    update_url:'/api/publish/project/update',
    delete_url:'/api/publish/project/delete',
    info_url:'/api/publish/project/info'
};

/***
 * 添加
 */
function add(){
    var url = '/publish/project/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    window.location.href = "/publish/project/update?id="+id;

}

/***
 * * @param id
 */
function del(id) {
    layer.confirm('确定要删除?',{
            btn: ['确定','取消'], //按钮
            icon: 3,
            title:'提示'
        }, function(){
            ajax_post(urls.delete_url,{id:id})
        },
        function(){

        }
    );
}

function info($id){
    var url = urls.info_url+"?id="+id;
    layer_form(url,1,['900px', '600px']);
}
//表单
function layer_form(url,action,area){
    var content = url;
    var title = action==2?'修改':'添加';
    var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
    layer.open({
        type: 2, //iframe
        maxmin: true,
        area:area ,
        title: title,
        btn: btn,
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:content,
        yes: function(index, layero){
            var body = layer.getChildFrame('body', index);
            var param ={
                
					id:body.find('#id').val(),
					admin_id:body.find('#admin_id').val(),
					name:body.find('#name').val(),
					type:body.find('#type').val(),
					status:body.find('#status').val(),
					repo_type:body.find('#repo_type').val(),
					repo_url:body.find('#repo_url').val(),
					repo_username:body.find('#repo_username').val(),
					repo_password:body.find('#repo_password').val(),
					rsync_local_www:body.find('#rsync_local_www').val(),
					rsync_remote_www:body.find('#rsync_remote_www').val(),
					rsync_back_www:body.find('#rsync_back_www').val(),
					rsync_user:body.find('#rsync_user').val(),
					rsync_remote_hosts:body.find('#rsync_remote_hosts').val(),
					rsync_exclude:body.find('#rsync_exclude').val(),
					before_deploy:body.find('#before_deploy').val(),
					after_deploy:body.find('#after_deploy').val(),
					audit:body.find('#audit').val(),
					keep_version_num:body.find('#keep_version_num').val(),
					addtime:body.find('#addtime').val(),
					edittime:body.find('#edittime').val()

            };
            //todo生成js验证
            if(param.id){
                var url = urls.update_url+'?id='+param.id;
            }else{
                var url = urls.create_url
            }
            ajax_post(url,param);

        },btn2: function(index, layero){

        }

    });
}

</script>

</html>
