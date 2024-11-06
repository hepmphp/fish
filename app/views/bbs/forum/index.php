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
                <label class="control-label">id：</label>
                <input placeholder="文本" class="form-control" name="id" id="id" value="<?=$form['id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">父id：</label>
                <input placeholder="文本" class="form-control" name="parentid" id="parentid" value="<?=$form['parentid']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">名称：</label>
                <input placeholder="文本" class="form-control" name="name" id="name" value="<?=$form['name']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">创建时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_created_time" type="text" value="<?=$form['begin_created_time']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_created_time" type="text" value="<?=$form['end_created_time']?>">
            </span>
            </div>        <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status']){ echo "selected";}?>><?=$vo['name']?></option>
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
                <th>父id</th>
                <th>层级</th>
                <th>名称</th>
                <th>图标</th>
                <th>创建时间</th>
                <th>状态</th>

                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>

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
            '<td>[parentid]</td>'+
            '<td>[level]</td>'+
            '<td>[name]</td>'+
            '<td>[logo]</td>'+
            '<td>[created_time]</td>'+
            '<td>[status]</td>'+
            '<td><a onclick="edit(\'[id]\')" class="">[编辑]</a><a onclick="del(\'[id]\')" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/forum/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[parentid]', d.parentid).
                    replace('[level]', d.level).
                    replace('[name]', d.name).
                    replace('[logo]', d.logo).
                    replace('[created_time]', d.created_time).
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

    var urls = {
        create_url:'/api/forum/create',
        update_url:'/api/forum/update',
        delete_url:'/api/forum/delete',
        info_url:'/api/forum/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/bbs/forum/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = '/bbs/forum/update?id='+id;
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
                    parentid:body.find('#parentid').val(),
                    level:body.find('#level').val(),
                    name:body.find('#name').val(),
                    logo:body.find('#logo').val(),
                    created_time:body.find('#created_time').val(),
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