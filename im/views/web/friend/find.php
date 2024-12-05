<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>踮脚敲代码-layim查找</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="keywords" content="踮脚敲代码,layim查找" />
    <meta name="description" content="踮脚敲代码,layim查找" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?=STATIC_URL?>layim2/dist/css/layui.css">
    <style>
        body{
            height: auto;
        }
        .search{
            width: 100%;
            height: 50px;
        }
        .ml_10{
            margin-left: 10px;
        }
        .findFriend,.findGroup{
            width: 100px;
            letter-spacing: 6px;
        }
        .recordList{
            padding: 0px;
            min-height: 365px;
        }
        .recordList .demo-list .layui-card{
            height:100px;
        }
        .avatar{
            width: 100px;
            float: left;
        }
        .avatar img{
            border-radius: 50%;
            width: 60px;
            height: 60px;
            margin: 20px;
        }
        .units{
            float: left;
            font-size: 12px;
            line-height: 20px;
            padding-top: 16px;
        }
        .line {
            padding: 0 10px;
            color: #ccc;
        }
        .icons{
            font-size: 12px;
            color: #888;
        }
        .addFriend{
            background-color: #7ADDD4;
        }
        .friendList{
            margin-top: -40px;
        }
    </style>
</head>

<body>
<div class="layui-card" style="margin-bottom:0px;">
    <div class="layui-tab layui-tab-brief layadmin-latestData">
        <ul class="layui-tab-title">
            <li class="layui-this">找人</li>
            <li>群聊</li>
        </ul>
        <div class="layui-tab-content" style="padding-bottom:0px;">
            <div class="layui-tab-item layui-show">
                <div class="layui-row layui-col-space15">
                    <div class="layui-form">
                        <div class="search">
                            <div class="layui-col-md4">
                                <input type="text" id="search_filed" placeholder="请输入姓名或手机号搜索" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-col-md4 ml_10">
                                <select id="roleId" lay-verify="required" lay-filter="aihao">
                                    <option value="">请选择职位</option>
                                    <option value="1">超级管理员</option>
                                    <option value="2">项目经理</option>
                                    <option value="3">客服</option>
                                </select>
                            </div>
                            <div class="layui-col-md2" style="margin-left:10px;">
                                <button class="findFriend layui-btn">查找</button>
                            </div>
                        </div>
                        <div class="recordList">
                            <div id="friendList" class="layui-row layui-col-space10 demo-list"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-tab-item">
                <div class="layui-row layui-col-space15">
                    <div class="layui-form">
                        <div class="search">
                            <div class="layui-col-md4">
                                <input type="text" id="search_filed_group" placeholder="请输入群名称搜索" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-col-md2 ml_10">
                                <button class="findGroup layui-btn">查找</button>
                            </div>
                        </div>
                        <div class="recordList">
                            <div id="groupList" class="layui-row layui-col-space10 demo-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<textarea title="用户模版" id="LAY_Friend" style="display:none;">
			{{# layui.each(d.data, function(index, item){ }}
				<div class="layui-col-sm4 layui-col-md4 layui-col-lg2">
			        <div class="layui-card" >
			        	<div class="avatar">
			          		<img class="layadmin-homepage-pad-img" src="{{ item.avatar }}" />
			        	</div>
			        	<div class="units">
				        	<p>{{ item.userName }}({{ item.userCode }})</p>
				        	<p>{{ item.roleNames }}</p>
				        	<p>
					        	{{# if(item.isValid == 0){ }}
					        		<button userId="{{ item.userId }}" userName="{{ item.userName }}"   class="addFriend layui-btn layui-btn-xs" style="background-color:#7ADDD4;">&nbsp;&nbsp;<strong>+</strong>&nbsp;&nbsp;好友&nbsp;&nbsp;</button>
					        	{{# } else { }}
					        		<span class="c_red">已经是好友</span>
					        	{{# } }}
				        	</p>
			        	</div>
			        </div>
		      	</div>
		  	{{# }); }}
		</textarea>

<textarea title="群聊模版" id="LAY_Group" style="display:none;">
			{{# layui.each(d.data, function(index, item){ }}
				<div class="layui-col-sm4 layui-col-md4 layui-col-lg2">
			        <div class="layui-card" >
			        	<div class="avatar">
			          		<img class="layadmin-homepage-pad-img" src="{{ item.avatar }}" />
			        	</div>
			        	<div class="units">
			        		<p style="font-size: 14px;">{{ item.groupName }}</p>
			        		<p><i class="layui-icon layui-icon-group icons"></i> {{ item.userCount }}<span class="line">|</span><i class="layui-icon layui-icon-friends icons"></i>{{ item.userName }}</p>
				        	<p>
					        	{{# if(item.isJoin == 0){ }}
					        		<button groupId="{{ item.groupId }}" class="addGroup layui-btn layui-btn-xs" style="background-color:#7ADDD4;">&nbsp;&nbsp;<strong>+</strong>&nbsp;&nbsp;加群&nbsp;&nbsp;</button>
					        	{{# } else { }}
					        		<span class="c_red">已经是群成员</span>
					        	{{# } }}
				        	</p>
			        	</div>
			        </div>
		      	</div>
		  	{{# }); }}
		</textarea>
</body>

<script src="<?=STATIC_URL?>layim2/dist/layui.js"></script>
<script src="<?=STATIC_URL?>layim2/dist/lay/modules/layim.js"></script>

<!--您的Layui代码start-->
<script type="text/javascript">
    var form, layer, laytpl, $;

    layui.use(['laytpl', 'form', 'element','layim'], function() {
        layim =layui.layim;
        form = layui.form;
        layer = layui.layer;
        laytpl = layui.laytpl;
        $ = layui.jquery;

        /**
         * 添加好友
         */
        $(document).on('click', '.addFriend', function() {
            var myBut = $(this);
            var userid = myBut.data("userid");
            var username = myBut.data("username");

            // 修改按钮
            myBut.parent().html('<span class="c_red">已经提交申请</span>');

            // 弹出添加好友验证界面
            layim.add({
                type: 'friend'
                ,username: 'fish'
                ,avatar: 'http://127.0.0.1/upload/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg'
                ,submit: function(group, remark, index){
                    // 推送一个消息
                    //请求添加用户
                    var msg = {
                        action: "add_friend",
                        from_id: 1,
                        from_username:'hepm',
                        friend_id: userid,
                        friend_username:username,
                        group_id: group,
                        remark: remark
                    };
                    console.log(msg);return;
                    layer.msg('好友申请已发送，请等待对方确认', { icon: 1 });
                    parent.window.Gsocket.send(JSON.stringify({
                         type: 'chatMsgbox' // 随便定义，用于在服务端区分消息类型
                        ,data: msg
                    }));
                }
            });
        });


        /**
         * 加入群聊
         */
        $(document).on('click', '.addGroup', function() {
            var myBut = $(this);
            var groupid = myBut.data("groupid");
            console.log($(this));
            // 修改按钮
            myBut.parent().html('<span class="c_red">已经提交申请</span>');

            // 弹出加入群聊验证界面
            layim.add({
                type: 'group'
                ,username: 'fish'
                ,avatar: 'aaa'
                ,submit: function(group, remark, index){
                    // 推送一个消息
                    //请求添加用户
                    var msg = {
                        action: "add_group",
                        from_id: 1,
                        from_username:'hepm',
                        friend_id: '',
                        friend_username:'',
                        group_id: groupid,
                        remark: remark
                    };
                    layer.msg('好友申请已发送，请等待对方确认', { icon: 1 });
                    parent.window.Gsocket.send(JSON.stringify({
                        type: 'chatMsgbox' // 随便定义，用于在服务端区分消息类型
                        ,data: msg
                    }));
                }
            });
        });
        /**
         * 查找用户按钮点击事件
         */
        $(document).on('click', '.findFriend', function() {
            var search_filed = $('#search_filed').text();
            var param = {name:search_filed};
            $.ajax({
                type: "POST",
                url: '/im.php/api/member/get_list',
                data: param,
                timeout: "4000",
                dataType: 'json',
                success: function (data) {
                    layer.closeAll('loading');

                    if (data.status == 0) {
                        var friend_list = '';
                        $.each(data.data.list,function (i,friend) {
                            console.log(friend);
                             friend_list = friend_list+`
                             <div class="layui-col-sm4 layui-col-md4 layui-col-lg2">
                            <div class="layui-card">
                            <div class="avatar">
                            <img class="layadmin-homepage-pad-img" src="${friend.avatar_url}"> </div>
                            <div class="units"> <p>${friend.id}</p> <p>${friend.nickname}</p> <p>  <button data-userid="${friend.id}" data-username="${friend.nickname}" class="addFriend layui-btn layui-btn-xs" style="background-color:#7ADDD4;">
                            <strong>+</strong> 好友 </button>  </p>
                            </div> </div>
                            </div>
                        `;
                        })
                        $('#friendList').html(friend_list);
                    } else {

                    }
                },
            });
           // bindingFriend();
        });
        /**
         * 查找群聊按钮点击事件
         */
        $(document).on('click', '.findGroup', function() {
            var search_filed = $('#search_filed_group').val();
            //bindingGroup();
            var param = {name:search_filed};
            $.ajax({
                type: "POST",
                url: '/im.php/api/group/get_list',
                data: param,
                timeout: "4000",
                dataType: 'json',
                success: function (data) {
                    layer.closeAll('loading');
                    console.log(data);
                    if (data.code == 0) {
                        var group_list = '';
                        $.each(data.data.list,function (i,group) {
                            console.log(group);

                            group_list = group_list+`
                             <div class="layui-col-sm4 layui-col-md4 layui-col-lg2"> <div class="layui-card">
                                <div class="avatar">
                                    <img class="layadmin-homepage-pad-img" src="${group.avatar_url}"> </div>
                                <div class="units">
                                    <p style="font-size: 14px;">${group.group_name}</p>
                                    <p><i class="layui-icon layui-icon-group icons"></i> 15<span class="line">|</span>
                                    <i class="layui-icon layui-icon-friends icons"></i>${group.belong}</p> <p>
                                <button data-groupid="${group.id}" data-group_name="${group.group_name}" class="addGroup layui-btn layui-btn-xs" style="background-color:#7ADDD4;"> <strong>+</strong> 加群 </button>  </p>
                                </div>
                                </div>
                            </div>
                        `;
                        })
                        $('#groupList').html(group_list);
                    } else {

                    }
                },
            });
        });

    });

    /**
     * 重新绑定用户列表
     */
    function bindingFriend(){
        layer.msg('开始绑定用户列表');
        var control = $('#friendList');
        control.empty();
        var json = {
            "code": 0,
            "count": null,
            "data": [
                {
                    "avatar": "http://tva4.sinaimg.cn/crop.0.1.1125.1125.180/475bb144jw8f9nwebnuhkj20v90vbwh9.jpg",
                    "isValid": 0,
                    "roleNames": "hepm",
                    "userCode": "18818880003",
                    "userId": 1,
                    "userName": "用户6011"
                }, {
                    "avatar": "http://tva2.sinaimg.cn/crop.1.0.747.747.180/633f068fjw8f9h040n951j20ku0kr74t.jpg",
                    "isValid": 0,
                    "roleNames": "fish",
                    "userCode": "18818880004",
                    "userId": 2,
                    "userName": "fish"
                },{
                    "avatar": "http://tva2.sinaimg.cn/crop.1.0.747.747.180/633f068fjw8f9h040n951j20ku0kr74t.jpg",
                    "isValid": 0,
                    "roleNames": "lgt",
                    "userCode": "18818880004",
                    "userId": 4,
                    "userName": "lgt"
                },
            ],
            "msg": "操作成功！"
        };
        var list = json.data;
        if(list != null){
            // 数据转化为html格式
            var html = laytpl(LAY_Friend.value).render({
                data: list
            });
            control.html(html);
        }else{
            control.append('<div style="color:#ccc; margin:150px 350px;">没有找到符合搜索条件的用户</div>');
        }


        var data = {
            roleId: $("#roleId").val(),
            searchKey: $("#searchKey1").val()
        };
        $.ajax({
            type: "get",
            url: "../json/friend.json",
            async: true,// 异步为true
            data: data,
            success: function (data) {
                var json = data;
                var list = json.data;
                if(list != null){
                    // 数据转化为html格式
                    var html = laytpl(LAY_Friend.value).render({
                        data: list
                    });
                    control.html(html);
                }else{
                    control.append('<div style="color:#ccc; margin:150px 350px;">没有找到符合搜索条件的用户</div>');
                }
            }
        });
    }

    /**
     * 重新绑定群聊列表
     */
    function bindingGroup(){
        layer.msg('开始绑定群聊列表');
        var control = $('#groupList');
        control.empty();
        var json = {
            "code": 0,
            "count": null,
            "data": [
                {
                    "avatar": "http://tva2.sinaimg.cn/crop.0.0.199.199.180/005Zseqhjw1eplix1brxxj305k05kjrf.jpg",
                    "groupId": 1,
                    "groupName": "IM群聊",
                    "isJoin": 0,
                    "userCount": 15,
                    "userId": 1,
                    "userName": "小升"
                }, {
                    "avatar": "http://tva1.sinaimg.cn/crop.0.0.200.200.50/006q8Q6bjw8f20zsdem2mj305k05kdfw.jpg",
                    "groupId": 18,
                    "groupName": "热血三角裤",
                    "isJoin": 1,
                    "userCount": 2,
                    "userId": 1,
                    "userName": "小升"
                }
            ],
            "msg": "操作成功！"
        };
        var list = json.data;
        if(list != null){
            // 数据转化为html格式
            var html = laytpl(LAY_Group.value).render({
                data: list
            });
            control.html(html);
        }else{
            control.append('<div style="color:#ccc; margin:150px 350px;">没有找到符合搜索条件的群聊</div>');
        }


        var data = {
            searchKey: $("#searchKey2").val()
        };
        $.ajax({
            type: "get",
            url: "../json/group.json",
            async: true,// 异步为true
            data: data,
            success: function (data) {
                var json = data;
                var list = json.data;
                if(list != null){
                    // 数据转化为html格式
                    var html = laytpl(LAY_Group.value).render({
                        data: list
                    });
                    control.html(html);
                }else{
                    control.append('<div style="color:#ccc; margin:150px 350px;">没有找到符合搜索条件的群聊</div>');
                }
            }
        });
    }


</script>
</body>

</html>