<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文件管理</title>


</head>
<body>

<div class="Business-back">
    <div class="Business-top clearfix">
     <span class="file_title">文件管理</span>
    </div>
    <div class="Business-top-header clearfix">
    </div>
    <div class="Business-left clearfix">
        <ul id="treeDemo" class="ztree"></ul>
        <div id="rMenu" class="context-menu-list">
            <ul>
                <li class="context-menu-item" id="m_add" onclick="addTreeNode();"><i class="create_dir"></i>添加目录</li>
                <li class="context-menu-item" id="m_check" onclick="checkTreeNode(true);">
                    <i class="edit_dir"></i>
                    修改目录</li>
                <li class="context-menu-item " id="m_del" onclick="removeTreeNode();">
                    <i class="remove"></i>
                    删除目录

            </ul>
        </div>
    </div>

    <!--左边 end-->
    <div class="Business-right clearfix">
<!--        --><?php //include APP_PATH.'/views/cms/file/folder.php'?>
        <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" src="/cms/file/folder?iframe=1" frameborder="0" data-id="index"></iframe>
    </div>

</div>

</body>
<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script>
    var folder_id = '<?=\app\helpers\Input::get_post('folder_id')?>';
    var zNodes = <?=json_encode($folders,JSON_UNESCAPED_SLASHES)?>;
</script>
<style>

</style>

<script>
    var urls = {
        create_folder_url:'/api/folder/create',
        update_folder_url:'/api/folder/update',
        delete_folder_url:'/api/folder/delete',
        info_folder_url:'/api/folder/info'
    };
    //表单
    function layer_folder_form(url,action,area){
        var content = url;
        var title = action==2?'修改':'添加';
        var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
        layer.open({
            type: 2, //iframe
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
                    parentid:body.find('#parentid').val(),
                    name:body.find('#name').val(),
                    status:body.find('#status').val()
                };
                //todo生成js验证
                if(param.id){
                    var url = urls.update_folder_url+'?id='+param.id;
                }else{
                    var url = urls.create_folder_url
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
</script>
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        view: {
            dblClickExpand: false,
            showLine: false,
            showIcon: false,
            addDiyDom: addDiyDom

        },
        check: {
            enable: false
        },
        data: {
            simpleData: {
                enable: true,
                idKey:'id',
                pIdKey:'pId'
            }
        },
        callback: {
            // beforeClick:beforeClick,
            onRightClick: OnRightClick,
            onClick:onClick,
            onDblClick:onDblClick,
        }
    };
    function beforeClick(treeId, treeNode) {
        if (treeNode.level == 0 ) {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            zTree.expandNode(treeNode);
            return false;
        }
        return true;
    }
    function addDiyDom(treeId, treeNode) {
        var spaceWidth = 5;
        var switchObj = $("#" + treeNode.tId + "_switch"),
            icoObj = $("#" + treeNode.tId + "_ico");
        switchObj.remove();
        icoObj.before(switchObj);
        icoObj.after('<i class="image_logo"></i>');

        if (treeNode.level > 1) {
            var spaceStr = "<span style='display: inline-block;width:" + (spaceWidth * treeNode.level)+ "px' ></span>";
            switchObj.before(spaceStr);

        }
    }

    // var zNodes =[
    //     { id:1, pId:0, name:"文件夹", open:true},
    //     { id:11, pId:1, name:"收件箱"},
    //     { id:111, pId:11, name:"收件箱1"},
    //     { id:112, pId:111, name:"收件箱2"},
    //     { id:113, pId:112, name:"收件箱3"},
    //     { id:114, pId:113, name:"收件箱4"},
    //     { id:12, pId:1, name:"垃圾邮件"},
    //     { id:13, pId:1, name:"草稿"},
    //     { id:14, pId:1, name:"已发送邮件"},
    //     { id:15, pId:1, name:"已删除邮件"},
    //     { id:3, pId:0, name:"快速视图"},
    //     { id:31, pId:3, name:"文档"},
    //     { id:32, pId:3, name:"照片"}
    // ];
    function OnRightClick(event, treeId, treeNode) {
        if (!treeNode && event.target.tagName.toLowerCase() != "button" && $(event.target).parents("a").length == 0) {
            zTree.cancelSelectedNode();
            showRMenu("root", event.clientX, event.clientY);
        } else if (treeNode && !treeNode.noR) {
            zTree.selectNode(treeNode);
            showRMenu("node", event.clientX, event.clientY);
        }
    }

    function showRMenu(type, x, y) {
        $("#rMenu ul").show();
        if (type=="root") {
            $("#m_del").hide();
            $("#m_check").hide();
            $("#m_unCheck").hide();
        } else {
            $("#m_del").show();
            $("#m_check").show();
            $("#m_unCheck").show();
        }
        rMenu.css({"top":y+"px", "left":x+"px", "visibility":"visible"});

        $("body").bind("mousedown", onBodyMouseDown);
    }
    function hideRMenu() {
        if (rMenu) rMenu.css({"visibility": "hidden"});
        $("body").unbind("mousedown", onBodyMouseDown);
    }
    function onBodyMouseDown(event){
        if (!(event.target.id == "rMenu" || $(event.target).parents("#rMenu").length>0)) {
            rMenu.css({"visibility" : "hidden"});
        }
    }
    var addCount = 1;
    function addTreeNode() {
        var id = zTree.getSelectedNodes()[0].id;
        var url = '/cms/folder/create?id='+id;
        layer_folder_form(url,1,['400px', '350px']);

    }
    function removeTreeNode() {
        var id = zTree.getSelectedNodes()[0].id;
        layer.confirm('确定要删除?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                ajax_post(urls.delete_folder_url,{id:id})
            },
            function(){

            }
        );

    }
    function checkTreeNode(checked) {
        var id = zTree.getSelectedNodes()[0].id;
        var url = '/cms/folder/update?id='+id;
        layer_folder_form(url,1,['400px', '350px']);

    }

    function onClick(event, treeId, treeNode){
        console.log($(this));
        var id = zTree.getSelectedNodes()[0].id;
        window.location.href = '/cms/file/index?iframe=1&folder_id='+id;
    }
    function onDblClick(event, treeId, treeNode){
        var id = zTree.getSelectedNodes()[0].id;
        window.location.href = '/cms/file/index?iframe=1&folder_id='+id;
    }

    function resetTree() {
        hideRMenu();
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    }

    var zTree, rMenu,curMenu;
    $(document).ready(function(){
        var treeObj = $("#treeDemo");
        $.fn.zTree.init(treeObj, setting, zNodes);
        zTree = $.fn.zTree.getZTreeObj("treeDemo");
        rMenu = $("#rMenu");

        zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
        // curMenu = zTree_Menu.getNodes()[0];
        curMenu = zTree_Menu.getNodeByParam("id", folder_id);
        zTree_Menu.selectNode(curMenu);

        treeObj.hover(function () {
            if (!treeObj.hasClass("showIcon")) {
                treeObj.addClass("showIcon");
            }
        }, function() {
            treeObj.removeClass("showIcon");
        });
    });
    //-->
</SCRIPT>
<link rel="stylesheet" href="<?= STATIC_URL ?>/js/ztree/css/metroStyle/metroStyle.css" type="text/css">
<link rel="stylesheet" href="<?= STATIC_URL ?>/js/ztree/css/demo.css" type="text/css">
<script type="text/javascript" src="<?= STATIC_URL ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>/js/logic/admin/ajax.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>/js/layer/layer.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>/js/ztree/js/jquery.ztree.core.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>/js/ztree/js/jquery.ztree.excheck.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>/js/ztree/js/jquery.ztree.exedit.js"></script>
</html>