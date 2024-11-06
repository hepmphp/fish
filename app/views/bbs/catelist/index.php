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
                <label class="control-label">板块id：</label>
                <input placeholder="文本" class="form-control" name="fid" id="fid" value="<?=$form['fid']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">父id：</label>
                <input placeholder="文本" class="form-control" name="pid" id="pid" value="<?=$form['pid']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">主题：</label>
                <input placeholder="文本" class="form-control" name="subject" id="subject" value="<?=$form['subject']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">发帖时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_created_time" type="text" value="<?=$form['begin_created_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_created_time" type="text" value="<?=$form['end_created_time']?>">
            </span>
            </div>
            <div class="form-group">
                <label class="control-label">用户id：</label>
                <input placeholder="文本" class="form-control" name="user_id" id="user_id" value="<?=$form['user_id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">用户名：</label>
                <input placeholder="文本" class="form-control" name="username" id="username" value="<?=$form['username']?>" type="text">
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
                <th>板块id</th>
                <th>父id</th>
                <th>主题</th>
                <th>发帖时间</th>
                <th>用户id</th>
                <th>用户名</th>
                <th>用户ip</th>
                <th>修改帖子时间</th>
                <th>修改帖子的用户</th>
                <th>修改贴子的用户id</th>
                <th>修改帖子的ip</th>
                <th>帖子回复数</th>
                <th>帖子状态</th>

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

<script src="<?= STATIC_URL ?>js/logic/admin/ajax.js?<?=rand()?>"></script>

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
            '<td>[fid]</td>'+
            '<td>[pid]</td>'+
            '<td>[subject]</td>'+
            '<td>[created_time]</td>'+
            '<td>[user_id]</td>'+
            '<td>[username]</td>'+
            '<td>[ip]</td>'+
            '<td>[modified_time]</td>'+
            '<td>[modified_username]</td>'+
            '<td>[modified_userid]</td>'+
            '<td>[modified_ip]</td>'+
            '<td>[total_reply]</td>'+
            '<td>[status]</td>'+
            '<td><a onclick="edit(\'[id]\')" class="">[编辑]</a><a onclick="del(\'[id]\')" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/catelist/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                if(data.data.list){
                    $.each(data.data.list, function (i, d) {
                        list_html += template.
                        replace('[id]', d.id).
                        replace('[fid]', d.fid).
                        replace('[pid]', d.pid).
                        replace('[subject]', d.subject).
                        replace('[content]', d.content).
                        replace('[created_time]', d.created_time).
                        replace('[user_id]', d.user_id).
                        replace('[username]', d.username).
                        replace('[ip]', d.ip).
                        replace('[modified_time]', d.modified_time).
                        replace('[modified_username]', d.modified_username).
                        replace('[modified_userid]', d.modified_userid).
                        replace('[modified_ip]', d.modified_ip).
                        replace('[total_reply]', d.total_reply).
                        replace('[status]', d.status);
                    });
                    $('table tbody').html(list_html);
                    var total_num = data.data.total;
                    $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                    $(".table").bootstrapTable('resetView');
                    // window.console.clear();
                }
            } else {
                layer.alert(data.msg);
            }

        });
    }


    var urls = {
        create_url:'/api/cate_list/create',
        update_url:'/api/cat_list/update',
        delete_url:'/api/cate_list/delete',
        info_url:'/api/cate_list/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/bbs/cate_list/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/bbs/cate_list/update?id="+id;
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
                ajax_post(urls.delete_url,{ids:id})
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
                    fid:body.find('#fid').val(),
                    pid:body.find('#pid').val(),
                    subject:body.find('#subject').val(),
                    content:body.find('#content').val(),
                    created_time:body.find('#created_time').val(),
                    user_id:body.find('#user_id').val(),
                    username:body.find('#username').val(),
                    ip:body.find('#ip').val(),
                    modified_time:body.find('#modified_time').val(),
                    modified_username:body.find('#modified_username').val(),
                    modified_userid:body.find('#modified_userid').val(),
                    modified_ip:body.find('#modified_ip').val(),
                    total_reply:body.find('#total_reply').val(),
                    status:body.find('#status').val()

                };
                //todo生成js验证
                if(param.id){
                    var url = urls.update_url+'&id='+param.id;
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