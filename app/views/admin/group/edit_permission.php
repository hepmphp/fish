<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>菜单管理</title>
    <meta name="keywords" content="菜单管理">
    <meta name="description" content="菜单管理">
    <link rel="stylesheet" href="<?= STATIC_URL ?>js/bootstrap-treetable/libs/v3/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= STATIC_URL ?>js/bootstrap-treetable/bootstrap-treetable.css" type="text/css"/>
</head>
<body>
<div id="demo-toolbar" class="btn-group" role="group" aria-label="...">
    <button id="expandAllBtn" type="button" class="btn btn-default">展开/折叠 所有</button>
    <input class="btn btn-info m-l" value="全选" name="search" type="button" style="width:60px;margin-left: 20px" onclick="check_all()">
    <input class="btn btn-info m-l" value="取消选中" name="search" type="button" style="width:120px;margin-left: 20px" onclick="un_check_all()">
    <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;margin-left: 20px" onclick="add_mid('/admin/menu/create?id=0',1)">
</div>
<input type="hidden" id="id" value="<?=$form['id']?>">
<table id="demo"></table>
<!-- 全局js -->
<script  src="<?= STATIC_URL ?>js/jquery.min.js"></script>
<script  src="<?= STATIC_URL ?>js/layer/layer.js"></script>
<script src="<?= STATIC_URL ?>js/logic/admin/ajax.js?<?=rand()?>"></script>
<script  src="<?= STATIC_URL ?>js/bootstrap-treetable/libs/v3/bootstrap.min.js"></script>
<script  src="<?= STATIC_URL ?>js/bootstrap-treetable/bootstrap-treetable.js"></script>
<script>
    var data =<?=$menu_data?>;
    var admin_info_mids =<?=$admin_info_mids?>;
</script>
</body>
<script>
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
      //  height: 500,
        parentId : "parentid",
        data:data,
        columns: [{
            checkbox: true
        },{
            title: '菜单名称',
            field: 'name',
            width: '150',
            align: "center",
            formatter: function(value,row, index) {
                var menu_tips = '';
                if(row.level==0){// label-primary
                    menu_tips = menu_tips+'<span class="label label-primary">'+row.level+'级菜单</span><span>'+value+'</span>';
                }else if(row.level==1){
                    menu_tips = menu_tips+'<span class="label label-success">'+row.level+'级菜单</span><span>'+value+'</span>';
                }else{
                    menu_tips = menu_tips+'<span class="label label-info">'+row.level+'级菜单</span><span>'+value+'</span>';
                }
                return menu_tips;
            }
        },  {
            field: 'id',
            title: 'id',
            width: '150',
            align: "left",
            valign: "bottom",
            visible: true
        }, {
            field: 'parentid',
            title: '父id',
            width: '150',
            align: "left",
            valign: "bottom",
            visible: true
        }, {
            title: '状态',
            field: 'status',
            width: '150',
            align: "center",
            valign: "top",
            formatter: function(value,row, index) {
                var menu_tips = '';
                if(row.status=='-1'){
                    menu_tips = '<span class="label btn-danger">删除</span>';
                }else{
                    menu_tips = '<span class="label btn-info">正常</span>';
                }
                return menu_tips;
            }
        },{
            title: '类型',
            width: '150',
            align: "center",
            valign: "top",
            formatter: function(value,row, index) {
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
            },{
                title: '操作',
                width: '200',
                align: "center",
                formatter: function(value,row, index) {
                    var actions = [];
                    actions.push('<a class="btn btn-success btn-xs btn_edit_mid " href="javascript:void(0)" data-id="'+row.id+'" ><i class="fa fa-edit"></i>编辑</a> ');
                    actions.push('<a class="btn btn-info btn-xs btn_add_mid" href="javascript:void(0)"  data-id="'+row.id+'" ><i class="fa fa-plus"></i>新增</a> ');
                    actions.push('<a class="btn btn-danger btn-xs btn_del_mid" href="javascript:void(0)" data-id="'+row.id+'" ><i class="fa fa-remove"></i>删除</a>');
                    return actions.join('');
                }
            }

        ],
        onAll: function (data) {
            console.log("onAll");

            return false;
        },
        onLoadSuccess: function (data) {

            console.log("onLoadSuccess");
            $.each(admin_info_mids,function (i,v){
                $("input[name='select_item'][value="+v+"]").attr("checked", true);
            });
            return false;
        },
        onLoadError: function (status) {
            // console.log("onLoadError");
            return false;
        },
        onClickCell: function (field, value, row, $element) {
            // console.log("onClickCell", row);
            return false;
        },
        onDblClickCell: function (field, value, row, $element) {
            // console.log("onDblClickCell", row);
            return false;
        },
        onClickRow: function (row, $element) {
            // console.log("onClickRow", row);
            return false;
        },
        onDblClickRow: function (row, $element) {
            // console.log("onDblClickRow", row);
            return false;
        },

    });
    $('#demo').bootstrapTreeTable('expandAll');

    $("#expandRowBtn").click(function () {
        $('#demo').bootstrapTreeTable('toggleRow', 1);
    });
    var _expandFlag_all = false;
    $("#expandAllBtn").click(function () {
        if (_expandFlag_all) {
            $('#demo').bootstrapTreeTable('expandAll');
        } else {
            $('#demo').bootstrapTreeTable('collapseAll');
        }
        _expandFlag_all = _expandFlag_all ? false : true;
    });

    $('.btn_add_mid').click(function () {
        add_mid('/admin/menu/create?id='+$(this).data('id'),1);
    });

    $('.btn_edit_mid').click(function () {
        add_mid('/admin/menu/update?id='+$(this).data('id'),2);
    });

    $('.btn_del_mid').click(function () {
        var param =  {id:$(this).data('id')};
        layer.confirm('确定要删除?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: '/api/menu/delete',
                    data: param,
                    timeout:"4000",
                    dataType:'json',
                    success: function(data){
                        if (data.status == 0) {
                            layer.closeAll();
                            alert_success(data.msg);
                        }
                        else {
                            layer.closeAll();
                            alert_fail(data.msg);
                        }
                    },
                });
            },
            function(){

            }
        );
    })

    function add_mid(url,menu_action=1){
        layer.open({
            type: 2,
            title: menu_action===1?'添加菜单':'修改菜单',
            shadeClose: true,
            btn: ['确认', '关闭'],
            area: ['400px', '400px'],
            content:url ,
            yes: function (index, layero) {
                var body = layer.getChildFrame('body', index);
                var id = body.find('#id').val();
                var parentid = body.find('#parentid').val();
                var name = body.find('#name').val();
                var model = body.find('#model').val();
                var action = body.find('#action').val();
                var data = body.find('#data').val();
                var listorder = body.find('#listorder').val();
                var remark = body.find('#remark').val();
                var status = body.find('#status').val();
                var param = {
                    id:id,
                    parentid:parentid,
                    name:name,
                    model:model,
                    action:action,
                    data:data,
                    listorder:listorder,
                    remark:remark,
                    status:status
                };
                console.log('/api/menu/create',param);
                layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: menu_action===1?'/api/menu/create':'/api/menu/update',
                    data: param,
                    dataType: 'json',
                    success: function (data) {
                        layer.close(2);
                        layer.alert(data.msg, {icon: 1}, function (index) {
                                layer.close(index);
                                layer.closeAll();
                                window.location.reload();
                            }
                        );
                    }
                });

            }, btn2: function (index, layero) {
                console.log('no');
            }
        });
    }
    function check_all(){
        $.each( $("input[name='select_item']"),function (i,v){
            $(this).prop({checked:true});
        });
    }
    function un_check_all(){
        $.each( $("input[name='select_item']"),function (i,v){
            $("input[name='select_item']").attr("checked", false);
        });
    }

</script>

</html>
