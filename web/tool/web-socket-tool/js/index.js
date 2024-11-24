window.onload = function(){
    init()
    listenerClickEvent()
}

// 初始化
function init(){
    $('.controllerArea').css({'display': 'block'})
}

/**
 * 监听点击事件
 */
// 定义socket句柄 方便其他函数操作
var ws = null
var heartBeatSecond = 0 // 心跳时间（秒）
var heartBeatT = null // 心跳定时器
function listenerClickEvent(){
    // 点击连接
    $("#linkSocket").on('click', () => {
        let wsHost = $('#wsHost').val()
        if(!wsHost)return
        addMessage('开始连接服务器。。')
        ws = new WebSocket(wsHost)

        ws.onopen = function (evt) {
            addMessage('连接成功！')
            // 如果设置了心跳
            heartBeatSecond = $("#heartBeatSecond").val()
            if(heartBeatSecond){
                let sendHertContent = $("#sendHertContent").val()
                heartBeatT = setInterval(() => {
                    addMessage('发送心跳内容：'+ sendHertContent)
                    ws.send(sendHertContent)
                }, heartBeatSecond*1000)
            }
            // 将连接按钮置为不可用
            $("#linkSocket").attr('disabled', 'disabled')
            // 将发送按钮置为可用
            $("#sendMessage").removeAttr('disabled')
            // console.log("Connected to WebSocket server.");
            // 将设置心跳按钮置为不可用
            $("#sendHertMessage").attr('disabled', 'disabled')
        };

        ws.onclose = function (evt) {
            addMessage('连接关闭！')
            console.log("onclose");
            // 将连接按钮置为可用
            $("#linkSocket").removeAttr('disabled')
            // 将发送按钮置为不可用
            $("#sendMessage").attr('disabled', 'disabled')
            // 将设置心跳按钮置为可用
            $("#sendHertMessage").removeAttr('disabled')
            clearWs()
        };

        ws.onmessage = function (evt) {
            addMessage('收到消息：'+ evt.data)
            // console.log('Retrieved data from server: ' + evt.data);
        };

        ws.onerror = function (evt, e) {
            addMessage('连接异常！')
            console.log('Error occured: ' + evt.data);
            // 将连接按钮置为可用
            $("#linkSocket").removeAttr('disabled')
            // 将发送按钮置为不可用
            $("#sendMessage").attr('disabled', 'disabled')
            // 将设置心跳按钮置为可用
            $("#sendHertMessage").removeAttr('disabled')
            clearWs()
        };
    })

    // 点击断开
    $("#closeSocket").on('click', () => {
        clearWs()
    })

    // 清除消息
    $("#clearMessage").on('click', function(){
        $('.messageNot').empty()
    })

    // 发送消息
    $("#sendMessage").on('click', function(){
        if(ws){
            let needMessage = $("#sendContent").val()
            addMessage('发送内容：'+ needMessage)
            ws.send(needMessage)
        }
    })

    // 设置心跳
    $("#sendHertMessage").on('click', function(){
        heartBeatSecond = $("#heartBeatSecond").val()
        console.log('heartBeatSecond', heartBeatSecond)
        // 将设置心跳按钮置为不可用
        $("#sendHertMessage").attr('disabled', 'disabled')
    })
}

// 销毁ws
function clearWs(){
    if(ws){
        ws.close()
        ws = null
    }
    heartBeatSecond = 0
    clearInterval(heartBeatT)
    heartBeatT = null
}

function addMessage(message){
    let currentTime = new Date().toLocaleString() + ": "
    let m = "<p>" + currentTime + message + "</p>"
    $('.messageNot').append(m)
    // 自动滚动到最底部
    let ele = document.querySelector('.messageNot')
    ele.scrollTop = ele.scrollHeight;
}