
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文件管理</title>


</head>
<body>
<script  src="http://127.0.0.1/static/admin/js/jquery.min.js?1008518258"></script>
<script  src="http://127.0.0.1/static/admin/js/jquery.cookie.js?2079846296"></script>
<script  src="http://127.0.0.1/static/admin/js/page.js?699784068"></script>
<script  src="http://127.0.0.1/static/admin/js/bootstrap.min.js?1322867740"></script>
<script  src="http://127.0.0.1/static/admin/js/date/moment.min.js?259657693"></script>
<script  src="http://127.0.0.1/static/admin/js/date/jquery.daterangepicker.js?1848431855"></script>
<script  src="http://127.0.0.1/static/admin/js/layer/layer.js?1448383258"></script>
<script  src="http://127.0.0.1/static/admin/js/logic/admin/ajax.js?324998102"></script>
<link href="http://127.0.0.1/static/admin/css/bootstrap.min.css?1608542455" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/css/style.css?2146112489" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/css/font-awesome.min.css?1237282833" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/js/bootstrap-table/bootstrap-table.min.css?395317088" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/css/form.css?2145105919" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/js/date/daterangepicker.css?1924278693" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/css/mobile.css?775036387" rel="stylesheet">
<link href="http://127.0.0.1/static/admin/js/layer/layui/layui.css?1025435458" rel="stylesheet">
<script >
    layer.config({
        skin: 'layer-ext-moon',
        extend: 'moon/style.css'
    });
</script>
<style>
    .btn-info{
        background: #0256FF;
    }
    .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info {
        color: #ffffff !important;
        background: #0256FF;
        border-color: #189ec8;
    }

    .my-gallery {
        /*width: 100%;*/
        height:75%;
        /*float: left;*/
    }

    .image_border{
        border: 2px solid rgb(2, 86, 255);

    }
    .my-gallery img {
        width: 80px;
        height: 80px;
        margin-top:10px;
        margin-left: 10px;
    }
    .my-gallery figure {
        display: block;
        float: left;
    }

    .my-gallery figcaption {
        text-align: center;
        margin-top:15px;
        /*display: none;*/
    }
    .image_box {
        width: 100px;
        height: 100px;
        background-color: #f8f8f8;
        margin-left: 10px;
        margin-top: 20px;
        /*border: 10px solid #FFFFFF;*/
    }
    .page-list{
        float: left;
    }
    .page-bottom{
        width: 900px;
    }
</style>
<?php include DOC_PATH . 'views/doc/web/common/header.php' ?>
<div class="Business-back">
    <div class="Business-top-header clearfix">
    </div>
    <div class="Business-left clearfix">
        <ul id="treeDemo" class="ztree">
        </ul>
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


<div class="form-wrapper">
    <div class="form-item">
        <div class="form-item">
            <input type="hidden" id="folder_id" name="folder_id" value="<?=$form['id']?>">
            <input type="hidden" id="folder_name" name="folder_name" value="<?=$form['name']?>">
            <form class="form-inline clearfix" role="form"  action="#" method="get">
                <div class="form-group">
                    <label class="control-label">用户id：</label>
                    <input placeholder="文本" class="form-control" name="user_id" id="user_id" value="" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">所属分类：</label>
                    <select id="folder_id" name="folder_id" class="form-control">
                        <option value="">请选择</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">文件名称：</label>
                    <input placeholder="文本" class="form-control" name="name" id="name" value="" type="text">
                </div>

                <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
                <input class="btn btn-info m-l" value="上传" name="search" type="button" style="width:60px;" onclick="upload_win()">
            </form>
        </div>
    </div>
    <div class="table-wrap">
        <table data-toggle="table" class="table-item table" >
            <thead>
            <tr>
                <th class="col-5">id</th>
                <th  class="col-5">名称</th>
                <th  class="col-5">文件名</th>
                <th  class="col-5">目录id</th>
                <th  class="col-5">目录名称</th>
                <th  class="col-5">目录父id</th>
                <th  class="col-5">用户id</th>
                <th  class="col-5">扩展名</th>
                <th  class="col-5">大小</th>
                <th  class="col-5">状态</th>
                <th  class="col-5">添加时间</th>
                <th  class="col-5">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $k=>$v){?>
            <tr>
                <td  class="col-5"><?=$v['id']?></td>
                <td  class="col-5"><?=$v['name']?></td>
                <td  class="col-5" ><a onclick="layer_file_win_form('<?=$v['file_url']?>','<?=$v['file']?>')" "><?=$v['file_url']?></a></td>

                <td class="col-5"><?=$v['folder_id']?></td>
                <td  class="col-5"><?=$v['folder_parentid']?></td>
                <td class="col-5"><?=$v['folder_name']?></td>
                <td  class="col-5"><?=$v['user_id']?></td>
                <td  class="col-5"><?=$v['ext']?></td>
                <td  class="col-5"><?=$v['size']?></td>
                <td  class="col-5"><?=$v['status']?></td>
                <td  class="col-5"><?=$v['addtime']?></td>
                <td  class="col-5"><a onclick="layer_file_win_form('<?=$v['file_url']?>','<?=$v['file']?>')" class="" data-id="[id]">[查看]</a>|<a onclick="del_file('<?=$v['id']?>')" class="" data-id="[id]">[删除]</a></td>

            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <style>
        .pagination{
            width: 900px;
        }
        .pagination-outline{
            width: 600px;
        }

    </style>
    <div class="page-bottom clearfix" style="margin-left: 500px;margin-top: 100px;">
        <div class=" pagination" style="margin: 0 auto;">
<span class="page-list">每页显示
    <span class="btn-group dropup">
            <select class="form-control" id="per_page" onchange="change_page()">
                  <option value="2">2</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
        </span>条</span>


            <ul class="pagination pagination-outline">
                <li class="page-pre"><a href="javascript:void(0)" data-page="1">&laquo;</a></li>
                <?php   for ($i=1;$i<=$data['total_page'];$i++){
                        if($i<=10){
                    ?>
                <li class="page-number  <?php if($i==$data['page']){echo 'active';}?>" ><a href="javascript:void(0)"  data-page="<?=$i?>"><?=$i?></a></li>
                <?php }}?>
                <li class="page-next"><a href="javascript:void(0)"  data-page="<?=($data['page']+1)?>">&raquo;</a></li>
            </ul>
            <input class="form-control jump-page" id="jump_page" size="2" maxlength="7" type="text"
                   style="width: 40px;margin-left: -200px;">
            <a href="javascript:void(0)" id="jump_page_click" style="margin-right: 10px;" onclick="go_page()">跳转</a>
        </div>
    </div>
    <script>
        function ajax_list(param){
            window.location.href = '/doc.php/web/file/index?'+'&'+$.param(param);
        }
        $(".pagination-outline").delegate('a', 'click', function () {
            console.log('pagination-outline');
            $(this).parent('li').addClass('active').siblings().removeClass('active');
            var page =$(this).data('page');
            var param = {
                folder_id:$("#folder_id").val(),
                page: page,
                per_page: $('#per_page').val(),
            };
            console.log(param);
            ajax_list(param);
        });
        $(document).ready(function () {
            window.go_page =function go_page() {
                var page = $('#jump_page').val();
                var per_page = $('#per_page').val();
                var param = {
                    folder_id:$("#folder_id").val(),
                    page: page,
                    per_page: per_page,
                };
                ajax_list(param);
            }

            $("#jump_page").keydown(function (e) {
                var curKey = e.which;
                console.log(curKey);
                if (curKey == 13) {
                    $('#jump_page_click').trigger('click');
                }
            });


            window.change_page =function change_page() {
                var per_page = $('#per_page').val();
                var param = {
                    folder_id:$("#folder_id").val(),
                    page: 1,
                    per_page: per_page,
                };
                ajax_list(param);
            }
        });


    </script>

</div>


</div>
    </div>
</div>
</body>

<link rel="stylesheet" href="http://127.0.0.1/static/admin/js/ztree/css/metroStyle/metroStyle.css" type="text/css">
<link rel="stylesheet" href="http://127.0.0.1/static/admin/js/ztree/css/demo.css" type="text/css">
<script  src="http://127.0.0.1/static/admin/js/jquery.min.js"></script>
<script  src="http://127.0.0.1/static/admin/js/logic/admin/ajax.js"></script>
<script src="http://127.0.0.1/static/admin/js/layer/layer.js"></script>
<script   src="http://127.0.0.1/static/admin/js/ztree/js/jquery.ztree.core.js"></script>
<script  src="http://127.0.0.1/static/admin/js/ztree/js/jquery.ztree.excheck.js"></script>
<script  src="http://127.0.0.1/static/admin/js/ztree/js/jquery.ztree.exedit.js"></script>

<script>
    var file_urls = {
        create_url:'/doc.php/api/file/create',
        update_url:'/doc.php/api/file/update',
        delete_url:'/doc.php/api/file/delete',
        info_url:'/doc.php/api/file/info'
    };
    function layer_file_win_form(url,file){
        var content = '/doc.php/web/file/file?url='+url+"&file="+file;
        var title = '浏览文件';
        var btn =[];
        layer.open({
            type: 2, //iframe
            maxmin: true,
            area:['1300px', '800px'] ,
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:content,
            success:function (index, layero) {

            },
            yes: function(index, layero){

            },btn2: function(index, layero){

            }

        });
    }
    function upload_win(url){
        layer_upload_win_form("/doc.php/web/file/upload",['1400px', '800px']);
    }
    //表单
    function layer_upload_win_form(url,area){
        var content = url;
        var title = '上传文件';
        var btn = ['确认','取消'];
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
                var file_lists  = new Array();
                 $.each(body.find('.file-list .data-file'),function (i,v){
                        var file = {
                            url:$(this).data('url'),
                            filename:$(this).data('filename'),
                            filepath:$(this).data('filepath'),
                            name:$(this).data('name')
                        };
                        console.log("file:aaaaaaaaaaaaaaaaaaaaaaaa=>",file);
                        file_lists.push(file);

                });
                var folder_id = $('#folder_id').val();
                var folder_name =  $('#folder_name').val();
                var param ={
                    id:body.find('#id').val(),
                    folder_id:folder_id,
                    folder_name:folder_name,
                    file_lists:file_lists
                };
                console.log(param);
                //todo生成js验证
                if(param.id){
                    var url = file_urls.update_url+'?id='+param.id;
                }else{
                    var url = file_urls.create_url;
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
</script>
<script>
    var folder_id = '<?=\app\helpers\Input::get_post('folder_id')?>';
    var zNodes = <?=json_encode($folders,JSON_UNESCAPED_SLASHES)?>;
</script>
<style>

</style>

<script>
    var urls = {
        create_folder_url:'/doc.php/api/folder/create',
        update_folder_url:'/doc.php/api/folder/update',
        delete_folder_url:'/doc.php/api/folder/delete',
        info_folder_url:'/doc.php/api/folder/info'
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
                    parentid:body.find('#parent_id').val(),
                    name:body.find('#name').val(),
                    status:body.find('#status').val()
                };
                console.log(param);
                //todo生成js验证
                if(param.id>0){
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
                pIdKey:'parentid'
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
        var url = '/doc.php/web/folder/create?folder_id='+id;
        layer_folder_form(url,1,['800px', '400px']);

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
        var url = '/doc.php/web/folder/update?id='+id;
        layer_folder_form(url,1,['800px', '400px']);

    }

    function onClick(event, treeId, treeNode){
        console.log($(this));
        var id = zTree.getSelectedNodes()[0].id;
        window.location.href = '/doc.php/web/file/index?iframe=1&folder_id='+id;
    }
    function onDblClick(event, treeId, treeNode){
        var id = zTree.getSelectedNodes()[0].id;
        window.location.href = '/doc.php/web/file/index?iframe=1&folder_id='+id;
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
</html>


