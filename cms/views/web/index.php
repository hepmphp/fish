
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>网站</title>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/styles.css'>
</head>
<body>
<?php include CMS_PATH.'views/web/common/header.php';?>
<?php include CMS_PATH.'views/web/common/banner.php';?>

<div class="container" style="margin-top: 30px;">
    <div class="cm-tab">
        <div class="tab-hd">
            <ul>
                <li class="active">
                    <a href="<?=\cms\helpers\Uri::list_href(2)?>" target="_blank">
                        权威发布
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-bd">
            <ul class="top-news-list init">
                <?php foreach ($data1 as $k=>$v1){?>
                <li><a href="<?=\cms\helpers\Uri::detail_href($v1['id'])?>" target="_blank">
                        <?=($k+1).".".$v1['title']?> <span>(<?=date("Y-m-d H:i:s",$v1['addtime'])?>)</span></a>   </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>

<div class="container m-t-lg">
    <div class="row">
        <?php  foreach ($list_format as $k=>$v){?>
        <div class="col-md-4-12 clearfix" style="min-height: 500px; ">
            <div class="cm-tab">
                <div class="tab-hd">
                    <ul>
                        <li class="active">
                            <a href="<?=\cms\helpers\Uri::list_href($v[0]['cate_id'])?>" target="_blank">
                                <?=$v[0]['cate_name']?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-bd">
                    <div class="tab-item active">
                        <ul class="news-list">
                            <?php foreach ($v as $k1=>$v1){?>
                                <li><a href="<?=\cms\helpers\Uri::detail_href($v1['id'])?>" title="<?=$v1['title']?>" target="_blank"><?=($k1+1).'. '.mb_substr($v1['title'],0,23)."..."?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<?php include CMS_PATH.'views/web/common/footer.php';?>
</body>
</html>
