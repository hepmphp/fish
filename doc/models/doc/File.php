<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace doc\models\doc;
use doc\base\Model;
use doc\base\exception\LogicException;
use app\helpers\Arr;
use doc\helpers\FileUpload;
use doc\helpers\SiteUrl;


class File extends Model
{
    public $db = 'doc';
    public $table='doc_file';
    public $db_prefix='';
    public $folder = '';
    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->folder = new Folder();
        parent::__construct();
    }
    public function create($form){
        $form['user_id'] =1;
        $upload = new FileUpload();//folder_name
        $folders = $this->folder->find_all([],1,1000);
        $folders = Arr::index($folders,'id');
        $file_lists = $form['file_lists'];
        unset($form['file_lists']);
        foreach ($file_lists as $k=>$file){
            $filename = filesize ($upload->upload_root.$file['filename']);
            $form['folder_parentid'] = isset($folders[$form['folder_id']])?$folders[$form['folder_id']]['parentid']:0;
            $form['folder_name'] = isset($folders[$form['folder_id']])?$folders[$form['folder_id']]['name']:'';
            $form['file'] = $file['filename'];
            $form['name'] = $file['name'];
            $form['width'] = 0;
            $form['height'] = 0;
            $form['ext'] = $upload->fileext($file['filename']);
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
        $folders = $this->folder->find_all([],1,1000);
        $folders = Arr::index($folders,'id');
        $file_lists = $form['file_lists'];
        unset($form['file_lists']);
        foreach ($file_lists as $k=>$file){
            $filename = filesize ($upload->upload_root.$file['filename']);
            $form['folder_parentid'] = isset($folders[$form['folder_id']])?$folders[$form['folder_id']]['parentid']:0;
            $form['folder_name'] = isset($folders[$form['folder_id']])?$folders[$form['folder_id']]['name']:'';
            $form['file'] = $file['filename'];
            $form['name'] = $file['name'];
            $form['width'] = 0;
            $form['height'] = 0;
            $form['ext'] = $upload->fileext($file['filename']);
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
        $where_sql = ' 1=1 ';
        if(isset($where['id'])){
            $where_sql .= " AND id='{$where['id']}'";
        }
        if(isset($where['user_id'])){
            $where_sql .= " AND user_id='{$where['user_id']}'";
        }
        if(isset($where['name'])){
            $where_sql .= " AND name='{$where['name']}'";
        }
        if(isset($where['folder_id'])){
            $where_sql .= " AND folder_id={$where['folder_id']} OR folder_parentid={$where['folder_id']} ";
        }


        $total = $this->get_total($where_sql);
        $data = $this->get_list($where_sql, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['status'] = $v['status']==-1?'<span class="label btn-danger" style="background-color: red;" >删除</span>':'正常';
            $data[$k]['file_url'] = SiteUrl::get_file_url($v['file']);
            $data[$k]['file'] = WEB_PATH."/upload".$v['file'];
        }
        return [$data,$total['total']];
    }






}#end

##生成时间:2024-11-08 19:16:07 文件路径：File.php🐘