<?php
namespace app\helpers;
class ImageLocal{
     public $local_dir = WEB_PATH.'/images/';
     public $image_base_url = 'http://127.0.0.1/images/';

     /**
     * 图片本地化
     * @param $userid 用户id
     * @param $content 文章内容的html
     * @param string $pregImgRule 启用了自定义图片规则
     * @return mixed
     */
    public function localization($user_id, $content, $base_url = '')
    {
        /*获取上传路径*/
        $this->local_dir = $this->local_dir.$user_id.'/';
        $this->image_base_url = $this->image_base_url.$user_id.'/';

        if(!is_dir($this->local_dir)){
            mkdir($this->local_dir,0755,true);
        }
        $list_url = array();
        preg_match_all('/(<img[\s\S]*?(><\/img>|>))/i', $content, $match_img);
        if (!empty($match_img[1])) {
            foreach ($match_img[1] as $key => $img) {
                /*匹配图片 src width height*/
                $src = $width = $height = array();
                $s = $w = $h = '';

                preg_match('/src=["\']?(.+?)("|\'| |>|\/>){1}/i', $img, $src); //默认规则

                preg_match('/width=["\']?(.*?)("|\'| |>|\/>){1}/i', $img, $width);
                preg_match('/height=["\']?(.*?)("|\'| |>|\/>){1}/i', $img, $height);
                $remote_file = $src[1];
                if (isset($width[1])) {
                    $w = ' width=' . $width[1];
                }
                if (isset($height[1])) {
                    $h = ' height=' . $height[1] . ' ';
                }
                $img_ext = $this->get_file_ext($remote_file);
                if (!preg_match('/^(jpg|gif|png|jpeg)$/i', $img_ext)) {
                    $img_ext = 'jpg';
                }
                /*图片本地化*/
                $imgcontent = file_get_contents($base_url.$remote_file);
                $img_file_name = md5($imgcontent). '.' . $img_ext;
                file_put_contents($this->local_dir.$img_file_name, $imgcontent);
                //替换图片链接
                $match_img[3][$key] = '<img src=' . $this->image_base_url.$img_file_name . $w . $h . ' />';
                $list_url[] = $this->image_base_url.$img_file_name;
                // sleep(1);
            }
                $content = str_replace($match_img[1], $match_img[3], $content);
        }
        $this->image_base_url = 'http://127.0.0.1/images/';
        $this->local_dir  = WEB_PATH.'/images/';
        return array($list_url,$content);
    }
    /**
     * 获取文件后缀
     * @param $filePath 文件路径
     * @return string
     */
    public function get_file_ext($filePath)
    {
        return (trim(strtolower(substr(strrchr($filePath, '.'), 1))));
    }




}