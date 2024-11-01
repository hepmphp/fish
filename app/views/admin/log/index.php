<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>日志列表</title>
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
<body class="form-body">
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form">
            <div class="form-group">
                <label class="control-label">用户id：</label><input id="user_id" class="form-control" type="text">
            </div>

            <div class="form-group">
                <label class="control-label">用户名：</label><input id="username" class="form-control" type="text">
            </div>

            <div class="form-group">
                <label class="control-label">最后登录时间：</label>
                <span class="date-range">
		<input placeholder="开始时间" id="start_time" class="form-control date-range00 date-ico" type="text">
		<input placeholder="结束时间" id="end_time" class="form-control date-range01 date-ico" type="text">
		</span>
            </div>
            <button class="btn btn-info m-l" type="button" onclick="search_list()"> 查询</button>

            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add_user()">
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table" >
            <thead>
            <tr>
                <th>日志类型</th>
                <th>id</th>
                <th>用户id</th>
                <th>用户名</th>
                <th>ip</th>
                <th>控制器</th>
                <th>方法</th>
                <th>操作时间</th>
                <th>请求信息</th>
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
            per_page : $('#per_page').val(),
            username: $("#username").val(),
            user_id:$('#user_id').val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);
        var template = '<tr><td >[log_type_name]</td>' +
            '<td>[id]</td>' +
            '<td>[user_id]</td>' +
            '<td>[username]</td>' +
            '<td>[ip]</td>' +
            '<td>[m]</td>' +
            '<td>[a]</td>' +
            '<td>[addtime]</td>' +
            '<td><a onclick="layer_log_info(\'[id]\')" class="" data-id="[id]">[查看详情]</a>' +
            '</tr>';
        var list_html = '';
        $.getJSON('/api/log/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).
                    replace('[log_type_name]', d.log_type_name).
                    replace('[user_id]', d.user_id).
                    replace('[username]', d.username).
                    replace('[ip]', d.ip).
                    replace('[m]', d.m).
                    replace('[a]', d.a).
                    replace('[addtime]', d.addtime)

                });

                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $(".table").bootstrapTable('resetView');
            } else {
                layer.alert(data.msg);
            }

        });
    }

    function layer_log_info(id){
        var url = '/admin/log/info?id='+id;
        layer.open({
            type: 2,
            title: '查看日志',
            shadeClose: true,
            shade: 0.8,
            area: ['1200px', '600px'],
            content: url //iframe的url
        });
    }


</script>
<?=\helpers\AppAsset::run_javascript_end()?>
</body>
</html>
