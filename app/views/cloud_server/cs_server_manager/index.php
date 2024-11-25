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
            <label class="control-label">主机：</label>
            <input placeholder="文本" class="form-control" name="host" id="host" value="<?=$form['host']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">账号：</label>
            <input placeholder="文本" class="form-control" name="username" id="username" value="<?=$form['username']?>" type="text">
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
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                
<th>id</th>
<th>主机</th>
<th>端口号</th>
<th>账号</th>
<th>密码</th>
<th>账号过期时间</th>
<th>添加时间</th>
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
						host: $('#host').val(),
						port: $('#port').val(),
						username: $('#username').val(),
						password: $('#password').val(),
						expire_time: $('#expire_time').val(),
						addtime: $('#addtime').val(),
						deltime: $('#deltime').val(),
						status: $('#status').val(),

            };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr id="tr-[id]">' +
            
'<td>[id]</td>'+
'<td class="host" value="[host]">[host]</td>'+
'<td class="port" value="[port]">[port]</td>'+
'<td class="username" value="[username]">[username]</td>'+
'<td class="password" value="[password]">[password]</td>'+
'<td>[expire_time]</td>'+
'<td>[addtime]</td>'+
'<td>[deltime]</td>'+
'<td>[status]</td>'+

            '<td><a onclick="login_server([id])" class="">[连接服务器]</a>|<a onclick="status_server([id])" class="">[服务器状态]</a>|<a onclick="sql_server([id])" class="">[数据库管理]</a>|<a onclick="redis_server([id])" class="">[redis]</a>|<a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/cloud/server_manager/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																											
                        replace(/\[id\]/g, d.id).
                        replace(/\[host\]/g, d.host).
                        replace(/\[port\]/g, d.port).
                        replace(/\[username\]/g, d.username).
                        replace(/\[password\]/g, d.password).
                        replace('[expire_time]', d.expire_time).
                        replace('[addtime]', d.addtime).
                        replace('[deltime]', d.deltime).
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
    create_url:'/api/cloud/server_manager/create',
    update_url:'/api/cloud/server_manager/update',
    delete_url:'/api/cloud/server_manager/delete',
    info_url:'/api/cloud/server_manager/info'
};

/***
 * 添加
 */
function add(){
    var url = '/cloud/server_manager/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/cloud/server_manager/update?id="+id;
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

function login_server(id){
    var url = '/cloud/server_manager/info?';
    var host = $('#tr-'+id).find('.host').attr('value');
    var port = $('#tr-'+id).find('.port').attr('value');
    var username = $('#tr-'+id).find('.username').attr('value');
    var password = $('#tr-'+id).find('.password').attr('value');
    var param = {
        host:host,
        port:port,
        username:username,
        password:password
    };
    var layer_index = layer.open({
        type: 2, //iframe
        maxmin: true,
        area:['900px', '600px'] ,
        title: '服务器管理 '+username+'@'+host,
        btn: [],
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:url+$.param(param),
    });
    layer.full(layer_index);
    // layer_form(url,1,['900px', '600px']);
}

function status_server(id){
    var url = '/cloud/server_manager/server_status?';
    var host = $('#tr-'+id).find('.host').attr('value');
    var port = $('#tr-'+id).find('.port').attr('value');
    var username = $('#tr-'+id).find('.username').attr('value');
    var password = $('#tr-'+id).find('.password').attr('value');
    var param = {
        host:host,
        port:port,
        username:username,
        password:password
    };
    var layer_index = layer.open({
        type: 2, //iframe
        maxmin: true,
        area:['900px', '600px'] ,
        title: '服务器状态 '+username+'@'+host,
        btn: [],
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:url+$.param(param),
    });
    layer.full(layer_index);
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
					host:body.find('#host').val(),
					port:body.find('#port').val(),
					username:body.find('#username').val(),
					password:body.find('#password').val(),
					expire_time:body.find('#expire_time').val(),
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

function sql_server(){
    var url = '/cloud/server_manager/mysql';
    var layer_index = layer.open({
        type: 2, //iframe
        maxmin: true,
        area:['900px', '600px'] ,
        title: '数据库服务器管理',
        btn: [],
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:url,
    });
    layer.full(layer_index);
}

function redis_server(){
    var url = '/cloud/server_manager/redis';
    var layer_index = layer.open({
        type: 2, //iframe
        maxmin: true,
        area:['900px', '600px'] ,
        title: '数据库服务器管理',
        btn: [],
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:url,
    });
    layer.full(layer_index);
}

</script>

</html>
