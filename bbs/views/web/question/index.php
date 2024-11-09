<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <title></title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/sidebar.css" rel="stylesheet" type="text/css" />
    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script src="<?=STATIC_URL?>js/layer/layer.js"></script>
    <link href="<?= STATIC_URL ?>css/page.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=STATIC_URL?>js/page.js"></script>
</head>
<body>
<?php include BBS_PATH.'views/web/common/header.php'?>
<?php include BBS_PATH.'views/web/common/sidebar.php'?>
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content">
                    <!-- 话题推荐bar -->
                    <!-- 话题推荐bar -->
                    <!-- 话题bar -->
                    <div class="aw-mod aw-topic-bar" id="question_topic_editor" data-type="question" data-id="2">
                        <div class="tag-bar clearfix">
							<span class="topic-tag" data-id="5">
								<a href="<?=\bbs\helpers\Uri::bbs_list_index_href($post['fid'])?>" class="text">
                                    <?=$post['forum_name']?></a>
							</span>
                            <a href="<?=\bbs\helpers\Uri::bbs_list_index_href($post['fid'])?>">
                                <div style="float:right;width: 72px;height: 72px;margin: 0 auto;">
                                    <img src="<?=\bbs\helpers\SiteUrl::get_image_url($forum['logo'])?>" style="width: 80px;height: 80px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- end 话题bar -->
                    <div class="aw-mod aw-question-detail aw-item">
                        <div class="mod-head">
                            <h1>
                                <?=$post['subject']?> </h1>
                            <?php if(!empty($post['stamp'])){?>
                            <div id="threadstamp"><img src="<?=\bbs\helpers\SiteUrl::get_stamp_url($post['stamp'])?>" title=""></div>
                            <?php }?>
                            <div class="operate clearfix">

                            </div>
                        </div>
                        <div class="mod-body">
                            <div class="content markitup-box" style="margin-top: 50px;">
                               <?=$post['content']?>
                            </div>
                        </div>
                        <div class="mod-footer">
                            <div class="meta">
                                <span class="text-color-999"><?=date('Y-m-d h:i:s',$post['created_time'])?></span>
                                <a class="text-color-999" onclick="update_post(<?=$post['id']?>)"><i
                                        class="icon icon-edit"></i>编辑</a>

                                <div class="pull-right more-operate">

                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="aw-mod aw-question-comment">
                        <div class="mod-head">
                            <ul class="nav nav-tabs aw-nav-tabs active">
                                <h2 class="hidden-xs"><?=count($reply['list'])?> 个回复</h2>
                            </ul>
                        </div>
                        <div class="mod-body aw-feed-list">
                            <?php foreach ($reply['list'] as $k=>$reply_detail){?>
                            <div class="aw-item" uninterested_count="0" force_fold="0" id="answer_list_<?=$reply_detail['id']?>">
                                <div class="mod-head">
                                    <!-- 最佳回答 -->
                                    <div class="aw-best-answer">
                                        <i class="icon "style="font-size: 30px;"><?=($k+1)?>楼 </i>
                                    </div>
                                    <!-- end 最佳回答 -->
                                    <a class="anchor" name="answer_1"></a>
                                    <!-- 用户头像 -->
                                    <a class="aw-user-img aw-border-radius-5"
                                       href="<?=\bbs\helpers\Uri::user_bbslist_href($reply_detail['user_id'])?>" >
                                        <img class="avator_image_box"
                                            src="<?=\bbs\helpers\SiteUrl::get_avator_url($reply_detail['avator'])?>"
                                            alt=""></a>                                        <!-- end 用户头像 -->
                                    <div class="title">
                                        <p>
                                            <a class="aw-user-name" href="#"></a>
                                              <h1 class="text-color-999"><?=($k+1)?>楼 <?=date("Y-m-d H:i:s",$reply_detail['created_time'])?></h1></p>
                                        <p class="text-color-999 aw-agree-by collapse">
                                            赞同来自:

                                        </p>
                                    </div>
                                </div>
                                <div class="mod-body clearfix">
                                    <!-- 评论内容 -->
                                    <div class="markitup-box">
                                        <?=$reply_detail['content']?>
                                    </div>

                                    <!-- end 评论内容 -->
                                </div>
                                <div>
                                    <a class="text-color-999" onclick="update_post(<?=$reply_detail['id']?>)"><i class="icon icon-edit"></i>编辑</a>
                                    <a class="text-color-999" onclick="update_post_reply(<?=$reply_detail['fid']?>,<?=$reply_detail['id']?>)"><i
                                                class="icon"></i>回复</a>
                                    <a class="text-color-999" onclick="see_reply_list(<?=$reply_detail['id']?>)"><i
                                                class="icon"></i>查看回复</a>
                                </div>

                            </div>
                             <?php }?>
                        </div>
                        <div class="container">
                            <script>
                                function ajax_list(param){
                                    window.location.href = "<?=\bbs\helpers\Uri::question_href($_GET['id'])?>&"+$.param(param);
                                }
                            </script>
                            <?=\bbs\helpers\PageWidget::run()?>
                        </div>

                    </div>
                    <!-- end 问题详细模块 -->
                    <!-- 回复编辑器 -->
                    <?php if(!empty($bbs_user['id'])){?>
                    <div class="aw-mod aw-replay-box question" style="    width: 1070px;margin: 0 auto;">
                        <a name="answer_form"></a>
                        <form action="/bbs.php/web/question/create" method="post" id="answer_form" class="question_answer_form">
                            <input type="hidden" name="pid" value="<?=$post['id']?>">
                            <input type="hidden" name="fid" value="<?=$post['fid']?>">
                            <input type="hidden" name="subject" value="<?=$post['subject']?>">
                            <div class="mod-head">
                                <?php if(!empty($bbs_user['avator'])){?>
                                <a href="#" class="aw-user-name"><img alt="admin" src="<?=\bbs\helpers\SiteUrl::get_avator_url($bbs_user['avator'])?>"></a>
                                <?php }?>
                                <p>
                                    <label class="pull-right">
                                    </label>
                                    <?=$bbs_user['username']?> </p>
                            </div>
                            <div class="mod-body">
                                <div class="aw-mod aw-editor-box" style="margin: 0 auto;">
                                    <script name="content" id="content" type="text/plain" style="width:900px;height:500px;"></script>
                                    <div class="mod-footer clearfix">
                                        <input type="submit" class="btn btn-large btn-success btn-publish-submit" value="回复" id="publish_submit" style="float:right;margin-right: 450px;margin-top: 30px;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php }?>
                    <!-- end 回复编辑器 -->
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $('.pagination-outline').html(multi(<?=$reply['total']?>, <?=$reply['per_page']?>,  <?=$reply['page']?>, 100));
</script>

</body>

<?php include BBS_PATH.'views/web/common/up_to_top.php'?>
<?php include BBS_PATH.'views/web/common/editor.php'?>

<script>
    function see_reply_list(id){
        var content = '/bbs.php/web/ask/see_reply_list?id='+id;
        var index = layer.open({
            type: 2, //iframe
            area: ['900px', '700px'],
            title: '查看回帖',
            btn: ['确认', '关闭'],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content: content,
            yes: function (index, layero) {
                var body = layer.getChildFrame('body', index);

                var id = body.find('#id').val();
                var pid = body.find('#pid').val();
                var fid = body.find('#fid').val();
                var subject = body.find('#subject').val();
                var content_html = body.find('#content').html();
                var param = {
                    id: id,
                    pid: pid,
                    fid: fid,
                    subject: subject,
                    content: content_html
                };
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/bbs.php/web/ask/create',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 0) {
                            layer.close(2);
                            layer.alert(data.msg, {icon: 1}, function () {
                                layer.closeAll();
                                window.location.reload();
                            });
                        } else {
                            layer.alert(data.msg, {icon: 2}, function (index) {
                                layer.closeAll('loading');
                                layer.close(index);
                                // layer.closeAll();
                                // window.location.reload();
                            });
                        }
                    }
                });
            }, btn2: function (index, layero) {

            }
        });
    }
    function update_post_reply(fid,id){
        var content = '/bbs.php/web/ask/ajax_reply_create?id='+id+'&fid='+fid;
        var index = layer.open({
            type: 2, //iframe
            area: ['900px', '700px'],
            title: '回复帖子',
            btn: ['确认', '关闭'],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content: content,
            yes: function (index, layero) {
                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var pid = body.find('#pid').val();
                var fid = body.find('#fid').val();
                var subject = body.find('#subject').val();
                var content_html = body.find('#content').html();
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
                    url: '/bbs.php/web/ask/create',
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
        });
            // content:"{:U('Serverpolicy/add')}" //iframe的url
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
                var content_html = body.find('#content').html();
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
<?php include BBS_PATH . 'views/web/common/auto_index.php' ?>
<?php include BBS_PATH.'views/web/common/footer.php'?>
</html>