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
<body class="form-body">
<div class="form-wrapper" style="padding-top: 0">
    <ul class="list-inline page-tab clearfix">
        <li ><a href="/cms/collect/index?iframe=1">任务列表</a><em></em></li>
        <li  class="cur"><a href="/cms/collect/create?iframe=1">采集添加</a><em></em></li>
        <li ><a href="/cms/collect/update?iframe=1">采集修改</a><em></em></li>
    </ul>
    <div class="form-item">
        <div class="form-main">

            <div class="row">
                <input type="hidden" id="id" value="<?=$form['id']?>">
                <div class="col" style="float:left">
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点名称:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input class="form-control" placeholder="站点名称" id="site" value="<?=$form['site']?>" style="width: 750px;">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点首页:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input class="form-control" placeholder="站点首页" id="site_url" value="<?=$form['site_url']?>" style="width: 750px;">
                        </div>
                        <button class="btn btn-info" type="button" id="btn_preview_site">预览</button>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点列表页：</label>
                            <input class="form-control" placeholder="站点列表页" id="list" value="<?=$form['list']?>"  style="width: 750px;">
                        </div>
                        <button class="btn btn-info" type="button" id="btn_preview_list">预览</button>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">文章分类：</label>
                            <input class="form-control" placeholder="文章分类" id="cate" value="<?=$form['cate']?>"  style="width: 750px;">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点详情页：</label>
                            <input class="form-control" placeholder="站点详情页" id="detail" value="<?=$form['detail']?>"  style="width: 750px;">
                        </div>
                        <button class="btn btn-info" type="button" id="btn_preview_detail">预览</button>
                    </div>
                    <!--
                  preg_list	varchar(255) []	站点列表正则
                    preg_page	varchar(255) []	站点分页正则
                    preg_detail	varchar(255) []	站点详情页正则
                    preg_title	varchar(255) []	详情页标题正则
                    preg_author	varchar(255) []	详情页作者正则
                    preg_time	varchar(255) []	详情页时间正则
                    preg_media	varchar(255) []	详情页来源正则
                    preg_content	varchar(255) []	详情页内容正则
                    -->
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点列表正则：</label>
                            <textarea class="form-control" placeholder="站点列表正则" id="preg_list" style="width: 750px;"><?=$form['preg_list']?></textarea>
                        </div>
                        <button class="btn btn-info" type="button" id="btn_preview_preg_list">预览</button>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">站点详情页正则：</label>
                            <textarea class="form-control" placeholder="站点详情页" id="preg_detail"   style="width: 750px;"><?=$form['preg_detail']?></textarea>
                        </div>
                        <button class="btn btn-info" type="button" id="btn_preview_preg_detail">预览</button>
                    </div> <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">详情页标题正则：</label>
                            <textarea class="form-control" placeholder="站点详情页" id="preg_title"    style="width: 750px;"><?=$form['preg_title']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">详情页作者正则：</label>
                            <textarea class="form-control" placeholder="站点详情页" id="preg_author"   style="width: 750px;"><?=$form['preg_author']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">详情页时间正则：</label>
                            <textarea class="form-control" placeholder="站点详情页" id="preg_time"   style="width: 750px;"><?=$form['preg_time']?></textarea>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">详情页来源正则：</label>
                            <textarea class="form-control" placeholder="详情页来源正则" id="preg_media"  style="width: 750px;"><?=$form['preg_media']?></textarea>
                        </div>
                    </div>

                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">详情页内容正则：</label>
                            <textarea class="form-control" placeholder="详情页来源正则" id="preg_content"  style="width: 750px;"><?=$form['preg_content']?></textarea>
                        </div>
                    </div>
                    <button class="btn btn-info m-l-74" type="button" id="btn_add">采集站点修改</button>
                </div>
                <div class="col" style="float:right">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $('#btn_preview_site').click(function () {
        var site_url = $("#site_url").val();
        open_url(site_url);

    });
    $('#btn_preview_list').click(function () {
        var site = $("#list").val();
        var url = '/cms/collect/preview?url='+site;
        open_url(url);

    });
    $('#btn_preview_detail').click(function () {
        var site = $("#detail").val();
        var url = '/cms/collect/preview?url='+site;
        open_url(url);
    });
    $('#btn_preview_preg_list').click(function (){
        var list_url = $("#list").val();
        var preg_list = $("#preg_list").val();
        var param = {
            list_url:list_url,
            preg_list:preg_list
        };
        var url = '/cms/collect/preg_list?'+$.param(param);
        open_url(url);
    });
    $('#btn_preview_preg_detail').click(function (){
        var detail_url = $('#detail').val();
        var preg_detail = $('#preg_detail').val();
        var preg_title = $('#preg_title').val();
        var preg_author = $('#preg_author').val();
        var preg_media = $('#preg_media').val();
        var preg_time = $('#preg_time').val();
        var preg_content = $('#preg_content').val();
        var param ={
            detail_url:detail_url,
            preg_detail:preg_detail,
            preg_title:preg_title,
            preg_author:preg_author,
            preg_media:preg_media,
            preg_time:preg_time,
            preg_content:preg_content
        };
        var url = '/cms/collect/preg_detail?'+$.param(param);
        open_url(url);
    });
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
    $('#btn_add').click(function(){
        var id = $('#id').val();
        var site = $('#site').val();
        var site_url =$('#site_url').val();
        var list = $('#list').val();
        var cate = $('#cate').val();
        var detail = $('#detail').val();
        var preg_list = $('#preg_list').val();
        var preg_detail = $('#preg_detail').val();
        var preg_title = $('#preg_title').val();
        var preg_author = $('#preg_author').val();
        var preg_media = $('#preg_media').val();
        var preg_time = $('#preg_time').val();
        var preg_content = $('#preg_content').val();
        var param ={
            id:id,
            site:site,
            site_url:site_url,
            list:list,
            cate:cate,
            detail:detail,
            preg_list:preg_list,
            preg_detail:preg_detail,
            preg_title:preg_title,
            preg_author:preg_author,
            preg_media:preg_media,
            preg_time:preg_time,
            preg_content:preg_content
        };
        ajax_post('/api/cms/collect/update',param);
    });
</script>
</html>