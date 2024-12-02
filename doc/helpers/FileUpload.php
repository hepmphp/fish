<?php

namespace doc\helpers;

use app\base\exception\LogicException;

class FileUpload
{

    public $field;
    public $alowexts = array('gif', 'jpg', 'jpeg', 'png', 'bmp','txt','pdf','mp3','mp4','doc','docx','xls','xlsx');
    public $upload_maxsize = '1000000000';
    public $error;
    public $save_path = '';
    public $upload_root = WEB_PATH . '/upload/';
    public $upload_url = 'http://192.168.2.103/upload/';
    public $upload_dir = '';

    function __construct($upload_dir = '')
    {

        $this->upload_dir = $upload_dir.'/';
    }

    /**
     * 附件上传方法
     * @param $field 上传字段
     * @param $alowexts 允许上传类型
     * @param $maxsize 最大上传大小
     * @param $overwrite 是否覆盖原有文件
     * @param $thumb_setting 缩略图设置
     * @param $watermark_enable  是否添加水印
     */
    function upload($file)
    {
//        $file = $_FILES['file'];
        if (!isset($file)) {
            throw new LogicException(-100, '请选择上传文件');
        }
        $this->save_path = $this->upload_root . $this->upload_dir . date('Y/m/d/');
        if (!is_dir($this->save_path)) {
            mkdir($this->save_path, 0755, true);
        }

        $fileext = $this->fileext($file['name']);
        if ($file['error'] != 0) {
            throw new LogicException(-100, '上传出错');
        }

        if (!in_array($fileext,$this->alowexts)) {
            throw new LogicException(-100, '上传的文件格式不允许');
        }
        if ($this->upload_maxsize && $file['size'] > $this->upload_maxsize) {
            throw new LogicException(-100, '上传文件大小超出');
        }
        if (!$this->isuploadedfile($file['tmp_name'])) {
            throw new LogicException(-100, '非上传文件');
        }
        $temp_filename = $this->getname($file['name'],$fileext);
        $savefile = $this->save_path . $temp_filename;

        if (copy($file['tmp_name'], $savefile)) {
            chmod($savefile, 0644);
            unlink($file['tmp_name']);
            $uploadedfile = array('url' => $this->upload_url.$this->upload_dir . date('Y/m/d/').$temp_filename,'name'=>$file['name'], 'filename' => $this->upload_dir.date('Y/m/d/').$temp_filename, 'filepath' => $savefile, 'filesize' => $file['size'], 'fileext' => $fileext);
        } else {
            throw new LogicException(-100, '移动文件出错');
        }
        return $uploadedfile;
        }

        function fileext($filename) {
            return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
        }

        /**
         * 获取附件名称
         * @param $fileext 附件扩展名
         */
        function getname($file,$ext)
        {
            return md5($file).'.'.$ext;
        }

        /**
         * 返回附件大小
         * @param $filesize 图片大小
         */

        function size($filesize)
        {
            if ($filesize >= 1073741824) {
                $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
            } elseif ($filesize >= 1048576) {
                $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
            } elseif ($filesize >= 1024) {
                $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
            } else {
                $filesize = $filesize . ' Bytes';
            }
            return $filesize;
        }

        /**
         * 判断文件是否是通过 HTTP POST 上传的
         *
         * @param string $file 文件地址
         * @return    bool    所给出的文件是通过 HTTP POST 上传的则返回 TRUE
         */
        function isuploadedfile($file)
        {
            return is_uploaded_file($file) || is_uploaded_file(str_replace('\\\\', '\\', $file));
        }



}

