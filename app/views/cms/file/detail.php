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
        <div class="form-item">
            <form class="form-inline clearfix" role="form"  action="#" method="get">
                <div class="form-group">
                    <label class="control-label">用户id：</label>
                    <input placeholder="文本" class="form-control" name="user_id" id="user_id" value="<?=$form['user_id']?>" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">所属分类：</label>
                    <select id="folder_id" name="folder_id" class="form-control">
                        <option value="">请选择</option>
                        <?=$config_folder_id?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">文件名称：</label>
                    <input placeholder="文本" class="form-control" name="name" id="name" value="<?=$form['name']?>" type="text">
                </div>

                <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
                <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
            </form>
        </div>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>

                <th>id</th>
                <th>用户id</th>
                <th>所属分类</th>
                <th>分类id</th>
                <th>文件名称</th>
                <th>文件路径</th>
                <th>文件类型</th>
                <th>文件大小</th>
                <th>添加时间</th>
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
            per_page : $("#user_id").val().length==0?100:1,
            user_id: $("#user_id").val(),
            name:$('#name').val(),
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
            '<td>[user_id]</td>'+
            '<td>[folder_id]</td>'+
            '<td>[folder_name]</td>'+
            '<td>[name]</td>'+
            '<td><img src="[file]" width="75px" height="75px"></td>'+
            '<td>[ext]</td>'+
            '<td>[size]</td>'+
            '<td>[addtime]</td>'+
            '<td>[status]</td>'+
            '<td><a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/file/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[id]', d.id).
                    replace('[user_id]', d.user_id).
                    replace('[folder_id]', d.folder_id).
                    replace('[folder_name]', d.folder_name).
                    replace('[name]', d.name).
                    replace('[file]', d.file).
                    replace('[ext]', d.ext).
                    replace('[size]', d.size).
                    replace('[status]', d.status).
                    replace('[addtime]', d.addtime);
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
<script>
    var urls = {
        create_url:'/api/file/create',
        update_url:'/api/file/update',
        delete_url:'/api/file/delete',
        info_url:'/api/file/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/cms/file/create';
        layer_form(url,1,['884px', '342px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/cms/file/update?id="+id;
        layer_form(url,2,['884px', '342px']);
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
                var images  = new Array();
                $.each(body.find('.image-item'),function (i,v){
                    if($(this).attr('src')){
                        images.push($(this).attr('src'));
                    }
                });
                var folder_name =  body.find('#folder_id').find(':selected').text();
                var param ={
                    id:body.find('#id').val(),
                    folder_id:body.find('#folder_id').val(),
                    folder_name:folder_name,
                    file:images.join(',')
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