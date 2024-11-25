<html>
<head>
</head>
<?php \app\helpers\AppAsset::run()?>
<script >
    layer.config({
        skin: 'layer-ext-moon',
        extend: 'moon/style.css'
    });
</script>
<body>

    <div class="form-item" style="height:100px;margin-top: 30px;">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
            <div class="form-group">
                <label class="control-label">主机：</label>
                <input type="text" value="172.18.0.2" id="host">
            </div>
            <div class="form-group">
                <label class="control-label">端口：</label>
                <input type="text" value="6379" id="port">
            </div>
            <div class="form-group">
                <label class="control-label">密码：</label>
                <input type="password" value="" id="password">
            </div>
            <a  class="btn btn-info m-l" id="btn-submit">连接redis</a>
            <input class="btn btn-info m-l"  name="search" type="button" style="width:200px;" id="btn-info" value="redis服务器信息">
        </form>
    </div>
    <div >
        <div class="col-sm-1">
        <select id="db" name="db" class="form-control" style="float: left">
            <?php for($i=0;$i<=16;$i++){?><option value="<?=$i?>" <?php if('string'==$form['db']){ echo "selected";}?>>数据库[db<?=$i?>]
                </option>
            <?php }?>
          </select>
        </div>
        <div class="col-sm-1">

            <select id="data_type" name="data_type" class="form-control">
                <option value="string" <?php if('string'==$form['data_type']){ echo "selected";}?>>String（字符串）</option>
                <option value="list" <?php if('list'==$form['data_type']){ echo "selected";}?>>List（列表）</option>
                <option value="set" <?php if('set'==$form['data_type']){ echo "selected";}?>>Set（集合）</option>
                <option value="hash" <?php if('hash'==$form['data_type']){ echo "selected";}?>>Hash（散列）</option>
                <option value="zset" <?php if('zset'==$form['data_type']){ echo "selected";}?>>Zset（有序集合）</option>
            </select>
        </div>
        <div class="col-sm-1">
            <div style="display:block;width:300px;float: left">
                <span>键名：</span><input type="text" value="" id="redis_key"> <input type="button" id="btn-redis-query" value="查询">
            </div>
        </div>
    </div>

    <div class="form-wrapper" style="margin-top: 50px;">
        <div class="table-wrap">
            <table  data-toggle="table" class="table-item table">
                <thead>

                </thead>
                <tbody>
                <tr><td>序号</td><td>键名</td></tr>
                <?php foreach ($all_keys as $k=>$v){?>
                    <tr>
                        <td><?=$k?></td><td><?=$v?></td>
                    </tr>
                <?php }?>

                </tbody>
            </table>
        </div>

    </div>




</body>
<script>
    $('#btn-redis-query').click(function (){
        redis_edit();
    });
    function redis_edit(){
        var url = '/cloud/server_manager/redis_edit?';
        var host = $('#host').val();
        var port =$('#port').val();
        var password = $('#password').val();
        var db = $('#db').val();
        var redis_key = $('#redis_key').val();
        var data_type = $('#data_type').val();
        var param = {
            host:host,
            port:port,
            password:password,
            db:db,
            redis_key:redis_key,
            data_type:data_type
        };
        var layer_index = layer.open({
            type: 2, //iframe
            maxmin: true,
            area:['900px', '600px'] ,
            title: 'reids服务器信息'+host,
            btn:['确认','取消'],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:url+$.param(param),
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    host:body.find('#host').val(),
                    port:body.find('#port').val(),
                    password:body.find('#password').val(),
                    db:body.find('#db').val(),
                    data_type:body.find('#data_type').val(),
                    redis_key:body.find('#redis_key').val(),
                    redis_value:body.find('#redis_value').val()
                };
                var url =  '/cloud/server_manager/redis_update';
                ajax_post(url,param);

            },btn2: function(index, layero){

            }
        });
        //layer.full(layer_index);
        // layer_form(url,1,['900px', '600px']);
    }
    $('#btn-info').click(function (){
        redis_info();
    });
    function redis_info(){
        var url = '/cloud/server_manager/redis_info?';
        var host = $('#host').val();
        var port =$('#port').val();
        var password = $('#password').val();
        var db = $('#db').val();
        var param = {
            host:host,
            port:port,
            password:password,
            db:db
        };
        var layer_index = layer.open({
            type: 2, //iframe
            maxmin: true,
            area:['900px', '600px'] ,
            title: 'reids服务器信息'+host,
            btn: [],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:url+$.param(param),
        });
        //layer.full(layer_index);
        // layer_form(url,1,['900px', '600px']);
    }
</script>
</html>