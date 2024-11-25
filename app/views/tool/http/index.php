<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<style>
    .container {
        padding-left: 0;
        padding-right: 0;
        width: 1160px !important;
        max-width: 1160px !important;
    }
    .t-small-margin {
        margin-top: 10px;
    }
    .http-box {
        margin-top: 10px;
    }
    .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 32px;
        padding: 5px 8px;
        font-size: 13px;
        line-height: 1.53846154;
        color: #222;
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 2px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    }
    .input-group-addon {
        padding: 5px 12px;
        font-size: 13px;
        font-weight: 400;
        line-height: 1;
        color: #222;
        text-align: center;
        background-color: #e5e5e5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .input-group-addon.fix-padding {
        width: 1px;
        padding: 0;
    }
    .input-group .form-control {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
    }
    .http-box .http-head #httpHeadUrlBox {
        display: table-cell;
    }
    .input-group-addon.fix-padding {
        width: 1px;
        padding: 0;
    }
    .input-group-addon:empty {
        width: 1px;
        padding: 0;
    }
    .input-group-addon.fix-border {
        border-right: 0;
        border-left: 0;
    }
    .input-group-btn {
        position: relative;
        font-size: 0;
        white-space: nowrap;
    }
    .input-group-btn>.btn {
        position: relative;
    }
    .btn-primary {
        color: #fff;
        background-color: #3280fc;
        border-color: #1970fc;
    }
    .http-box .http-switch {
        margin-top: 10px;
    }
    .http-box .http-switch .switch {
        width: 130px;
        float: left;
        margin-right: 20px;
        border-radius: 3px;
        border: 1px solid #ddd;
        padding: 0 10px;
    }
    .switch>input {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        margin: 0;
        opacity: 0;
    }
    .switch.text-left>label {
        padding: 5px 35px 5px 0;
    }
    .switch>label {
        display: block;
        padding: 5px 0 5px 35px;
        margin: 0;
        font-weight: 400;
        line-height: 20px;
    }
    .http-box .http-switch .switch label:before {
        right: 10px;
    }
    .switch>input:checked+label:before {
        background-color: #3280fc;
        border-color: #3280fc;
    }
    .switch.text-left>label:after, .switch.text-left>label:before {
        right: 0;
        left: auto;
    }
    .switch>label:after, .switch>label:before {
        position: absolute;
        top: 5px;
        left: 0;
        display: block;
        width: 30px;
        height: 20px;
        pointer-events: none;
        content: ' ';
        border: 1px solid #ddd;
        border-radius: 10px;
        -webkit-transition: all .4s cubic-bezier(.175,.885,.32,1);
        -o-transition: all .4s cubic-bezier(.175, .885, .32, 1);
        transition: all .4s cubic-bezier(.175,.885,.32,1);
    }
    .http-box .http-switch .switch input:checked+label:after {
        right: 11px;
    }
    .switch.text-left>input:checked+label:after {
        right: 1px;
        left: auto;
    }
    .http-box .http-switch .switch label:after {
        right: 22px;
    }
    .switch>input:checked+label:after {
        left: 11px;
        border-color: #fff;
    }
    .switch.text-left>label:after {
        right: 12px;
    }
    .switch.text-left>label:after, .switch.text-left>label:before {
        right: 0;
        left: auto;
    }
    .switch>label:after {
        top: 6px;
        width: 18px;
        height: 18px;
        background-color: #fff;
        border-color: #ccc;
        border-radius: 9px;
        -webkit-box-shadow: rgba(0, 0, 0, .05) 0 1px 4px, rgba(0, 0, 0, .12) 0 1px 2px;
        box-shadow: rgba(0, 0, 0, .05) 0 1px 4px, rgba(0, 0, 0, .12) 0 1px 2px;
    }
    .switch>label:after, .switch>label:before {
        position: absolute;
        top: 5px;
        left: 0;
        display: block;
        width: 30px;
        height: 20px;
        pointer-events: none;
        content: ' ';
        border: 1px solid #ddd;
        border-radius: 10px;
        -webkit-transition: all .4s cubic-bezier(.175,.885,.32,1);
        -o-transition: all .4s cubic-bezier(.175, .885, .32, 1);
        transition: all .4s cubic-bezier(.175,.885,.32,1);
    }
    .nav-tabs {
        border-bottom: 1px solid #ddd;
    }
    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    .nav-tabs>li {
        float: left;
        margin-bottom: -1px;
    }
    .nav>li {
        position: relative;
        display: block;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: grey;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.53846154;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
    }
    .nav>li>a {
        position: relative;
        display: block;
        padding: 8px 15px;
        color: #353535;
    }
    .http-box .http-option .tab-content {
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        padding: 15px;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: grey;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.53846154;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
    }
    .nav>li>a {
        position: relative;
        display: block;
        padding: 8px 15px;
        color: #353535;
    }
    #tab2Content2{
        width: 500px;
    }
    .http-box .http-option .tab-content .http-option-item {
        margin-bottom: 10px;
    }
    .http-box .http-option .tab-content .http-option-item input:first-child {
        width: 169px;
    }
    .http-box .http-option .tab-content .http-option-item input, .http-box .http-option .tab-content .http-option-item select {
        width: 300px;
        margin-right: 10px;
        display: inline-block;
    }
    .http-box .http-option .tab-content .http-option-item input, .http-box .http-option .tab-content .http-option-item select {
        width: 300px;
        margin-right: 10px;
        display: inline-block;
    }
</style>
<div class="container t-small-margin">
<div class="http-box">
    <div class="http-head">
        <div class="input-group" id="httpHead">

            <span class="input-group-addon">网址</span>
            <select class="form-control" id="httpProtocol">
                <option value="http://">http://</option>
                <option value="https://">https://</option>
            </select>
            <div id="httpHeadUrlBox">
                <div id="httpUrlHistory" style="display: none;">
                    <div id="httpClearHistory">
                        <p>本地请求历史记录</p>
                        <button type="button" class="btn">删除全部</button>
                    </div>
                    <ul id="httpHistoryBox"></ul>
                </div>
                <input type="text" class="form-control" placeholder="请输入可以访问的网址" id="httpHost">
            </div>
            <span class="input-group-addon fix-border fix-padding"></span>
            <select class="form-control" id="httpType">
                <option value="POST">POST</option>
                <option value="GET">GET</option>
                <option value="DELETE">DELETE</option>
                <option value="PUT">PUT</option>
                <option value="TRACE">TRACE</option>
                <option value="HEAD">HEAD</option>
                <option value="OPTIONS">OPTIONS</option>
            </select>
            <span class="input-group-addon fix-border fix-padding"></span>
            <select class="form-control" id="httpCode">
                <option value="utf-8">UTF-8</option>
                <option value="gbk">GBK</option>
                <option value="gb2312">GB2312</option>
                <option value="gb18030">GB18030</option>
            </select>
            <span class="input-group-btn">
                  <button id="httpRequest" class="btn btn-primary" data-loading-text="正在请求..." type="button">模拟请求</button>
                </span>
        </div>
        <div class="http-option" id="httpOptionBox" style="margin-top: 30px;">
            <ul class="nav nav-tabs">
                <li class="active" data-index="0"><a href="###" data-target="#tab2Content1" data-toggle="tab">参数设置</a></li>
                <li data-index="1"><a href="###" data-target="#tab2Content2" data-toggle="tab">批量参数添加</a></li>
                <li data-index="2"><a href="###" data-target="#tab2Content3" data-toggle="tab">JSON参数设置</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab2Content1">
                    <div id="addOptionsBox">

                    </div>
                    <button type="button" class="btn btn-primary r-small-margin" id="httpAddOption">添加一行</button>
                    <button type="button" class="btn display-none" id="httpRemoveOptions">全部删除</button>
                </div>
                <div class="tab-pane fade" id="tab2Content2">
                        <textarea placeholder="批量参数添加，如：name=bejson&amp;domain=www.bejson.com
或纯文本参数提交，如：QQ123456" id="httpGetOption" name="httpGetOption" style="width: 1138px; height: 223px;"></textarea>
                </div>
                <div class="tab-pane fade" id="tab2Content3">
                    <textarea  style="width: 1138px; height: 223px;" placeholder="JSON 参数添加，如：{&quot;name&quot;:&quot;bejson&quot;,&quot;domain&quot;:&quot;www.bejson.com&quot;}" id="httpJsonOption" name="httpJsonOption"></textarea>
                </div>
            </div>
        </div>
        <div class="http-option" id="httpHeaderBox" style="margin-top: 50px;">
            <ul class="nav nav-tabs">
                <li class="active"><a href="###" data-target="#tab3Content1" data-toggle="tab">Header/请求头 设置</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab3Content1">
                    <div class="http-option-item">
                        <input type="text" class="form-control" value="Content-Type" id="httpContentTypeKey" readonly>
                        <select class="form-control" id="httpContentType">
                            <option value="application/x-www-form-urlencoded;charset=utf-8">
                                application/x-www-form-urlencoded;charset=utf-8
                            </option>
                            <option value="application/json;charset=utf-8">application/json;charset=utf-8</option>
                        </select>
                    </div>
                    <div id="addHeadersBox">

                    </div>
                    <button type="button" class="btn btn-primary r-small-margin" id="httpAddHeader">添加一行</button>
                    <button type="button" class="btn display-none" id="httpRemoveHeaders">全部删除</button>
                </div>
            </div>
        </div>
        <div class="http-option display-none" id="httpCookieBox" style="margin-top: 30px;">
            <ul class="nav nav-tabs">
                <li class="active"><a href="###" data-target="#tab5Content1" data-toggle="tab">Cookie设置</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab5Content1">
                    <textarea   placeholder="添加Cookie，非必填" id="httpCookie" style="width: 1138px; height: 223px;"></textarea>
                </div>
            </div>
        </div>

        <div class="http-option">
            <ul class="nav nav-tabs">
                <li class="active"><a href="###" data-target="#tab6Content1" data-toggle="tab">Header <span class="font-12 text-info-a"> 响应数据</span></a></li>
                <li class=""><a href="###" data-target="#tab6Content2" data-toggle="tab">Response Text <span class="font-12 text-info-a"> 响应头信息</span></a></li>
                <li class=""><a href="###" data-target="#tab6Content3" data-toggle="tab">Response Text <span class="font-12 text-info-a"> 请求头信息</span></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab6Content1">
                    <textarea  class="r-big-margin" id="response_html" placeholder="响应数据"  style="width: 1138px; height: 223px;"></textarea>
                </div>
                <div class="tab-pane fade" id="tab6Content2">
                    <textarea   id="response_header" placeholder="响应头信息"  style="width: 1138px; height: 223px;"></textarea>
                </div>
                <div class="tab-pane fade" id="tab6Content3">
                    <textarea  id="request_header" placeholder="请求头信息"  style="width: 1138px; height: 223px;"> </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>

<script>
    //添加一行参数
    var addOptionsBoxHeight = $('#addOptionsBox').innerHeight();
    function httpAddOptions (value1,value2) {
        var val1 = value1?value1:'';
        var val2 = value2?value2:'';
        var addItem = '<div class="http-option-item">\n' +
            '                                <input type="text" value="'+val1+'" class="form-control" placeholder="请输入参数key">\n' +
            '                                <input type="text" value="'+val2+'" class="form-control" placeholder="请输入参数value，可为空">\n' +
            '                                <button type="button" class="btn http-option-cancel">删除</button>\n' +
            '                            </div>';
        addOptionsBoxHeight = addOptionsBoxHeight + 47;
        $('#addOptionsBox').height(addOptionsBoxHeight);
        $('#addOptionsBox').append(addItem);
        if (val1) {
            httpRequestOptions.param1[val1] = val2
        }
        if ($('#httpOptionBox .http-option-item').length>1) {
            $('#httpRemoveOptions').show()
        } else {
            $('#httpRemoveOptions').hide()
        }
    }
    $('#httpAddOption').click(function(){
        httpAddOptions();
    });
    //批量添加参数
    $('#httpAddOptions').click(function(){
        confirmArea({
            title: '批量添加，支持GET参数和JSON参数类型',
            placeholder: '例如：{"name":"bejson","domain":"www.bejson.com"}或者：name=bejson&domain=www.bejson.com',
            success: function(val){
                try{
                    if (typeof JSON.parse(val) == "object") {
                        var paramArr = JSON.parse(val);
                        for (key in paramArr) {
                            httpAddOptions(key, paramArr[key])
                        }
                        $('#confirmAreaModal').modal('hide', 'fit');
                        return;
                    }
                } catch (e) {
                    var reg = /^\{/gi;
                    var reg2 = /\}$/gi;
                    if (reg.test(val) && reg2.test(val)) {
                        var jsonError = 'JSON格式错误：'+ e;
                        msgError(jsonError);
                        return
                    } else {
                        var getJson = paramParse(val);
                        try {
                            var paramArr = JSON.parse(getJson);
                            for (key in paramArr) {
                                httpAddOptions(key, paramArr[key])
                            }
                            $('#confirmAreaModal').modal('hide', 'fit')
                        } catch (e) {
                            msgError('参数解析错误，请检查格式')
                        }
                    }
                    return;
                }
                msgError('参数解析错误，请检查格式')
            }
        })
    });
    //删除添加的参数
    $('body').on('click','#addOptionsBox .http-option-cancel',function(){
        addOptionsBoxHeight = addOptionsBoxHeight -47;
        $('#addOptionsBox').height(addOptionsBoxHeight);
        $(this).parent().remove();
        if ($('#httpOptionBox .http-option-item').length>1) {
            $('#httpRemoveOptions').show()
        } else {
            $('#httpRemoveOptions').hide()
        }
    });

    $('body').on('click','#addHeadersBox .http-option-cancel',function(){
        addHeadersBoxHeight = addHeadersBoxHeight -47;
        $('#addHeadersBox').height(addHeadersBoxHeight);
        $(this).parent().remove();
        if ($('#addHeadersBox .http-option-item').length>1) {
            $('#httpRemoveHeaders').show()
        } else {
            $('#httpRemoveHeaders').hide()
        }
    });
    //批量删除添加的参数
    $('body').on('click','#httpRemoveOptions',function(){
        addOptionsBoxHeight = 0;
        $('#addOptionsBox').height(addOptionsBoxHeight);
        $('#addOptionsBox').empty();
        $('#httpRemoveOptions').hide();
    });

    $('body').on('click','#httpRemoveHeaders',function(){
        addHeadersBoxHeight = 0;
        $('#addHeadersBox').height(addHeadersBoxHeight);
        $('#addHeadersBox').empty();
        $('#httpRemoveHeaders').hide();
    });
    //批量添加参数
    $('#httpAddOptions').click(function(){
        confirmArea({
            title: '批量添加，支持GET参数和JSON参数类型',
            placeholder: '例如：{"name":"bejson","domain":"www.bejson.com"}或者：name=bejson&domain=www.bejson.com',
            success: function(val){
                try{
                    if (typeof JSON.parse(val) == "object") {
                        var paramArr = JSON.parse(val);
                        for (key in paramArr) {
                            httpAddOptions(key, paramArr[key])
                        }
                        $('#confirmAreaModal').modal('hide', 'fit');
                        return;
                    }
                } catch (e) {
                    var reg = /^\{/gi;
                    var reg2 = /\}$/gi;
                    if (reg.test(val) && reg2.test(val)) {
                        var jsonError = 'JSON格式错误：'+ e;
                        msgError(jsonError);
                        return
                    } else {
                        var getJson = paramParse(val);
                        try {
                            var paramArr = JSON.parse(getJson);
                            for (key in paramArr) {
                                httpAddOptions(key, paramArr[key])
                            }
                            $('#confirmAreaModal').modal('hide', 'fit')
                        } catch (e) {
                            msgError('参数解析错误，请检查格式')
                        }
                    }
                    return;
                }
                msgError('参数解析错误，请检查格式')
            }
        })
    });
    $('#httpAddHeaders').click(function(){
        confirmArea({
            title: '批量添加Header，支持JSON和Text',
            placeholder: '可以从抓包工具，或者浏览器控制台复制Header信息直接添加。',
            success: function(val){
                try{
                    if (typeof JSON.parse(val) == "object") {
                        var paramArr = JSON.parse(val);
                        for (key in paramArr) {
                            httpAddHeaders(key, paramArr[key]);
                        }
                        $('#confirmAreaModal').modal('hide', 'fit');
                        return;
                    }
                } catch (e) {
                    var reg = /^\{/gi;
                    var reg2 = /\}$/gi;
                    if (reg.test(val) && reg2.test(val)) {
                        var jsonError = 'JSON格式错误：'+ e;
                        msgError(jsonError);
                        return
                    } else {
                        var getJson = val.replace(/\r\n/g, '&?%$#@?*&^&%#@!').replace(/\r/g, '&?%$#@?*&^&%#@!').replace(/\n/g, '&?%$#@?*&^&%#@!').replace(/,{2,}/g, '&?%$#@?*&^&%#@!');
                        getJson = getJson.split('&?%$#@?*&^&%#@!');
                        var paramJson = {};
                        $(getJson).each(function(index,item){
                            var left = '';
                            var right = '';
                            $(item.split(':')).each(function(key,value){
                                if (key === 0) {
                                    left = value
                                } else if (key === 1) {
                                    right = value
                                } else {
                                    right = right + ':' + value
                                }
                            });
                            paramJson[left] = right
                        });
                        try {
                            for (key in paramJson) {
                                httpAddHeaders(key, paramJson[key])
                            }
                            $('#confirmAreaModal').modal('hide', 'fit')
                        } catch (e) {
                            msgError('参数解析错误，请检查格式')
                        }
                    }
                    return;
                }
                msgError('参数解析错误，请检查格式')
            }
        })
    });
    $('#httpAddHeader').click(function(){
        httpAddHeaders();
    });
    var addHeadersBoxHeight = $('#addHeadersBox').innerHeight();
    function httpAddHeaders (value1,value2) {
        var val1 = value1?value1:'';
        var val2 = value2?value2:'';
        var addItem = '<div class="http-option-item">\n' +
            '                                <input type="text" value="'+val1+'" class="form-control" placeholder="请输入参数Header key">\n' +
            '                                <input type="text" value="'+val2+'" class="form-control" placeholder="请输入参数Header，可为空">\n' +
            '                                <button type="button" class="btn http-option-cancel">删除</button>\n' +
            '                            </div>';
        addHeadersBoxHeight = addHeadersBoxHeight + 47;
        $('#addHeadersBox').height(addHeadersBoxHeight);
        $('#addHeadersBox').append(addItem);
        if (val1) {
            httpRequestOptions.headers[val1] = val2
        }
        if ($('#addHeadersBox .http-option-item').length>1) {
            $('#httpRemoveHeaders').show()
        } else {
            $('#httpRemoveHeaderns').hide()
        }
    }


    $('#httpRequest').click(function () {
        var http_protocol = $('#httpProtocol').val();
        var url = $('#httpHost').val();
        var http_type = $('#httpType').val();
        url = http_protocol+url;
        var headers = {};
        var params = {};
        //获取json参数
        headers['Content-Type'] = $('#httpContentType').val();

        //获取header头
        $('#httpHeaderBox .http-option-item').each(function(index,item){
            if(index!=0){
                var key = $(item).find('input').eq(0).val();
                if (key) {
                    headers[key] = $(item).find('input').eq(1).val();
                }
            }

        });
        //获取其他
        $('#addOptionsBox .http-option-item').each(function(index,item){
            var key = $(item).find('input').eq(0).val();
            if (key) {
                params[key] = $(item).find('input').eq(1).val();
            }
        });
        var httpRequestOptions =new Array();
        httpRequestOptions.cookie = $('#httpCookie').val();
        httpRequestOptions.contentType = $('#httpContentType').val();
        if(Object.keys(params).length==0){
            console.log(headers['Content-Type']);
            if(headers['Content-Type']=='application/x-www-form-urlencoded;charset=utf-8'){
                params = $('#httpGetOption').val();
            }else{
                params = $('#httpJsonOption').val();
            }
        }else{
            console.log(params);
            params = jQuery.param(params);
        }
        console.log(params);
        $.ajax({
            type:http_type,
            url: url,
            data: params,
            headers:headers,
            timeout:"4000",
            dataType:'json',
            success: function(data,status,xhr){
                console.log(data);
                $('#response_html').html(JSON.stringify(data,null,"\t"));
                $('#response_header').html(xhr.getAllResponseHeaders());
                $('#request_header').html(JSON.stringify(data.request_data,null,"\t"));
            },
        });
    });
</script>
</html>