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
<body class="form-body">
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
            <div class="form-group">
                <label class="control-label">菜单id</label>
                <input placeholder="菜单id" class="form-control" name="id" id="id" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">菜单名称</label>
                <input placeholder="菜单名称" class="form-control" name="name" id="name" value="" type="text">
            </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
            <input class="btn btn-info m-l" value="树图" name="search" type="button" style="width:60px;" onclick="tree_view()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>菜单名称</th>
                <th>头像</th>
                <th>菜单上一级id</th>
                <th>父菜单名称</th>
                <th>菜单状态</th>
                <th>标题</th>
                <th>菜单级别 0 1 2 3 4 依次递增</th>
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
            name:$('#name').val(),

        };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);
        param.per_page =2;
        var template = '<tr>' +
            '<td>[id]</td>'+
            '<td>[name]</td>'+
            '<td><img src="[avator]"></td>'+
            '<td>[parentid]</td>'+
            '<td>[parent_name]</td>'+
            '<td>[status]</td>'+
            '<td>[title]</td>'+
            '<td>[level]</td>'+

            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/doc.php/api/user_structure/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace(/\[id\]/g, d.id).
                    replace('[name]', d.name).
                    replace('[avator]', d.avator_url).
                    replace('[parentid]', d.parentid).
                    replace('[parent_name]', d.parent_name).
                    replace('[status]', d.status).
                    replace('[title]', d.title).
                    replace('[level]', d.level);

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
        create_url:'/doc.php/api/user_structure/create',
        update_url:'/doc.php/api/user_structure/update',
        delete_url:'/doc.php/api/user_structure/delete',
        info_url:'/doc.php/api/user_structure/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/doc.php/web/user_structure/create';
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/doc.php/web/user_structure/update?id="+id;
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
    function tree_view(){
        tree_layer_form("/doc.php/web/user_structure/tree");
    }
 function tree_layer_form(url){
     var layer_index = layer.open({
         type: 2, //iframe
         area: ['500px', '560px'],
         title: '查看树形结构',
         btn: [],
         shade: 0.3, //遮罩透明度
         content:url,
         yes: function(index, layero){
         },btn2: function(index, layero){

         }
     });
     layer.full(layer_index);
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
                    name:body.find('#name').val(),
                    avator:body.find('.image-item').eq(0).attr('src'),
                    parentid:body.find('#parentid').val(),
                    tree_nod_id:body.find('#tree_nod_id').val(),
                    tree_nod_name:body.find('#tree_nod_id').find("option:selected").text(),
                    parent_name:body.find('#parentid').find("option:selected").text(),
                    status:body.find('#status').val(),
                    remark:body.find('#remark').val(),
                    level:body.find('#level').val()

                };
                //todo生成js验证
                if(param.id>0){
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