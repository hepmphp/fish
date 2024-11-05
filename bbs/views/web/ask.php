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

                    <form action="/bbs.php/web/ask/create" method="post" id="question_form" >


                        <div class="aw-mod aw-mod-publish">
                            <div class="mod-body">
                                <h3>问题标题:</h3>
                                <!-- 问题标题 -->
                                <div class="aw-publish-title">
                                    <div>
                                        <input type="text" placeholder="问题标题..." name="subject" id="subject" value="" class="form-control">
                                    </div>
                                </div>
                                <!-- end 问题标题 -->
                                <h3>分类:</h3>
                                <div>

                                    <select name="fid" id="fid">
                                        <option>请选择</option>
                                        <?=$config_menu?>
                                    </select>
                                </div>
                                <script name="content" id="editor" type="text/plain" style="width:1024px;height:500px;margin-top: 50px"></script>

                            </div>
                            <div class="mod-footer clearfix">
                                <input type="submit" class="btn btn-large btn-success btn-publish-submit" value="确认发起" id="publish_submit" style="margin-right: 70px">
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
<?php include BBS_PATH.'views/web/common/footer.php'?>
</html>