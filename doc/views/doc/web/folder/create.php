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
    <script  src="http://127.0.0.1/static/doc/jquery.min.js?1633167148"></script>
    <link href="http://127.0.0.1/static/admin/css/bootstrap.min.css?1725255454" rel="stylesheet">
    <link href="http://127.0.0.1/static/admin/js/bootstrap-table/bootstrap-table.min.css?418103589" rel="stylesheet">
    <link href="http://127.0.0.1/static/admin/css/form.css?1095491078" rel="stylesheet">
</head>
<style>
    .w_400{
        width: 400px;
        margin-top: 10px;
    }
</style>
<body>
<div class="container col-sm-12" >
    <div class="form-horizontal" style="margin: 0 auto;width: 500px;">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <input type="hidden" id="parent_id" value="<?=$form['parent_id']?>">
        <div class="form-inline">
        <div class="form-group w_400">
            <label class="col-sm-4 control-label" for="name">目录名称</label>
            <div class="col-sm-4 ">
                <input id="name" name="name" type="text" value="<?=$form['name']?>" placeholder="目录名称" class="form-control input-md " style="width: 200px;">
            </div>
        </div>
        </div>
        <div class="form-inline">
        <!-- Select Basic -->
        <div class="form-group w_400">
            <label class="col-sm-4 control-label" for="parentid">父类id</label>
            <div class="col-sm-4 w_300">
                <select id="parentid" name="parentid" class="form-control">
                    <option value="">请选择</option>
                    <?php if(!empty($form['select_tree'])){
                            foreach ($form['select_tree'] as $k=>$v){?>
                                <option value="<?=$v['id']?>"><?=$v['name']?></option>
                    <?php }
                        }
                    ?>
                </select>
            </div>
        </div>
        </div>
        <div class="form-inline">
            <!-- Select Basic -->
            <div class="form-group w_400">
                <label class="col-sm-4 control-label" for="status">状态</label>
                <div class="col-sm-4 ">
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
        </div>


    </div>
</div>

</body>
<script  src="http://127.0.0.1/static/admin/js/bootstrap-table/bootstrap-table.min.js?1435768043"></script>
<script  src="http://127.0.0.1/static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js?421764799"></script>
<script  src="http://127.0.0.1/static/admin/js/table-demo.js?1443085742"></script>
</html>