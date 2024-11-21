<?php
namespace app\helpers;
class VideoLocal{
     public $local_dir = WEB_PATH.'/videos/';
     public $video_base_url = 'http://127.0.0.1/videos/';

     /**
     * 图片本地化
     * @param $userid 用户id
     * @param $content 文章内容的html
     * @param string $pregImgRule 启用了自定义图片规则
     * @return mixed
     */
    public function localization($user_id, $content, $base_url = '')
    {
        $list_url = array();
        preg_match_all('/(<video[\s\S]*?(><\/video>|>))/i', $content, $match_video);

        if (!empty($match_video[1])) {
            foreach ($match_video[1] as $key => $video) {
                /*匹配图片 src width height*/
                preg_match('/src=["\']?(.+?)("|\'| |>|\/>){1}/i', $video, $src); //默认规则
                preg_match('/poster="(.*?)"/i', $video, $src_poster); //默认规则
                $width = " 800px;";
                $height = " 500px;";
                $remote_video_file = $src[1];
                $remote_poster_file = $src_poster[1];
//                $video_ext = $this->get_file_ext($remote_file);
//                if (!preg_match('/^(mp4|avi|flv)$/i', $video_ext)) {
//                    $video_ext = 'mp4';
//                }
                /*图片本地化*/
//                $video_content = file_get_contents($base_url.$remote_file);
//                $video_file_name = md5($video_content). '.' . $video_ext;
//                file_put_contents($this->local_dir.$video_file_name, $video_content);
                //替换图片链接
             //   $match_video[3][$key] = '<video src=' .  .'  . "{} {$height} . />";
                $match_video[3][$key] = <<<PHP
<video width="{$width}" height="{$height}" controls poster="$base_url.$remote_poster_file">
  <source src="$base_url.$remote_video_file" type="video/mp4">
</video>
PHP;

                $list_url[] = $base_url.$remote_video_file;
            }
            $content = str_replace($match_video[1], $match_video[3], $content);
        }

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