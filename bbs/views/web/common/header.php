<script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
<div class="aw-top-menu-wrap">
    <div class="container">
        <!-- logo -->
        <div class="aw-logo hidden-xs">
            <a href="http://127.0.0.1:1111/wecenter"></a>
        </div>
        <!-- end logo -->
        <!-- 搜索框 -->
        <div class="aw-search-box  hidden-xs hidden-sm" style="display: none;">
            <form class="navbar-search" action="http://127.0.0.1:1111/wecenter/?/search/" id="global_search_form" method="post">
                <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="q" id="aw-search-query">
                <span title="搜索" id="global_search_btns" onclick="$('#global_search_form').submit();"><i class="icon icon-search"></i></span>
                <div class="aw-dropdown">
                    <div class="mod-body">
                        <p class="title">输入关键字进行搜索</p>
                        <ul class="aw-dropdown-list collapse"></ul>
                        <p class="search"><span>搜索:</span><a onclick="$('#global_search_form').submit();"></a></p>
                    </div>
                    <div class="mod-footer">
                        <a href="javascript:;" onclick="$('#header_publish').click();" class="pull-right btn btn-mini btn-success publish">发起问题</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- end 搜索框 -->
        <!-- 导航 -->
        <div class="aw-top-nav navbar">
            <div class="navbar-header">
                <button class="navbar-toggle pull-left">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/bbs.php"><i class="icon icon-home"></i> 动态</a></li>
                    <li><a href="<?=\bbs\helpers\Uri::list_href(0)?>"><i class="icon icon-topic"></i> 话题</a></li>
                    <li><a href="/bbs.php/web/user/register" class="active"><i class="icon icon-list"></i>注册</a></li>
<!--                    <li>-->
<!--                        <a href="http://127.0.0.1:1111/wecenter/?/notifications/" class=""><i class="icon icon-bell"></i> 通知</a>-->
<!--                        <span class="badge badge-important" style="display:none" id="notifications_unread">0</span>-->
<!--                        <div class="aw-dropdown pull-right hidden-xs">-->
<!--                            <div class="mod-body">-->
<!--                                <ul id="header_notification_list"><p class="aw-padding10" align="center">没有未读通知</p></ul>-->
<!--                            </div>-->
<!--                            <div class="mod-footer">-->
<!--                                <a href="http://127.0.0.1:1111/wecenter/?/notifications/">查看全部</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a style="font-weight:bold;">· · ·</a>-->
<!--                        <div class="dropdown-list pull-right">-->
<!--                            <ul id="extensions-nav-list">-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
            </nav>
        </div>
        <!-- end 导航 -->
        <!-- 用户栏 -->
        <div class="aw-user-nav">
            <!-- 登陆&注册栏 -->
            <a href="http://127.0.0.1:1111/wecenter/?/people/admin" class="aw-user-nav-dropdown">
                <img alt="admin" src="<?=STATIC_URL?>image/avator/<?=$bbs_user['avator']?>">

            </a>
            <div class="aw-dropdown dropdown-list pull-right">
                <ul class="aw-dropdown-list">
                    <li><a href="/bbs.php/web/bbslist/create"><i class="icon icon-inbox"></i> 私信<span class="badge badge-important collapse" id="inbox_unread" style="display: none;">0</span></a></li>
                    <li class="hidden-xs"><a href="/bbs.php/web/user/info"><i class="icon icon-setting"></i> 修改头像</a></li>
                    <li class="hidden-xs"><a href="/bbs.php/web/user/password"><i class="icon icon-job"></i> 修改密码</a></li>
                    <li><a href="/bbs.php/web/user/logout"><i class="icon icon-logout" id="logout"></i> 退出</a></li>
                </ul>
            </div>
            <!-- end 登陆&注册栏 -->
        </div>
        <!-- end 用户栏 -->
        <!-- 发起 -->
        <div class="aw-publish-btn">

            <a id="header_publish" class="btn-primary" href="#"><i class="icon icon-ask"></i>发起</a>
            <div class="dropdown-list pull-right">
                <ul>
                    <li>
                        <form method="post" action="http://127.0.0.1:1111/wecenter/?/publish/">
                            <a href="<?=\bbs\helpers\Uri::ask_href('')?>">问题</a>
                        </form>

                    </li>
                    <li>
                        <form method="post" action="#">
                            <a  href="/bbs.php/web/question/index">文章</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end 发起 -->

    </div>
</div>
<script>
    $('#logout').click(function () {
        $.ajax({
            type: 'POST',
            url: '/bbs.php/web/user/logout',
            data: {},
            dataType: 'json',
            success: function (data) {
                if (data.status == 0) {
                    layer.alert(data.msg, {icon: 1}, function () {
                        window.location.href = '/bbs.php/web/user/login';
                    });
                } else {
                    layer.alert(data.msg, {icon: 2}, function () {

                    });
                }
            }
        });
    });
</script>