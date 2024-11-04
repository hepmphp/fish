<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit" />
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区" />
    <meta name="description" content="WeCenter 社交化知识社区"  />
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css"/>

    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>
</head>
<body>

<?php include BBS_PATH.'views/web/common/header.php'?>
<?php include BBS_PATH.'views/web/common/sidebar.php'?>
<div class="aw-container-wrap">

    <div class="container aw-publish">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content">

                    <form action="http://127.0.0.1:1111/wecenter/?/publish/ajax/publish_question/" method="post" id="question_form" onsubmit="return false;">
                        <input type="hidden" name="post_hash" value="4cba482680a02ca38e238d4307b57502">
                        <input type="hidden" name="attach_access_key" value="285e00d166e81eb6a61e46ede36e2fbd">
                        <input type="hidden" name="question_id" id="question_id" value="">
                        <input type="hidden" name="ask_user_id" value="">
                        <select name="category_id" class="collapse" id="category_id">
                            <option value="0">- 请选择分类 -</option>
                            <option value="1">默认分类</option><option value="2">人文</option><option value="3">艺术</option><option value="4">生活</option><option value="5">技术</option>						</select>
                        <div class="aw-mod aw-mod-publish">
                            <div class="mod-body">
                                <h3>问题标题:</h3>
                                <!-- 问题标题 -->
                                <div class="aw-publish-title">
                                    <div>
                                        <input type="text" placeholder="问题标题..." name="question_content" id="question_contents" value="" class="form-control">
                                    </div>
                                </div>
                                <!-- end 问题标题 -->


                                <script id="editor" type="text/plain" style="width:1024px;height:500px;margin-top: 50px"></script>

                            </div>
                            <div class="mod-footer clearfix">
                                <a class="btn btn-large btn-success btn-publish-submit" id="publish_submit" style="margin-right: 70px">确认发起</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
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
<?php include BBS_PATH.'views/web/common/up_to_top.php'?>
</html>