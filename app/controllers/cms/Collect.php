<?php

namespace app\controllers\cms;

use app\base\BaseController;
use app\helpers\Http;
use app\helpers\Image;
use app\helpers\Input;
use app\helpers\VideoLocal;
use app\models\curd\cms\Collect as M_Collect;
use app\helpers\Validate;
use app\helpers\ImageLocal;
 class Collect extends BaseController{

     public $collect  = '';
     public function __construct()
     {
         $this->collect = new M_Collect();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        $id = Input::get_post('id',0,'intval');
        if(is_numeric($id)){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }
        $site = Input::get_post('site','','trim');
        if($site){
          if(!Validate::required('site')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['site'] = $site;
        }
            
        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');
       
        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }
           
        $status = Input::get_post('status','','trim');
        if(is_numeric($status)){
           $where['status'] = $status;
        }
            

        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $form = $this->get_search_where();
         $config_status = $this->collect->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->assign('form',$form);
         $this->view->display('cms/collect/index');
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_status = $this->collect->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('cms/collect/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->collect->info(['id'=>$form['id']]);
		 $config_status = $this->collect->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('cms/collect/update');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('cms/collect/info');
     }

     public function preview(){
         $url = Input::get_post('url','','trim');
         $content = file_get_contents($url);
         highlight_string($content);
     }

     public function preg_list(){
         $list_url = Input::get_post('list_url','','trim');
         $preg_list = Input::get_post('preg_list','','trim');
         $config['preg_list'] = "/$preg_list/isU";
         $list_content = file_get_contents($list_url);
         preg_match($config['preg_list'], $list_content, $match_list);
         echo $match_list[1];
//         var_dump($match_list);
         //print_r($match_list);
     }

     public function preg_detail(){
        $detail_url = Input::get_post('detail_url','','trim');
        $preg_detail = Input::get_post('preg_detail','','trim');
        $preg_title= Input::get_post('preg_title','','trim');
        $preg_author= Input::get_post('preg_author','','trim');
        $preg_media= Input::get_post('preg_media','','trim');
        $preg_time= Input::get_post('preg_time','','trim');
        $preg_content= Input::get_post('preg_content','','trim');

        $config['preg_detail'] = "/$preg_detail/isU";
        $config['preg_title'] = "/$preg_title/is";
        $config['preg_author'] = "/$preg_author/is";
        $config['preg_media'] = "/$preg_media/is";
        $config['preg_time'] = "/$preg_time/is";
        $config['preg_content'] = "/$preg_content/isU";
        $detail_content = file_get_contents($detail_url);

        preg_match($config['preg_detail'], $detail_content, $match_detail);
        preg_match($config['preg_title'], $match_detail[1], $match_title);
        preg_match($config['preg_author'], $match_detail[1], $match_author);
        preg_match($config['preg_media'], $match_detail[1], $match_media);
        preg_match($config['preg_time'], $match_detail[1], $match_time);
        preg_match($config['preg_content'], $match_detail[1], $match_content);
        var_dump('title',$match_title[1]);
        var_dump('author',$match_author[1]);
        var_dump('media',$match_media[1]);
        var_dump('time',$match_time[1]);
        var_dump('content',$match_content[1]);
     }

     public function collect_site(){
         /*思路 下载列表页 在下载详情页 保存到指定文件夹*/
         set_time_limit(0);
         ini_set('memory_limit','2048MB');
         $form = $this->get_search_where();
         $site =    $this->collect->info(['id'=>$form['id']]);
         $path = WEB_PATH.'/collect/'.$site['site'].'/'.$site['cate'].'/';
         if(!is_dir($path)){
             mkdir($path,0755,true);
         }
         $config['preg_list'] = "/{$site['preg_list']}/isU";
         echo date("Y-m-d H:i:s")."<br/>";
         echo $path."<br/>";
         $list_content = file_get_contents($site['list']);
         preg_match($config['preg_list'], $list_content, $match_list);
         $urls = $this->_striplinks($match_list[1]);
         foreach ($urls as $k=>$url){
             echo $url."<br/>";
             $id = md5($url);
             $content = file_get_contents($url);
             file_put_contents($path.$id.'.html',$content);
         }
         echo date("Y-m-d H:i:s")."<br/>";
     }
     public function collect_site_parse_preview(){
         $form = $this->get_search_where();
         $site =    $this->collect->info(['id'=>$form['id']]);
         $path = WEB_PATH.'/collect/'.$site['site'].'/'.$site['cate'].'/';
         $all_files = glob($path.'*.html');
         natsort($all_files);

         echo date("Y-m-d H:i:s")."<br/>";
         $image_local = new ImageLocal();
         $video_local = new VideoLocal();
         $image = new Image();
         foreach($all_files as $file){
             $config['preg_detail'] = "/{$site['preg_detail']}/isU";
             $config['preg_title'] = "/{$site['preg_title']}/is";
             $config['preg_author'] = "/{$site['preg_author']}/is";
             $config['preg_media'] = "/{$site['preg_media']}/is";
             $config['preg_time'] = "/{$site['preg_time']}/is";
             $config['preg_content'] = "/{$site['preg_content']}/isU";
             $detail_content = file_get_contents($file);

             preg_match($config['preg_detail'], $detail_content, $match_detail);
             preg_match($config['preg_title'], $match_detail[1], $match_title);
             preg_match($config['preg_author'], $match_detail[1], $match_author);
             preg_match($config['preg_media'], $match_detail[1], $match_media);
             preg_match($config['preg_time'], $match_detail[1], $match_time);
             preg_match($config['preg_content'], $match_detail[1], $match_content);
             list($list_url,$content) = $image_local->localization($_SESSION['admin_user_id'],$match_content[1],$site['site_url']);
             list($list_video_url,$content) = $video_local->localization($_SESSION['admin_user_id'],$content,$site['site_url']);
             $post_data = array(
                 'cate_id'=>$site['cate'],
                 'admin_id'=>$_SESSION['admin_user_id'],
                 'admin'=>$_SESSION['admin_user_username'],
                 'title'=>$match_title[1],
                 'author'=>$match_author[1],
                 'media'=>$match_media[1],
                 'time'=>$match_time[1],
                 'is_top'=>0,
                 'list_image_url'=>!empty($list_url)?$list_url[0]:'',
                 'content'=>$content,
                 'status'=>0
             );

          //   $list_image_url = $image->watermark(WEB_PATH.'/images/20/2a8a6897cbbcea8d9f328fd5f19c16b3.jpg','',9,'watermark.png');
             var_dump($post_data);exit();
         }
         echo date("Y-m-d H:i:s")."<br/>";

     }

     public function collect_site_parse(){
         set_time_limit(0);
         ini_set('memory_limit','2048MB');
         $form = $this->get_search_where();
         $site =    $this->collect->info(['id'=>$form['id']]);
         $path = WEB_PATH.'/collect/'.$site['site'].'/'.$site['cate'].'/';
         $all_files = glob($path.'*.html');
         natsort($all_files);
         echo date("Y-m-d H:i:s")."<br/>";
         $image_local = new ImageLocal();
         $video_local = new VideoLocal();
         echo <<<JS
<script src="http://127.0.0.1/static/admin/js/jquery.min.js"></script>
<script src="http://127.0.0.1/static/admin/js/layer/layer.js"></script>
<script>console.log('采集进行中...')</script>
JS;
         foreach($all_files as $file){
             $config['preg_detail'] = "/{$site['preg_detail']}/isU";
             $config['preg_title'] = "/{$site['preg_title']}/is";
             $config['preg_author'] = "/{$site['preg_author']}/is";
             $config['preg_media'] = "/{$site['preg_media']}/is";
             $config['preg_time'] = "/{$site['preg_time']}/is";
             $config['preg_content'] = "/{$site['preg_content']}/isU";
             $detail_content = file_get_contents($file);
             echo $file."<br/>";
             preg_match($config['preg_detail'], $detail_content, $match_detail);
             preg_match($config['preg_title'], $match_detail[1], $match_title);
             preg_match($config['preg_author'], $match_detail[1], $match_author);
             preg_match($config['preg_media'], $match_detail[1], $match_media);
             preg_match($config['preg_time'], $match_detail[1], $match_time);
             preg_match($config['preg_content'], $match_detail[1], $match_content);
             list($list_url,$content) = $image_local->localization($_SESSION['admin_user_id'],$match_content[1],$site['site_url']);
             list($list_video_url,$content) = $video_local->localization($_SESSION['admin_user_id'],$content,$site['site_url']);
             $post_data = array(
                 'cate_id'=>$site['cate'],
                 'admin_id'=>$_SESSION['admin_user_id'],
                 'admin'=>$_SESSION['admin_user_username'],
                 'title'=>$match_title[1],
                 'author'=>$match_author[1],
                 'media'=>$match_media[1],
                 'time'=>$match_time[1],
                 'is_top'=>0,
                 'list_image_url'=>!empty($list_url)?$list_url[0]:'',
                 'content'=>$content,
                 'status'=>0
             );
             $post_data = json_encode($post_data);
             $url = 'http://127.0.0.1/api/article/create';
             $this->ajax_js_to_article($url,$post_data);
           //  unlink($file);
         }
         echo date("Y-m-d H:i:s")."<br/>";
         $tag = rand();
         echo <<<JS
<script>console.log('采集结束...')</script>
<script>
// 兼容处理
let Notification = window.Notification || window.webkitNotifications

// 创建实例 new Notification(title, options)
var notify =new Notification('管理后台采集通知', {
    // 文字方向，auto / ltr / rtl
    dir: 'auto',     
    // 赋予通知一个ID，以便在必要的时候对通知进行刷新、替换或移除           
    tag: {$tag}   ,    
    // 一个图片的URL，将被用于显示通知的图标    
    icon: 'http://127.0.0.1/static/admin/images/10001.jpg',  
    // image: 'http://127.0.0.1/static/admin/images/10001.jpg',  
    // 通知中额外显示的字符串
    body: '🐘采集完成',
    // 是否一直保持有效
    requireInteraction: true
})
notify.onclick = function(event) {
    window.open('http://127.0.0.1/cms/article/index?iframe=0','_blank');
}
notify.onclose = function(event) {
     window.open('http://127.0.0.1/cms/article/index?iframe=0','_blank');
}
setInterval(function() {
    var title = top.window.document.title;
      if (/新/.test(title) == false) {
             top.window.document.title = '【你有新消息采集完成】';    
        } else {
             top.window.document.title = '【　　　　　】';
        }
}, 500);
</script>
JS;
     }

     function ajax_js_to_article($url,$post_data){
         echo <<<JS
<script>
ajax_post();
function ajax_post(){
    $.ajax({
        type:"POST",
        url: '{$url}',
        data:  {$post_data},
        timeout:"4000000",
        dataType:'json',
        success: function(data){
              layer.closeAll('loading');
            if (data.status == 0) {
                console.log(data);
            }
            else {
                //  layer.alert(data.msg, {icon:2},function (index) {
                //     // layer.closeAll();
                //     // window.location.reload();
                // });
                 console.log(data);
            }
        },

    });
}
</script>
JS;

     }



     /**
      * 获取列表页所有url
      * @param $document 缩减后的html列表页
      * @param $baseUrl  页面链接
      * @param string $linkRule 启用特殊规则的链接
      * @return array
      */
     function _striplinks($document, $baseUrl='', $linkRule = '')
     {
         if ($linkRule) {
             preg_match_all(
                 $linkRule,
                 $document,
                 $links
             );
             while (list($key, $val) = each($links[1])) {
                 if (!empty($val) && strpos($val, $baseUrl) != FALSE) {
                     $match[] = $val;
                 } else if (!empty($val)) {
                     if (substr($val, 0, 7) == 'http://') {
                         continue;
                     } elseif (substr($val, 0, 1) == '/') {
                         $match[] = $baseUrl . $val;
                     } elseif (substr($val, 0, 2) == './') {
                         $match[] = $baseUrl . substr($val, 1);
                     } elseif (substr($val, 0, 3) == '../') {
                         $match[] = $baseUrl . substr($val, 2);
                     } else {
                         $match[] = $baseUrl . '/' . $val;
                     }
                 }
             }
         } else {
             preg_match_all("'<\s*a\s.*?href\s*=\s*		# find <a href=
						([\"\'])?					# find single or double quote
						(?(1) (.*?)\\1 | ([^\s\>]+))# if quote found, match up to next matching
													# quote, otherwise match up to next space
						'isx", $document, $links);
             // catenate the non-empty matches from the conditional subpattern
             foreach ($links[2] as $K=>$v){
                     $match[] = $v;
             }
             foreach ($links[3] as $K=>$v){
                     $match[] = $v;
             }
         }
         $match = array_filter($match);
         // return the links
         return array_unique($match);
     }
 }