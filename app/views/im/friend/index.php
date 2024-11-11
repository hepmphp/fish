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
                <label class="control-label">分组id：</label>
                <input placeholder="文本" class="form-control" name="group_id" id="group_id" value="<?=$form['group_id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">好友id：</label>
                <input placeholder="文本" class="form-control" name="member_id" id="member_id" value="<?=$form['member_id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">好友昵称：</label>
                <input placeholder="文本" class="form-control" name="nickname" id="nickname" value="<?=$form['nickname']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status'] && is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">创建时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_create_time" type="text" value="<?=$form['begin_create_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_create_time" type="text" value="<?=$form['end_create_time']?>">
            </span>
            </div>        <div class="form-group">
                <label class="control-label">删除时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_delete_time" type="text" value="<?=$form['begin_delete_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_delete_time" type="text" value="<?=$form['end_delete_time']?>">
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
                <th>分组id</th>
                <th>好友id</th>
                <th>好友昵称</th>
                <th>创建时间</th>
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
        page: 1,
        per_page: per_page,
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page :100,

            id: $('#id').val(),
            group_id: $('#group_id').val(),
            member_id: $('#member_id').val(),
            nickname: $('#nickname').val(),
            create_time: $('#create_time').val(),
            update_time: $('#update_time').val(),
            delete_time: $('#delete_time').val(),

        };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +

            '<td>[id]</td>'+
            '<td>[group_id]</td>'+
            '<td>[member_id]</td>'+
            '<td>[nickname]</td>'+
            '<td>[create_time]</td>'+
            '<td>[update_time]</td>'+
            '<td>[delete_time]</td>'+
            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/im/friend/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace(/\[id\]/g, d.id).
                    replace('[group_id]', d.group_id).
                    replace('[member_id]', d.member_id).
                    replace('[nickname]', d.nickname).
                    replace('[create_time]', d.create_time).
                    replace('[update_time]', d.update_time).
                    replace('[delete_time]', d.delete_time)
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
        create_url:'/api/im/friend/create',
        update_url:'/api/im/friend/update',
        delete_url:'/api/im/friend/delete',
        info_url:'/api/im/friend/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/im/friend/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/im/friend/update?id="+id;
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
                    group_id:body.find('#group_id').val(),
                    member_id:body.find('#member_id').val(),
                    nickname:body.find('#nickname').val(),
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