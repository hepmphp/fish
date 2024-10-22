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
                <label class="control-label">账号：</label><input id="username" class="form-control" type="text">
            </div>

            <div class="form-group">
                <label class="control-label">最后登录时间：</label>
                <span class="date-range">
		<input placeholder="开始时间" id="start_time" class="form-control date-range00 date-ico" type="text">
		<input placeholder="结束时间" id="end_time" class="form-control date-range01 date-ico" type="text">
		</span>
            </div>
            <button class="btn btn-info m-l" type="button" onclick="search()"> 查询</button>
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>用户名</th>
                <th>创建时间</th>
                <th>修改时间</th>
                <th>会话id</th>
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
        id: $.cookie('id'),
        admin_username: $.cookie('username'),
        access_token: $.cookie('access_token')
    };

    function search(){
        var search_param= {
            page: 1,
            per_page : $("#username").val().length==0?100:1,
            id: $.cookie('id'),
            username: $("#username").val(),
            access_token: $.cookie('access_token'),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);
        var template = '<tr><td>[id]</td><td>[username]</td><td>[create_time]</td><td>[update_time]</td><td>[last_session_id]</td><td><a onclick="user_info(\'[username]\')" class="" data-id="[id]">[修改]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/user/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).replace('[username]', d.username).replace('[username]', d.username).replace('[create_time]', d.create_time).replace('[update_time]', d.update_time).replace('[last_session_id]', d.last_session_id);
                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                window.console.clear();
                call_debug_log();
            } else {
                layer.alert(data.msg);
            }

        });
    }


    function user_info(username) {
        var username_param = username;
        layer.open({
            type: 2,
            title: '修改密码',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['300px', '300px'],
            content: '/admin/user/user_info',
            yes: function (index, layero) {

                var body = layer.getChildFrame('body', index);
                var password = body.find('#password').val();
                var re_password = body.find('#re_password').val();
                console.log(password);
                var param = {
                    username: username_param,
                    password: password,
                    re_password: re_password
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/api/user/update',
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
</script>
<!-- Bootstrap table -->
<script src="<?= STATIC_URL ?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?= STATIC_URL ?>js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="<?= STATIC_URL ?>js/table-demo.js"></script>
</body>
</html>
