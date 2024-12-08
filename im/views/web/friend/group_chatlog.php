

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>聊天记录</title>

    <link rel="stylesheet" href="<?=STATIC_URL?>layim2/dist/css/layui.css">
    <link rel="stylesheet" href="<?=SITE_URL?>static/im/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=SITE_URL?>static/im/css/style.css">
    <style>
        body .layim-chat-main{height: auto;}
    </style>
</head>
<body>

<div class="layim-chat-main">
    <ul id="LAY_view">
        <?php foreach ($data['list'] as $k=>$v){?>
        <li>
            <div class="layim-chat-user">
                <img src="<?php echo (isset($v['avatar_url'])?$v['avatar_url']:'')?>"><cite><?=$v['from_username']?><i><?=date('Y-m-d H:i:s',$v['create_time'])?></i></cite>
            </div>
            <div class="layim-chat-text">
                <?=$v['content']?>
            </div>
        </li>
        <?php }?>
    </ul>

</div>
<div class="page-bottom clearfix">
    <div class=" pagination">
        <ul class="pagination pagination-outline">

            <?php
            $pre_has_show = true;
            $next_has_show = true;
            $i = 0;
            for($i=1;$i<=$data['total_page'];$i++){?>
                <?php if($pre_has_show){$pre_has_show = false;?>
                    <li class="page-pre"><a href="javascript:void(0)" data-id="">&laquo;</a></li>
                <?php }?>
                <?php if($i<=10){ ?>
                    <li class="page-number <?php if($i==$data['page']){echo 'active';}?>" ><a data-page="<?=$i?>" href="javascript:void(0)" ><?=$i?></a></li>
                    <?php if($i==$data['total_page'] && $next_has_show){$next_has_show = false;?>
                        <li class="page-next"><a href="javascript:void(0)" data-page="<?=($data['page']+1)?>">&raquo;</a></li>
                    <?php }?>
                <?php }?>
            <?php }?>
            <span class="page-list">每页显示
                <span class="btn-group dropup">
                        <select class="form-control" id="per_page" onchange="change_page()">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </select>
                </span>条</span>
            <div class="div_right">
                <a href="javascript:void(0)" id="jump_page_click" style="margin-right: 10px;" onclick="go_page()">跳转</a>
                <input class="form-control jump-page" id="jump_page" size="2" maxlength="7" type="text"
                       style="width: 40px;">

            </div>
        </ul>
    </div>
</div>
<style>
    .pagination{
        width: 900px;
        margin-top: 20px;
        margin-bottom: 0;
    }
    .pagination-outline{
        margin-left: 30px;
    }

    .page-list{
        float: left;
    }
    .div_right{
        float: left;
        width: 90px;
    }
    #jump_page_click{
        float: right;
        margin-top: 8px;
    }
    .page-bottom{
        margin-top: -30px;
        margin-bottom: 0;
        text-align: center;
        border-bottom: 1px dotted #e2e2e2;
    }

    .layim-msgbox{
        margin-top: 15px;
    }

</style>


<script src="<?=STATIC_URL?>layim2/dist/layui.js"></script>
<script src="<?=STATIC_URL?>layim2/dist/lay/modules/layim.js"></script>

<script src="<?= STATIC_URL ?>/js/jquery.min.js?<?=rand()?>"></script>
<script>
    function ajax_list(param){
        ///friend/chatlog?id=2&type=friend
        param.type = "group";
        param.id = "<?=(isset($form['id'])?$form['id']:0);?>"
        window.location.href = '/im.php/web/friend/chatlog?'+$.param(param);
    }
    $(".pagination-outline").delegate('a', 'click', function () {
        console.log('pagination-outline');
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        //console.log($(this).find('li').addClass('c'));
        var page = $(this).data('page');
        var param = {
            page: page,
            per_page: $('#per_page').val(),
        };
        ajax_list(param);
    });
    $(document).ready(function () {
        window.go_page =function go_page() {
            var page = $('#jump_page').val();
            var per_page = $('#per_page').val();
            var param = {
                page: page,
                per_page: per_page,
            };
            ajax_list(param);
        }

        $("#jump_page").keydown(function (e) {
            var curKey = e.which;
            console.log(curKey);
            if (curKey == 13) {
                $('#jump_page_click').trigger('click');
            }
        });


        window.change_page =function change_page() {
            var per_page = $('#per_page').val();
            var param = {
                page: 1,
                per_page: per_page,
            };
            ajax_list(param);
        }
    });

</script>
</body>
</html>
