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
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
                    <div class="form-group">
        <label class="control-label">管理员id：</label>
        <select id="admin_id" name="admin_id" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_admin_id as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['admin_id'] &&is_numeric($form['admin_id'])){ echo "selected";}?>><?=$vo['username']?></option>
              <?php }?>
        </select>
	    </div>        <div class="form-group">
        <label class="control-label">项目id：</label>
        <select id="project_id" name="project_id" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_project_id as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['project_id'] &&is_numeric($form['project_id'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
	    </div>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
            <div class="form-group">
            <label class="control-label">项目名称：</label>
            <input placeholder="文本" class="form-control" name="project_name" id="project_name" value="<?=$form['project_name']?>" type="text">
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
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>

        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                
<th>id</th>
<th>管理员id</th>
<th>管理员名称</th>
<th>项目id</th>
<th>项目名称</th>
<th>添加时间</th>
                <th>状态</th>
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
						username: $('#username').val(),
						project_id: $('#project_id').val(),
						project_name: $('#project_name').val(),
						status: $('#status').val(),

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
'<td>[username]</td>'+
'<td>[project_id]</td>'+
'<td>[project_name]</td>'+
'<td>[addtime]</td>'+
'<td>[status]</td>'+
            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/publish/project_member/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																		
replace(/\[id\]/g, d.id).
replace('[admin_id]', d.admin_id).
replace('[username]', d.username).
replace('[project_id]', d.project_id).
replace('[project_name]', d.project_name).
replace('[addtime]', d.addtime).
replace('[status]', d.status)
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
    create_url:'/api/publish/project_member/create',
    update_url:'/api/publish/project_member/update',
    delete_url:'/api/publish/project_member/delete',
    info_url:'/api/publish/project_member/info'
};

/***
 * 添加
 */
function add(){
    var url = '/api/publish/project_member/create';
    var param ={
        admin_id: $('#admin_id').val(),
        username: $('#admin_id').find(":selected").text(),
        project_id: $('#project_id').val(),
        project_name:$('#project_id').find(":selected").text(),
    };
    ajax_post(url,param);

}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/publish/project_member/update?id="+id;
    layer_form(url,2,['300px', '300px']);
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
                username:body.find('#admin_id').find(":selected").text(),
                project_id:body.find('#project_id').val(),
                project_name:body.find('#project_id').find(":selected").text(),
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
