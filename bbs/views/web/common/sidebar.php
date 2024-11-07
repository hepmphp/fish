<?php if(!\app\helpers\Input::is_mobile()){?>
<link href="<?=STATIC_URL?>css/sidebar.css" rel="stylesheet" type="text/css" />
<style>
    .fixed_top_1{
        position: fixed;
        top: 0px;
        left: 20px;
        margin-top:15px;
        width: 300px;
        height: 30px;
        z-index: 99999;
        border-radius: 2%;
        overflow: hidden;
    }
</style>
<div class="fixed_top_1">
    <h3 class="aside-title;">
        <!-- 增加某种语言切换的按钮。注意 ul上加了一个 class="ignore" 代表这块代码不会被翻译到 -->
        <ul class="ignore" style="float: left;list-style: none;clear:both;">
            <li style="float: left;"><a href="javascript:translate.changeLanguage('english');" style="color: #ffffff;">English</a>&nbsp;&nbsp;</li>
            <li style="float: left;"><a href="javascript:translate.changeLanguage('chinese_traditional');" style="color: #ffffff;">繁體中文</a>&nbsp;&nbsp;</li>
            <li style="float: left;"><a href="javascript:translate.changeLanguage('chinese_simplified');" style="color: #ffffff;">简体中文</a></li>
        </ul>
    </h3>
</div>
<div class="fixed_top">
    <div>
        <h3 class="aside-title">论坛分类</h3>
    </div>
    <div id="forum_list" >
        <ul>
            <?php foreach ($forum_list as $k=>$list){?>
            <li><a href="<?=\bbs\helpers\Uri::bbs_list_index_href($list['id'])?>" class="icon icon-topic"><?=($k+1)?> <?=$list['name']?></a> </li>
            <?php }?>
        </ul>
    </div>

</div>

<?php }?>