<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>用户列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
<?=\app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>
</head>
<body class="form-body">
<div class="form-wrapper" style="padding-top: 0px;">
    <ul class="list-inline page-tab clearfix">
        <li class="cur"><a href="/admin/user/index?iframe=1">用户列表</a><em></em></li>
        <li><a href="/admin/user/update_info?iframe=1">修改用户密码</a><em></em></li>
        <li ><a href="/admin/user/user_bind?iframe=1">用户信息绑定</a><em></em></li>
    </ul>
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
            <button class="btn btn-info m-l" type="button" onclick="search_list()"> 查询</button>

            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add_user()">
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table" >
            <thead>
            <tr>
                <th class="col-5">id</th>
                <th  class="col-5">状态</th>
                <th  class="col-5">用户名</th>
                <th  class="col-5">真实名字</th>
                <th  class="col-5">用户组</th>
                <th  class="col-5">创建时间</th>
                <th  class="col-5">修改时间</th>
                <th  class="col-5">会话id</th>
                <th  class="col-5">邮箱是否激活</th>
                <th  class="col-5">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td  class="col-5"></td>
                <td  class="col-5"></td>
                <td class="col-5"></td>
                <td  class="col-5"></td>
                <td class="col-5"></td>
                <td  class="col-5"></td>
                <td  class="col-5"></td>
                <td  class="col-5"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?=\app\helpers\PageWidget::run();?>

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
            per_page : 20,
            username: $("#username").val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);
        var template = '<tr><td >[id]</td>' +
            '<td>[status]</td>' +
            '<td>[username]</td>' +
            '<td>[realname]</td>' +
            '<td>[group_name]</td>' +
            '<td>[create_time]</td>' +
            '<td>[update_time]</td>' +
            '<td>[last_session_id]</td>' +
            '<td>[email_status]</td>' +
            '<td><a onclick="edit_user(\'[id]\')" class="" data-id="[id]">[修改]</a>' +
            '<a onclick="group_permission(\'[id]\')" class="">[分配权限]</a>' +
            '<a  onclick="lock_user(\'[id]\')" style="color: red">[锁定]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/user/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).
                    replace('[status]', d.status_name).
                    replace('[username]', d.username).
                    replace('[realname]', d.realname).
                    replace('[group_name]', d.group_name).
                    replace('[create_time]', d.create_time).
                    replace('[update_time]', d.update_time).
                    replace('[email_status]', d.email_status).
                    replace('[last_session_id]', d.last_session_id);
                });

                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $(".table").bootstrapTable('resetView');
                //$('#bootstrap-table-js').attr('src',$('#bootstrap-table-js').attr('src')+'?'+<?//=rand()?>//);
                //$('#bootstrap-table-js-cn').attr('src',$('#bootstrap-table-js-cn').attr('src')+'?'+<?//=rand()?>//);
                //$('#bootstrap-table-demo').attr('src',$('#bootstrap-table-demo').attr('src')+'?'+<?//=rand()?>//);
               // window.console.clear();

            } else {
                layer.alert(data.msg);
            }

        });
    }


    function edit_user(id) {
        var username_param = {id:id};
        layer.open({
            type: 2,
            title: '修改密码',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['600px', '580px'],
            content: '/admin/user/update?'+$.param(username_param),
            yes: function (index, layero) {

                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var password = body.find('#password').val();
                var re_password = body.find('#re_password').val();
                var admin_url = body.find('#admin_url').val();
                console.log(password);
                var param = {
                    id:id,
                    password: password,
                    re_password: re_password,
                    admin_url:admin_url,
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/api/user/update',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        if(data.status==0){
                            layer.close(2);
                            alert_success(data.msg);
                        }else{
                            alert_fail(data.msg);
                        }

                    }
                });

            }, btn2: function (index, layero) {
                console.log('no');
            }
        });
    }

    function add_user(){
        layer.open({
            type: 2,
            title: '添加用户',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['600px', '500px'],
            content: '/admin/user/create',
            yes: function (index, layero) {
                var body = layer.getChildFrame('body', index);
                var username = body.find('#username').val();
                var realname = body.find('#realname').val();
                var password = body.find('#password').val();
                var re_password = body.find('#re_password').val();
                var group_id = body.find('#group_id').val();
                var param = {
                    username: username,
                    realname: realname,
                    password:password,
                    re_password:re_password,
                    group_id:group_id
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/api/user/create',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        if(data.status==0){
                            layer.close(2);
                            alert_success(data.msg);
                        }else{
                            alert_fail(data.msg);
                        }
                    }
                });

            }, btn2: function (index, layero) {
                console.log('no');
            }
        });
    }
    function group_permission(id){
        var url = "/admin/user/edit_permission"+"?id="+id+"&iframe=1";
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
                //select_item
                iframeWin.$("input[name='select_item']:checked").each(function(i){
                    mids.push($(this).val());
                    console.log($(this).val());
                });
                mids = mids.join(',');
                var param = {
                    id:iframeWin.$('#id').val(),
                    mids:mids
                };
                var index = layer.load(2);
                $.ajax({
                    type:"POST",
                    url: "/api/user/edit_permission",
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


    function lock_user(id) {
        var param =  {id:id};
        layer.confirm('确定要锁定账号?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: '/api/user/delete',
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
</script>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</body>

</html>
