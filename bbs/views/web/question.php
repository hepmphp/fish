<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <title>发现 - WeCenter</title>
    <meta name="keywords" content="WeCenter,知识社区,社交社区,问答社区"/>
    <meta name="description" content="WeCenter 社交化知识社区"/>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css"/>
    <link href="<?=STATIC_URL?>css/sidebar.css" rel="stylesheet" type="text/css" />
    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>

</head>
<body>
<?php include BBS_PATH.'views/web/common/header.php'?>
<?php include BBS_PATH.'views/web/common/sidebar.php'?>
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content">
                    <!-- 话题推荐bar -->
                    <!-- 话题推荐bar -->
                    <!-- 话题bar -->
                    <div class="aw-mod aw-topic-bar" id="question_topic_editor" data-type="question" data-id="2">
                        <div class="tag-bar clearfix">
														<span class="topic-tag" data-id="5">
								<a href="http://127.0.0.1:1111/wecenter/?/topic/%E7%BC%96%E7%A8%8B" class="text">编程</a>
							</span>

                        </div>
                    </div>
                    <!-- end 话题bar -->
                    <div class="aw-mod aw-question-detail aw-item">
                        <div class="mod-head">
                            <h1>
                                <?=$post['subject']?> </h1>
                            <div id="threadstamp"><img src="<?=STATIC_URL?>image/stamp/001.gif" title="置顶"></div>
                            <div class="operate clearfix">

                            </div>
                        </div>
                        <div class="mod-body">
                            <div class="content markitup-box">
                               <?=$post['content']?>
                            </div>
                        </div>
                        <div class="mod-footer">
                            <div class="meta">
                                <span class="text-color-999"><?=date('Y-m-d h:i:s',$post['created_time'])?></span>
                                <a class="text-color-999" href="http://127.0.0.1:1111/wecenter/?/publish/2"><i
                                        class="icon icon-edit"></i>编辑</a>
                                <div class="pull-right more-operate">
                                </div>
                            </div>
                        </div>
                        <!-- 站内邀请 -->
                        <div class="aw-invite-box collapse">
                            <div class="mod-head clearfix">
                                <div class="search-box pull-left">
                                    <input id="invite-input" class="form-control" type="text" placeholder="搜索你想邀请的人...">
                                    <div class="aw-dropdown">
                                        <p class="title">没有找到相关结果</p>
                                        <ul class="aw-dropdown-list"></ul>
                                    </div>
                                    <i class="icon icon-search"></i>
                                </div>
                                <div class="invite-list pull-left collapse">
                                    已邀请:
                                </div>
                            </div>
                        </div>
                        <!-- end 站内邀请 -->
                        <!-- 相关链接 -->
                        <div class="aw-question-related-box collapse">
                            <form action="http://127.0.0.1:1111/wecenter/?/publish/ajax/save_related_link/"
                                  method="post" onsubmit="return false" id="related_link_form">
                                <div class="mod-head">
                                    <h2>与内容相关的链接</h2>
                                </div>
                                <div class="mod-body clearfix">
                                    <input type="hidden" name="item_id" value="2">
                                    <input type="text" class="form-control pull-left" name="link" value="">

                                    <a onclick="AWS.ajax_post($('#related_link_form'));"
                                       class="pull-left btn btn-success">提交</a>
                                </div>
                            </form>
                        </div>
                        <!-- end 相关链接 -->
                    </div>

                    <div class="aw-mod aw-question-comment">
                        <div class="mod-head">
                            <ul class="nav nav-tabs aw-nav-tabs active">
                                <h2 class="hidden-xs">2 个回复</h2>
                            </ul>
                        </div>
                        <div class="mod-body aw-feed-list">
                            <div class="aw-item" uninterested_count="0" force_fold="0" id="answer_list_1">
                                <div class="mod-head">
                                    <!-- 最佳回答 -->
                                    <div class="aw-best-answer">
                                        <i class="icon icon-bestbg"></i>
                                    </div>
                                    <!-- end 最佳回答 -->
                                    <a class="anchor" name="answer_1"></a>
                                    <!-- 用户头像 -->
                                    <a class="aw-user-img aw-border-radius-5"
                                       href="http://127.0.0.1:1111/wecenter/?/people/admin" data-id="1"><img
                                            src="<?=STATIC_URL?>image/avator/10001.jpg"
                                            alt=""></a>                                        <!-- end 用户头像 -->
                                    <div class="title">
                                        <p>
                                            <a class="aw-user-name" href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                               data-id="1">admin</a>
                                            - <span class="text-color-999">国宝熊猫</span></p>
                                        <p class="text-color-999 aw-agree-by collapse">
                                            赞同来自:

                                        </p>
                                    </div>
                                </div>
                                <div class="mod-body clearfix">
                                    <!-- 评论内容 -->
                                    <div class="markitup-box">
                                        你好 很好
                                    </div>


                                    <!-- end 评论内容 -->
                                </div>
                                <div class="mod-footer">
                                    <!-- 社交操作 -->
                                    <div class="meta clearfix">
                                        <span class="text-color-999 pull-right">2024-10-15</span>
                                        <!-- 投票栏 -->
                                        <span class="operate">

                                        <!-- end 投票栏 -->
                                        <span class="operate">
												<a class="aw-add-comment" data-id="1" data-type="answer"
                                                   data-comment-count="3" data-first-click="" href="javascript:;"><i
                                                        class="icon icon-comment"></i> 3</a>
											</span>

                                    </div>
                                    <!-- end 社交操作 -->
                                    <div class="aw-comment-box" id="aw-comment-box-answer-1" style="display: none;">
                                        <div class="aw-comment-list">
                                            <ul>
                                                <li>
                                                    <a class="aw-user-name"
                                                       href="http://127.0.0.1:1111/wecenter/?/people/admin" data-id="1"><img
                                                            src="http://127.0.0.1:1111/wecenter/static/common/avatar-min-img.png"
                                                            alt=""></a>

                                                    <div>
                                                        <p class="clearfix">
							<span class="pull-right">
					<a href="javascript:;" onclick="AWS.User.remove_comment($(this).parent(), 'answer', 1);">删除</a> &nbsp;					<a
                                    href="javascript:;"
                                    onclick="$(this).parents('.aw-comment-box').find('form textarea').insertAtCaret('@admin:');$(this).parents('.aw-comment-box').find('form').show().find('textarea').focus();$.scrollTo($(this).parents('.aw-comment-box').find('form'), 300, {queue:true});">回复</a>				</span>

                                                            <a href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                               class="aw-user-name author" data-id="1">admin</a> •
                                                            <span>47 秒前</span>
                                                        </p>

                                                        <p class="clearfix">
                                                            杂事最多，什么都要会，甚至有些公司网络，服务器，甚至helpdesk都要你一个人搞，离谱的还要干行政的活。出了问题测试甩锅，开发甩锅，用户甩锅。工资涨幅比较慢，三年五年的运维和七年八年的运维工资区别不大，和开发一样，很多工资也用不到多么高端的运维技术，你最多的活就是部署个东西，重装个服务器，电脑，搞搞交换机啥玩意的。工作强度看情况，闲的时候可能很闲，忙的时候可能会忙死。运维这个活典型的面试造火箭，工作拧螺丝。很多东西不要求你多精通，但是你必须懂，不然开发能把你忽悠瘸了。职业寿命比开发要长点，但是其实硬说也长不了哪去。大部分公司招人还是要求35岁一下。运维的工资在一段时间内会有一个瓶颈，比如你今年拿一万，两年三年后可能还是拿一万，突破口很不好找。一个是运维很多时候都是在干杂货，对于个人提升真的挺有限的，这个需要靠你的自制力自学一些东西，不然的话技术水平停滞不前也很危险</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="aw-user-name"
                                                       href="http://127.0.0.1:1111/wecenter/?/people/admin" data-id="1"><img
                                                            src="http://127.0.0.1:1111/wecenter/static/common/avatar-min-img.png"
                                                            alt=""></a>

                                                    <div>
                                                        <p class="clearfix">
							<span class="pull-right">
					<a href="javascript:;" onclick="AWS.User.remove_comment($(this).parent(), 'answer', 2);">删除</a> &nbsp;					<a
                                    href="javascript:;"
                                    onclick="$(this).parents('.aw-comment-box').find('form textarea').insertAtCaret('@admin:');$(this).parents('.aw-comment-box').find('form').show().find('textarea').focus();$.scrollTo($(this).parents('.aw-comment-box').find('form'), 300, {queue:true});">回复</a>				</span>

                                                            <a href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                               class="aw-user-name author" data-id="1">admin</a> •
                                                            <span>26 秒前</span>
                                                        </p>

                                                        <p class="clearfix"><a
                                                                href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                                class="aw-user-name" data-id="1">@admin</a>:杂事最多，什么都要会，甚至有些公司网络，服务器，甚至helpdesk都要你一个人搞，离谱的还要干行政的活。出了问题测试甩锅，开发甩锅，用户甩锅。工资涨幅比较慢，三年五年的运维和七年八年的运维工资区别不大，和开发一样，很多工资也用不到多么高端的运维技术，你最多的活就是部署个东西，重装个服务器，电脑，搞搞交换机啥玩意的。工作强度看情况，闲的时候可能很闲，忙的时候可能会忙死。运维这个活典型的面试造火箭，工作拧螺丝。很多东西不要求你多精通，但是你必须懂，不然开发能把你忽悠瘸了。职业寿
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="aw-user-name"
                                                       href="http://127.0.0.1:1111/wecenter/?/people/admin" data-id="1"><img
                                                            src="http://127.0.0.1:1111/wecenter/static/common/avatar-min-img.png"
                                                            alt=""></a>

                                                    <div>
                                                        <p class="clearfix">
							<span class="pull-right">
					<a href="javascript:;" onclick="AWS.User.remove_comment($(this).parent(), 'answer', 3);">删除</a> &nbsp;					<a
                                    href="javascript:;"
                                    onclick="$(this).parents('.aw-comment-box').find('form textarea').insertAtCaret('@admin:');$(this).parents('.aw-comment-box').find('form').show().find('textarea').focus();$.scrollTo($(this).parents('.aw-comment-box').find('form'), 300, {queue:true});">回复</a>				</span>

                                                            <a href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                               class="aw-user-name author" data-id="1">admin</a> •
                                                            <span>15 秒前</span>
                                                        </p>

                                                        <p class="clearfix"><a
                                                                href="http://127.0.0.1:1111/wecenter/?/people/admin"
                                                                class="aw-user-name" data-id="1">@admin</a>:杂事最多，什么都要会，甚至有些公司网络，服务器，甚至helpdesk都要你一个人搞，离谱的还要干行政的活。出了问题测试甩锅，开发甩锅，用户甩锅。工资涨幅比较慢，三年五年的运维和七年八年的运维工资区别不大，和开发一样，很多工资也用不到多么高端的运维技术，你最多的活就是部署个东西，重装个服务器，电脑，搞搞交换机啥玩意的。工作强度看情况，闲的时候可能很闲，忙的时候可能会忙死。运维这个活典型的面试造火箭，工作拧螺丝。很多东西不要求你多精通，但是你必须懂，不然开发能把你忽悠瘸了。职业寿
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <form action="http://127.0.0.1:1111/wecenter/?/question/ajax/save_answer_comment/answer_id-1"
                                              method="post" onsubmit="return false">
                                            <div class="aw-comment-box-main"><textarea
                                                    class="aw-comment-txt form-control" rows="2" name="message"
                                                    placeholder="评论一下..."
                                                    style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 34px;"></textarea>
                                                <div class="aw-comment-box-btn"><span class="pull-right"><a
                                                            href="javascript:;" class="btn btn-mini btn-success"
                                                            onclick="AWS.User.save_comment($(this));">评论</a><a
                                                            href="javascript:;"
                                                            class="btn btn-mini btn-gray close-comment-box">取消</a></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="aw-item" uninterested_count="0" force_fold="0" id="answer_list_2">
                                <div class="mod-head">
                                    <a class="anchor" name="answer_2"></a>
                                    <!-- 用户头像 -->
                                    <a class="aw-user-img aw-border-radius-5" href="javascript:;"><img
                                            src="http://127.0.0.1:1111/wecenter/static/common/avatar-mid-img.png"
                                            alt="匿名用户"></a>                                        <!-- end 用户头像 -->
                                    <div class="title">
                                        <p>
                                            <a class="aw-user-name" href="javascript:;">匿名用户</a>
                                        </p>
                                        <p class="text-color-999 aw-agree-by collapse">
                                            赞同来自:

                                        </p>
                                    </div>
                                </div>
                                <div class="mod-body clearfix">
                                    <!-- 评论内容 -->
                                    <div class="markitup-box">
                                        非常好
                                    </div>


                                    <!-- end 评论内容 -->
                                </div>
                                <div class="mod-footer">
                                    <!-- 社交操作 -->
                                    <div class="meta clearfix">
                                        <span class="text-color-999 pull-right">1 分钟前</span>
                                        <!-- end 投票栏 -->
                                        <span class="operate">
												<a class="aw-add-comment" data-id="2" data-type="answer"
                                                   data-comment-count="0" data-first-click="collapse"
                                                   href="javascript:;"><i class="icon icon-comment"></i> 0</a>
											</span>
                                        <!-- 可显示/隐藏的操作box -->
                                        <div class="more-operate" style="display: block;">
                                            <a class="" href="javascript:;" style="display:block;"><i
                                                    class="icon icon-edit"></i> 编辑</a>
                                        </div>
                                        <!-- end 可显示/隐藏的操作box -->

                                    </div>
                                    <!-- end 社交操作 -->
                                </div>
                            </div>
                        </div>
                        <div class="mod-footer">
                            <div class="aw-load-more-content collapse" id="load_uninterested_answers">
                                <span class="text-color-999 aw-alert-box text-color-999" href="javascript:;"
                                      tabindex="-1" onclick="AWS.alert('被折叠的回复是被你或者被大多数用户认为没有帮助的回复');">为什么被折叠?</span>
                                <a href="javascript:;" class="aw-load-more-content"><span
                                        class="hide_answers_count">0</span> 个回复被折叠</a>
                            </div>

                            <div class="collapse aw-feed-list" id="uninterested_answers_list"></div>
                        </div>

                    </div>
                    <!-- end 问题详细模块 -->

                    <!-- 回复编辑器 -->
                    <div class="aw-mod aw-replay-box question">
                        <a name="answer_form"></a>
                        <form action="http://127.0.0.1:1111/wecenter/?/question/ajax/save_answer/"
                              onsubmit="return false;" method="post" id="answer_form" class="question_answer_form">
                            <input type="hidden" name="post_hash" value="4cba482680a02ca38e238d4307b57502">
                            <input type="hidden" name="question_id" value="2">
                            <input type="hidden" name="attach_access_key" value="d96890a6163f996b647dd46e3a438e91">
                            <div class="mod-head">
                                <a href="http://127.0.0.1:1111/wecenter/?/people/" class="aw-user-name"><img alt="admin"
                                                                                                             src="http://127.0.0.1:1111/wecenter/static/common/avatar-mid-img.png"></a>
                                <p>
                                    <label class="pull-right">
                                    </label>
                                    admin </p>
                            </div>
                            <div class="mod-body">
                                <div class="aw-mod aw-editor-box">
                                    <script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
                                    <div class="mod-head" style="border: none;">
                                        <div class="wmd-panel">
                                        </div>
                                    </div>
                                    <div class="mod-body clearfix">
                                        <a href="javascript:;"
                                           style="margin-right: 70px;"
                                           class="btn btn-normal btn-success pull-right btn-reply">回复</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- end 回复编辑器 -->
                </div>

            </div>
        </div>
    </div>
</div>


</body>
<?php include BBS_PATH.'views/web/common/up_to_top.php'?>
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/ueditor.all.min.js"></script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?=STATIC_URL?>js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
<?php include BBS_PATH.'views/web/common/footer.php'?>
</html>