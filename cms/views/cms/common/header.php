<!--HEADE-->
<div class="header">
    <div class="container">
        <div class="header-box">
            <div class="row">
                <div class="col-md-6-12">
                    <div class="brand">
                        <img src="<?=STATIC_URL?>/image/logo.png" class="n" alt="国防部网中文版">
                        <img src="<?=STATIC_URL?>/image/logo-i.png" class="i" alt="国防部网中文版">
                    </div>
                </div>
            </div>
        </div>
    </div></div>

<!--NAVIGATION-->

<div class="navbar">
    <div class="container">
        <div class="nav-box clearfix">
            <ul class="navbar-nav hidden-md-down">
                <li class="47101 active">
                    <!--首页 新 214023-->
                    <a href="#">
                        首页
                    </a>
                </li>

                <?php foreach ($menu_data as $K=>$d){ ?>
                    <li>
                        <!--权威发布新214031-->
                        <a href="/cms.php?g=web&m=catelist&a=index&id=<?=$d['id']?>" target="_blank">
                            <?=$d['name']?>
                        </a>
                        <!-- 权威发布子菜单-->
                        <ul class="dropdown-menu">
                            <?php foreach ($menu_children as $k1=>$child){
                                if($child['parentid']==$d['id']){
                                    ?>
                                    <li>
                                        <!-- 军委办公厅 新214033-->
                                        <a href="/cms.php?g=web&m=list&a=index&id=<?=$child['id']?>"  target="_blank">
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
