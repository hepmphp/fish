<style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    .pagination{
        width: 900px;
    }
    .pagination-outline{
        width: 600px;
    }

</style>
<div class="page-bottom clearfix">
    <div class=" pagination">
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
<script>
    const url_params = new URLSearchParams(window.location.search);
    const id = url_params.get('id');
    // function ajax_list(param){
    //     console.log(window.location.search);
    //     console.log(url_params);
    //     window.location.href = window.location.href+'&'+$.param(param);
    // }
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