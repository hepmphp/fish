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
            <label class="control-label">stmp邮箱主机名：</label>
            <input placeholder="文本" class="form-control" name="stmp_server" id="stmp_server" value="<?=$form['stmp_server']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">stmp邮箱主机名：</label>
            <input placeholder="文本" class="form-control" name="imap_server" id="imap_server" value="<?=$form['imap_server']?>" type="text">
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
            <th>邮件服务器</th>
            <th>stmp邮箱主机名</th>
            <th>stmp邮箱主机名</th>
            <th>smtp端口号</th>
            <th>imap端口号</th>
            <th>账号</th>
            <th>密码</th>
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
						stmp_server: $('#stmp_server').val(),
						imap_server: $('#imap_server').val(),
						stmp_port: $('#stmp_port').val(),
						imap_port: $('#imap_port').val(),
						username: $('#username').val(),
						password: $('#password').val(),
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

        var template = '<tr>' +
            
'<td>[id]</td>'+
'<td><a href="[mail_server_url]" target="_blank" style="200px;height:50px;"><img src="[mail_server]" ></a></td>'+
'<td>[stmp_server]</td>'+
'<td>[imap_server]</td>'+
'<td>[stmp_port]</td>'+
'<td>[imap_port]</td>'+
'<td>[username]</td>'+
'<td>[password]</td>'+
'<td>[addtime]</td>'+
'<td>[deltime]</td>'+
'<td>[status]</td>'+

            '<td><a onclick="mail_server([id])" class="">[查看邮件]</a>|<a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/email/mail_server/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																														
                    replace(/\[id\]/g, d.id).
                    replace('[mail_server]', d.mail_server).
                    replace('[mail_server_url]', d.mail_server_url).
                    replace('[stmp_server]', d.stmp_server).
                    replace('[imap_server]', d.imap_server).
                    replace('[stmp_port]', d.stmp_port).
                    replace('[imap_port]', d.imap_port).
                    replace('[username]', d.username).
                    replace('[password]', d.password).
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
    create_url:'/api/email/mail_server/create',
    update_url:'/api/email/mail_server/update',
    delete_url:'/api/email/mail_server/delete',
    info_url:'/api/email/mail_server/info'
};

/***
 * 添加
 */
function add(){
    var url = '/email/mail_server/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/email/mail_server/update?id="+id;
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
					stmp_server:body.find('#stmp_server').val(),
					imap_server:body.find('#imap_server').val(),
					stmp_port:body.find('#stmp_port').val(),
					imap_port:body.find('#imap_port').val(),
					username:body.find('#username').val(),
					password:body.find('#password').val(),
					addtime:body.find('#addtime').val(),
					deltime:body.find('#deltime').val(),
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
function mail_server(id){
    var url = '/email/mail/index?iframe=1&id=';

    var layer_index = layer.open({
        type: 2, //iframe
        maxmin: true,
        area:['900px', '600px'] ,
        title: '查看邮件',
        btn: [],
        shade: 0.3, //遮罩透明度
        shadeClose: true,
        content:url+id,
    });
    layer.full(layer_index);
    // layer_form(url,1,['900px', '600px']);
}
</script>

</html>
