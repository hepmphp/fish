<?php \app\helpers\AppAsset::run()?>
<script >
    layer.config({
        skin: 'layer-ext-moon',
        extend: 'moon/style.css'
    });
</script>
<style>
    .btn-info{
        background: #0256FF;
    }
    .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info {
        color: #ffffff !important;
        background: #0256FF;
        border-color: #189ec8;
    }

    .my-gallery {
        /*width: 100%;*/
        height:75%;
        /*float: left;*/
    }

    .image_border{
        border: 2px solid rgb(2, 86, 255);

    }
    .my-gallery img {
        width: 80px;
        height: 80px;
        margin-top:10px;
        margin-left: 10px;
    }
    .my-gallery figure {
        display: block;
        float: left;
    }

    .my-gallery figcaption {
        text-align: center;
        margin-top:15px;
        /*display: none;*/
    }
    .image_box {
        width: 100px;
        height: 100px;
        background-color: #f8f8f8;
        margin-left: 10px;
        margin-top: 20px;
        /*border: 10px solid #FFFFFF;*/
    }
    .page-list{
        float: left;
    }
    .page-bottom{
        width: 900px;
    }
</style>
<div class="form-wrapper">
    <div class="form-item">
        <div class="form-item">
            <form class="form-inline clearfix" role="form"  action="#" method="get">
                <div class="form-group">
                    <label class="control-label">用户id：</label>
                    <input placeholder="文本" class="form-control" name="user_id" id="user_id" value="<?=$form['user_id']?>" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">所属分类：</label>
                    <select id="folder_id" name="folder_id" class="form-control">
                        <option value="">请选择</option>
                        <?=$config_folder_id?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">文件名称：</label>
                    <input placeholder="文本" class="form-control" name="name" id="name" value="<?=$form['name']?>" type="text">
                </div>

                <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
                <input class="btn btn-info m-l" value="上传" name="search" type="button" style="width:60px;" onclick="add()">
            </form>
        </div>
    </div>
    <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
        <?php foreach($data['list'] as $k=>$vo){?>

                <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                    <div class="image_box">
                    <a href="javascript:void(0)" data-image="<?=$vo['file']?>" itemprop="contentUrl" data-size="<?=$vo['width']?>x<?=$vo['height']?>" class="image_item">
                        <img src="<?=$vo['file']?>" itemprop="thumbnail" alt="Image description" data-id="<?=$vo['id']?>"/>
                    </a>
                    </div>
                    <figcaption itemprop="caption description"><?=mb_substr($vo['name'],0,8)?></figcaption>

                </figure>

        <?php }?>

    </div>

    <?php \app\helpers\PageWidget::run();?>

</div>

<script>
    function search_list(){
        var search_param= {
            page: 1,
            per_page : 100,
            name:$('#name').val(),
            user_id:$('#user_id').val(),
            folder_id:$('#folder_id').val(),

        };
        console.log(search_param);
        ajax_list(search_param);
    }
</script>
<script src="<?= STATIC_URL ?>js/logic/admin/ajax.js?<?=rand()?>"></script>

<?php include APP_PATH.'views/cms/file/gallery.php'?>
<script>
    $('.image_item').click(function(){
        if( $(this).parent().hasClass('image_border')){
            $(this).parent().removeClass('image_border');
        }else{
            $(this).parent().addClass('image_border');

        }
    });
    var file_urls = {
        create_url:'/api/file/create',
        update_url:'/api/file/update',
        delete_url:'/api/file/delete',
        info_url:'/api/file/info'
    };

    /***
     * 添加
     */
    function add(){
        var url = '/cms/file/create';
        layer_form(url,1,['884px', '342px']);
    }
    /**
     * 修改
     * @param id
     */
    function edit(id) {
        var url = "/cms/file/update?id="+id;
        layer_form(url,2,['884px', '342px']);
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
                ajax_post(file_urls.delete_url,{id:id})
            },
            function(){

            }
        );
    }

    function info($id){
        var url = file_urls.info_url+"?id="+id;
        layer_form(url,1,['900px', '600px']);
    }
    //表单
    function layer_form(url,action,area){
        var content = url;
        var title = action==2?'修改':'添加';
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
                var images  = new Array();
                $.each(body.find('.image-item'),function (i,v){
                    if($(this).attr('src')){
                        images.push($(this).attr('src'));
                    }
                });
                var folder_name =  body.find('#folder_id').find(':selected').text();
                var param ={
                    id:body.find('#id').val(),
                    folder_id:body.find('#folder_id').val(),
                    folder_name:folder_name,
                    file:images.join(',')
                };

                //todo生成js验证
                if(param.id){
                    var url = file_urls.update_url+'?id='+param.id;
                }else{
                    var url = file_urls.create_url;
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
</script>
<?php \app\helpers\AppAsset::run_javascript_end()?>
<script>
    function ajax_list(param){
        var url_param = new URLSearchParams(window.location.search);
        var $_get_param = {
            page: param.page,
            per_page: param.per_page,
            folder_id:url_param.get('folder_id')
        };
        window.location.href = "/cms/file/index?iframe=1&"+$.param($_get_param);
    }
    $('.pagination-outline').html(multi(<?=$data['total']?>, <?=$data['per_page']?>,  <?=$data['page']?>, 100));
</script>

