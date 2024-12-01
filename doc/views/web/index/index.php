
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
        <ul id="treeDemo" class="ztree"><li id="treeDemo_1" class="level0" tabindex="0" hidefocus="true" treenode=""><a id="treeDemo_1_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="电商"><span id="treeDemo_1_switch" title="" class="button level0 switch noline_docu" treenode_switch=""></span><span id="treeDemo_1_ico" title="" treenode_ico="" class="button ico_docu" style="width:0px;height:0px;"></span><i class="image_logo"></i><span id="treeDemo_1_span" class="node_name">电商</span></a></li><li id="treeDemo_2" class="level0" tabindex="0" hidefocus="true" treenode=""><a id="treeDemo_2_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="商品"><span id="treeDemo_2_switch" title="" class="button level0 switch noline_docu" treenode_switch=""></span><span id="treeDemo_2_ico" title="" treenode_ico="" class="button ico_docu" style="width:0px;height:0px;"></span><i class="image_logo"></i><span id="treeDemo_2_span" class="node_name">商品</span></a></li><li id="treeDemo_3" class="level0" tabindex="0" hidefocus="true" treenode=""><a id="treeDemo_3_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="鞋子"><span id="treeDemo_3_switch" title="" class="button level0 switch noline_docu" treenode_switch=""></span><span id="treeDemo_3_ico" title="" treenode_ico="" class="button ico_docu" style="width:0px;height:0px;"></span><i class="image_logo"></i><span id="treeDemo_3_span" class="node_name">鞋子</span></a></li></ul>
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
<div class="form-wrapper">
    <div class="form-item">
        <div class="form-item">
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
                <input class="btn btn-info m-l" value="上传" name="search" type="button" style="width:60px;" >
            </form>
        </div>
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
</html>


