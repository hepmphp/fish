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
<div class="form-wrapper" style="padding-top:0px; ">
    <ul class="list-inline page-tab clearfix">
        <li  class="cur"><a href="/cms/collect/index?iframe=1">任务列表</a><em></em></li>
        <li  ><a href="/cms/collect/create?iframe=1">采集添加</a><em></em></li>
        <li ><a href="/cms/collect/update?iframe=1">采集修改</a><em></em></li>
    </ul>
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
                    <div class="form-group">
            <label class="control-label">站点首页：</label>
            <input placeholder="文本" class="form-control" name="site" id="site" value="<?=$form['site']?>" type="text">
        </div>
        <div class="form-group">
            <label class="control-label">添加时间：</label>
            <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_addtine" type="text" value="<?=$form['begin_addtine']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_addtine" type="text" value="<?=$form['end_addtine']?>">
            </span>
        </div>        <div class="form-group">
        <label class="control-label">状态：</label>
        <select id="status" name="status" class="form-control">
        <option value="">请选择</option>
          <?php
              foreach($config_status as $k=>$vo){
                  ?>
                  <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status'] &&is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
              <?php }?>
        </select>
	    </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
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
                        per_page :100,
                    
						id: $('#id').val(),
						site: $('#site').val(),
						list: $('#list').val(),
						detail: $('#detail').val(),
						preg_list: $('#preg_list').val(),
						preg_page: $('#preg_page').val(),
						preg_detail: $('#preg_detail').val(),
						preg_title: $('#preg_title').val(),
						preg_author: $('#preg_author').val(),
						preg_time: $('#preg_time').val(),
						preg_media: $('#preg_media').val(),
						preg_content: $('#preg_content').val(),
						addtine: $('#addtine').val(),
						updatetime: $('#updatetime').val(),
						deltime: $('#deltime').val(),
						status: $('#status').val(),

            };
        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +
            
'<td>[id]</td>'+
'<td>[site]</td>'+
'<td>[list]</td>'+
'<td>[detail]</td>'+
'<td>[addtime]</td>'+
'<td>[updatetime]</td>'+
'<td>[deltime]</td>'+
'<td>[status]</td>'+

            '<td><a onclick="coll_to_local([id])" class="">[采集到本地]</a>|<a onclick="coll_to_db_preview([id])" class="">[采集入库预览]</a>|<a onclick="coll_to_db([id])" class="">[采集入库]</a>|<a onclick="edit([id])" class="">[编辑]</a>|<a onclick="del([id])" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/cms/collect/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.																																																
replace(/\[id\]/g, d.id).
replace('[site]', d.site).
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
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $(".table").bootstrapTable('resetView');
                // window.console.clear();

            } else {
                layer.alert(data.msg);
            }

        });
    }

</script>
<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>


var urls = {
    create_url:'/api/cms/collect/create',
    update_url:'/api/cms/collect/update',
    delete_url:'/api/cms/collect/delete',
    info_url:'/api/cms/collect/info'
};

/***
 * 添加
 */
function add(){
    var url = '/cms/collect/create';
    layer_form(url,1,['900px', '600px']);
}
/**
 * 修改
 * @param id
 */
function edit(id) {
    var url = "/cms/collect/update?id="+id;
    window.location.href = url;
}

function coll_to_local(id){
    var url = "/cms/collect/collect_site?id="+id;
    open_url(url);
}
function coll_to_db_preview(id){
    var url = "/cms/collect/collect_site_parse_preview?id="+id;
    open_url(url);
}
function coll_to_db(id){
    var url = "/cms/collect/collect_site_parse?id="+id;
    open_url(url);
}

function open_url(site){
    layer.open({
        type: 2,
        title: '站点预览',
        shadeClose: true,
        shade: 0.8,
        area: ['1200px', '700px'],
        content: site //iframe的url
    });
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
            var param ={
                
					id:body.find('#id').val(),
					site:body.find('#site').val(),
					list:body.find('#list').val(),
					detail:body.find('#detail').val(),
					preg_list:body.find('#preg_list').val(),
					preg_page:body.find('#preg_page').val(),
					preg_detail:body.find('#preg_detail').val(),
					preg_title:body.find('#preg_title').val(),
					preg_author:body.find('#preg_author').val(),
					preg_time:body.find('#preg_time').val(),
					preg_media:body.find('#preg_media').val(),
					preg_content:body.find('#preg_content').val(),
					addtine:body.find('#addtine').val(),
					updatetime:body.find('#updatetime').val(),
					deltime:body.find('#deltime').val(),
					status:body.find('#status').val()

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

</html>
