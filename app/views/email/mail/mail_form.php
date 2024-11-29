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
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppAsset::run()?>
    <link href="<?=STATIC_URL?>js/umeditor/themes/default/css/umeditor.css" rel="stylesheet">
</head>

<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-1 control-label" for="to">标题</label>
            <div class="col-sm-4">
                <input id="to" name="to" type="text" value="<?=$form['media']?>" placeholder="收件人" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="subject">标题</label>
            <div class="col-sm-4">
                <input id="title" name="title" type="text" value="<?=$form['subject']?>" placeholder="标题" class="form-control input-md">
            </div>
        </div>
        <div class="container col-sm-12" style="margin-top: 10px;">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-1 control-label">内容：</label>
                    <div class="col-sm-11">
                        <div type="text/plain" name="content" id="content"   style="width:1000px;height: 500px;"><?=html_entity_decode($form['content'])?></div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /*设置按扭样式*/
            .edui-icon-test {
                background-position: -380px 0;
            }
        </style>
        <!--        <div class="form-group">-->
        <!--            <label class="col-sm-1 control-label">内容：</label>-->
        <!--            <div class="col-sm-11">-->
        <!--                <div id="content" name="content">-->
        <!---->
        <!--                    --><?//=htmlspecialchars_decode($form['content'])?>
        <!---->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</div>

<script src="<?=STATIC_URL?>js/umeditor/umeditor.config.js"></script>
<script src="<?=STATIC_URL?>js/umeditor/umeditor.js"></script>
<script>
    var um = UM.getEditor('content', {
        toolbar: [
            'source | undo redo | bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
            'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize',
            '| justifyleft justifycenter justifyright justifyjustify |',
            'link unlink | emotion  video  | map',
            '| horizontal print preview fullscreen', 'drafts', 'formula', 'test'
        ]
    });
    um.ready(function () {
        //设置编辑器的内容
        //um.setContent(html_content);
        $('.edui-container').width("1000px");
        $('.edui-body-container').width("1000px");
    });
    UM.registerUI('test',
        function (name) {
            var me = this;
            var $btn = $.eduibutton({
                icon: name,
                click: function () {
                    layer.open({
                        type: 2, //iframe
                        area: ['1100px', '800px'],
                        title: '选择图片',
                        btn: ['确认', '取消'],
                        shadeClose: true,
                        shade: 0.3, //遮罩透明度
                        content: '/cms/file/index?iframe=1',
                        yes: function (index, layero) {
                            var body = window.layer.getChildFrame('body', index);
                            var image_list = '<p><img src="[src]" _src="[src]" ></p>' + "\n";
                            var html_image_list = '';
                            $.each(body.find('.image_border>a>img'),function (i,v) {
                                console.log('aaaaaaaaaaaaaaaaaaaaa');
                                html_image_list = html_image_list + image_list.replace('[src]', $(this).attr('src')).replace('[_src]', $(this).attr('src'));
                                //attach_urls.push($(this).attr('src'));
                            });
                            $('#content').append(html_image_list);
                            layer.closeAll();
                            console.log("checked...");
                        }, btn2: function (index, layero) {

                        }
                        // content:"{:U('Serverpolicy/add')}" //iframe的url
                    });
                },
                title: '相册插入图片'
            });

            this.addListener('selectionchange', function () {
                //切换为不可编辑时，把自己变灰
                var state = this.queryCommandState(name);
                $btn.edui().disabled(state == -1).active(state == 1)
            });
            return $btn;
        }
    );
</script>

</body>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</html>