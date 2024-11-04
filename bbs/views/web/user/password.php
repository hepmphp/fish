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
<?php include BBS_PATH.'views/web/common/header.php'?>

<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tabbable">
                        <ul class="nav nav-tabs aw-nav-tabs active">
                            <h2><i class="icon icon-setting"></i> 用户设置-修改密码</h2>
                        </ul>
                    </div>

                    <div class="tab-content clearfix">
                        <div class="aw-mod">
                            <div class="mod-body">
                                <div class="aw-mod aw-user-setting-bind">
                                    <div class="mod-head">

                                    </div>
                                    <form class="form-horizontal" action="http://127.0.0.1:1111/wecenter/?/account/ajax/modify_password/" method="post" id="setting_form">
                                        <div class="mod-body">
                                            <div class="form-group" style="margin-left: 60px">
                                                <label class="control-label" for="input-password-old">当前密码</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="password" class="form-control" id="input-password-old" name="old_password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-left: 60px">
                                                <label class="control-label" for="input-password-new">新的密码</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="password" class="form-control" id="input-password-new" name="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-left: 60px">
                                                <label class="control-label" for="input-password-re-new">确认密码</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="password" class="form-control" id="input-password-re-new" name="re_password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mod-footer clearfix">
                                <a href="javascript:;" class="btn btn-large btn-success pull-right" style=" margin-right: 900px;">保存</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>