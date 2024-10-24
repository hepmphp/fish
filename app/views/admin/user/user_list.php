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
            <button class="btn btn-info m-l" type="button" onclick="search_list()"> 查询</button>

            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add_user()">
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table">
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
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
        id: $.cookie('id'),
        admin_username: $.cookie('username'),
        access_token: $.cookie('access_token')
    };

    function search_list(){
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
        var template = '<tr><td >[id]</td>' +
            '<td>[status]</td>' +
            '<td>[username]</td>' +
            '<td>[realname]</td>' +
            '<td>[group_name]</td>' +
            '<td>[create_time]</td>' +
            '<td>[update_time]</td>' +
            '<td>[last_session_id]</td>' +
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
                    replace('[last_session_id]', d.last_session_id);
                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $('#bootstrap-table-js').attr('src',$('#bootstrap-table-js').attr('src')+'?'+<?=rand()?>);
                $('#bootstrap-table-js-cn').attr('src',$('#bootstrap-table-js-cn').attr('src')+'?'+<?=rand()?>);
               // window.console.clear();
                call_debug_log();
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
            area: ['600px', '500px'],
            content: '/admin/user/update?'+$.param(username_param),
            yes: function (index, layero) {

                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var password = body.find('#password').val();
                var re_password = body.find('#re_password').val();
                console.log(password);
                var param = {
                    id:id,
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
        layer.open({
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
<!-- Bootstrap table -->
<script id="bootstrap-table-js" src="<?= STATIC_URL ?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script id="bootstrap-table-js-cn" src="<?= STATIC_URL ?>js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="<?= STATIC_URL ?>js/table-demo.js?<?=rand()?>"></script>
</body>
</html>
