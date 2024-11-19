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
                <label class="control-label">发送者id：</label>
                <input placeholder="文本" class="form-control" name="from_id" id="from_id" value="<?=$form['from_id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">接收者id：</label>
                <input placeholder="文本" class="form-control" name="to_id" id="to_id" value="<?=$form['to_id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">消息发送者：</label>
                <input placeholder="文本" class="form-control" name="from_username" id="from_username" value="<?=$form['from_username']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">消息接收者：</label>
                <input placeholder="文本" class="form-control" name="to_username" id="to_username" value="<?=$form['to_username']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">聊天类型：</label>
                <select id="type" name="type" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_type as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['type'] &&is_numeric($form['type'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
        </div>        <div class="form-group">
            <label class="control-label">发送时间：</label>
            <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_send_time" type="text" value="<?=$form['begin_send_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_send_time" type="text" value="<?=$form['end_send_time']?>">
            </span>
        </div>        <div class="form-group">
            <label class="control-label">删除时间：</label>
            <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_delete_time" type="text" value="<?=$form['begin_delete_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_delete_time" type="text" value="<?=$form['end_delete_time']?>">
            </span>
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
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                
<th>id</th>
<th>发送者id</th>
<th>接收者id</th>
<th>消息发送者id</th>
<th>消息接收者id</th>
<th>发送内容</th>
<th>聊天类型</th>
<th>发送时间</th>
<th>删除时间</th>
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
						from_id: $('#from_id').val(),
						to_id: $('#to_id').val(),
						from_username: $('#from_username').val(),
						to_username: $('#to_username').val(),
						content: $('#content').val(),
						type: $('#type').val(),
						send_time: $('#send_time').val(),
						delete_time: $('#delete_time').val(),
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
'<td>[from_id]</td>'+
'<td>[to_id]</td>'+
'<td>[from_username]</td>'+
'<td>[to_username]</td>'+
'<td>[content]</td>'+
'<td>[type]</td>'+
'<td>[send_time]</td>'+
'<td>[delete_time]</td>'+
'<td>[status]</td>'+

            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/im/record/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																														
                        replace(/\[id\]/g, d.id).
                        replace('[from_id]', d.from_id).
                        replace('[to_id]', d.to_id).
                        replace('[from_username]', d.from_username).
                        replace('[to_username]', d.to_username).
                        replace('[content]', d.content).
                        replace('[type]', d.type).
                        replace('[send_time]', d.send_time).
                        replace('[delete_time]', d.delete_time).
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
    create_url:'/api/im/record/create',
    update_url:'/api/im/record/update',
    delete_url:'/api/im/record/delete',
    info_url:'/api/im/record/info'
};

/***
 * 添加
 */
function add(){
    var url = '/im/record/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/im/record/update?id="+id;
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
					from_id:body.find('#from_id').val(),
					to_id:body.find('#to_id').val(),
					from_username:body.find('#from_username').val(),
					to_username:body.find('#to_username').val(),
					content:body.find('#content').val(),
					type:body.find('#type').val(),
					status:body.find('#status').val()
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
