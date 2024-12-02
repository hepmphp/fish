<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyUpload.js</title>
    <link rel="stylesheet" href="<?=STATIC_URL?>esay_upload/easy_upload.min.css">
</head>
<style>
    .file-list{
        width: 900px;
    }
    .file-list .name-size{
        margin-left: 50px;
    }
    .file-list .wrap{
        margin-left: 50px;
        width: 700px;
    }
    .file-list .info .f-size{
        width: 150px!important;
    }
    .easy-upload{
        width: 900px;
        margin: 0 auto;
    }
    .btns{
        height: 50px;
    }
    .bg-blue,.bg-red,.select {
        width: 80px;
        height: 40px;
        background-color: #FFFFFF;
        border: 2px dotted #409eff;
        border-radius: 4px;
    }
    .easy-upload .pic{
        width: 100px;
        /*height: 100%;*/
        background-color: #FFFFFF;
        border: 2px dotted #409eff;
    }
    .easy-upload .msg{
        width: 80px;
        height: 36px;
        text-align: center;
        line-height: 40px;
        border-radius: 5px;
        color: blue;
        background-color: #FFFFFF;
        border: 2px dotted blue;
        margin-left: -2px;
    }

    .easy-upload .icon::after{
        content:"文件";
        color:#409eff;
        border:none;

    }
    .easy-upload .bg-green{
        color:#409eff;
        background-color: #FFFFFF;
        border: 2px dotted #409eff;
    }
    .file-li{
        display: inline-block;
        width: 100%;
    }
</style>
<body>
<div id="easy"></div>

</body>
<script src="<?=STATIC_URL?>jquery.min.js"></script>
<script src="<?=STATIC_URL?>esay_upload/easyUpload.min.js"></script>
<script>

    var easy = new EasyUpload('#easy', {
        url: '/doc.php/web/uploader/index',
        naxSize: 5,
        maxCount: 1,
        progress: function(e, data) {
            console.log("progress.....".data);
            if (e.lengthComputable) {
                var percentComplete = Math.round((e.loaded * 100) / e.total);
                $('#progress span').text(percentComplete + '%');
            }
        },

        // readAs: 'BinaryString'
    });
    var files = new Array();
    // 本次导入文件数>限定数maxCount时，触发onMax事件
    easy.onMax = function (fs) {
        // in为本次导入文件数，max为限定文件数
        console.log('in:' + fs.in, 'max:' + fs.max);
    }
    // 设置XMLHttpRequest实例的请求头
    easy.setHeader = function (xhr) {
        // 如下：
        // xhr.setRequestHeader('Content-Type', 'application/json');
    }
    // 自定义上传文件数据格式，未定义此方法时以参数readAs定义格式上传（默认base64格式）
    easy.setData = function (file) {
        // flie 为文件信息对象，file.source为原始文件对象
        var formdata = new FormData();
        files.push(file.source);
        $.each(files,function (i,v){
            formdata.append('files_'+i,v);
        });

        return formdata;
    }
    // setFLag用来标识文件成功上传的状态
    easy.setFlag = function () {
        // return一个结果为true或者false的表达式，用来判断文件是否成功上传到服务器，如下：
        // return this.status == 200;
    }
    // 文件上传过程中会触发onProgress事件
    easy.onProgress = function (p) {
        // p是上传进度百分比
        console.log('上传中', p)
    }
    // 每完成一个文件上传会触发onLoad事件
    easy.onLoad = function (_this) {
        // _this是当前XMLHttpRequest实例
        console.log('上传完一个', _this)
    }
    // 每失败一个文件上传会触发onError事件
    easy.onError = function (_this) {
        // _this是当前XMLHttpRequest实例
        console.log('上传失败一个', _this)
    }
    // 文件队列（所有文件）上传完成后会触发onEnd事件
    easy.onEnd = function (file) {
        // this是本次new出来的EasyUpload实例对象，this包含本实例的配置、属性、方法等
        var response = JSON.parse(file.response);
        console.log(response.data.length);
        if(response.status==0){
            $.each(response.data,function (i,v){
                console.log(i, $('.file-list .data-file').eq(i));
                $('.file-list .data-file').eq(i).attr("data-url",v.url);
                $('.file-list .data-file').eq(i).attr("data-filename",v.filename);
                $('.file-list .data-file').eq(i).attr("data-name",v.name);
                $('.file-list .data-file').eq(i).attr("data-filepath",v.filepath);
            });
            $.each($('.file-list>.file-li .percent'),function (i,v) {
                $(this).text('100%');
                $(this).parent().parent().css({"color":"#409eff"});
                console.log(  $(this).parent().parent().find(".bg-green"));
                $(this).parent().parent().find("i").css({"color":"bg-blue"});
            });
            $.each($('.file-list>.file-li .progress'),function (i,v) {
                $(this).css({"background-color":"#409eff","width":"100%"})
            });
            //$('.file-list .file-li .info .f-size').css({"background-color":"#409eff"});

        }
        console.log('上传完成', this)
    }
    $(".file-list").delegate(".file-li","click",function(){
        $(this).css({"border":"2px dotted red"});
        $(this).find("input:checkbox").click();
    });
    $(".file-list").delegate("input:checkbox","click",function () {
        $(this).css({"border":"2px dotted red"});
        $(this).attr("checked",true);


    });

</script>

</html>