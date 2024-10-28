<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – classic editor build – development sample</title>
    <style>
        body {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<h1>CKEditor 5 – classic editor build – development sample</h1>

<div id="editor" name="editor">

</div>

<script src="<?=STATIC_URL?>js/ckeditor5/ckeditor.js"></script>
<script src="<?=STATIC_URL?>js/ckeditor5/translations/zh-cn.js"></script>
<script src="<?=STATIC_URL?>js/ckfinder/ckfinder.js"></script>
<script>
    ClassicEditor.create( document.querySelector( '#editor' ),{
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
            window.editor = editor;
        } )
        .catch( error => {
            console.error( 'There was a problem initializing the editor.', error );
        } );

</script>

</body>
</html>
