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
    <link href="http://127.0.0.1/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://127.0.0.1/static/admin/css/style.css" rel="stylesheet">
    <link href="http://127.0.0.1/static/admin/css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="http://127.0.0.1/static/admin/css/font-awesome.min.css" rel="stylesheet">
    <!--表单表格-->
    <link href="http://127.0.0.1/static/admin/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="http://127.0.0.1/static/admin/css/form.css" rel="stylesheet">
    <!--日期-->
    <link href="http://127.0.0.1/static/admin/js/date/daterangepicker.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="http://127.0.0.1/static/admin/css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="http://127.0.0.1/static/admin/js/html5shiv.min.js"></script>
    <script src="http://127.0.0.1/static/admin/js/respond.min.js"></script>
    <![endif]-->

    <script src="http://127.0.0.1/static/admin/js/jquery.min.js"></script>
    <script src="http://127.0.0.1/static/admin/js/layer/layer.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/static/admin/js/common.js"></script>
    <script type="text/javascript">
        layer.config({
            skin:'layer-ext-moon',
            extend:'moon/style.css'
        });

        jQuery.browser = {};
        (function () {
            jQuery.browser.msie = false;
            jQuery.browser.version = 0;
            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                jQuery.browser.msie = true;
                jQuery.browser.version = RegExp.$1;
            }
        })();

        function ajax_post(url,param){
            layer.load(2);
            $.ajax({
                type:"POST",
                url: url,
                data:  param,
                timeout:"4000",
                dataType:'json',
                success: function(data){
                    if (data.status == 0) {
                        layer.closeAll('loading');
                        alert_success(data.msg);
                    }
                    else {
                        layer.closeAll('loading');
                        alert_fail(data.msg);
                    }
                }
            });
        }
    </script>

</head>
<body class="form-body">
<div class="form-wrapper">
		<div class="form-item">
        <form class="form-inline clearfix" role="form" id="form_log" method="get">
		<input type="hidden" name="search" value="1">
		<input type="hidden" name="page" value="<?php if(isset($_GET['page'])){echo $_GET['page'];}else{echo 1;}?>">
		<div class="form-group">
		<label class="control-label">平台：</label>
		<select class="form-control" name="platform" id="platform">
			<option value="" selected="">选择平台</option>
			<?php foreach($all_platform as $k=>$v){ ?>
			<option value="<?=$k?>" <?php if(isset($_GET['platform']) && $k==$_GET['platform']){echo "selected";}?>><?=$v?></option>
			<?php }?>
			</select>
	     </div>
	     <div class="form-group">
		<label class="control-label">游戏：</label>
		<select class="form-control" name="game_id" id="game_id">
			<option value="" selected="">请选择</option>
			<?php foreach($all_game as $k=>$v){ ?>
			<option value="<?=$k?>" <?php if(isset($_GET['game_id']) && $k==$_GET['game_id']){echo "selected";}?>><?=$v?></option>
			<?php }?>
			</select>
		 </div>
		 <div class="form-group">
		<label class="control-label">api：</label>
		<select class="form-control" name="api" id="api">
			<option value="" selected="">请选择</option>
			<?php foreach($all_api as $k=>$v){ ?>
			<option value="<?=$v?>" <?php if(isset($_GET['api']) && $v==$_GET['api']){echo "selected";}?>><?=$config_api[$v]?>  <?=$v?></option>
			<?php }?>
			</select>
		</div>
		<div class="form-group">
		<label class="control-label">区服：</label>
		<input class="form-control" type="text" name="server_id" id="server_id" value="<?php if(isset($_GET['server_id'])){echo $_GET['server_id'];}?>">
		</div>
		<div class="form-group">
		<label class="control-label">角色ID：</label>
		<input class="form-control" type="text" name="role_id" id="role_id" value="<?php if(isset($_GET['role_id'])){echo $_GET['role_id'];}?>">
		</div>
		<div class="form-group">
		<label class="control-label">道具ID：</label>
		<input class="form-control" type="text" name="item_id" id="item_id" value="<?php if(isset($_GET['item_id'])){echo $_GET['item_id'];}?>">
		</div>
	    <div class="form-group">
		<label class="control-label">途径：</label>
		<input class="form-control" type="text" name="ways" id="ways" value="<?php if(isset($_GET['ways'])){echo $_GET['ways'];}?>">
		</div>
		<div class="form-group">
		<label class="control-label">时间：</label>
		<span class="date-range">
		<input placeholder="开始时间" class="form-control date-range00 date-ico" type="text" name="begin_time" id="begin_time" value="<?=$_GET['begin_time']?>">
		<input placeholder="结束时间" class="form-control date-range01 date-ico" type="text" name="end_time" id="end_time" value="<?=$_GET['end_time']?>">
		</span>
		</div>

		<button class="btn btn-info m-l" type="button" id="btn_search"> 查询</button>
		</form>
		</div>
 
   


        <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>id</th>
                <th>站点首页</th>
                <th>站点列表页</th>
                <th>站点详情页</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>删除时间</th>
                <th>状态</th>
                <th>删除时间</th>
                <th>删除时间</th>
                <th>删除时间</th>

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

 
 
</div>
<!-- 全局js -->
<script src="http://127.0.0.1/static/admin/js/jquery.min.js"></script>
<script src="http://127.0.0.1/static/admin/js/bootstrap.min.js"></script>
<!-- Bootstrap table -->
<script src="http://127.0.0.1/static/admin/js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="http://127.0.0.1/static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="http://127.0.0.1/static/admin/js/table-demo.js"></script>
<!--日期-->
<script type="text/javascript" src="http://127.0.0.1/static/admin/js/date/moment.min.js"></script>
<script type="text/javascript" src="http://127.0.0.1/static/admin/js/date/jquery.daterangepicker.js"></script>
<script type="text/javascript">
    ajax_list();
    function ajax_list() {
        layer.load(2);

        var template = '<tr>' +
            
                '<td>[id]</td>'+
                '<td>[subject]</td>'+
                '<td>[list]</td>'+
                '<td>[detail]</td>'+
                '<td>[addtime]</td>'+
                '<td>[updatetime]</td>'+
                '<td>[deltime]</td>'+
                '<td>[status]</td>'+

            '<td><a onclick="coll_to_local([id])" class="">[采集到本地]</a>|<a onclick="coll_to_db_preview([id])" class="">[采集入库预览]</a>|<a onclick="coll_to_db([id])" class="">[采集入库]</a>|<a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('http://127.0.0.1/tool/awk/index.php?debug=0&m=bbs_posts&a=get_bbs_posts&status=0', function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																																																
                    replace(/\[id\]/g, d.id).
                    replace('[subject]', d.subject).
                    replace('[list]', d.list).
                    replace('[detail]', d.detail).
                    replace('[preg_list]', d.preg_list).
                    replace('[preg_detail]', d.preg_detail).
                    replace('[preg_title]', d.preg_title).
                    replace('[preg_author]', d.preg_author).
                    replace('[preg_time]', d.preg_time).
                    replace('[preg_media]', d.preg_media).
                    replace('[preg_content]', d.preg_content).
                    replace('[addtime]', d.addtime).
                    replace('[updatetime]', d.updatetime).
                    replace('[deltime]', d.deltime).
                    replace('[status]', d.status)
                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
               
                $(".table").bootstrapTable('resetView');
                // window.console.clear();

            } else {
                layer.alert(data.msg);
            }

        });
    }
 
</script>
</body>
</html>