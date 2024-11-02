<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>中华人民共和国国防部</title>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/styles.css'>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/detail.css'>
</head>
<?php include CMS_PATH.'views/cms/common/header.php';?>
<div class="container_list m-t">
    <!--原侧边栏已删除-->
    <div class="content">
        <ol class="">
            <!--当前位置-->
            <a href="http://www.mod.gov.cn/gfbw/wzll/index.html" target="_blank">武装力量</a>
            <font class="">/</font>正文
        </ol>
        <hr class="m-n">
        <div class="article-header">
            <h3></h3>
            <h1><?=$data['title']?></h1>
            <h3></h3>
            <div class="info">
                <span>来源：解放军报</span>
                <span>作者：苗鹏超 吴安宁</span> <span>责任编辑：刘上靖</span>
                <span><?=date("Y-m-d H:i:s",$data['addtime'])?></span>
            </div>
        </div>
        <div id="article_content">
            <div id="content">
               <?=$data['content']?>
            </div>
        </div>
    </div>
    <!--原侧边栏已删除-->

</div>
</html>