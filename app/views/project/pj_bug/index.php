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
    <link href="<?= STATIC_URL ?>css/number.css" rel="stylesheet">
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
                    <div class="form-group">
            <label class="control-label">id：</label>
            <input placeholder="文本" class="form-control" name="id" id="id" value="<?=$form['id']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">标题：</label>
            <input placeholder="文本" class="form-control" name="title" id="title" value="<?=$form['title']?>" type="text">
        </div>

        <div class="form-group">
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
            <label class="control-label">管理员：</label>
            <input placeholder="文本" class="form-control" name="admin_user" id="admin_user" value="<?=$form['admin_user']?>" type="text">
        </div>

        <div class="form-group">
            <label class="control-label">指派的用户：</label>
            <input placeholder="文本" class="form-control" name="owner_user" id="owner_user" value="<?=$form['owner_user']?>" type="text">
        </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>bug等级</th>
                <th>项目id</th>
                <th>标题</th>
                <th>描述</th>
                <th>bug颜色</th>
                <th>优先级</th>
                <th>状态</th>
                <th>管理员id</th>
                <th>管理员</th>
                <th>指派的用户id</th>
                <th>指派的用户</th>
                <th>计划工时</th>
                <th>开始日期</th>
                <th>截止日期</th>
                <th>剩余时间</th>
                <th>添加时间</th>
                <th>修改时间</th>
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
						title: $('#title').val(),
						content: $('#content').val(),
						task_color: $('#task_color').val(),
						descption: $('#descption').val(),
						priority: $('#priority').val(),
						status: $('#status').val(),
						admin_id: $('#admin_id').val(),
						admin_user: $('#admin_user').val(),
						owner_user_id: $('#owner_user_id').val(),
						owner_user: $('#owner_user').val(),
						hours: $('#hours').val(),
						start_date: $('#start_date').val(),
						end_date: $('#end_date').val(),
						addtime: $('#addtime').val(),
						updatetime: $('#updatetime').val(),

            };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +
            
            '<td>[id]</td>'+
            '<td>[bug_level]</td>'+
            '<td>[project_id]</td>'+
            '<td style="color: [bg_color]">[title]</td>'+
            '<td>[descption]</td>'+
            '<td style="background-color: [bg_color]">[task_color]</td>'+
            '<td>[priority]</td>'+
            '<td>[status]</td>'+
            '<td>[admin_id]</td>'+
            '<td>[admin_user]</td>'+
            '<td>[owner_user_id]</td>'+
            '<td>[owner_user]</td>'+
            '<td>[hours]</td>'+
            '<td>[start_date]</td>'+
            '<td>[end_date]</td>'+
            '<td>[remain_time]</td>'+
            '<td>[addtime]</td>'+
            '<td>[updatetime]</td>'+

            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/project/bug/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																																																
                        replace(/\[id\]/g, d.id).
                        replace('[bug_level]', d.bug_level).
                        replace('[project_id]', d.project_id).
                        replace('[title]', d.title).
                        replace('[task_color]', d.task_color).
                        replace(/\[bg_color\]/g, d.task_color).
                        replace('[descption]', d.descption).
                        replace('[priority]', d.priority).
                        replace('[status]', d.status).
                        replace('[admin_id]', d.admin_id).
                        replace('[admin_user]', d.admin_user).
                        replace('[owner_user_id]', d.owner_user_id).
                        replace('[owner_user]', d.owner_user).
                        replace('[hours]', d.hours).
                        replace('[start_date]', d.start_date).
                        replace('[end_date]', d.end_date).
                        replace('[remain_time]', d.remain_time).
                        replace('[addtime]', d.addtime).
                        replace('[updatetime]', d.updatetime)
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
    create_url:'/api/project/bug/create',
    update_url:'/api/project/bug/update',
    delete_url:'/api/project/bug/delete',
    info_url:'/api/project/bug/info'
};

/***
 * 添加
 */
function add(){
    var url = '/project/bug/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/project/bug/update?id="+id;
    layer_form(url,2,['900px', '600px']);
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
    var layer_index = layer.open({
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
                    project_id:body.find('#project_id').val(),
					title:body.find('#title').val(),
					content:body.find('#content').html(),
					task_color:body.find('#task_color').val(),
					descption:body.find('#descption').val(),
					priority:body.find('#priority').val(),
					status:body.find('#status').val(),
                    bug_level:body.find('#bug_level').val(),
					admin_id:body.find('#admin_id').val(),
                    admin_user:body.find('#admin_id').find("option:selected").text(),
					owner_user_id:body.find('#owner_user_id').val(),
                    owner_user:body.find('#owner_user_id').find("option:selected").text(),
					hours:body.find('#hours').val(),
					start_date:body.find('#start_date').val(),
					end_date:body.find('#end_date').val(),
					addtime:body.find('#addtime').val(),
					updatetime:body.find('#updatetime').val()

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
    layer.full(layer_index);
}

</script>

</html>
