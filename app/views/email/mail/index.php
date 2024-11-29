<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>邮件列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>
</head>
<body class="form-body">
<div class="form-wrapper">
    <div class="form-item">
        <form class="form-inline clearfix" role="form">
            <input class="btn btn-info m-l" value="发邮件" name="search" type="button" style="width:100px;" onclick="send_mail_form()">
        </form>

    </div>

    <div class="table-wrap">
        <table data-toggle="table" class="table-item table" >
            <thead>
            <tr>
                <th class="col-5">id</th>
                <th class="col-5">收件人</th>
                <th  class="col-5">标题</th>
                <th  class="col-5">发件人</th>
                <th  class="col-5">邮件日期</th>
                <th  class="col-5">邮件大小</th>
                <th  class="col-5">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>

            </tr>
            </tbody>
        </table>
    </div>
    <div class="page-bottom clearfix">
        <div class="pull-right pagination">
<span class="page-list">每页显示
    <span class="btn-group dropup">
            <select class="form-control" id="per_page" onchange="change_page()">
                  <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
        </span>条</span>

            <ul class="pagination pagination-outline">
                <li class="page-pre"><a href="javascript:void(0)">&laquo;</a></li>
                <li class="page-number active"><a href="javascript:void(0)">1</a></li>
                <li class="page-number"><a href="javascript:void(0)">2</a></li>
                <li class="page-next"><a href="javascript:void(0)">&raquo;</a></li>
            </ul>
            <input class="form-control jump-page" id="jump_page" size="2" maxlength="7" type="text"
                   style="width: 40px;">
            <a href="javascript:void(0)" id="jump_page_click" style="margin-right: 10px;" onclick="go_page()">跳转</a>
        </div>
    </div>

</div>

<script>
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
<script>
    /* 分页 */
    function multi(num, perpage,curpage,maxpages) {
        var multipage = '';
        if (num > perpage) {
            var page = 9;
            var offset = 2;
            var realpages = Math.ceil(num/perpage);//总共多少页
            var pages = maxpages && maxpages < realpages ? maxpages : realpages;//最大分页数
            console.log(realpages);
            if (page > pages) {
                var from = 1;
                var to = pages;
            } else {
                from = curpage -offset;//当前页-偏移量
                to = from + page - 1;
                if (from < 1) {//第一页
                    to = curpage + 1 -from;
                    from = 1;
                    if (to - from<page) {
                        to = page;
                    }
                } else if (to > pages) {
                    from = pages - page + 1;
                    to = pages;
                }
            }
            if(curpage===undefined ||curpage.length===0 ||curpage===null||(typeof value === 'string' && value.trim() === '') )
            {
                curpage=1;
            }
            console.log("curpage",curpage)
            multipage += (curpage > 1 ? '<li class="page-pre"><a data-page="'+(curpage-1)+'">上一页</a></li>' : '<li class="page-pre"><a href="javascript:void(0)" data-page="1">上一页</a></li>');
            console.log("from",from)
            console.log("to",to);
            for (i = from; i <= to; i++) {
                multipage += i == curpage ? '<li class="page-number active"><a data-page="'+i+'">'+i+'</a></li>' :'<li class="page-number"><a  data-page="'+i+'">'+i+'</a></li>';
            }
            multipage += (curpage <pages ? '<li class="page-next"><a data-page="'+(curpage + 1)+'">下一页</a></li>' : '');
        }
        return multipage;
    }
</script>

<script>
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page : $('#per_page').val(),
            username: $("#username").val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);

    function ajax_list(param) {
        layer.load(2);
        var template = '<tr><td >[Msgno]</td>' +
            '<td>[to]</td>' +
            '<td>[subject]</td>' +
            '<td>[from]</td>' +
            '<td>[MailDate]</td>' +
            '<td>[Size]</td>' +
            '<td><a onclick="info(\'[Msgno]\')" class="" data-id="[Msgno]">[查看邮件]</a></td>' ;
        var list_html = '';
        $.getJSON('/api/email/mail/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[Msgno\]/g, d.Msgno).
                    replace('[to]', d.to).
                    replace('[subject]', d.subject).
                    replace('[from]', d.from).
                    replace('[MailDate]', d.MailDate).
                    replace('[Size]', d.Size)
                });

                $('table tbody').html(list_html);
                var total_num = data.data.total;
                console.log("total:"+total_num);
                $('.pagination-outline').html(multi(total_num, param.per_page,param.page, 100));
                $(".table").bootstrapTable('resetView');

            } else {
                layer.alert(data.msg);
            }

        });
    }

    function info(mail_id){
        layer.open({
            type: 2, //iframe
            maxmin: true,
            area: ['1400px', '750px'],
            title: "查看邮件详情",
            btn: ['确认','取消'],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content: "/email/mail/info?mail_id="+mail_id,
            yes: function (index, layero) {

            }, btn2: function (index, layero) {

            }
        });
    }

    function send_mail_form(){

        layer.open({
            type: 2, //iframe
            maxmin: true,
            area:['1400px', '750px'] ,
            title: '发送邮件',
            btn: ['确定','取消'],
            shade: 0.3, //遮罩透明度
            shadeClose: true,
            content: '/email/mail/mail_form',
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    to:body.find('#to').val(),
                    subject:body.find('#subject').val(),
                    content:body.find('#content').html()
                };
                var url = '/email/mail/send_mail'
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }









</script>
<?=\app\helpers\AppAsset::run_javascript_end()?>
</body>
</html>
