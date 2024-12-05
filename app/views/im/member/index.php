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
                <label class="control-label">账号：</label>
                <input placeholder="文本" class="form-control" name="username" id="username" value="<?=$form['username']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">昵称：</label>
                <input placeholder="文本" class="form-control" name="nickname" id="nickname" value="<?=$form['nickname']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">在线状态：</label>
                <input placeholder="文本" class="form-control" name="status" id="status" value="<?=$form['status']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">上次登录时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_login_time" type="text" value="<?=$form['begin_login_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_login_time" type="text" value="<?=$form['end_login_time']?>">
            </span>
            </div>        <div class="form-group">
                <label class="control-label">创建时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_create_time" type="text" value="<?=$form['begin_create_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_create_time" type="text" value="<?=$form['end_create_time']?>">
            </span>
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
                <th>账号</th>
                <th>密码</th>
                <th>密码盐</th>
                <th>昵称</th>
                <th>头像</th>
                <th>签名</th>
                <th>在线状态</th>
                <th>上次登录时间</th>
                <th>创建时间</th>
                <th>修改时间</th>
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
            per_page : $("#admin").val().length==0?100:1,
            admin: $("#admin").val(),
            title:$('#title').val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val(),
            status:$('#status').val(),
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +
            '<td>[id]</td>'+
            '<td>[username]</td>'+
            '<td>[password]</td>'+
            '<td>[salt]</td>'+
            '<td>[nickname]</td>'+
            '<td>[avatar]</td>'+
            '<td>[signature]</td>'+
            '<td>[status]</td>'+
            '<td>[login_time]</td>'+
            '<td>[create_time]</td>'+
            '<td>[update_time]</td>'+
            '<td>[delete_time]</td>'+
            '<td>[delete_status]</td>'+
            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/im/member/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[username]', d.username).
                    replace('[password]', d.password).
                    replace('[salt]', d.salt).
                    replace('[nickname]', d.nickname).
                    replace('[avatar]', d.avatar).
                    replace('[signature]', d.signature).
                    replace('[status]', d.status).
                    replace('[login_time]', d.login_time).
                    replace('[create_time]', d.create_time).
                    replace('[update_time]', d.update_time).
                    replace('[delete_time]', d.delete_time).
                    replace('[delete_status]', d.delete_status);
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

    var urls = {
        create_url:'/api/im/member/create',
        update_url:'/api/im/member/update',
        delete_url:'/api/im/member/delete',
        info_url:'/api/im/member/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/im/member/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/im/member/update?id="+id;
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
                    username:body.find('#username').val(),
                    nickname:body.find('#nickname').val(),
                    avatar:body.find('.image-item').eq(0).attr('src'),
                    signature:body.find('#signature').val(),
                    password:body.find('#password').val(),
                    status:body.find('#status').val(),
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
<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
</html>