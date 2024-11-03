<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>网站</title>
    <link rel="stylesheet" href='<?=STATIC_URL?>css/styles.css'>
    <link rel="stylesheet" href='<?=STATIC_URL?>css/list.css'>
    <link rel="stylesheet" href='<?=STATIC_URL?>css/page.css'>
    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script src="<?=STATIC_URL?>js/page.js"></script>

</head>
<body>
<?php include CMS_PATH.'views/cms/common/header.php';?>

<div class="container_list m-t ">
    <div class="main-section">
        <p class="position">
            <!--当前位置-->
            <!--begin 863023-0-5-->
            <!--end 863023-0-5-->
            <a href="<?=\cms\helpers\Uri::list_href($data['list'][0]['cate_id'])?>" class=""><?=$data['list'][0]['cate_name']?>></a>
            列表
        </p>
        <ul class="list-unstyled article-list" id="main-news-list">
            <?php foreach ($data['list'] as $k=>$v){?>
            <li>
                <a href="<?=\cms\helpers\Uri::detail_href($v['id'])?>">
                    <h3>
                        <p class="title">
                            <?=($k+1)?>. <?=$v['title']?>
                        </p>
                        <small class="time"><?=$v['addtime_name']?></small>
                    </h3>

                </a>
            </li>
            <?php }?>
        </ul>

    </div>

</div>
<div class="container">
    <?=\helpers\PageWidget::run()?>
</div>
<script>
    $('.pagination-outline').html(multi(<?=$data['total']?>, <?=$data['per_page']?>,  <?=$data['page']?>, 100));
</script>
<?php include CMS_PATH.'views/cms/common/footer.php';?>
</body>
</html>