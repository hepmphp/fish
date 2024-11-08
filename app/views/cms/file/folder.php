<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>
    <link href="<?= STATIC_URL ?>js/photoswipe/photoswipe.css" rel="stylesheet" >
    <link href="<?= STATIC_URL ?>js/photoswipe/default-skin/default-skin.css" rel="stylesheet">

</head>
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
        width: 100%;
        height:75%;
        /*float: left;*/
    }

    .image_border{
        background:rgb(2, 86, 255);
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
        z-index: 999;
        margin-left: 10px;
        margin-top: 20px;
        /*border: 10px solid #FFFFFF;*/
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

<script src="<?= STATIC_URL ?>js/logic/admin/ajax.js?<?=rand()?>"></script>
<script src="<?= STATIC_URL ?>js/photoswipe/photoswipe.min.js" ></script>
<script src="<?= STATIC_URL ?>js/photoswipe/photoswipe-ui-default.min.js" ></script>

<script>
    $('.image_item').click(function(){
        if( $(this).parent().hasClass('image_border')){
            $(this).parent().removeClass('image_border');
        }else{
            $(this).parent().addClass('image_border');

        }
    });
    var urls = {
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
                ajax_post(urls.delete_url,{id:id})
            },
            function(){

            }
        );
    }

    function info($id){
        var url = urls.info_url+"?id="+id;
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
                    var url = urls.update_url+'?id='+param.id;
                }else{
                    var url = urls.create_url
                }
                ajax_post(url,param);

            },btn2: function(index, layero){

            }

        });
    }
</script>
<?php \app\helpers\AppAsset::run_javascript_end()?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>

<script>
    var initPhotoSwipeFromDOM = function(gallerySelector) {
        console.log(gallerySelector);
        // parse slide data (url, title, size ...) from DOM elements
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for(var i = 0; i < numNodes; i++) {

                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes
                if(figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('data-image'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if(figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if(linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if(!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i].nodeType !== 1) {
                    continue;
                }

                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if(index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                }

            };

            // PhotoSwipe opened from URL
            if(fromURL) {
                if(options.galleryPIDs) {
                    // parse real index when custom PIDs are used
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for(var j = 0; j < items.length; j++) {
                        if(items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if( isNaN(options.index) ) {
                return;
            }
            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }
            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };
        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll( gallerySelector );
        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].ondblclick = onThumbnailsClick;
            console.log( galleryElements[i]);
        }
        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
        }
    };
    // execute above function
    initPhotoSwipeFromDOM('.my-gallery');
</script>
</body>
</html>