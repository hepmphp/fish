<link href="<?=STATIC_URL?>js/layer/layui/layui.css" rel="stylesheet">

<style>
    .layui-fixbar {
        position: fixed;
        right:40%;
        bottom: 15px;
        z-index: 999999;
    }
    .layui-fixbar .layui-fixbar-top {
        display: none;
        font-size: 40px;
    }
    .layui-fixbar a {
        width: 150px;
        height: 50px;
        line-height: 50px;
        margin-bottom: 1px;
        text-align: center;
        cursor: pointer;
        font-size: 14px;
        background-color: #000000;
        color: #fff;
        border-radius: 2px;
        opacity: .95;
    }


</style>
<ul class="layui-fixbar"><a id="debug_tool" class="layui-icon layui-fixbar-top" lay-type="top" style="display:block">debug</a></ul>

<?php
$url =  'http://'.$_SERVER['HTTP_HOST'].'/tool/log/index?iframe=1&file_name=debug/'.date("Y/m/d").'/debug.log';
?>
<script>
    // $('html').on('contextmenu', function(e) {
    //     e.preventDefault(); // 阻止默认的右键点击菜单
    //     // 你可以在这里添加你的逻辑
    //     $('#debug_tool').show();
    //     $('#debug_tool').trigger('click');
    // });

    $('#debug_tool').click(function (){
        layer.open({
            type: 2,
            title: '调试窗口',
            shadeClose: true,
            shade: 0.8,
            area: ['800px', '600px'],
            content: '<?=$url?>' //iframe的url
        });
    });

</script>