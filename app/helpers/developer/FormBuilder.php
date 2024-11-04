<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xiaoming
 * Date: 18-1-14
 * Time: 下午11:21
 * To change this template use File | Settings | File Templates.
 */

namespace app\helpers\developer;

/***
 * 表单生成
 * Class FormBuilder
 * @package app\helpers
 */
class FormBuilder {

    public static function get_config_form_builder_type(){
        $config = array(
            'text_input'=>'1.普通文本',
            'password_input'=>'2.密码',
            'textarea_input'=>'3.文本框',
            'select_input'=>'4.下拉框',
            'multi_radio'=>'5.单选框',
            'mutil_checkbox'=>'6.复选框',
            'date_time'=>'7.时间',
            'date'=>'8.日期',
            'image'=>'9.单图上传',
            'image_mutil'=>'10.多图上传',
            'text_rich'=>'11.富文本',
            'text_multi_select'=>'12.文本多选',
            'text_search'=>'13.下拉搜索',
            'select_tree'=>'14.树形菜单',
            'image_priview'=>'15.单图预览上传',
            'image_mutil_priview'=>'16.多图预览上传',


        );
        return $config;
    }

    /**
     * 普通文本框
     * @param $field
     * @param $name
     * @return mixed
     */
    public static  function text_input($field,$name){
        $input = <<<EOT
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
          <input id="[field]" name="[field]" type="text" value="<?=\$form['[field]']?>" placeholder="[name]" class="form-control input-md">
          </div>
       </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }


    /**
     * 下拉搜索
     * @param $field
     * @param $name
     * @return mixed
     */
    public static  function text_search($field,$name){
        $input = <<<EOT
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
          <input id="[field]" name="[field]" type="text" value="<?=\$form['[field]']?>" placeholder="[name]" class="form-control input-md">
          </div>
       </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }

    public static function text_multi_select($field,$name){
        $input = <<<EOT
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
           <select class="form-control " style="width:500px"  id="[field]" name="[field][]" multiple="multiple"></select>
          </div>
       </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }

    /**
     * 密码框
     * @param $field
     * @param $name
     * @return mixed
     */
    public static function password_input($field,$name){
        $input = <<<EOT
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
          <input id="[field]" name="[field]" type="password" value="<?=\$form['[field]']?>" placeholder="[name]" class="form-control input-md">
          </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }

    /**
     * 文本
     * @param $field
     * @param $name
     * @return mixed
     */
    public static function textarea_input($field,$name){
        $input = <<<EOT
        <!-- Textarea -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
            <textarea class="form-control" id="[field]" name="[field]"><?=\$form['[field]']?></textarea>
          </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }

    /**
     * 下拉框
     * @param $field
     * @param $name
     * @return mixed
     */
    public static function select_input($field,$name){
        $input = <<<EOT
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
            <select id="[field]" name="[field]" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach(\$config_[field] as \$k=>\$vo){
                        ?>
                        <option value="<?=\$vo['id']?>" <?php if(\$vo['id']==\$form['[field]'] && is_numeric(\$vo['id'])){ echo "selected";}?>><?=\$vo['name']?></option>
                    <?php }?>
            </select>
          </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }


    public static function select_tree($field,$name){
        $input = <<<EOT
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="[field]">[name]</label>
          <div class="col-sm-4">
            <select id="[field]" name="[field]" class="form-control">
              <option value="">请选择</option>
                <?=\$select_tree?>
            </select>
          </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }

    /**
     * 多选框
     * @param $field
     * @param $name
     * @param $items
     * @param int $is_inline
     * @return mixed
     */
    public static function multi_radio($field,$name,$items,$is_inline=1){
        $input = <<<EOT
<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-sm-4 control-label" for="[field]">[name]</label>
   <div class="col-sm-4">
    [items]
  </div>
</div>
EOT;
        $item_html = <<<EOT
  <label class="[radio-inline]" for="[field]-[i]">
      <input type="radio" name="[field]" id="[field]-[i]" value="[i]">
      [v]
    </label>
EOT;
        if($is_inline==1){
            $item_html = str_replace('[radio-inline]','radio-inline',$item_html);
        }else{
            $item_html = str_replace('[radio-inline]','',$item_html);
        }
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        $item_html = str_replace(array('[field]'),array($field),$item_html);
        $items_html = '';
        foreach($items as $k=>$it){

            $items_html .= str_replace(array('[i]','[v]'),array($k,$it['name']),$item_html);
        }

        $input = str_replace('[items]',$items_html,$input);
        return $input;
    }

    /**
     * 多选框
     * @param $field
     * @param $name
     * @param $items
     * @param int $is_inline
     * @return mixed
     */
    public static function mutil_checkbox($field,$name,$items,$is_inline=1){
        $input = <<<EOT
<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-sm-4 control-label" for="[field]">[name]</label>
  <div class="col-sm-4">
  [items]
  </div>
</div>

EOT;
        $item_html = <<<EOT
   <label class="[checkbox-inline]" for="[field]-[i]">
      <input type="checkbox" name="[field]" id="[field]-[i]" value="[i]">
      [v]
    </label>
EOT;
        if($is_inline==1){
            $item_html = str_replace('[checkbox-inline]','checkbox-inline',$item_html);
        }else{
            $item_html = str_replace('[checkbox-inline]','',$item_html);
        }
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        $item_html = str_replace(array('[field]'),array($field),$item_html);
        $items_html = '';
        foreach($items as $k=>$it){

            $items_html .= str_replace(array('[i]','[v]'),array($k,$it['name']),$item_html);
        }

        $input = str_replace('[items]',$items_html,$input);
        return $input;
    }

    public static function date_time($field,$name){
        $input = <<<EOT
       <div class="form-group">
		<label class="control-label col-sm-4">[name]：</label>
		  <div class="col-sm-4">
		<input placeholder="[name]" class="form-control date-range-[field] date-ico form-date-time" name="[field]" id="[field]"  type="text" value="<?php if(!empty(\$form['[field]'])){echo date('Y-m-d H:i:s',\$form['[field]']);}?>">
		</div>
	   </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }

    public static function date($field,$name){
        $input = <<<EOT
       <div class="form-group">
		<label class="control-label col-sm-4">[name]：</label>
		  <div class="col-sm-4">
		<input placeholder="[name]" class="form-control date-range-[field] date-ico  form-date" name="[field]" id="[field]"  type="text" value="<?php if(!empty(\$form['[field]'])){echo date('Y-m-d H:i:s',\$form['[field]']);}?>">
		</div>
	   </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;
    }

    public static function image($field,$name){
        $input = <<<EOT
            <div class="form-group">
            <label class="col-sm-4 control-label">[name]：</label>
            <form name="image_form_[field]" id="image_form_[field]" action="?r=api/upload-single/index" method="post" enctype="multipart/form-data" target="imageFrame">
               <input type="hidden" name="form_name" value="image_form_[field]">
              <div class="col-sm-4">
                <input value="<?=\$form['[field]']?>" name="[field]" class="imgPath form-control" type="text" id="[field]">
              </div>
               <button type="button" class="btnImg btn btn-success">浏览</button>
               <input name="submitImg" id="submitImg" class="submitImg" style="display:none" type="file" accept=".jpg,.png,.gif,.jpeg">
               <iframe width="0" height="0" id="imageFrame" name="imageFrame" frameborder="0" scrolling="no"></iframe>
            </form>
            </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }

    /**
     * 富文本编辑器
     * @param $field  字段
     * @param $name   字段名
     * @return mixed
     */
    public static function text_rich($field,$name){
        $input = <<<EOT
      <div class="form-group">
     <label class="col-sm-4 control-label">[name]：</label>
       <div class="col-sm-4">
        <script type="text/plain" name="[field]" id="[field]" value="" style="width:100%;height: 400px;"></script>

        <style>
        /*设置按扭样式*/
        .edui-icon-test{
            background-position: -380px 0;
        }
        </style>
        <script>
            var um = UM.getEditor('content',{
                toolbar: [
                    'source | undo redo | bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
                    'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize' ,
                    '| justifyleft justifycenter justifyright justifyjustify |',
                    'link unlink | emotion image video  | map',
                    '| horizontal print preview fullscreen', 'drafts', 'formula','test'
                ]
            });
            um.ready(function() {
                //设置编辑器的内容
                um.setContent("<?=addslashes(\$form['content'])?>");
                $('.edui-container').width("900px");
                $('.edui-body-container').width("900px");
            });
            UM.registerUI('test',
                function(name) {
                    var me = this;
                    var \$btn = $.eduibutton({
                        icon : name,
                        click : function(){

                            layer.open({
                                type: 2, //iframe
                                area: ['900px', '560px'],
                                title: '选择图片',
                                btn: ['确认','取消'],
                                shade: 0.3, //遮罩透明度
                                content:'http://yiiadmin.local/?r=cms/attach/index&iframe=1',
                                yes: function(index, layero){

                                    var body = layer.getChildFrame('body', index);

                                    var image_list = '<p><img src="[src]" _src="[src]" ></p>'+"\n";
                                    var html_image_list = '';
                                    body.find('.image_border').each(function(){
                                        html_image_list = html_image_list+image_list.replace('[src]',$(this).attr('src')).replace('[_src]',$(this).attr('_src'));
                                        //attach_urls.push($(this).attr('src'));
                                    });

                                    $('#content').append(html_image_list);
                                    layero.close();
                                    console.log("checked...");
//                                            ajax_post(url,param);
                                },btn2: function(index, layero){

                                }
                                // content:"{:U('Serverpolicy/add')}" //iframe的url
                            });
                        },
                        title: '相册插入图片'
                    });

                    this.addListener('selectionchange',function(){
                        //切换为不可编辑时，把自己变灰
                        var state = this.queryCommandState(name);
                       \$btn.edui().disabled(state == -1).active(state == 1)
                    });
                    return \$btn;
                }
            );
        </script>
      </div>
     </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }

    /**
     *
     * 单图预览上传
     * @param $field
     * @param $name
     * @return mixed
     */
    public static function image_priview($field,$name){
        $input = <<<EOT
         <div class="form-group">
            <label class="col-sm-4 control-label">[name]：</label>
            <div class="col-sm-8">
                <div class="clear-float">
                    <form class="upload-win clear-float" enctype="multipart/form-data">
                        <div class="upload-img upload-img-one left">
                            <input value="<?=\$form['[field]']?>" type="hidden" class="image-item" type="text" id="[field]">
                            <img src="<?=Yii::\$app->controller->getStaticUrl()?><?=\$form['[field]']?>" alt=""  class="pic_url">
                            <input type="file" name="images" style="opacity:0" accept="image/*" capture="camera">
                            <i class="iconfont icon-lajitong"></i>
                            <i class="iconfont icon-tianjia"></i>
                            <div class="over-cover"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
       return $input;
    }

    /***
     * 多图预览上传
     * @param $field
     * @param $name
     * @return mixed
     */
    public static function image_mutil_priview($field,$name){

        $input = <<<EOT
   <div class="form-group">
            <label class="col-sm-4 control-label">[name]：</label>
            <input value="<?=\$form['[field]']?>" type="hidden" id="images">
            <div class="col-sm-8">
                <div class="clear-float">
                    <form class="upload-win clear-float" enctype="multipart/form-data">
                        <input type="hidden" class="group_name" value="admin">
                        <?php
                            \$form['images'] = explode(',',\$form['[field]']);
                            if(!empty(\$form['[field]'])){
                                foreach(\$form['[field]'] as \$image){

                        ?>
                        <div class="upload-img upload-img-one left">
                            <img src="<?=Yii::\$app->controller->getStaticUrl()?><?=\$image?>" alt=""  class="pic_url">
                            <span class="image-item" src="<?=\$image?>"></span>
                            <input type="file" name="images" style="opacity:0" accept="image/*" capture="camera">
                            <i class="iconfont icon-lajitong"></i>
                            <i class="iconfont icon-tianjia"></i>
                            <div class="over-cover"></div>
                        </div>
                        <?php }?>
                        <?php }?>

                        <div class="upload-img upload-img-mutil left">
                            <img src="" alt=""  class="pic_url">
                           <span class="image-item" src=""></span>
                            <input type="file" name="images" style="opacity:0" accept="image/*" capture="camera">
                            <i class="iconfont icon-lajitong"></i>
                            <i class="iconfont icon-tianjia"></i>
                            <div class="over-cover"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
EOT;
        $input = str_replace(array('[name]','[field]'),array($name,$field),$input);
        return $input;

    }


    public static function get_form_html($database,$table,$config_fied_builder_types,$get_form_builder_types){
        list($fields,$select) = (new InfoSchema($database))->get_all_fields($table);
        //生成html
        $form_html = '';
        foreach($fields as $field=>$name){
            $fb_func = $config_fied_builder_types[$field];
            if(empty($fb_func)){
                continue;
            }

            if(isset($select[$field])){
                $form_html .= FormBuilder::$fb_func($field,$name,$select[$field])."\n";
            }else{
                $form_html .= FormBuilder::$fb_func($field,$name)."\n";
            }
        }

        $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppFormAsset::run()?>
</head>
<body>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=\$form['id']?>">
        [form_html]
    </div>
</div>

</body>
<?=\app\helpers\AppFormAsset::run_javascript_end()?>
</html>
HTML;
        $html = str_replace('[form_html]',$form_html,$html);
        return $html;
    }







}