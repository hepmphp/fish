<!DOCTYPE html>
<html lang="zh" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>bootstrap-treetable</title>
    <meta name="keywords" content="bootstrap-treetable">
    <meta name="description" content="bootstrap-treetable">
    <link rel="stylesheet" href="<?= STATIC_URL ?>js/bootstrap-treetable/libs/v3/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= STATIC_URL ?>js/bootstrap-treetable/bootstrap-treetable.css" type="text/css"/>
</head>
<body>
<div id="demo-toolbar" class="btn-group" role="group" aria-label="...">
    <button id="expandAllBtn" type="button" class="btn btn-default">展开/折叠 所有</button>
</div>
<input type="hidden" id="id" value="<?=$form['id']?>">
<table id="demo"></table>
<!-- 全局js -->
<script type="text/javascript" src="<?= STATIC_URL ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>js/bootstrap-treetable/libs/v3/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= STATIC_URL ?>js/bootstrap-treetable/bootstrap-treetable.js"></script>
<script>
    var data =<?=$menu_data?>;
    var admin_info_mids =<?=$admin_info_mids?>;
</script>

<script type="text/javascript">
    /**
     rootIdValue: null,//设置根节点id值----可指定根节点，默认为null,"",0,"0"
     id : "id",               // 选取记录返回的值,用于设置父子关系
     parentId : "parentId",       // 用于设置父子关系
     type: 'get',                   // 请求方式（*）
     url: "./data.json",             // 请求后台的URL（*）
     ajaxParams : {},               // 请求数据的ajax的data属性
     expandColumn : 0,            // 在哪一列上面显示展开按钮
     expandAll : false,                // 是否全部展开
     expandFirst : true, // 是否默认第一级展开--expandAll为false时生效
     toolbar: null,//顶部工具条
     height: 0,
     expanderExpandedClass : 'glyphicon glyphicon-chevron-down',// 展开的按钮的图标
     expanderCollapsedClass : 'glyphicon glyphicon-chevron-right',// 缩起的按钮的图标
     **/
    var treeTable = $('#demo').bootstrapTreeTable({
        toolbar: "#demo-toolbar",    //顶部工具条
        expandColumn: 1,            // 在哪一列上面显示展开按钮
        height: 500,
        parentId : "parentid",
        data:data,
        columns: [{
            checkbox: true
        },{
            title: '菜单名称',
            field: 'name',
            width: '150',
            align: "center",
        },  {
            title: '类型',
            width: '150',
            align: "center",
            valign: "top",
            formatter: function(value,item, index) {
                return '<span class="label label-primary">菜单</span>';
            }
        },
            {
                field: 'model',
                title: '控制器',
                width: '150',
                align: "left",
                valign: "bottom",
                visible: true
            },
            {
                field: 'action',
                title: '方法',
                width: '150',
                align: "left"
            }
        ],
        onAll: function (data) {
            console.log("onAll");
            return false;
        },
        onLoadSuccess: function (data) {
            console.log("onLoadSuccess");
            $.each(admin_info_mids,function (i,v){
                $("input[name='select_item']").eq(v).attr("checked", true);
            });

            return false;
        },
        onLoadError: function (status) {
            console.log("onLoadError");
            return false;
        },
        onClickCell: function (field, value, row, $element) {
            console.log("onClickCell", row);
            return false;
        },
        onDblClickCell: function (field, value, row, $element) {
            console.log("onDblClickCell", row);
            return false;
        },
        onClickRow: function (row, $element) {
            console.log("onClickRow", row);
            return false;
        },
        onDblClickRow: function (row, $element) {
            console.log("onDblClickRow", row);
            return false;
        },

    })
    $('#demo').bootstrapTreeTable('expandAll');

    $("#expandRowBtn").click(function () {
        $('#demo').bootstrapTreeTable('toggleRow', 1);
    })
    var _expandFlag_all = false;
    $("#expandAllBtn").click(function () {
        if (_expandFlag_all) {
            $('#demo').bootstrapTreeTable('expandAll');
        } else {
            $('#demo').bootstrapTreeTable('collapseAll');
        }
        _expandFlag_all = _expandFlag_all ? false : true;
    })

</script>
</body>
</html>
