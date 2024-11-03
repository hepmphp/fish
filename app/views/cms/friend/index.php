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
    <?=\helpers\AppAsset::run()?>
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
                <label class="control-label">分类名：</label>
                <input placeholder="文本" class="form-control" name="name" id="name" value="" type="text">
            </div>

            <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="0">正常</option>
                    <option value="-1">删除</option>
                </select>
            </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="friend_layer_form('/cms/friend/create')">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>名称</th>
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
    <?=\helpers\PageWidget::run();?>
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
        var template = '<tr><td >[id]</td><td >[name]</td><td >[status_name]</td>' +
            '<td><a onclick="delete_freind(\'[id]\')" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/friend/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).
                    replace('[name]', d.name).
                    replace('[status_name]', d.status_name);
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

    function delete_freind(id){
        var param =  {id:id};
        layer.confirm('确定删除友情链接?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: '/api/friend/delete',
                    data: param,
                    timeout:"4000",
                    dataType:'json',
                    success: function(data){
                        if (data.status == 0) {
                            alert_success(data.msg);
                        }else {
                            alert_fail(data.msg);
                        }
                    },
                });
            }
        );
    }
    function friend_layer_form(url,action=1){
        var title = action==1?'添加':'修改';
        var btn =  action==1?['确认添加','取消']:['确认修改','取消'];
        var layer_index = layer.open({
            type: 2, //iframe
            area: ['500px', '400px'],
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            content:url,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    name:body.find('#name').val(),
                    link_address:body.find('#link_address').val(),
                    status:body.find('#status').val(),
                }
                console.log(param);
                var url = action==1?'/api/friend/create':'/api/friend/update';
                ajax_post(url,param);
            },btn2: function(index, layero){

            }
        });
    }
</script>
<?=\helpers\AppAsset::run_javascript_end()?>
</body>
</html>
