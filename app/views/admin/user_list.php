
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--全局样式-->
    <link href="<?=STATIC_URL?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="<?=STATIC_URL?>/css/font-awesome.min.css" rel="stylesheet">
    <!--表单表格-->
    <link href="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/form.css" rel="stylesheet">
    <!--日期-->
    <link href="<?=STATIC_URL?>/js/date/daterangepicker.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="<?=STATIC_URL?>/css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>/js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="form-body">
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form">
            <div class="form-group">
                <label class="control-label">订单号：</label><input  class="form-control" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">角色ID：</label><input  class="form-control" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">角色名：</label><input  class="form-control" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">账号：</label><input  class="form-control" type="text">
            </div>
            <div class="form-group">
                <label class="control-label m-l-xs">状态：</label>
                <select class="form-control">
                    <option value="" selected="">请选择</option>
                    <option value="1"></option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">发布时间：</label>
                <span class="date-range">
		<input placeholder="开始时间" class="form-control date-range00 date-ico" type="text">
		<input placeholder="结束时间" class="form-control date-range01 date-ico" type="text">
		</span>
            </div>
            <button class="btn btn-info m-l" type="button"> 查询</button>
        </form>

    </div>

    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
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
    <div class="page-bottom clearfix">
        <div class="pull-right pagination">
<span class="page-list">每页显示
    <span class="btn-group dropup">
            <select class="form-control"  id="per_page" onchange="change_page()">
                <option value="2" >2</option>
                <option value="20">20</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
        </span>条</span>
<!--	<span class="btn-group dropup">-->
<!--		<button type="button" class="btn btn-default  btn-outline dropdown-toggle" data-toggle="dropdown">-->
<!--			<span class="page-size">30</span>-->
<!--            <span class="caret"></span>-->
<!--		</button>-->
<!--		<ul class="dropdown-menu" role="menu">-->
<!--			<li class="active">-->
<!--				<a href="javascript:void(0)">30</a>-->
<!--			</li>-->
<!--			<li>-->
<!--				<a href="javascript:void(0)">100</a>-->
<!--			</li>-->
<!--            <li>-->
<!--				<a href="javascript:void(0)">200</a>-->
<!--			</li>-->
<!--            <li>-->
<!--				<a href="javascript:void(0)">500</a>-->
<!--			</li>-->
<!--		</ul>-->
<!--	</span> -->
<!--条</span>-->
            <ul class="pagination pagination-outline">
                <li class="page-pre"><a href="javascript:void(0)">&laquo;</a></li>
                <li class="page-number active"><a href="javascript:void(0)">1</a></li>
                <li class="page-number"><a href="javascript:void(0)">2</a></li>
                <li class="page-next"><a href="javascript:void(0)">&raquo;</a></li>
            </ul>
            <input class="form-control jump-page" id="jump_page"  size="2" maxlength="7" type="text" style="width: 40px;">
            <a href="javascript:void(0)" id="jump_page_click" style="margin-right: 10px;" onclick="go_page()">跳转</a>
        </div>
    </div>

</div>
<!-- 全局js -->
<script src="<?=STATIC_URL?>/js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>/js/jquery.cookie.js"></script>
<script src="<?=STATIC_URL?>/js/page.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap.min.js"></script>
<!-- Bootstrap table -->
<script src="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="<?=STATIC_URL?>/js/table-demo.js"></script>
<!--日期-->
<script type="text/javascript" src="<?=STATIC_URL?>/js/date/moment.min.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>/js/date/jquery.daterangepicker.js"></script>


<script type="text/javascript" src="<?=STATIC_URL?>/js/layer/layer.js"></script>
<script type="text/javascript">
    layer.config({
        skin:'layer-ext-moon',
        extend:'moon/style.css'
    });
</script>
<script type="text/javascript">
    $('.date-range').dateRangePicker(
        {
            separator : ' to ',
            format: 'YYYY-MM-DD HH:mm:ss',
            endDate: moment(),
            getValue: function()
            {

                if ($('.date-range00').val() && $('.date-range01').val() )
                    return $('.date-range00').val() + ' 至 ' + $('.date-range01').val();
                else
                    return '';
            },
            setValue: function(s,s1,s2)
            {
                $('.date-range00').val(s1);
                $('.date-range01').val(s2);
            },
            time: {
                enabled: true
            },
            defaultTime: moment().subtract(1, 'month').startOf('month').startOf('day').toDate(),
            defaultEndTime: moment().endOf('day').toDate()
        });
    $(function () { $(".popover-options a").popover({
        html : true
    });});

</script>
<script>
    var per_page = $('#per_page').val();
    var param ={
        page:1,
        per_page:per_page,
        id:$.cookie('id'),
        username:$.cookie('username'),
        access_token:$.cookie('access_token')
    };
    ajax_list(param);
    function ajax_list(param){
        layer.load(2);
        var template = '<tr><td>[id]</td><td>[username]</td><td>[create_time]</td><td>[update_time]</td><td>[last_session_id]</td><td><a href="javascript:void(0)" class="" data-id="[id]">[修改]</a></td></tr>';
        var list_html= '';
        $.getJSON('/api/user/get_list/?'+$.param(param),function(data){
            layer.closeAll();
            if(data.status==0){
                $.each(data.data.list,function(i,d){
                    list_html  += template.replace(/\[id\]/g,d.id).
                    replace('[username]',d.username).
                    replace('[create_time]',d.create_time).
                    replace('[update_time]',d.update_time).
                    replace('[last_session_id]',d.last_session_id);
                });
            }
           // console.log(list_html);
            $('table tbody').html(list_html);
             var total_num = data.data.total;
            console.log(multi(total_num,param.per_page,param.page,100));
            $('.pagination-outline').html(multi(total_num,param.per_page,param.page,100));

        });
    }
    function go_page(){
        var page = $('#jump_page').val();
        var per_page = $('#per_page').val();
        var param ={
            page:page,
            per_page:per_page,
            id:$.cookie('id'),
            username:$.cookie('username'),
            access_token:$.cookie('access_token')
        };
        ajax_list(param);
    }
    $(document).ready(function() {
        $("#jump_page").keydown(function(e) {
            var curKey = e.which;
            console.log(curKey);
            if (curKey == 13) {
                $('#jump_page_click').trigger('click');
            }
        });

        $(".pagination-outline").delegate('a','click',function (){
            $(this).parent('li').addClass('active').siblings().removeClass('active');
            //console.log($(this).find('li').addClass('c'));
            var page = $(this).data('page');
            var param = {
                page:page,
                per_page:$('#per_page').val(),
                id:$.cookie('id'),
                username:$.cookie('username'),
                access_token:$.cookie('access_token')
            };
            ajax_list(param);
        });

    });
    function change_page(){
        var per_page = $('#per_page').val();
        var param ={
            page:1,
            per_page:per_page,
            id:$.cookie('id'),
            username:$.cookie('username'),
            access_token:$.cookie('access_token')
        };
        ajax_list(param);
    }
</script>
</body>
</html>
