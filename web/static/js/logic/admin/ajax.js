
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
    layer.alert(msg, {icon:1}, function(){
        layer.closeAll();
        window.location.reload();
    });
}

/***
 * 失败弹窗
 * @param msg
 */
function alert_fail(msg){
    layer.alert(msg, {icon:2},function (index) {
        layer.closeAll('loading');
        layer.close(index);
        // layer.closeAll();
        // window.location.reload();
    });
}