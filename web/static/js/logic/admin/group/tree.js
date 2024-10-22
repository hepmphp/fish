var setting = {
    view: {
        addHoverDom: addHoverDom,
        removeHoverDom: removeHoverDom,
        selectedMulti: false,
        expandAll: true
    },
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    edit: {
        // enable: true
    }
};
//var zNodes = {$menu_data};
$(document).ready(function(){
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    // var tree = $.fn.zTree.getZTreeObj("treeDemo");
    // tree.expandAll(true);
});
var newCount = 1;
function addHoverDom(treeId, treeNode) {
    var sObj = $("#" + treeNode.tId + "_span");
    if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
    var addStr = "<span class='button add' id='addBtn_[tid]' data-id='[id]' title='add node'></span>";
    var editStr = "<span class='button edit' id='editBtn_[tid]' data-id='[id]' title='add node'></span>";
    addStr = addStr.replace('[tid]',treeNode.tId).replace('[id]',treeNode.id);
    editStr = editStr.replace('[tid]',treeNode.tId).replace('[id]',treeNode.id);
    addStr = addStr+editStr;
    sObj.after(addStr);
    var btn_add = $("#addBtn_"+treeNode.tId);
    if (btn_add){
        btn_add.bind("click", function(){
            console.log('tree item click....');
            add($(this).data('id'));
        });
    }
    var btn_edit = $("#editBtn_"+treeNode.tId);
    if (btn_edit){
        btn_edit.bind("click", function(){
            console.log($(this).data('id'));
            edit($(this).data('id'));
        });
    }
};
function removeHoverDom(treeId, treeNode) {
    $("#addBtn_"+treeNode.tId).unbind().remove();
    $("#editBtn_"+treeNode.tId).unbind().remove();
};

/**
 * tree curd
 */
$('#add_adminmenu').click(function(){
    add(0);
});

function add(parentid){
    var url = "/admin/group/?parentid="+parentid;
    admin_menu_form(url,1);
}

function edit(id) {
    var url = "?r=ga-admin-menu/update&id="+id;
    admin_menu_form(url,2);
}
//添加模板
function admin_menu_form(url,action){
    var content = url;
    var title = action==2?'修改':'添加';
    var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
    layer.open({
        type: 2, //iframe
        area: ['800px', '500px'],
        title: title,
        btn: btn,
        shade: 0.3, //遮罩透明度
        content:content,
        yes: function(index, layero){
            var body = layer.getChildFrame('body', index);
            var param ={
                id:body.find('#id').val(),
                GaAdminMenu:{
                    id:body.find('#id').val(),
                    parentid:body.find('#parentid').val(),
                    app_id:body.find('#app_id').val(),
                    model:body.find('#model').val(),
                    action:body.find('#action').val(),
                    data:body.find('#data').val(),
                    status:body.find('#status').val(),
                    name:body.find('#name').val(),
                    remark:body.find('#remark').val(),
                    listorder:body.find('#listorder').val(),
                    level:body.find('#level').val()
                }
            };
            var url = "?r=ga-admin-menu/create";
            if(param.GaAdminMenu.id){
                var url = "?r=ga-admin-menu/update";
            }
            layer.load(2);
            ajax_post(url,param);

        },btn2: function(index, layero){

        }
        // content:"{:U('Serverpolicy/add')}" //iframe的url
    });
}

function ajax_post(url,param){
    layer.load(2);
    $.ajax({
        type:"POST",
        url: url,
        data:  param,
        timeout:"4000",
        dataType:'json',
        success: function(data){
            if (data.status == 0) {
                layer.closeAll('loading');
                alert_success(data.msg);
            }
            else {
                layer.closeAll('loading');
                alert_fail(data.msg);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.readyState);
            console.log(textStatus);
            console.log(errorThrown);
            console.log(XMLHttpRequest.responseText);
            var result = jQuery.parseJSON(XMLHttpRequest.responseText);
            console.log(result);
            layer.closeAll('loading');
            alert_fail(result.msg);
        },
        complete: function(XMLHttpRequest, textStatus) {
            // console.log(textStatus);
            //this; // 调用本次AJAX请求时传递的options参数
        }
    });
}

/***
 * 成功
 * @param msg
 */
function alert_success(msg){
    layer.confirm(msg,{
        btn: ['确定'], //按钮
        shade: false, //不显示遮罩,
        icon:1
    }, function(){
        window.location.reload();
    });
}
/***
 *
 * @param msg
 * @param url
 */
function alert_success_url(msg,url){
    layer.confirm(msg,{
        btn: ['确定'], //按钮
        shade: false, //不显示遮罩,
        icon:1
    }, function(){
        window.location.href=url;
    });
}


function alert_success_sub(msg){
    layer.alert(msg, {icon:1});
}
/***
 * 失败弹窗
 * @param msg
 */
function alert_fail(msg){
    layer.alert(msg, {icon:2});
}