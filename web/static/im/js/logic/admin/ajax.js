


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