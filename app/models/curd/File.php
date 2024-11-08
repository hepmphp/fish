<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd;
use app\base\Model;
use app\base\exception\LogicException;
use app\helpers\FileUpload;
use app\helpers\SiteUrl;


class File extends Model
{
    public $db = 'cms';
    public $table='cms_file';
    public $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['user_id'] = $_SESSION['admin_user_id'];
        $upload = new FileUpload();//folder_name
        $files = explode(',',$form['file']);
        unset($form['file']);
        foreach ($files as $k=>$file){
            $filename = filesize ($upload->upload_root.$file);
            list($width, $height, $type, $attr) = getimagesize($upload->upload_root.$file);
            $form['file'] = $file;
            $form['name'] = basename($file);
            $form['width'] = $width;
            $form['height'] = $height;
            $form['ext'] = $upload->fileext($form['name']);
            $form['size']  = $upload->size($filename);
            $form['addtime'] = time();
            $res = $this->insert($form);
        }
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }

    }
    public function save($form){
        $form['user_id'] = $_SESSION['admin_user_id'];
        $upload = new FileUpload();//folder_name
        $files = explode(',',$form['file']);
        unset($form['file']);
        foreach ($files as $k=>$file){
            $filename = filesize ($upload->upload_root.$file);
            list($width, $height, $type, $attr) = getimagesize($upload->upload_root.$file);
            $form['file'] = $file;
            $form['name'] = basename($file);
            $form['width'] = $width;
            $form['height'] = $height;
            $form['ext'] = $upload->fileext($form['name']);
            $form['size']  = $upload->size($filename);
            $form['status'] = 0;
            $res = $this->update($form,['id'=>$form['id']],1);
        }

        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
        }
    }

    public function delete($form){
        $form['status'] = -1;

        $file = $this->find(['id'=>$form['id']]);
        $res_file = unlink(WEB_PATH.'/upload/'.$file['file']);
        if(!$res_file){
            throw new LogicException(-1,'物理删除失败');
        }

        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'删除成功');
        }else{
            throw new LogicException(-1,'删除成功');
        }
    }

    public function info($data){
        $info = $this->find(['id'=>$data['id']],'*');
        $info['file_url'] = SiteUrl::get_image_url($info['file']);
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['status'] = $v['status']==-1?'<span class="label btn-danger" style="background-color: red;" >删除</span>':'正常';
            $data[$k]['file'] = SiteUrl::get_image_url($v['file']);
        }
        return [$data,$total['total']];
    }






}#end

##生成时间:2024-11-08 19:16:07 文件路径：File.php🐘