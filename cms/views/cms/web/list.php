<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>中华人民共和国国防部</title>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/styles.css?v=1.0.9'>
    <link rel="stylesheet" href='<?=STATIC_URL?>/css/list.css'>
</head>
<body>
<?php include CMS_PATH.'views/cms/common/header.php';?>

<div class="container_list m-t">
    <div class="main-section">
        <p class="position">
            <!--当前位置-->
            <!--begin 863023-0-5-->
            <!--end 863023-0-5-->
            <a href=" http://www.mod.gov.cn/gfbw/jsxd/index.html" target="_blank" class="">军事行动</a><font class="">/</font>
            <a href=" http://www.mod.gov.cn/gfbw/jsxd/fk/index.html" target="_blank" class="">反恐</a><font class="">/</font>
            列表
        </p>
        <ul class="list-unstyled article-list" id="main-news-list">
            <?php foreach ($data['list'] as $k=>$v){?>
            <li>
                <a href="/cms.php?g=web&m=detail&a=index&id=<?=$v['id']?>">
                    <h3>
                        <p class="title">
                            <?=$v['title']?>
                        </p>
                        <small class="time hidden-xs"><?=$v['addtime_name']?></small>
                    </h3>

                </a>
            </li>
            <?php }?>
            <div id="displaypagenum" class="more-page" style="text-align:center"><a href="index.html">首页</a><span class="page">1</span><a href="index_2.html">2</a><a href="index_2.html">下一页</a><a class="next" href="index_2.html">尾页</a></div>
        </ul>
    </div>

</div>
</body>
</html>