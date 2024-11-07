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
</head>
<body>
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tab-content clearfix" style="height: 300px;">
                        <div class="aw-mod">
                            <div class="mod-body" style="width: 400px;margin-left: 30px;">
                                <input type="hidden" name="id" id="id" value="<?=$form['id']?>">
                                <div class="aw-mod aw-user-setting-bind">
                                    <div class="mod-body">

                                        <select id="parentid" name="parentid" style="font-size: 25px;width: 300px;margin-top: 30px;">
                                            <option value="0">请选择</option>
                                            <?=$config_menu?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mod-body" style="width: 400px;margin-left: 30px;margin-top: 30px;">
                                <div class="aw-mod aw-user-setting-bind">
                                    <div class="mod-body">
                                        <input  type="text" id="name" name="name" value="<?=$form['name']?>" placeholder="分类名称" style="width: 300px;font-size: 25px;">
                                    </div>
                                </div>
                            </div>
                            <?php include BBS_PATH.'views/web/common/upload.php'?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>