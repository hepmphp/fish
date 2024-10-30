<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--全局样式-->
    <link href="<?=STATIC_URL?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="<?=STATIC_URL?>/css/font-awesome.min.css" rel="stylesheet">
    <!--表单表格-->
    <link href="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/form.css" rel="stylesheet">
    <!--日期-->
    <link href="<?=STATIC_URL?>/js/date/daterangepicker.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="<?=STATIC_URL?>/css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>/js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>/js/respond.min.js"></script>
    <![endif]-->
</head>

<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-1 control-label" for="title">标题</label>
            <div class="col-sm-4">
                <input id="title" name="title" type="text" value="<?=$form['title']?>" placeholder="标题" class="form-control input-md">
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="cate_id">分类</label>
            <div class="col-sm-4">
                <select id="cate_id" name="cate_id" class="form-control">
                    <option value="">请选择</option>
                    <?=$select_tree?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label" for="tag_ids">标签id  </label>
            <div class="col-sm-4">
                <input id="tag_ids" name="tag_ids" type="text" value="<?=$form['tag_ids']?>" placeholder="标签id  " class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label" for="keywords">关键词</label>
            <div class="col-sm-4">
                <input id="keywords" name="keywords" type="text" value="<?=$form['keywords']?>" placeholder="关键词" class="form-control input-md">
            </div>
        </div>
        <!-- Textarea -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="description">描述</label>
            <div class="col-sm-4">
                <textarea class="form-control" id="description" name="description">default text</textarea>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="is_top">是否置顶</label>
            <div class="col-sm-4">
                <select id="is_top" name="is_top" class="form-control">
                    <option value="">请选择</option>
                    <option value="0" <?=$form['is_top']==0?'selected':''?> >普通</option>
                    <option value="1"  <?=$form['is_top']==1?'selected':''?>  >置顶</option>
                    <option value="2"  <?=$form['is_top']==2?'selected':''?> >头条</option>
                </select>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">列表显示图片：</label>
            <div class="col-sm-4">
             <span>
                 <image src="<?=$form['list_image_url']?>" id="list_image" style="height: 60px;width: 60px;"></image>
                 <input value="<?=$form['list_image_url']?>" name="list_image_url" class="input-md form-control"  type="text" id="list_image_url">
             </span>
            </div>

            <button type="button" class="btnImg btn btn-success" onclick="add_list_image()">浏览</button>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-1 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <option value="0"  <?=$form['status']==0?'selected':''?>>正常</option>
                    <option value="-1"  <?=$form['status']==-1?'selected':''?>>删除</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">内容：</label>
            <div class="col-sm-11">
                <div id="content" name="content">
                    <?=$form['content']?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>js/ckeditor5/build/ckeditor.js?<?=rand()?>"></script>
<script src="<?=STATIC_URL?>js/ckeditor5/build/translations/zh-cn.js"></script>
<script src="<?=STATIC_URL?>js/ckfinder/ckfinder.js?<?=rand()?>"></script>
<script>
    ClassicEditor.create( document.querySelector( '#content' ),{
        toolbar: {
            items: [
                'sourceEditing',
                '|','undo','redo',
                '|','heading',
                '|','findandReplace','alignment','bold','italic','underline','code',
                'horizontalLine','removeformat','link','strikethrough','subscript','superscript','blockQuote','specialCharacters',
                '|','FontSize','FontColor','FontBackgroundColor','FontFamily','highlight',
                '|','numberedList','bulletedList','todoList','outdent','indent','pageBreak',
                '|','insertImage','cKFinder','insertTable','mediaEmbed',

            ],
            shouldNotGroupWhenFull:true,
        },
        mediaEmbed: {
            providers: [
                {
                    name: 'myprovider',
                    url: [
                        /\/media\/(\w+)/,
                        /^.*/
                    ],
                    html: match => {
                        //获取媒体url
                        const input = match['input'];
                        console.log('input' + match['input']);
                        return (
                            '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 70%;">' +
                            `<iframe src="http://${input}" ` +
                            'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                            'frameborder="0" allowtransparency="true" allow="encrypted-media">' +
                            '</iframe>' +
                            '</div>'
                        );
                    }
                }
            ]
        },
        ckfinder: {
            uploadUrl: 'http://127.0.0.1:2222/ckfinder/file/index?command=QuickUpload&type=Files&responseType=json',
        },
        //设置字体
        fontFamily: {
            options: [
                'default',
                'Blackoak Std',
                '宋体,SimSun',
                '新宋体,NSimSun',
                '微软雅黑,Microsoft YaHei',
                '楷体_GB2312,KaiTi_GB2312',
                '隶书,LiSu',
                '幼园,YouYuan',
                '华文细黑,STXihei',
            ]
        },
        image: {
            styles: [
                'full','alignLeft', 'alignCenter', 'alignRight'
            ],
            resizeOptions: [
                {
                    name: 'resizeImage:原尺寸',
                    label: '原尺寸',
                    value: null
                },
                {
                    name: 'resizeImage:25',
                    label: '25%',
                    value: '25'
                },
                {
                    name: 'resizeImage:50',
                    label: '50%',
                    value: '50'
                },
                {
                    name: 'resizeImage:75',
                    label: '75%',
                    value: '75'
                }
            ],
            toolbar: [
                // 'imageStyle:full',
                // 'imageStyle:side',
                'imageStyle:alignLeft',
                'imageStyle:alignCenter',
                'imageStyle:alignRight',
                '|',
                'resizeImage',
                '|',
                'toggleImageCaption',
                'imageTextAlternative',
                'linkImage'
            ],

        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        },
        language: 'zh-cn'
    } )
        .then( editor => {

            // editor.ui.view.editable.element.style.minHeight = '500px';
            window.editor = editor;
            editor.model.document.on('change:data', () => {
                if($('#ckf-modal-close').text()!==''){
                    $('#ckf-modal-close')[0].click();
                }
            });

        } )
        .catch( error => {
            console.error( 'There was a problem initializing the editor.', error );
        } );
    document.querySelectorAll('oembed[url]' ).forEach( element => {
        const videoLable = document.createElement( 'video' );
        videoLable.setAttribute( 'src', element.getAttribute( 'url' ) );
        videoLable.setAttribute( 'controls', 'controls' );
        videoLable.setAttribute( 'style', ' width: 100%;height: 100%; ' );
        element.appendChild( videoLable);
    } );

    function add_list_image(){
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    $('#list_image_url').val(file.getUrl());
                    $('#list_image').attr('src',file.getUrl()).show();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    // var output = $( '#list_image_url' );
                    // output.value = evt.data.resizedUrl;
                    $('#list_image_url').val(file.resizedUrl());
                    $('#list_image').attr('src',file.resizedUrl()).show();
                } );
            }
        } );
    }

</script>

</body>
<!-- 全局js -->
<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>js/bootstrap.min.js"></script>
<!-- Bootstrap table -->
<script src="<?=STATIC_URL?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?=STATIC_URL?>js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
</html>