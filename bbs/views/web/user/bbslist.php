<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区"/>
    <meta name="description" content="WeCenter 社交化知识社区"/>
    <link href="<?= STATIC_URL ?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?= STATIC_URL ?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?= STATIC_URL ?>css/commom.css" rel="stylesheet" type="text/css"/>
    <link href="<?= STATIC_URL ?>css/page.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=STATIC_URL?>js/page.js"></script>
</head>
<body>
<?php include BBS_PATH . 'views/web/common/header.php' ?>
<?php include BBS_PATH . 'views/web/common/sidebar.php' ?>

<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="aw-global-tips">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content">
                    <div class="aw-mod aw-topic-detail-title">
                        <div class="mod-body" style="width:300px;margin: 0 auto;">
                            <h2 class="pull-left">用户帖子</h2>
                        </div>
                    </div>

                    <div class="aw-mod aw-topic-list-mod">
                        <div class="mod-head">
                            <div class="tabbable">
                                <!-- tab 切换 -->
                                <ul class="nav nav-tabs aw-nav-tabs hidden-xs">

                                </ul>
                                <!-- end tab 切换 -->
                            </div>
                        </div>

                        <div class="mod-body" style="width: 100%;margin: 0 auto;">
                            <!-- tab 切换内容 -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="all">
                                    <!-- 推荐问题 -->
                                    <!-- end 推荐问题 -->
                                    <div class="aw-mod">
                                        <div class="mod-body">
                                            <div class="aw-common-list" id="c_all_list">
                                                <?php foreach ($data['list'] as $k=>$v){?>
                                                    <div class="aw-item article">
                                                        <a class="aw-user-name hidden-xs" data-id="1"
                                                           href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                           rel="nofollow">
                                                            <img
                                                                src="<?=\bbs\helpers\SiteUrl::get_avator_url($v['avator'])?>"
                                                                alt=""></a>
                                                        <div class="aw-question-content">
                                                            <h4>
                                                                <a href="<?=\bbs\helpers\Uri::question_href($v['id'])?>"><?=$v['subject']?></a>
                                                            </h4>
                                                            <span>
                                                            <?=date('Y-m-d H:i:s',$v['created_time'])?>
                                                        </span>
                                                            <div style="float: right;"><a onclick="update_post(<?=$v['id']?>)">修改帖子</a></div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <?=\bbs\helpers\PageWidget::run()?>
                    </div>
                    <?php include BBS_PATH . 'views/web/common/up_to_top.php' ?>
                    <?php include BBS_PATH . 'views/web/common/auto_index.php' ?>
                    <?php include BBS_PATH.'views/web/common/footer.php'?>
</body>
<script>
    $('.pagination-outline').html(multi(<?=$data['total']?>, <?=$data['per_page']?>,  <?=$data['page']?>, 100));
    function ajax_list(param){
        window.location.href = "<?=\bbs\helpers\Uri::user_bbslist_href($_GET['user_id'])?>&"+$.param(param);
    }
    function update_post(update_id){
        var content = '/bbs.php/web/ask/ajax_update?id='+update_id;
        var update_url ='/bbs.php/web/ask/update_ask?id='+update_id;
        var index = layer.open({
            type: 2, //iframe
            area: ['900px', '700px'],
            title: '编辑回帖',
            btn: ['确认', '关闭'],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content:content,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var pid = body.find('#pid').val();
                var fid = body.find('#fid').val();
                var subject = body.find('#subject').val();
                var content_html = body.find('#edui1_iframeholder').find('#ueditor_0').contents().find('body').html();
                var param = {
                    id:id,
                    pid: pid,
                    fid:fid,
                    subject: subject,
                    content:content_html
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: update_url,
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        if(data.status==0){
                            layer.close(2);
                            layer.alert(data.msg, {icon:1}, function(){
                                layer.closeAll();
                                window.location.reload();
                            });
                        }else{
                            layer.alert(data.msg, {icon:2},function (index) {
                                layer.closeAll('loading');
                                layer.close(index);
                                // layer.closeAll();
                                // window.location.reload();
                            });
                        }
                    }
                });
            },btn2: function(index, layero){

            }
            // content:"{:U('Serverpolicy/add')}" //iframe的url
        });

    }
</script>

</html>