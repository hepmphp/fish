<link href="http://127.0.0.1:2222/static/admin/js/umeditor/themes/default/css/umeditor.css" rel="stylesheet">
<script src="http://127.0.0.1:2222/static/admin/js/umeditor/umeditor.config.js"></script>
<script src="http://127.0.0.1:2222/static/admin/js/umeditor/umeditor.js"></script>
<style>
    /*设置按扭样式*/
    .edui-icon-test {
        background-position: -380px 0;
    }

</style>
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
        $('.edui-container').width("1030px");
        $('.edui-body-container').width("500px");
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