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
                <label class="control-label">群号：</label>
                <input placeholder="文本" class="form-control" name="account" id="account" value="<?=$form['account']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">群名称：</label>
                <input placeholder="文本" class="form-control" name="group_name" id="group_name" value="<?=$form['group_name']?>" type="text">
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
                <th>群号</th>
                <th>群名称</th>
                <th>群头像</th>
                <th>群主</th>
                <th>描述</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>更新时间</th>
                <th>删除时间</th>

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
        page:1,
        per_page:per_page,
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page :100,
            id:$('#id').val(),
            account:$('#account').val(),
            group_name:$('#group_name').val(),
            avatar:$('#avatar').val(),
            belong:$('#belong').val(),
            description:$('#description').val(),
            status:$('#status').val(),
            create_time:$('#create_time').val(),
            update_time:$('#update_time').val(),
            delete_time:$('#delete_time').val(),

        };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +
            '<td>[id]</td>'+
            '<td>[account]</td>'+
            '<td>[group_name]</td>'+
            '<td>[avatar]</td>'+
            '<td>[belong]</td>'+
            '<td>[description]</td>'+
            '<td>[status]</td>'+
            '<td>[create_time]</td>'+
            '<td>[update_time]</td>'+
            '<td>[delete_time]</td>'+

            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/chat_group/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace(/\[id\]/g, d.id).
                    replace('[account]', d.account).
                    replace('[group_name]', d.group_name).
                    replace('[avatar]', d.avatar).
                    replace('[belong]', d.belong).
                    replace('[description]', d.description).
                    replace('[status]', d.status).
                    replace('[create_time]', d.create_time).
                    replace('[update_time]', d.update_time).
                    replace('[delete_time]', d.delete_time);

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
        create_url:'/api/group/group/create',
        update_url:'/api/group/group/update',
        delete_url:'/api/group/group/delete',
        info_url:'/api/group/group/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/im/group/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/im/group/update?id="+id;
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
                    account:body.find('#account').val(),
                    group_name:body.find('#group_name').val(),
                    avator:body.find('.image-item').eq(0).attr('src'),
                    belong:body.find('#belong').val(),
                    description:body.find('#description').val(),
                    status:body.find('#status').val(),
                    create_time:body.find('#create_time').val(),
                    update_time:body.find('#update_time').val(),
                    delete_time:body.find('#delete_time').val()

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