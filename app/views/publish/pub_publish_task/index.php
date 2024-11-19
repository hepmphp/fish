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
<div class="form-wrapper" style="padding-top:0px;">
    <ul class="list-inline page-tab clearfix">
        <li  class="cur"><a href="/publish/task/index?iframe=1">任务列表</a><em></em></li>
        <li  ><a href="/publish/task/apply?iframe=1">发布申请</a><em></em></li>
        <li ><a href="/publish/task/publish?iframe=1">任务发布</a><em></em></li>
        <li ><a href="/publish/task/rollback?iframe=1">任务回滚</a><em></em></li>
    </ul>
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
                    <div class="form-group">
            <label class="control-label">申请人员id：</label>
            <input placeholder="文本" class="form-control" name="admin_id" id="admin_id" value="<?=$form['admin_id']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">发布人员id：</label>
            <input placeholder="文本" class="form-control" name="deploy_admin_id" id="deploy_admin_id" value="<?=$form['deploy_admin_id']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">项目id：</label>
            <input placeholder="文本" class="form-control" name="project_id" id="project_id" value="<?=$form['project_id']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">项目名称：</label>
            <input placeholder="文本" class="form-control" name="project_name" id="project_name" value="<?=$form['project_name']?>" type="text">
        </div>
        <div class="form-group">
        <label class="control-label">发布状态：</label>
        <select id="status" name="status" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_status as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status'] &&is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
	    </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                
<th>主键</th>
<th>申请人员id</th>
<th>发布人员id</th>
<th>项目id</th>
<th>项目名称</th>
<th>文件列表</th>
<th>发布状态</th>
<th>rsync同步日志</th>
<th>发布备注</th>
<th>还原备注</th>
<th>添加时候</th>

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
						deploy_admin_id: $('#deploy_admin_id').val(),
						project_id: $('#project_id').val(),
						project_name: $('#project_name').val(),
						file_list: $('#file_list').val(),
						status: $('#status').val(),
						rsync_log: $('#rsync_log').val(),
						comment: $('#comment').val(),
						rollback_comment: $('#rollback_comment').val(),
						addtime: $('#addtime').val(),

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
'<td>[deploy_admin_id]</td>'+
'<td>[project_id]</td>'+
'<td>[project_name]</td>'+
'<td>[file_list]</td>'+
'<td>[status]</td>'+
'<td>[rsync_log]</td>'+
'<td>[comment]</td>'+
'<td>[rollback_comment]</td>'+
'<td>[addtime]</td>'+

            '<td><a onclick="publish([id])" class="">[发布]</a>|<a onclick="rollback([id])" class="">[回滚]</a>|<a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/publish/task/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																																	
replace(/\[id\]/g, d.id).
replace('[admin_id]', d.admin_id).
replace('[deploy_admin_id]', d.deploy_admin_id).
replace('[project_id]', d.project_id).
replace('[project_name]', d.project_name).
replace('[file_list]', d.file_list).
replace('[status]', d.status).
replace('[rsync_log]', d.rsync_log).
replace('[comment]', d.comment).
replace('[rollback_comment]', d.rollback_comment).
replace('[addtime]', d.addtime)
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
    create_url:'/api/publish/task/create',
    update_url:'/api/publish/task/update',
    delete_url:'/api/publish/task/delete',
    info_url:'/api/publish/task/info'
};

/***
 * 添加
 */
function add(){
    var url = '/publish/task/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/publish/task/apply?id="+id;
    window.location.href = url;
}

function publish(id){
    var url = "/publish/task/publish?id="+id;
    window.location.href = url;
}
function rollback(id){
    var url = "/publish/task/rollback?id="+id;
    window.location.href = url;
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
					deploy_admin_id:body.find('#deploy_admin_id').val(),
					project_id:body.find('#project_id').val(),
					project_name:body.find('#project_name').val(),
					file_list:body.find('#file_list').val(),
					status:body.find('#status').val(),
					rsync_log:body.find('#rsync_log').val(),
					comment:body.find('#comment').val(),
					rollback_comment:body.find('#rollback_comment').val(),
					addtime:body.find('#addtime').val()

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
</body>
</html>
