<html>
<head>
    <link rel="stylesheet" href="<?=STATIC_URL?>org_chart/dist/css/jquery.orgchart.css">
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>org_chart/dist/js/jquery.orgchart.js"></script>
</head>
<script >
    layer.config({
        skin: 'layer-ext-moon',
        extend: 'moon/style.css'
    });
</script>
<body>
<style>
    html,body{width:100%;height:100%;margin:0;padding:0;overflow:hidden;}
    body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.428571429;color:#333333;}
    *,*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
    #chart-container{overflow-x:auto;position:relative;margin-bottom:-120px;height:100%;text-align:center;}
    .chart-switch{position:absolute;top:60px;right:30px;z-index:1111;}
    /* styles of background map */
    .backgroundMap{position:absolute;opacity:0.3;}
    .map-stroke{fill:none;}
    .map-fill{fill:#fff;}
    .map-land{fill:#90bbfd;}
    .map-boundary{fill:none;stroke:#fff;}
    .mask{position:absolute;top:0px;right:0px;bottom:0px;left:0px;z-index:9999;text-align:center;background-color:#000;opacity:0.3;}
    .mask p{position:absolute;top:40%;left:45%;color:#fff;font-size:24px;}
    /* 上下文菜单的样式 */
    .context-menu {
        display: none;
        position: absolute;
        z-index: 1000;
        border: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .context-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .context-menu li {
        padding: 8px 12px;
        cursor: pointer;
    }
    .context-menu li:hover {
        background-color: #eee;
    }
</style>
<div id="context-menu" class="context-menu"> <!-- 上下文菜单的容器 -->

</div>
<div style="width:500px;margin: 0 auto;">
    <input type="text" id="search-input" placeholder="Search...">
    <input type="button" value="搜索" id="btn-search">
    <?php if(isset($_GET['direction'])){
        $direction = $_GET['direction']=='t2b'?'l2r':'t2b';
        ?>
    <input type="button" value="树形结构方向切换" id="btn_node_lr" onclick="toggleDirection('<?=$direction?>')">
    <?php }else{?>
        <input type="button" value="树形结构方向切换" id="btn_node_lr" onclick="toggleDirection('l2r')">
    <?php }?>
    <input type="button" value="树形结构重置" id="btn_node" onclick="node_reset()">
</div>
<div id="chart-container"></div>
<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>
<script>

    var urls = {
        create_url:'/doc.php/api/user_structure/create',
        update_url:'/doc.php/api/user_structure/update',
        delete_url:'/doc.php/api/user_structure/delete',
        info_url:'/doc.php/api/user_structure/info'
    };

    $("#chart-container").delegate(".bottomEdge","click",function(){
        // $('.image').eq(1).parent().parent().removeClass("left_width_500");
        // $('.image').eq(1).parent().parent().addClass("left_width_500_reset");
    });
    // 构建层级数据的辅助函数
    function buildHierarchicalData(flatData) {
        var map = {};
        var roots = [];
        var tmp_item = {};
        flatData.forEach(function(item) {
            tmp_item.id = item.id;
            tmp_item.name = item.name;
            tmp_item.title = item.title;
            tmp_item.image = item.image;
            map[item.id] = { ...tmp_item, 'children': [] };
        });

        flatData.forEach(function(item) {
            var parent = map[item.parentid];
            if (parent) {
                console.log(map[item.id])
                parent.children.push(map[item.id]);
            } else {
                console.log(map[item.id])
                roots.push(map[item.id]);
            }
        });

        return roots;
    }
    var datascource = buildHierarchicalData(<?=$tree_list?>);
    var  direction = '<?php if(isset($_GET['direction'])){ if(empty($_GET['direction'])){$_GET['direction']='t2b';}echo "{$_GET['direction']}";}?>';
    var chart = $('#chart-container').orgchart({
        'data' : datascource[0], //数据
        'nodeContent': 'title', //内容对应的字段
        theme: 'modern',
        enableSearch: true,
        'nodeTemplate': function(data) {
            // 自定义节点模板，这里可以添加更多的自定义内容
            return `
                        <div class="image" data-id="${data.id}">
                            <img src="${data.image}" alt="${data.name}" />
                            <div class="title">${data.name}</div>
                            <div class="content">${data.title}</div>
                        </div>
                    `;
        },
        'exportFilename': 'MyOrgChart', // 可选：导出文件的默认名称
        'exportFileextension': '.png', // 可选：导出文件的扩展名
        'pan': true, // 可选：启用平移
        'zoom': true, // 可选：启用缩放
        'draggable': true ,// 可选：启用拖拽
        'direction': direction

    });
    function node_reset(){
        window.location.href = '/doc.php/web/user_structure/tree';
    }
    function toggleDirection(direction) {
        window.location.href = '/doc.php/web/user_structure/tree?direction='+direction;
    }
    // 监听搜索输入的变化（可选）
    $('#btn-search').click(function () {
        search_node();
    });
    $('#search-input').on('input', function() {
        search_node();
        // 可能需要调整OrgChart的布局以适应隐藏的节点
        // chart.repaint(); // 注意：repaint方法可能不是OrgChart.js的标准API，具体取决于库的实现
    });
    function search_node(){
        var searchText = $('#search-input').val().toLowerCase();
        if(searchText==''){
            window.location.reload();
        }
        chart.$chartContainer.find('.node').each(function() {
            var $node = $(this);
            var   nodeName = "  "+$node.find('.title').text().toLowerCase();
            nodeName = nodeName+$node.find('.content').text().toLowerCase();
            console.log(nodeName,nodeName.indexOf(searchText) !== -1)
            if (nodeName.indexOf(searchText) !== -1) {
                $node.show();
            } else {
                $node.hide();
                $('*').css('border', 'none');
            }
        });
    }



    $('#btn_node_lr').click(function () {

    });

    // 上下文菜单的变量
    var contextMenu = $('#context-menu');
    var menuVisible = false;

    // 禁用默认的右键菜单
    $(document).on('contextmenu', function(e) {
        e.preventDefault();
    });

    // 为 OrgChart.js 的节点添加右键点击事件
    $('#chart-container').on('contextmenu', '.node', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log($(this).find('.image').data('id'));
        var node_id = $(this).find('.image').data('id');
        console.log("node_id:"+node_id);
        var tpl_context_menu = `
        <ul>
        <li onclick="handleMenuItemClick('[id]',function (id){return add(id);})">添加结点</li>
        <li onclick="handleMenuItemClick('[id]',function (id){return update(id);})">修改结点</li>
        <li onclick="handleMenuItemClick('[id]',function (id){return del(id);})">删除结点</li>
    </ul>
        `;
        context_menu = tpl_context_menu.replace(/\[id\]/g,node_id)
        $('#context-menu').html(context_menu);
        // 显示上下文菜单
        contextMenu.css({
            top: e.pageY + 'px',
            left: e.pageX + 'px'
        }).show();

        menuVisible = true;

        // 点击文档其他地方时隐藏菜单
        $(document).one('click', function() {
            if (menuVisible) {
                contextMenu.hide();
                menuVisible = false;
            }
        });
    });

    // 处理菜单项点击事件
    function handleMenuItemClick(option,action) {
        console.log('You clicked: ' + option);
        // 在这里添加您的自定义逻辑
        action(option);
        // 隐藏上下文菜单
        contextMenu.hide();
        menuVisible = false;
    }

    /***
     * 添加
     */
    function add(id){
        var url = '/doc.php/web/user_structure/create?id='+id;
        layer_form(url,1,['900px', '600px']);
    }
    /**
     * 修改
     * @param id
     */
    function update(id) {
        var url = "/doc.php/web/user_structure/update?id="+id;
        layer_form(url,2,['900px', '600px']);
    }

    /***
     * * @param id
     */
    function del(id) {
        layer.confirm('确定要删除?',{
                btn: ['确定','取消'], //按钮
                icon: 3,
                title:'提示'
            }, function(){
                ajax_post(urls.delete_url,{id:id})
            },
            function(){

            }
        );
    }
    function tree_view(){
        tree_layer_form("/doc.php/web/user_structure/tree");
    }
    function tree_layer_form(url){
        var layer_index = layer.open({
            type: 2, //iframe
            area: ['500px', '560px'],
            title: '查看树形结构',
            btn: [],
            shade: 0.3, //遮罩透明度
            content:url,
            yes: function(index, layero){
            },btn2: function(index, layero){

            }
        });
        layer.full(layer_index);
    }
    function info($id){
        var url = urls.info_url+"?id="+id;
        layer_form(url,1,['900px', '600px']);
    }
    //表单
    function layer_form(url,action,area){
        var content = url;
        var title = action==2?'添加':'修改';
        var btn =  action==2?['确认修改','取消']:['确认添加','取消'];
        layer.open({
            type: 2, //iframe
            maxmin: true,
            area:area ,
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content:content,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={

                    id:body.find('#id').val(),
                    name:body.find('#name').val(),
                    avator:body.find('.image-item').eq(0).attr('src'),
                    parentid:body.find('#parentid').val(),
                    parent_name:body.find('#parentid').find("option:selected").text(),
                    status:body.find('#status').val(),
                    title:body.find('#title').val(),
                    level:body.find('#level').val()

                };
                var action = body.find('#action').val();
                if(action=='create'){
                    param.id = 0;
                }
                //todo生成js验证
                if(param.id>0){
                    var url = urls.update_url;
                }else{
                    var url = urls.create_url
                }
                console.log(action);
                console.log(param);
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
</script>
</body>
</html>