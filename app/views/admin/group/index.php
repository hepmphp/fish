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
    <script src="<?= STATIC_URL ?>/js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>/js/respond.min.js"></script>
    <![endif]-->
    <?=\helpers\AppAsset::run()?>
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
        <form class="form-inline clearfix" role="form">
            <div class="form-group">
                <label class="control-label">用户组：</label><input id="name" class="form-control" type="text">
            </div>

            <button class="btn btn-info m-l" type="button" onclick="search()"> 查询</button>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add_group()">
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>用户组id</th>
                <th>用户组</th>
                <th>备注</th>
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


    function search(){
        var search_param= {
            page: 1,
            per_page : $("#name").val().length==0?100:1,
            id: $.cookie('id'),
            name: $("#name").val(),
            access_token: $.cookie('access_token'),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    get_ajax_list();
    function get_ajax_list(){
        var per_page = $('#per_page').val();
        window.param = {
            page: 1,
            per_page: per_page,
            id: $.cookie('id'),
            admin_username: $.cookie('username'),
            access_token: $.cookie('access_token')
        };

        ajax_list = function ajax_list(param) {
            layer.load(2);
            var template = '<tr><td>[id]</td><td>[name]</td><td>[comment]</td><td><a onclick="group_info(\'[id]\')" class="" >[编辑]</a><a onclick="group_permission(\'[id]\')" class="">[分配权限]</a></td></tr>';
            var list_html = '';
            $.getJSON('/api/group/get_list/?' + $.param(param), function (data) {
                layer.closeAll();
                if (data.status == 0) {
                    $.each(data.data.list, function (i, d) {
                        list_html += template.replace('[id]', d.id).
                        replace('[id]', d.id).
                        replace('[id]', d.id).
                        replace('[name]', d.name).
                        replace('[comment]', d.comment);
                    });
                    $('table tbody').html(list_html);
                    var total_num = data.data.total;
                    $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                    $(".table").bootstrapTable('resetView');
                    window.console.clear();
                    call_debug_log();
                } else {
                    layer.alert(data.msg);
                }

            });
        }
        ajax_list(param);
    }
    function group_info(id) {
        var id_param = id;
        layer.open({
            type: 2,
            title: '修改用户组',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['400px', '400px'],
            content: '/admin/group/group_info?id='+id_param,
            yes: function (index, layero) {

                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var name = body.find('#name').val();
                var comment = body.find('#comment').val();
                var allow_mutil_login = body.find('#allow_mutil_login').val();

                var param = {
                    id: id,
                    name: name,
                    comment: comment,
                    allow_mutil_login:allow_mutil_login
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/api/group/update',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        layer.close(2);
                        layer.alert(data.msg, {icon: 1}, function (index) {
                                layer.close(index);
                                layer.closeAll();
                            }
                        );
                    }
                });

            }, btn2: function (index, layero) {
                console.log('no');
            }
        });
    }

    function add_group(){
        layer.open({
            type: 2,
            title: '添加用户组',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['400px', '400px'],
            content: '/admin/group/create',
            yes: function (index, layero) {
                var body = layer.getChildFrame('body', index);
                var name = body.find('#name').val();
                var comment = body.find('#comment').val();
                var allow_mutil_login = body.find('#allow_mutil_login').val();
                var param = {
                    name: name,
                    comment: comment,
                    allow_mutil_login:allow_mutil_login
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/api/group/create',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        layer.close(2);
                        layer.alert(data.msg, {icon: 1}, function (index) {
                                layer.close(index);
                                layer.closeAll();
                            }
                        );
                    }
                });

            }, btn2: function (index, layero) {
                console.log('no');
            }
        });
    }

    function group_permission(id){
        var url = "/admin/group/edit_permission"+"?id="+id+"&iframe=1";
        permission_form(url,1);

    }
    //权限设置窗口
    function permission_form(url,action){
        var content = url;
        var title = action==2?'设置用户组权限':'设置用户组权限';
        var btn =  action==2?['确认','取消']:['确认','取消'];
        var index = layer.open({
            type: 2, //iframe
            area: ['1000px', '850px'],
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            content:content,
            yes: function(index, layero){
                console.log("tree ok...");
                var body = layer.getChildFrame('body', index);

                var iframeWin = window[layero.find('iframe')[0]['name']];
                console.log(iframeWin);
                var mids = new Array();
                iframeWin.$('.treetable-selected').each(function(){
                    mids.push($(this).attr('dataid'));
                    console.log($(this).attr('dataid'));
                });
                mids = mids.join(',');
                var param = {
                    id:iframeWin.$('#id').val(),
                    mids:mids
                };
                var index = layer.load(2);
                $.ajax({
                    type:"POST",
                    url: "/admin/group/update",
                    data:  param,
                    timeout:"4000",
                    dataType:"json",
                    success: function(data){
                        layer.close(index);
                        if (data.status == 0) {
                            alert_success(data.msg);
                        }
                        else {
                            alert_fail(data.msg);
                        }
                    }
                });
            },btn2: function(index, layero){

            }
            // content:"{:U('Serverpolicy/add')}" //iframe的url
        });
        layer.full(index);
    }
</script>
<!-- Bootstrap table -->
<script src="<?= STATIC_URL ?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?= STATIC_URL ?>js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="<?= STATIC_URL ?>js/table-demo.js"></script>
</body>
</html>
