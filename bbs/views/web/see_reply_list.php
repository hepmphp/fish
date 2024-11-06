<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区"/>
    <meta name="description" content="WeCenter 社交化知识社区"/>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/sidebar.css" rel="stylesheet" type="text/css" />
    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script src="<?=STATIC_URL?>js/layer/layer.js"></script>
</head>
<body>

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
								<a href="http://127.0.0.1:1111/wecenter/?/topic/%E7%BC%96%E7%A8%8B" class="text">编程</a>
							</span>

                        </div>
                    </div>
                    <!-- end 话题bar -->
                    <div class="aw-mod aw-question-detail aw-item">
                        <div class="mod-head">
                            <h1>
                                <?=$post['subject']?> </h1>
<!--                            <div id="threadstamp"><img src="--><?//=STATIC_URL?><!--image/stamp/001.gif" title="置顶"></div>-->
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
                            <?php foreach ($reply['list'] as $k=>$reply){?>
                                <div class="aw-item" uninterested_count="0" force_fold="0" id="answer_list_<?=$reply['id']?>">
                                    <div class="mod-head">
                                        <!-- 最佳回答 -->
                                        <div class="aw-best-answer">
                                            <i class="icon "style="font-size: 30px;"><?=($k+1)?>楼 </i>
                                        </div>
                                        <!-- end 最佳回答 -->
                                        <a class="anchor" name="answer_1"></a>
                                        <!-- 用户头像 -->
                                        <a class="aw-user-img aw-border-radius-5"
                                           href="" data-id="<?=$reply['id']?>"><img
                                                src="<?=STATIC_URL?>image/avator/10001.jpg"
                                                alt=""></a>                                        <!-- end 用户头像 -->
                                        <div class="title">
                                            <p>
                                                <a class="aw-user-name" href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                   data-id="1"></a>
                                            <h1 class="text-color-999"><?=($k+1)?>楼 <?=date("Y-m-d H:i:s",$reply['created_time'])?></h1></p>
                                            <p class="text-color-999 aw-agree-by collapse">
                                                赞同来自:

                                            </p>
                                        </div>
                                    </div>
                                    <div class="mod-body clearfix">
                                        <!-- 评论内容 -->
                                        <div class="markitup-box">
                                            <?=$reply['content']?>
                                        </div>

                                        <!-- end 评论内容 -->
                                    </div>


                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <!-- end 问题详细模块 -->
                    <!-- 回复编辑器 -->
                    <div class="aw-mod aw-replay-box question">
                        <a name="answer_form"></a>
                        <form action="#" method="post" id="answer_form" class="question_answer_form">
                            <input type="hidden" id="pid" name="pid" value="<?=$post['id']?>">
                            <input type="hidden" id="fid" name="fid" value="<?=$post['fid']?>">
                            <input type="hidden" id="subject" name="subject" value="<?=$post['subject']?>">
                            <div class="mod-head">
                                <a href="#" class="aw-user-name"><img alt="admin"
                                                                      src="http://127.0.0.1:1111/wecenter/static/common/avatar-mid-img.png"></a>
                                <p>
                                    <label class="pull-right">
                                    </label>
                                    admin </p>
                            </div>
                            <div class="mod-body">
                                <div class="aw-mod aw-editor-box">
                                    <script name="content" id="editor" type="text/plain" style="width:1024px;height:500px;margin-top: 50px"></script>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end 回复编辑器 -->
                </div>

            </div>
        </div>
    </div>
</div>


</body>
<?php include BBS_PATH.'views/web/common/up_to_top.php'?>
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/ueditor.all.min.js"></script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');

</script>
<script>
    function see_post_reply(id){
        var content = '/bbs.php/web/ask/ajax_create?id='+id;
        var update_url ='/bbs.php/web/ask/create?id='+id;
        var index = layer.open({
            type: 2, //iframe
            area: ['900px', '700px'],
            title: '编辑回帖',
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
                var content_html = body.find('#edui1_iframeholder').find('#ueditor_0').contents().find('body').html();
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
                    url: update_url,
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
    function update_post_reply(id){
        var content = '/bbs.php/web/ask/ajax_create?id='+id;
        var index = layer.open({
            type: 2, //iframe
            area: ['900px', '700px'],
            title: '编辑回帖',
            btn: ['确认', '关闭'],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content: content,
            yes: function (index, layero) {

            }, btn2: function (index, layero) {

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