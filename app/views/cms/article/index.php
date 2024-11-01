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
                <label class="control-label">用户id：</label>
                <input placeholder="用户id" class="form-control" name="id" id="id" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">用户名：</label>
                <input placeholder="用户名" class="form-control" name="admin" id="admin" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">标题：</label>
                <input placeholder="标题" class="form-control" name="title" id="title" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">添加时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="start_time" type="text" value="">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_time" type="text" value="">
            </span>
            </div>
            <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="0">正常</option>
                    <option value="-1">删除</option>
                </select>
            </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="article_layer_form('/cms/article/create')">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>用户id</th>
                <th>用户名</th>
                <th>标题</th>
                <th>分类</th>
                <th>标签id  </th>
                <th>描述</th>
                <th>添加时间</th>
                <th>是否置顶</th>
                <th>列表显示图片</th>
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
                    <td></td>
                    <td></td>
                    <td></td>
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


<script >
    $('.date-range').dateRangePicker(
        {
            separator: ' to ',
            format: 'YYYY-MM-DD HH:mm:ss',
            endDate: moment(),
            getValue: function () {

                if ($('.date-range00').val() && $('.date-range01').val())
                    return $('.date-range00').val() + ' 至 ' + $('.date-range01').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('.date-range00').val(s1);
                $('.date-range01').val(s2);
            },
            time: {
                enabled: true
            },
            defaultTime: moment().subtract(1, 'month').startOf('month').startOf('day').toDate(),
            defaultEndTime: moment().endOf('day').toDate()
        });
    $(function () {
        $(".popover-options a").popover({
            html: true
        });
    });

</script>
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
            id:$('#id').val(),
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
        var template = '<tr><td >[id]</td><td >[admin]</td>' +
            '<td>[title]</td>' +
            '<td>[cate_name]</td>' +
            '<td>[tag_name]</td>' +
            '<td>[description]</td>' +
            '<td>[addtime_name]</td>' +
            '<td>[is_top_name]</td>' +
            '<td><image src="[list_image_url]" style="width: 60px;height: 60px;"></image></td>' +
            '<td>[status_name]</td>' +
            '<td><a onclick="edit_article(\'[id]\')" class="" data-id="[id]">[修改]</a><br/>' +
            '<a onclick="delete_article(\'[id]\')" style="color: red;">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/article/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).
                    replace('[admin]', d.admin).
                    replace('[title]', d.title).
                    replace('[cate_name]', d.cate_name).
                    replace('[tag_name]', d.tag_name).
                    replace('[description]', d.description).
                    replace('[addtime_name]', d.addtime_name).
                    replace('[is_top_name]', d.is_top_name).
                    replace('[list_image_url]', d.list_image_url).
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
    function edit_article(id){
        var edit_article_url = '/cms/article/update?id='+id;
        article_layer_form(edit_article_url,2);
    }

    function delete_article(id){
        var param =  {id:id};
        layer.confirm('确定删除文章?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: '/api/article/delete',
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

    function article_layer_form(url,action=1){
        var title = action==1?'添加':'修改';
        var btn =  action==1?['确认添加','取消']:['确认修改','取消'];
        var layer_index = layer.open({
            type: 2, //iframe
            area: ['500px', '560px'],
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            content:url,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    cate_id:body.find('#cate_id').val(),
                    tag_ids:body.find('#tag_ids').val(),
                    admin_id:$.cookie('admin_id'),
                    admin:$.cookie('username'),
                    title:body.find('#title').val(),
                    keywords:body.find('#keywords').val(),
                    description:body.find('#description').val(),
                    content:body.find('.ck-content').html(),
                    addtime:body.find('#addtime').val(),
                    is_top:body.find('#is_top').val(),
                    list_image_url:body.find('#list_image_url').val(),
                    status:body.find('#status').val()
                }
                console.log(param);
                var url = action==1?'/api/article/create':'/api/article/update';
               ajax_post(url,param);
            },btn2: function(index, layero){

            }
        });
        layer.full(layer_index);
    }
</script>
<?=\helpers\AppAsset::run_javascript_end()?>
</body>
</html>
