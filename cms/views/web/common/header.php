<!--HEADE-->
<style>
    .logo {
        width: 650px;
        margin: auto;
        padding-top: 60px;
    }
    .top_bg {
        height: 250px;
        background: url("<?=STATIC_URL?>image/top_bg.png") no-repeat center;
        background-color: transparent;
        background-size: 100% 100%;

    }

</style>
<div class="header">
    <div class="container-header">
        <div class="header-box">
            <!-- 增加某种语言切换的按钮。注意 ul上加了一个 class="ignore" 代表这块代码不会被翻译到 -->
            <ul class="ignore" style="float: right;list-style: none;margin-bottom: 50px;z-index: 10000">
                <li style="float: left;"><a href="javascript:translate.changeLanguage('english');">English</a>|</li>
                <li style="float: left;"><a href="javascript:translate.changeLanguage('chinese_traditional');">繁體中文</a>|</li>
                <li style="float: left;"><a href="javascript:translate.changeLanguage('chinese_simplified');">简体中文</a>|</li>
            </ul>
                <div class="top_bg" style="height: 168px;">
                    <div class="logo" style="padding-top: 36px;">
                        <img src="<?=STATIC_URL?>image/top-logo.png" alt="" tabindex="0" aria-label="">
                    </div>
                </div>
        </div>
    </div>

</div>

<!--NAVIGATION-->

<div class="navbar">
    <div class="container">
        <div class="nav-box clearfix">
            <ul class="navbar-nav hidden-md-down">
                <li class="47101">
                    <!--首页 新 214023-->
                    <a href="/cms.php">
                        首页
                    </a>
                </li>

                <?php foreach ($menu_data as $K=>$d){ ?>
                    <li>
                        <!--权威发布新214031-->
                        <a href="<?=\cms\helpers\Uri::list_href($d['id'])?>" target="_blank">
                            <?=$d['name']?>
                        </a>
                        <!-- 权威发布子菜单-->
                        <ul class="dropdown-menu">
                            <?php foreach ($menu_children as $k1=>$child){
                                if($child['parentid']==$d['id']){
                                    ?>
                                    <li>
                                        <!-- 军委办公厅 新214033-->
                                        <a href="<?=\cms\helpers\Uri::list_href($child['id'])?>"  target="_blank">
                                            <?=$child['name']?>
                                        </a>
                                    </li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </li>
                <?php }?>

            </ul>
        </div>
    </div>
</div>
