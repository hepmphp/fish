<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>LayIM 3.x PC版本地演示</title>

    <link rel="stylesheet" href="<?=STATIC_URL?>layim2/dist/css/layui.css">
    <style>
        html{background-color: #333;}
    </style>
</head>
<body>


<script src="<?=STATIC_URL?>layim2/dist/layui.js"></script>
<script>

    if(!/^http(s*):\/\//.test(location.href)){
        alert('请部署到localhost上查看该演示');
    }
    window.to_message = '';
    window.from_message = '';
    window.message_form_talk = '';
    window.message_form = '';
    window.Gsocket = '';
    layui.use('layim', function(layim){
        layui.cache.dir = "<?=STATIC_URL?>layim2/dist/";
        //演示自动回复
        var autoReplay = [
            '您好，我现在有事不在，一会再和您联系。',
            '你没发错吧？face[微笑] ',
            '洗澡中，请勿打扰，偷窥请购票，个体四十，团体八折，订票电话：一般人我不告诉他！face[哈哈] ',
            '你好，我是主人的美女秘书，有什么事就跟我说吧，等他回来我会转告他的。face[心] face[心] face[心] ',
            'face[威武] face[威武] face[威武] face[威武] ',
            '<（@￣︶￣@）>',
            '你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复。',
            'face[黑线]  你慢慢说，别急……',
            '(*^__^*) face[嘻嘻] ，是贤心吗？'
        ];

        //基础配置
        layim.config({

            //初始化接口
            init: {
                url: '/im.php/api/group/get_group_member_list?belong_id=1'
                ,data: {}
            }

            //或采用以下方式初始化接口
            /*
            ,init: {
              mine: {
                "username": "LayIM体验者" //我的昵称
                ,"id": "100000123" //我的ID
                ,"status": "online" //在线状态 online：在线、hide：隐身
                ,"remark": "在深邃的编码世界，做一枚轻盈的纸飞机" //我的签名
                ,"avatar": "a.jpg" //我的头像
              }
              ,friend: []
              ,group: []
            }
            */


            //查看群员接口
            ,members: {
                url: ''
                ,data: {}
            }

            //上传图片接口
            ,uploadImage: {
                url: '/upload/image' //（返回的数据格式见下文）
                ,type: '' //默认post
            }

            //上传文件接口
            ,uploadFile: {
                url: '/upload/file' //（返回的数据格式见下文）
                ,type: '' //默认post
            }

            ,isAudio: true //开启聊天工具栏音频
            ,isVideo: true //开启聊天工具栏视频

            //扩展工具栏
            ,tool: [{
                alias: 'code'
                ,title: '代码'
                ,icon: '&#xe64e;'
            }]

            //,brief: true //是否简约模式（若开启则不显示主面板）

            //,title: 'WebIM' //自定义主面板最小化时的标题
            //,right: '100px' //主面板相对浏览器右侧距离
            //,minRight: '90px' //聊天面板最小化时相对浏览器右侧距离
            ,initSkin: '5.jpg' //1-5 设置初始背景
            //,skin: ['aaa.jpg'] //新增皮肤
            //,isfriend: false //是否开启好友
            //,isgroup: false //是否开启群组
            //,min: true //是否始终最小化主面板，默认false
            ,notice: true //是否开启桌面消息提醒，默认false
            //,voice: false //声音提醒，默认开启，声音文件为：default.mp3

            ,msgbox:  "<?=SITE_URL?>"+'im.php/web/msgbox/index' //消息盒子页面地址，若不开启，剔除该项即可
            ,find: "<?=SITE_URL?>"+'im.php/web/friend/find' //发现页面地址，若不开启，剔除该项即可
            ,chatLog: layui.cache.dir + 'css/modules/layim/html/chatlog.html' //聊天记录页面地址，若不开启，剔除该项即可

        });

        /*
        layim.chat({
          name: '在线客服-小苍'
          ,type: 'kefu'
          ,avatar: 'http://tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg'
          ,id: -1
        });
        layim.chat({
          name: '在线客服-心心'
          ,type: 'kefu'
          ,avatar: 'http://tva1.sinaimg.cn/crop.219.144.555.555.180/0068iARejw8esk724mra6j30rs0rstap.jpg'
          ,id: -2
        });
        layim.setChatMin();*/

        //监听在线状态的切换事件
        layim.on('online', function(data){
            //console.log(data);
        });

        //监听签名修改
        layim.on('sign', function(value){
            //console.log(value);
        });

        //监听自定义工具栏点击，以添加代码为例
        layim.on('tool(code)', function(insert){
            layer.prompt({
                title: '插入代码'
                ,formType: 2
                ,shade: 0
            }, function(text, index){
                layer.close(index);
                insert('[pre class=layui-code]' + text + '[/pre]'); //将内容插入到编辑器
            });
        });

        //监听layim建立就绪
        layim.on('ready', function(res){

            //console.log(res.mine);

            layim.msgbox(5); //模拟消息盒子有新消息，实际使用时，一般是动态获得

            //添加好友（如果检测到该socket）
            layim.addList({
                type: 'group'
                ,avatar: "http://tva3.sinaimg.cn/crop.64.106.361.361.50/7181dbb3jw8evfbtem8edj20ci0dpq3a.jpg"
                ,groupname: 'Angular开发'
                ,id: "12333333"
                ,members: 0
            });
            layim.addList({
                type: 'friend'
                ,avatar: "http://tp2.sinaimg.cn/2386568184/180/40050524279/0"
                ,username: '冲田杏梨'
                ,groupid: 2
                ,id: "1233333312121212"
                ,remark: "本人冲田杏梨将结束AV女优的工作"
            });

            setTimeout(function(){
                //接受消息（如果检测到该socket）
                layim.getMessage({
                    username: "Hi"
                    ,avatar: "http://qzapp.qlogo.cn/qzapp/100280987/56ADC83E78CEC046F8DF2C5D0DD63CDE/100"
                    ,id: "10000111"
                    ,type: "friend"
                    ,content: "临时："+ new Date().getTime()
                });

                /*layim.getMessage({
                  username: "贤心"
                  ,avatar: "http://tp1.sinaimg.cn/1571889140/180/40030060651/1"
                  ,id: "100001"
                  ,type: "friend"
                  ,content: "嗨，你好！欢迎体验LayIM。演示标记："+ new Date().getTime()
                });*/

            }, 3000);
        });

        window.layim = layim;
        window.Gsocket = new WebSocket('ws://127.0.0.1:9501');
//连接成功时触发
        window.Gsocket.onopen = function(){
            console.log('onopen连接成功');
            window.Gsocket.send('{"type":"onconnect","id":"1","from_username":"hepm"}');
        };

//监听收到的消息
        window.Gsocket.onmessage = function(evt){
            //res为接受到的值，如 {"emit": "messageName", "data": {}}
            //emit即为发出的事件名，用于区分不同的消息
            var message_form_talk = JSON.parse(evt.data);
            window.message_form_talk = message_form_talk;
            console.log('message_form_talk',message_form_talk);
            console.log(window.from_message);
            var message_form = {
                username:message_form_talk.to_username
                ,avatar:  window.to_message.avatar
                ,id: window.to_message.id
                ,type:"friend"
                ,content: message_form_talk.content
                ,timestamp: message_form_talk.create_time
            };
            if(message_form_talk.type=='group'){
                 layer.alert('有添加群消息,请及时处理',{icon:1},function () {
                     parent.layer.close(parent.layer.index);
                     parent.layer.close( layer.getFrameIndex('layui-layer-iframe3'));
                 });
            }else{
                window.message_form = message_form;
                console.log('message_form:',message_form);
                layim.getMessage(message_form);
            }

        };


        //监听发送消息
        layim.on('sendMessage', function(data){
            var to_message = data.to;
            console.log(to_message)
            window.from_message = data.mine;
            console.log(from_message);
            window.to_message = to_message;
            window.from_message = from_message;
            var content = {
                "from_id": from_message.id,
                "to_id": to_message.id,
                "from_username": from_message.username,
                "to_username": to_message.username,
                "type": 1,
                "status": 0,
                "content": from_message.content,
                "group_id": 1,
                "send_time": 1731248989,
                "create_time": 1731248989
            };
            window.Gsocket.send(JSON.stringify(content));

            // To = data.to;
            // //演示自动回复
            // setTimeout(function(){
            //     var obj = {};
            //     if(To.type === 'group'){
            //         obj = {
            //             username: '模拟群员'+(Math.random()*100|0)
            //             ,avatar: layui.cache.dir + 'images/face/'+ (Math.random()*72|0) + '.gif'
            //             ,id: To.id
            //             ,type: To.type
            //             ,content: autoReplay[Math.random()*9|0]
            //         }
            //     } else {
            //         obj = {
            //             username: To.name
            //             ,avatar: To.avatar
            //             ,id: To.id
            //             ,type: To.type
            //             ,content: autoReplay[Math.random()*9|0]
            //             ,timestamp: new Date().getTime()
            //         }
            //     }
            //     console.log(obj);
            //     layim.getMessage(obj);
            // }, 1000);
        });

        //监听查看群员
        layim.on('members', function(data){
            //console.log(data);
        });

        //监听聊天窗口的切换
        layim.on('chatChange', function(res){
            var type = res.data.type;
            console.log(res.data.id)
            if(type === 'friend'){
                //模拟标注好友状态
                //layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
            } else if(type === 'group'){
                //模拟系统消息
                layim.getMessage({
                    system: true
                    ,id: res.data.id
                    ,type: "group"
                    ,content: '模拟群员'+(Math.random()*100|0) + '加入群聊'
                });
            }
        });



    });
</script>
<script src="<?= STATIC_URL ?>/js/jquery.min.js"></script>
<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>
<script>
    var urls_friend_group = {
        create_url:'/im.php/api/friend_group/create',
        update_url:'/im.php/api/friend_group/update',
        delete_url:'/im.php/api/friend_group/delete',
        info_url:'/im.php/api/friend_group/info'
    };
    var urls_group = {
        create_url:'/im.php/api/group/create',
        update_url:'/im.php/api/group/update',
        delete_url:'/im.php/api/group/delete',
        info_url:'/im.php/api/group/info'
    };
    function groupCreate(id){
        layer_group_form('/im.php/web/group/create',1,['900px','700px']);
    }
    function groupUpdate(id) {
        layer_group_form('/im.php/web/group/update?id='+id,2,['900px','700px']);
    }
    function groupInfo(id){
        layer_group_form('/im.php/web/group/update?id='+id,2,['900px','700px']);
    }
    function groupChat(data){
        console.log(data);
        layim.chat({
            type: "group",
            name: data.name,
            avatar: data.avatar,
            id: data.id,
            status: '好友当前离线状态'
        });

    }
    function groupRemove(id) {
        var param =  {id:id};
        layer.confirm('确定要删除群?',{
            btn: ['确定','取消'], //按钮
            icon: 3,
            title:'提示'
        }, function(){
            layer.load(2);
            $.ajax({
                type:"POST",
                url: urls_group.delete_url,
                data: param,
                timeout:"4000",
                dataType:'json',
                success: function(data){
                    if (data.status == 0) {
                        alert_success(data.msg);
                    }else {
                        alert_fail(data.msg);
                    }
                },
            });
        });

    }
    function friendGroupRename(id){
        layer_friend_group_form('/im.php/web/friend_group/update?id='+id,2,['900px','700px']);
    }
    function friendGroupCreate(){
        layer_friend_group_form('/im.php/web/friend_group/create',1,['900px','700px']);
    }
    function friendGroupDelete(id){
        var param =  {id:id};
        layer.confirm('确定要好友分组?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: urls_friend_group.delete_url,
                    data: param,
                    timeout:"4000",
                    dataType:'json',
                    success: function(data){
                        if (data.status == 0) {
                            alert_success(data.msg);
                        }else {
                            alert_fail(data.msg);
                        }
                    },
                });
            }

        );
    }
    //表单
    function layer_friend_group_form(url,action,area){
        var content = url;
        var title = action==2?'修改':'添加';
        var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
        layer.open({
            type: 2, //iframe
            maxmin: true,
            area:area ,
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:content,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    account:body.find('#account').val(),
                    group_name:body.find('#group_name').val(),
                    avatar:body.find('.image-item').eq(0).attr('src'),
                    belong:body.find('#belong').val(),
                    description:body.find('#description').val(),
                    status:body.find('#status').val(),
                    create_time:body.find('#create_time').val(),
                    update_time:body.find('#update_time').val(),
                    delete_time:body.find('#delete_time').val()
                };
                //todo生成js验证
                if(param.id>0){
                    var url = urls_friend_group.update_url;
                }else{
                    var url = urls_friend_group.create_url
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
    //表单
    function layer_group_form(url,action,area){
        var content = url;
        var title = action==2?'修改':'添加';
        var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
        layer.open({
            type: 2, //iframe
            maxmin: true,
            area:area ,
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:content,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    account:body.find('#account').val(),
                    group_name:body.find('#group_name').val(),
                    avatar:body.find('.image-item').eq(0).attr('src'),
                    belong:body.find('#belong').val(),
                    description:body.find('#description').val(),
                    status:body.find('#status').val(),
                    create_time:body.find('#create_time').val(),
                    update_time:body.find('#update_time').val(),
                    delete_time:body.find('#delete_time').val()
                };
                //todo生成js验证
                if(param.id>0){
                    var url = urls_group.update_url;
                }else{
                    var url = urls_group.create_url
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
    // 阻止浏览器默认右键点击事件
    document.oncontextmenu = function() {
        return false;
    }
    // 绑定右击菜单中选项的点击事件
    var active = {
        menuChat: function(){
            /*发送即时消息*/
            var mineId = $(this).parent().data('id');
            var moldId = $(this).parent().data('mold');
            console.log($(this).parent().data('id'),$(this).parent().data('name'));
            layim.chat({
                type: moldId == 1 ? "friend" : "group",
                name: 'hepm',
                avatar: 'http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg',
                id: mineId,
                status: '好友当前离线状态'
            });
        },
        menuHistory: function(){
            /*消息记录*/
            var mineId = $(this).parent().data('id');
            var moldId = $(this).parent().data('mold');
            console.log(mineId);
        },
        menuProfile:function(a){
            console.log(a);
            console.log('call menuProfile....');
        },
        friendGroupCreate:function (data){
            console.log(data);
            console.log('friendGroupCreate');
            friendGroupCreate();

        },
        friendGroupRename:function (data){
            console.log(data);
            console.log('friendGroupCreate');
            friendGroupRename(data.id);
        },
        friendGroupDelete:function (data) {
            friendGroupDelete(data.id);
        },
        groupCreate:function (data) {
            groupCreate(data.id);
        },
        groupUpdate:function (data) {
            groupUpdate(data.id);
        },
        groupInfo:function (data) {
            groupInfo(data.id);
        },
        groupRemove:function (data) {
            groupRemove(data.id);
        },
        groupChat:function (data) {
            console.log('groupChat');
            groupChat(data);
        }
    };
    function getGroupList() {
        var group_url ='/im.php/api/group/get_group_list?belong_id=1';
        // 自定义接口获取群列表
        $.ajax({
            url: group_url, // 替换为您的服务器端接口地址
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var groupListHtml = '';
                $.each(data.data, function(index, group) {
                    console.log(group);
                    // 构建群列表的HTML
                    groupListHtml += ' <li  data-type="group" data-avatar="'+group.avatar_url+'" data-name="'+group.group_name+'" data-id="'+group.id+'" data-index="'+group.id+'" class="layim-group'+group.id+' ">';
                    groupListHtml += '<img src="'+group.avatar_url+'">';
                    groupListHtml += '<span>'+group.group_name+'</span><p></p>';
                    groupListHtml += ' <span class="layim-msg-status">new</span></li>';
                });
                // 将群列表的HTML添加到页面上
                $('.layim-list-group').html(groupListHtml);
                // 绑定点击事件（可选）
                $('.layui-layim-list a').on('click', function() {
                    var groupId = $(this).data('id');
                    // 在这里处理点击群的操作，比如打开聊天窗口
                    layer.msg('您点击了群ID为：' + groupId + ' 的群');
                });
            },
            error: function(xhr, status, error) {
                layer.msg('获取群列表失败：' + error);
            }
        });
    }

    // 单击聊天主界面事件
    $('body').on('click', '.layui-layim-tab', function(e){
        console.log(e,$(this));
        if($('.layui-layim-tab>.layim-this').attr('lay-type')=='group'){
            getGroupList();
        }
        emptyTips();
    });


    // 右击聊天主界面事件
    $('body').on('mousedown', '.layui-layim', function(e){
        emptyTips();
    });
    /* 监听鼠标滚轮事件 */
    $('body').on('mousewheel DOMMouseScroll', '.layim-tab-content', function(e){
        emptyTips();
    });
    /* 绑定好友右击事件 */
    $('body').on('mousedown', '.layim-list-friend li ul li', function(e){
        // 清空所有右击弹框
        emptyTips();
        if(3 != e.which) {
            return;
        }
        // 不再派发事件
        e.stopPropagation();

        var othis = $(this);
        if (othis.hasClass('layim-null')) return;

        // 移除所有选中的样式
        $('.layim-list-friend li ul li').removeAttr("style","");
        // 标注为选中
        othis.css({'background-color':'rgba(0,0,0,.05)'});

        var mineId = 1;
        var uid = Date.now().toString(36);
        var space_icon = '&nbsp;&nbsp;';
        var space_text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        var html = [
            '<ul id="contextmenu_'+uid + '" data-id="'+mineId+'" data-index="'+mineId+'" data-mold="1">',
            '<li data-type="menuChat" data-id="'+mineId+'"><i class="layui-icon" >&#xe611;</i>'+space_icon+'发送即时消息</li>',
            '<li data-type="menuProfile" data-id="'+mineId+'"><i class="layui-icon">&#xe60a;</i>'+space_icon+'查看资料</li>',
            '<li data-type="menuHistory" data-id="'+mineId+'"><i class="layui-icon" >&#xe60e;</i>'+space_icon+'消息记录</li>',
            '<li data-type="menuDelete" data-id="'+mineId+'">'+space_text+'删除好友</li>',
            '<li data-type="menuMoveto" data-id="'+mineId+'">'+space_text+'移动至</li></ul>'
        ].join('');

        layer.tips(html, othis, {
            tips: 1
            ,time: 0
            ,shift: 5
            ,fix: true
            ,skin: 'ayui-box layui-layim-contextmenu'
            ,success: function(layero){
                var liCount = (html.split('</li>')).length;
                var stopmp = function (e) { stope(e); };
                layero.off('mousedowm',stopmp).on('mousedowm',stopmp);
                var layerobj = $('#contextmenu_'+uid).parents('.layui-layim-contextmenu');
                // 移动弹框位置
                var top = layerobj.css('top').toLowerCase().replace('px','');
                var left = layerobj.css('left').toLowerCase().replace('px','');
                top = getTipTop(1, top, liCount);
                left = 30 + parseInt(left);
                layerobj.css({'width':'150px', 'left':left+'px', 'top':top+'px'});
                $('.layui-layim-contextmenu li').css({'padding-left':'18px'});
            }
        });
    });

    // 清空所有右击弹框
    var emptyTips = function () {
        // 移除所有好友选中的样式
        $('.layim-list-friend li ul li').removeAttr("style", "");
        // 移除所有群组选中的样式
        $('.layim-list-group li').removeAttr("style","");
        // 关闭右键菜单
        layer.closeAll('tips');
    };

    // 获取窗口的文档显示区的高度
    var currentHeight = getViewSizeWithScrollbar();
    function getViewSizeWithScrollbar(){
        var clientHeight = 0;
        if(window.innerWidth){
            clientHeight = window.innerHeight;
        }else if(document.documentElement.offsetWidth == document.documentElement.clientWidth){
            clientHeight = document.documentElement.offsetHeight;
        }else{
            clientHeight = document.documentElement.clientHeight + getScrollWith();
        }
        clientHeight = clientHeight-180;
        return clientHeight;
    }

    /**
     *计算tip定位的高度
     * @param type 类型(1好友、群组，2分组)
     * @param top 原弹框高度
     * @param liCount 弹框层中li数量
     */
    var getTipTop = function (type, top, liCount) {
        liCount--;
        if(top > (currentHeight-45*liCount)){
            top = parseInt(top) - 45;
        }else{
            if(type == 1){
                top = parseInt(top) + 30*liCount - 10;
            }else{
                top = parseInt(top) + 30*(liCount - 1);
            }
        }
        return top;
    };
    $('body').on('click', '.layim-list-group li', function(e) {
        console.log('layim-list-group bbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',$(this));
        var id= $(this).data('id');
        var avatar=$(this).data('avatar');
        var name = $(this).data('name');
        var group_info = {id:id,avatar:avatar,name:name};
        groupChat(group_info);
    });

    $('body').on('click', '.layui-layer-tips li', function(e){
        var type = $(this).data('type');
        var id = $(this).data('id');
        var avatar = $(this).data('avatar');
        var name = $(this).data('name');
        var data = {
            id:id,
            type:type,
            avatar:avatar,
            name:name,
        };
        active[type] ? active[type].call(this,data) : '';
        console.log('activeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',active);
        // 清空所有右击弹框
        emptyTips();
    });

    /* 绑定分组右击事件 */
    $('body').on('mousedown', '.layim-list-friend li h5', function(e){
        // 清空所有右击弹框
        emptyTips();
        if(3 != e.which) {
            return;
        }
        // 不再派发事件
        e.stopPropagation();

        var othis = $(this);
        if (othis.hasClass('layim-null')) return;

        var groupId = $(this).parent().data('groupid');
        var uid = Date.now().toString(36);
        var space_icon = '&nbsp;&nbsp;';
        var space_text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        var html = [
            '<ul id="contextmenu_'+uid+'" data-id="'+groupId+'" data-index="'+groupId +'">',
            '<li data-type="menuReset"><i class="layui-icon" >&#xe669;</i>'+space_icon+'刷新好友列表</li>',
            // '<li data-type="menuOnline"><i class="layui-icon">&#x1005;</i>'+space_icon+'显示在线好友</li>',
            '<li data-type="friendGroupCreate"  data-id="'+groupId+'" >'+space_text+'添加分组</li>',
            '<li data-type="friendGroupRename"  data-id="'+groupId+'" >'+space_text+'重命名</li>',
            '<li data-type="friendGroupDelete"  data-id="'+groupId+'"  data-mold="1">'+space_text+'删除分组</li></ul>',
        ].join('');

        layer.tips(html, othis, {
            tips: 1
            ,time: 0
            ,shift: 5
            ,fix: true
            ,skin: 'ayui-box layui-layim-contextmenu'
            ,success: function(layero){
                var liCount = (html.split('</li>')).length;
                var stopmp = function (e) { stope(e); };
                layero.off('mousedowm',stopmp).on('mousedowm',stopmp);
                var layerobj = $('#contextmenu_'+uid).parents('.layui-layim-contextmenu');
                // 移动弹框位置
                var top = layerobj.css('top').toLowerCase().replace('px','');
                var left = layerobj.css('left').toLowerCase().replace('px','');
                top = getTipTop(2, top, liCount);
                left = 30 + parseInt(left);
                layerobj.css({'width':'150px', 'left':left+'px', 'top':top+'px'});
                $('.layui-layim-contextmenu li').css({'padding-left':'18px'});
            }
        });
    });
    /* 绑定好友列表空白地方右击事件 */
    $('body').on('mousedown', '.layim-list-friend', function(e){
        // 清空所有右击弹框
        emptyTips();
        if(3 != e.which) {
            return;
        }
        // 不再派发事件
        e.stopPropagation();

        var othis = $(this);
        if (othis.hasClass('layim-null')) return;

        var uid = Date.now().toString(36);
        var space_icon = '&nbsp;&nbsp;';
        var space_text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        var html = [
            '<ul id="contextmenu_'+uid+'">',
            '<li data-type="menuReset"><i class="layui-icon" >&#xe669;</i>'+space_icon+'刷新好友列表</li>',
            '<li data-type="friendGroupCreate">'+space_text+'添加分组</li></ul>',
        ].join('');

        layer.tips(html, othis, {
            tips: 1
            ,time: 0
            ,shift: 5
            ,fix: true
            ,skin: 'ayui-box layui-layim-contextmenu'
            ,success: function(layero){
                var liCount = (html.split('</li>')).length;
                var stopmp = function (e) { stope(e); };
                layero.off('mousedowm',stopmp).on('mousedowm',stopmp);
                var layerobj = $('#contextmenu_'+uid).parents('.layui-layim-contextmenu');
                var top = e.pageY;
                var left = e.pageX;
                var screenWidth = window.screen.width;
                // 根据实体情况调整位置
                if(screenWidth-left > 150){
                    left = left - 30;
                }else if(screenWidth-left < 110){
                    left = left - 180;
                }else{
                    left = left - 130;
                }
                if(top > 816){
                    top = top - 140;
                }else{
                    top = top - 60;
                }
                layerobj.css({'width':'150px', 'left':left+'px', 'top':top+'px'});
                $('.layui-layim-contextmenu li').css({'padding-left':'18px'});
            }
        });
    });


    /* 绑定群聊右击事件 */
    $('body').on('mousedown', '.layim-list-group li', function(e) {
        // 清空所有右击弹框
        emptyTips();
        if (3 != e.which) {
            return;
        }
        // 不再派发事件
        e.stopPropagation();

        var othis = $(this);
        if (othis.hasClass('layim-null')) return;

        // 移除所有选中的样式
        $('.layim-list-group li').removeAttr("style", "");
        // 标注为选中
        othis.css({'background-color': 'rgba(0,0,0,.05)'});

        var mineId = $(this).data('mineid');
        var groupId = $(this).data('id');
        var avatar = $(this).find('img').attr("src");
        var name = $(this).data('name');
        console.log('layim-list-group li:',$(this));
        var uid = Date.now().toString(36);
        var space_icon = '&nbsp;&nbsp;';
        var space_text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        var html = [
            '<ul id="contextmenu_' + uid + '"  data-avatar="'+avatar+'" data-id="' + mineId + '" data-index="' + mineId + '" data-mold="2">',
            '<li data-type="groupChat" data-name="'+name+'" data-avatar="'+avatar+'" data-id="'+groupId+'"><i class="layui-icon" >&#xe611;</i>' + space_icon + '发送群消息</li>',
            '<li data-type="groupInfo"   data-name="'+name+'" data-avatar="'+avatar+'" data-id="'+groupId+'"><i class="layui-icon">&#xe60a;</i>' + space_icon + '查看群资料</li>',
            '<li data-type="groupHistory"  data-name="'+name+'" data-avatar="'+avatar+'"  data-id="'+groupId+'"><i class="layui-icon" >&#xe60e;</i>' + space_icon + '消息记录</li>',
            '<li data-type="groupUpdate"   data-name="'+name+'" data-avatar="'+avatar+'" data-id="'+groupId+'">' + space_text + '修改群图标</li>',
            '<li data-type="groupRemove"   data-name="'+name+'"  data-avatar="'+avatar+'" data-id="'+groupId+'"  data-mold="2">' + space_text + '解散该群</li>',
            '<li data-type="groupSecede"  data-name="'+name+'" data-avatar="'+avatar+'" data-id="'+groupId+'">' + space_text + '退出该群</li></ul>',
        ].join('');
        layer.tips(html, othis, {
            tips: 1
            , time: 0
            , shift: 5
            , fix: true
            , skin: 'ayui-box layui-layim-contextmenu'
            , success: function (layero) {
                var liCount = (html.split('</li>')).length;
                var stopmp = function (e) {
                    stope(e);
                };
                layero.off('mousedowm', stopmp).on('mousedowm', stopmp);
                var layerobj = $('#contextmenu_' + uid).parents('.layui-layim-contextmenu');
                // 移动弹框位置
                var top = layerobj.css('top').toLowerCase().replace('px', '');
                var left = layerobj.css('left').toLowerCase().replace('px', '');
                top = getTipTop(1, top, liCount);
                left = 30 + parseInt(left);
                layerobj.css({'width': '150px', 'left': left + 'px', 'top': top + 'px'});
                $('.layui-layim-contextmenu li').css({'padding-left': '18px'});
            }
        });
    });

    /* 绑定群聊空白地方右击事件 */
    /* 绑定群聊空白地方右击事件 */
    $('body').on('mousedown', '.layim-list-group', function(e){
        // 清空所有右击弹框
        emptyTips();
        if(3 != e.which) {
            return;
        }
        // 不再派发事件
        e.stopPropagation();

        var othis = $(this);
        if (othis.hasClass('layim-null')) return;

        var uid = Date.now().toString(36);
        var space_icon = '&nbsp;&nbsp;';
        var space_text = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        var html = [
            '<ul id="contextmenu_'+uid+'">',
            '<li data-type="menuResetGroup"><i class="layui-icon" >&#xe669;</i>'+space_icon+'刷新群聊列表</li>',
            '<li data-type="groupCreate">'+space_text+'创建群聊</li></ul>',
        ].join('');

        layer.tips(html, othis, {
            tips: 1
            ,time: 0
            ,shift: 5
            ,fix: true
            ,skin: 'ayui-box layui-layim-contextmenu'
            ,success: function(layero){
                var liCount = (html.split('</li>')).length;
                var stopmp = function (e) { stope(e); };
                layero.off('mousedowm',stopmp).on('mousedowm',stopmp);
                var layerobj = $('#contextmenu_'+uid).parents('.layui-layim-contextmenu');
                var top = e.pageY;
                var left = e.pageX;
                var screenWidth = window.screen.width;
                if(screenWidth-left > 150){
                    left = left - 30;
                }else if(screenWidth-left < 110){
                    left = left - 180;
                }else{
                    left = left - 130;
                }
                if(top > 816){
                    top = top - 140;
                }else{
                    top = top - 60;
                }
                layerobj.css({'width':'150px', 'left':left+'px', 'top':top+'px'});
                $('.layui-layim-contextmenu li').css({'padding-left':'18px'});
            }
        });
    });


</script>
<style>
    .layim-list-group{
        height: 900px;
    }
</style>
</body>
</html>
