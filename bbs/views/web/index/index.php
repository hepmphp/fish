<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit" />
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区" />
    <meta name="description" content="WeCenter 社交化知识社区"  />
    <link href="<?=STATIC_URL?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>/css/icon.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>/css/commom.css" rel="stylesheet" type="text/css" />
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
                    <!-- tab切换 -->
                    <ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
                        <h2 class="hidden-xs"><i class="icon icon-topic"></i> 热门话题</h2>
                    </ul>
                    <!-- end tab切换 -->
                    <!-- 我关注的话题 -->
                    <div class="aw-mod aw-topic-list">
                        <div class="mod-body clearfix">
                            <?php foreach ($data['list'] as $k=>$list){?>
                            <div class="aw-item">
                                <!-- 话题图片 -->
                                <a class="img aw-border-radius-5 " href="" data-id="5">
                                    <img class="image_logo" src="<?=\bbs\helpers\SiteUrl::get_image_url($list['logo'])?>" alt="">
                                </a>
                                <!-- end 话题图片 -->
                                <p class="clearfix">
                                    <!-- 话题内容 -->
                                    <span class="topic-tag">
                                        <a class="text" href="<?=\bbs\helpers\Uri::bbs_list_index_href($list['id'])?>" data-id=""><?=$list['name']?></a>
                                    </span>
                                    <!-- end 话题内容 -->
                                </p>
                                <p class="text-color-999">
                                    <span>1 个讨论</span>
                                </p>
                                <p class="text-color-999">
                                    7 天新增 1 个讨论, 30 天新增 1 个讨论
                                </p>
                            </div>
                            <?php }?>

                        </div>
                        <div class="mod-footer clearfix">
                        </div>
                    </div>
                    <!-- end 我关注的话题 -->
                    <div class="container">
                        <?=\bbs\helpers\PageWidget::run()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.pagination-outline').html(multi(<?=$data['total']?>, <?=$data['per_page']?>,  <?=$data['page']?>, 100));
    function ajax_list(param){
        const url_params = new URLSearchParams(window.location.search);
        window.location.href = '/bbs.php/web/index/index?'+$.param(param);
    }
</script>
<?php include BBS_PATH.'views/web/common/up_to_top.php'?>
<?php include BBS_PATH.'views/web/common/footer.php'?>
</body>
</html>