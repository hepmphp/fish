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
<?php if(!empty($bbs_user['id'])) {?>
<div class="aw-container-wrap">

    <div class="container aw-publish">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content">
                    <form action="/bbs.php/web/ask/update_ask" method="post" id="question_form" >
                        <input type="hidden" name="id" id="id" value="<?=$post['id']?>">
                        <div class="aw-mod aw-mod-publish">
                            <div class="mod-body">
                                <h3>问题标题:</h3>
                                <!-- 问题标题 -->
                                <div class="aw-publish-title">
                                    <div>
                                        <input type="text" placeholder="问题标题..." name="subject" id="subject" value="<?=$post['subject']?>" class="form-control">
                                    </div>
                                </div>
                                <!-- end 问题标题 -->
                                <h3>分类:</h3>
                                <div style="margin-bottom: 30px;">

                                    <select name="fid" id="fid">
                                        <option>请选择</option>
                                        <?=$config_menu?>
                                    </select>
                                </div>
                                <div name="content" id="content"   type="text/plain" style="width:700px;height:500px;">
                                    <?=html_entity_decode($post['content'])?>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include BBS_PATH.'views/web/common/editor.php'?>
</body>
<?php }?>
</html>