<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>网站</title>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/styles.css'>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/detail.css'>

</head>
<?php include CMS_PATH.'views/web/common/header.php';?>
<div class="container_list m-t">
    <!--原侧边栏已删除-->
    <div class="content">
        <ol class="">
            <!--当前位置-->
            <a href="<?=\cms\helpers\Uri::list_href($data['cate_id'])?>"><?=$data['cate_name']?>></a>/正文
        </ol>
        <hr class="m-n">
        <div class="article-header">
            <h3></h3>
            <h1><?=$data['title']?></h1>
            <h3></h3>
            <div class="info">
                <span>来源：<?=$data['media']?></span>
                <span>作者：<?=$data['author']?></span>
                <span><?=date("Y-m-d H:i:s",$data['addtime'])?></span>
            </div>
        </div>
        <div id="article_content">
            <div id="content">
               <?=htmlspecialchars_decode ($data['content'])?>
            </div>
        </div>
    </div>
    <!--原侧边栏已删除-->
</div>

<?php include CMS_PATH.'views/web/common/footer.php';?>
</html>