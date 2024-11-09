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
                        <div class="mod-body" style="width:150px;margin: 0 auto;">
                            <?php if(empty($forum_data['name'])){?>
                            <h2 class="pull-left">论坛</h2>
                            <?php }else{?>
                            <img class="" src="<?=\bbs\helpers\SiteUrl::get_image_url($forum_data['logo'])?>" style="width: 80px;height: 80px;">
                            <h2 class="pull-left"><?=$forum_data['name']?></h2>
                            <?php }?>
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
                                                       href="<?=\bbs\helpers\Uri::user_bbslist_href($v['user_id'])?>"
                                                       rel="nofollow">
                                                        <img
                                                                src="<?=\bbs\helpers\SiteUrl::get_avator_url($v['avator'])?>"
                                                                alt=""></a>
                                                    <?php if(!empty($v['stamp'])){?>
                                                        <div id="" style="float: right;"><img src="<?=\bbs\helpers\SiteUrl::get_stamp_url($v['stamp'])?>"></div>
                                                    <?php }?>
                                                    <div class="aw-question-content">
                                                        <h4>
                                                            <a href="<?=\bbs\helpers\Uri::detail_href($v['id'])?>"><?=$v['subject']?></a>
                                                        </h4>
                                                        <span>
                                                            <?=date('Y-m-d H:i:s',$v['created_time'])?>
                                                        </span>
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
                    <?=\bbs\helpers\PageWidget::run()?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include BBS_PATH . 'views/web/common/up_to_top.php' ?>
<?php include BBS_PATH . 'views/web/common/auto_index.php' ?>
<?php include BBS_PATH.'views/web/common/footer.php'?>
<script>
    $('.pagination-outline').html(multi(<?=$data['total']?>, <?=$data['per_page']?>,  <?=$data['page']?>, 100));
    function ajax_list(param_data){
        window.location.href = "<?=\bbs\helpers\Uri::bbs_list_index_href($_GET['id'])?>&"+$.param(param_data);
    }
</script>
</body>
</html>