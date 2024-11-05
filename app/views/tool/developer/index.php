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
    <?=\app\helpers\AppAsset::run()?>
    <style>
        .fixed-table-container {
            position: relative;
            clear: both;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-left: none;
            border-right: none;
        }
    </style>
</head>
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form" method="get">
            <input type="hidden" name="iframe" value="1">
            <div class="form-group">
                <label class="control-label">模块：</label>
                <select class="form-control" name="database" id="database">
                    <option value="">请选择</option>
                    <?php foreach($databases as $k=>$v){ ?>
                        <option value="<?=$v?>" <?php if($v==$_GET['database']){ echo "selected";}?>><?=$v?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">表：</label>
                <select class="form-control" name="table" id="table">
                    <option value="">请选择</option>
                    <?php foreach($config_table_id as $k=>$v){ ?>
                        <option value="<?=$v['id']?>" <?php if($v['id']==$_GET['table']){ echo "selected";}?>><?=$v['id']?></option>
                    <?php }?>
                </select>
            </div>


            <button class="btn btn-info m-l" type="submit"> 查询</button>
            <button class="btn" id="preview" type="button">预览from</button>
            <button class="btn" type="button" id="btn_js">预览js</button>
            <!-- <button class="btn" type="button" id="btn_search">生成搜索项</button> -->
            <button class="btn" type="button" id="btn_model">预览模型</button>
            <button class="btn" type="button" id="btn_list">预览列表</button>
            <button class="btn" type="button" id="btn_controller">预览控制器</button>
            &nbsp;&nbsp;&nbsp;&nbsp;

            <div class="form-group">
                <label class="control-label">菜单：</label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="">请选择</option>
                    <option value="0">作为一级菜单</option>
                    <?=$config_menu?>
                </select>
            </div>
            <button class="btn" type="button" id="btn_menu">预览菜单</button>
        </form>

    </div>
    <div class="fixed-table-container">
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item2 table inner-table">
            <thead>
            <tr>
                <th><input type="checkbox" class="chekck_all"></th>
                <th>字段名</th>
                <th>字段</th>
                <th>表单类型</th>
                <th>列表搜索</th>
                <th>控制器搜索</th>


            </tr>
            </thead>
            <tbody>
            <?php foreach($fields as $k=>$vo){ ?>
                <tr>
                    <td><input type="checkbox" name="ids[]" value="<?=$k?>"></td>
                    <td><?=$vo?></td>
                    <td><?=$k?></td>
                    <td>
                        <select  name="form_builder_type[]" class="form-control form_builder_type">
                            <?php
                            foreach($config_form_builder_type as $t=>$fb){
                                ?>
                                <option value="<?=$t?>"><?=$fb?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td>
                        <select  name="search_list_type[]" class="form-control search_list_type">
                            <?php
                            foreach($config_search_list_type as $t=>$fb){
                                ?>
                                <option value="<?=$t?>"><?=$fb?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td>
                        <select  name="search_builder_type[]" class="form-control search_builder_type">
                            <?php
                            foreach($config_search_builder_type as $t=>$fb){
                                ?>
                                <option value="<?=$t?>"><?=$fb?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    </div>
</div>


<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>

<script>
    $('.chekck_all').click(function(){
        console.log($(this));
        if(this.checked){
            $("input[name='ids[]']").each(function(){
                this.checked = true;
            });
        }else{
            $("input[name='ids[]']").each(function(){
                this.checked = false;
            });
        };
    });
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page : $("#admin").val().length==0?100:1,
            admin: $("#admin").val(),
            title:$('#title').val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val(),
            status:$('#status').val(),
        };

        console.log(search_param);
        ajax_list(search_param);
    }

    function delete_freind(id){
        var param =  {id:id};
        layer.confirm('确定删除友情链接?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                layer.load(2);
                $.ajax({
                    type:"POST",
                    url: '/api/friend/delete',
                    data: param,
                    timeout:"4000",
                    dataType:'json',
                    success: function(data){
                        if (data.status == 0) {
                            alert_success(data.msg);
                        }else {
                            alert_fail(data.msg);
                        }
                    },
                });
            }
        );
    }
    function friend_layer_form(url,action=1){
        var title = action==1?'添加':'修改';
        var btn =  action==1?['确认添加','取消']:['确认修改','取消'];
        var layer_index = layer.open({
            type: 2, //iframe
            area: ['500px', '400px'],
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            content:url,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    name:body.find('#name').val(),
                    link_address:body.find('#link_address').val(),
                    status:body.find('#status').val(),
                }
                console.log(param);
                var url = action==1?'/api/friend/create':'/api/friend/update';
                ajax_post(url,param);
            },btn2: function(index, layero){

            }
        });
    }




    $('#preview').click(function(){
        var fields = new Array();
        var form_builder_types = new Array();
        var table = $('#table').val();
        var database = $('#database').val();
        $("input[name='ids[]']").each(function(){
            if(this.checked){
                var form_builder_type =  $(this).parent().parent().find('.form_builder_type').val();//查找对应的生成类型
                fields.push($(this).val());
                form_builder_types.push(form_builder_type);
            }
        });
        var param = {
            fields:fields,
            form_builder_types:form_builder_types,
            table:table,
            database:database
        };
        var preview_url = "/tool/developer/preview?"+ $.param(param);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览视图',
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:preview_url,
            btn: ['生成','取消'],
            yes: function(index, layero){
                ajax_get_alert_success(preview_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
    });

    $('#btn_list').click(function(){
        var fields = new Array();
        var search_list_types = new Array();
        var table = $('#table').val();
        var database = $('#database').val();
        $("input[name='ids[]']").each(function(){
            if(this.checked){
                var search_list_type = $(this).parent().parent().find('.search_list_type').val();//查找对应的生成类型
                fields.push($(this).val());
                search_list_types.push(search_list_type);
            }
        });
        var param = {
            fields:fields,
            search_list_types:search_list_types,
            table:table,
            database:database
        };
        var list_url = "/tool/developer/create_list?"+$.param(param);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览',
            btn: [],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content:list_url,
            btn: ['生成','取消'],
            yes: function(index, layero){
                // ajax_get_alert_success(list_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
    });

    $('#btn_controller').click(function(){
        var fields = new Array();
        var search_builder_types = new Array();
        var form_builder_types = new Array();
        var table = $('#table').val();
        var database = $('#database').val();
        $("input[name='ids[]']").each(function(){
            if(this.checked){
                var search_builder_type =  $(this).parent().parent().find('.search_builder_type').val();//查找对应的生成类型
                fields.push($(this).val());
                search_builder_types.push(search_builder_type);
                var form_builder_type =  $(this).parent().parent().find('.form_builder_type').val();//查找对应的生成类型
                form_builder_types.push(form_builder_type);
            }
        });
        var param = {
            fields:fields,
            form_builder_types:form_builder_types,
            search_builder_types,search_builder_types,
            table:table,
            database:database
        };
        var controller_url = "/tool/developer/create_controller?"+ $.param(param);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览',
            btn: [],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content:controller_url,
            btn: ['生成','取消'],
            yes: function(index, layero){
                ajax_get_alert_success(controller_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
    });

    $('#btn_model').click(function(){
        var fields = new Array();
        var form_validator_types = new Array();
        var database = $('#database').val();
        var table = $('#table').val();
        $("input[name='ids[]']").each(function(){
            if(this.checked){
                var form_validator_type =  $(this).parent().parent().find('.form_validator_type').val();//查找对应的生成类型
                fields.push($(this).val());
                form_validator_types.push(form_validator_type);
            }
        });
        var param = {
            fields:fields,
            form_validator_types:form_validator_types,
            table:table,
            database:database
        };
        var model_url = "/tool/developer/create_model?="+ $.param(param);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览',
            btn: [],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:model_url,
            btn: ['生成','取消'],
            yes: function(index, layero){
                // ajax_get_alert_success(model_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
    });

    $('#btn_js').click(function(){
        var create_js_url = '/tool/developer/create_js';
        var table = $('#table').val();
        var fields = new Array();
        var form_builder_types = new Array();
        var database = $('#database').val();
        $("input[name='ids[]']").each(function(){
            if(this.checked){
                fields.push($(this).val());
                var form_builder_type =  $(this).parent().parent().find('.form_builder_type').val();//查找对应的生成类型
                form_builder_types.push(form_builder_type);
            }
        });
        var param = {
            fields:fields,
            form_builder_types:form_builder_types,
            table:table,
            database:database
        };
        var js_url = create_js_url+"?"+ $.param(param);
        //  console.log(fields);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览',
            btn: [],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:js_url,
            btn: ['生成','取消'],
            yes: function(index, layero){

                // ajax_get_alert_success(js_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
        //ajax_post(create_js_url,{table:$('#table').val()});
    });

    $('#btn_menu').click(function(){
        var create_js_url = '/tool/developer/create_menu';
        var table = $('#table').val();
        var parent_id = $('#parent_id').val();
        var js_url = create_js_url+"?table="+table+"&parentid="+parent_id;
        //  console.log(fields);
        layer.open({
            type: 2, //iframe
            area: ['1200px', '750px'],
            title: '预览',
            btn: [],
            shadeClose: true,
            shade: 0.3, //遮罩透明度
            content:js_url,
            btn: ['生成','取消'],
            yes: function(index, layero){
                ajax_get_alert_success(js_url,{create_file:1});
            },btn2: function(index, layero){

            }
        });
        //ajax_post(create_js_url,{table:$('#table').val()});
    });

</script>

</body>
</html>
