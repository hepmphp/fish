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
            <label class="col-sm-1 control-label" for="project_id">项目</label>
            <div class="col-sm-4">
                <select id="project_id" name="project_id" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_project_id as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['project_id'] && is_numeric($form['project_id'])){ echo "selected";}?>><?=$vo['title']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="title">标题</label>
            <div class="col-sm-4">
                <input id="title" name="title" type="text" value="<?=$form['title']?>" placeholder="标题" class="form-control input-md">
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
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="task_color">任务颜色</label>
            <div class="col-sm-4">
                <select id="task_color" name="task_color" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($conig_task_color as $k=>$vo){
                        ?>
                        <option value="<?=$vo['color']?>"  style="color:#FFFFFF;background-color: <?=$vo['color']?>" <?php if($vo['color']==$form['task_color']){ echo "selected";}?>><?=$vo['name']?></option>

                    <?php }?>
                </select>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="descption">描述</label>
            <div class="col-sm-4">
                <input id="descption" name="descption" type="text" value="<?=$form['descption']?>" placeholder="描述" class="form-control input-md">
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="priority">优先级</label>
            <div class="col-sm-4">
                <select id="priority" name="priority" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_priority as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>"  <?php if($vo['id']==$form['priority'] && is_numeric($form['priority'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['status'] && is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="bug_level">bug级别</label>
            <div class="col-sm-4">
                <select id="bug_level" name="bug_level" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_bug_level as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['bug_level'] && is_numeric($form['bug_level'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="admin_id">管理员</label>
            <div class="col-sm-4">
                <select id="admin_id" name="admin_id" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_admin_user as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['admin_id'] && is_numeric($form['admin_id'])){ echo "selected";}?>><?=$vo['username']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="owner_user_id">指派给用户</label>
            <div class="col-sm-4">
                <select id="owner_user_id" name="owner_user_id" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_admin_user as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['owner_user_id'] && is_numeric($form['owner_user_id'])){ echo "selected";}?>><?=$vo['username']?></option>
                    <?php }?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label" for="hours">计划工时</label>
            <div class="col-sm-4">
                <input id="hours" name="hours" type="text" value="<?=$form['hours']?>" placeholder="计划工时" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-1">开始日期：</label>
            <div class="col-sm-4">
                <input placeholder="开始日期" class="form-control date-range  date-ico  form-date" name="start_date" id="start_date"  type="text" value="<?php if(!empty($form['start_date'])){echo date('Y-m-d H:i:s',$form['start_date']);}?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-1">截止日期：</label>
            <div class="col-sm-4">
                <input placeholder="截止日期" class="form-control date-range  date-ico  form-date" name="end_date" id="end_date"  type="text" value="<?php if(!empty($form['end_date'])){echo date('Y-m-d H:i:s',$form['end_date']);}?>">
            </div>
        </div>


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
<script >
    $('.date-range').dateRangePicker(
        {
            separator: ' to ',
            format: 'YYYY-MM-DD',
            // endDate: moment(),
            getValue: function () {

                if ($('#start_date').val() && $('#end_date').val())
                    return $('#start_date').val() + ' 至 ' + $('#end_date').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('#start_date').val(s1);
                $('#end_date').val(s2);
            },
            time: {
                enabled: true
            },
            defaultTime: moment().subtract(1, 'month').startOf('month').startOf('day').toDate(),
            defaultEndTime: moment().endOf('day').toDate()
        });
    $(function () {
        $(".popover-options a").popover({
            html: true
        });
    });

</script>
</body>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</html>