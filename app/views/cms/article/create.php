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
            <label class="col-sm-1 control-label" for="title">标题</label>
            <div class="col-sm-4">
                <input id="title" name="title" type="text" value="<?=$form['title']?>" placeholder="标题" class="form-control input-md">
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="cate_id">分类</label>
            <div class="col-sm-4">
                <select id="cate_id" name="cate_id" class="form-control">
                    <option value="">请选择</option>
                    <?=$select_tree?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="title">标题</label>
            <div class="col-sm-4">
                <input id="media" name="media" type="text" value="<?=$form['media']?>" placeholder="来源" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="title">作者</label>
            <div class="col-sm-4">
                <input id="author" name="author" type="text" value="<?=$form['author']?>" placeholder="作者" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="tag_ids">标签id  </label>
            <div class="col-sm-4">
                <input id="tag_ids" name="tag_ids" type="text" value="<?=$form['tag_ids']?>" placeholder="标签id  " class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label" for="keywords">关键词</label>
            <div class="col-sm-4">
                <input id="keywords" name="keywords" type="text" value="<?=$form['keywords']?>" placeholder="关键词" class="form-control input-md">
            </div>
        </div>
        <!-- Textarea -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="description">描述</label>
            <div class="col-sm-4">
                <textarea class="form-control" id="description" name="description">default text</textarea>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="is_top">是否置顶</label>
            <div class="col-sm-4">
                <select id="is_top" name="is_top" class="form-control">
                    <option value="">请选择</option>
                    <option value="0" <?=$form['is_top']==0?'selected':''?> >普通</option>
                    <option value="1"  <?=$form['is_top']==1?'selected':''?>  >置顶</option>
                    <option value="2"  <?=$form['is_top']==2?'selected':''?> >头条</option>
                </select>
            </div>
        </div>
        <script>
            var images_list = <?php echo json_encode([$form['file']]); ?>;
            var image_list_url = <?php echo json_encode([$form['list_image_url']]); ?>;
        </script>
        <?php include APP_PATH.'/views/admin/root/upload.php';?>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <option value="0"  <?=$form['status']==0?'selected':''?>>正常</option>
                    <option value="-1"  <?=$form['status']==-1?'selected':''?>>删除</option>
                </select>
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