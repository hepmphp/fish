<?php
namespace app\helpers\email;

class MailTool{
    public $hostname = "{imap.139.com:993/imap/ssl}INBOX";
    public $username = "15060779893@139.com";
    public $password = "84874f770303ac0a7400";
    public $atach_path = WEB_PATH.'/upload/';


    public function __construct()
    {
        if(!empty($_SESSION['imap_server'])){
            $this->hostname =   $_SESSION['imap_server'];
            $this->port =    $_SESSION['imap_port'];
            $this->username =   $_SESSION['username'];
            $this->password  = $_SESSION['password'];
        }
    }

    /**
     *  [0] => Bulk Mail
        [1] => Draft
        [2] => Inbox
        [3] => Sent
        [4] => Trash
     * @param $where
     * @param int $page
     * @param int $per_page
     */
    public function get_mail_lists($where,$page=1,$per_page=2){
        $offset = $page;
        if($offset<=1){
            $offset = 0;
        }else if($offset==2){
            $offset = 2;
        }else if($offset==3){
            $offset = 4;
        }else if($offset==4){
            $offset = 6;
        }else{
            $offset = ($offset-1)*2;
        }

        $inbox = imap_open($this->hostname, $this->username, $this->password);

        $total_rows = imap_num_msg($inbox);
        $total_page = ceil($total_rows/$per_page);
        $mail_lists = array();
        $mail_data = array();
        for ($i=1;$i<=$total_rows;$i++){

            $is_attach = $this->is_attach($inbox,$i);
            $attach = '';
            if($is_attach[$i]){
                $section = empty( $is_attach[$i]) ? 1 : 1.1;
                $headers = imap_headerinfo($inbox, $i); //获取信件标头
                $mail_bdoy = imap_fetchbody($inbox, $i, $section); //获取信件正文
                $attach = $this->get_attach($inbox,$i);
            }else{
                $section = empty( $is_attach[$i]) ? 1 : 1.1;
                $headers = imap_headerinfo($inbox, $i); //获取信件标头
                $mail_bdoy = imap_fetchbody($inbox, $i, $section); //获取信件正文
            }
            $mail_data[] = $this->parse_header($headers,$mail_bdoy,$attach);

        }
        $list = array_slice($mail_data,$offset,$per_page);
        $mail_lists['list'] = $list;
        $mail_lists['total'] = $total_rows;
        $mail_lists['total_rows'] = $total_rows;
        $mail_lists['per_page'] = $per_page;
        $mail_lists['page'] = $page;
        return $mail_lists;
    }

    public function is_attach($inbox,$email_number){
        // 获取邮件结构
        $structure = imap_fetchstructure($inbox, $email_number);
        $is_attach[$email_number] = false;
        // 处理附件
        if (isset($structure->parts) && count($structure->parts)) {
            for ($i = 0; $i < count($structure->parts); $i++) {
                $part = $structure->parts[$i];
                // 检查是否有附件
                if ($part->ifdparameters) {
                    foreach ($part->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $filename = $object->value;
                            if(!empty($filename)){
                                $is_attach[$email_number] = true;
                            }
                        }
                    }
                }
            }
        }
        return $is_attach;
    }

    public function get_attach($inbox,$email_number) {
        // 获取邮件结构
        $structure = imap_fetchstructure($inbox, $email_number);
        // 处理附件
        if (isset($structure->parts) && count($structure->parts)) {
            for ($i = 0; $i < count($structure->parts); $i++) {
                $part = $structure->parts[$i];

                // 检查是否有附件
                if ($part->ifdparameters) {
                    foreach ($part->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $filename = $object->value;

                            // 下载附件
                            $attachment = imap_fetchbody($inbox, $email_number, $i + 1);
                            if ($part->encoding == 3) { // base64编码
                                $attachment = base64_decode($attachment);
                            } elseif ($part->encoding == 4) { // quoted-printable编码
                                $attachment = quoted_printable_decode($attachment);
                            }

                            // 保存附件到本地
                            file_put_contents($this->atach_path.$filename, $attachment);
                            //echo "Attachment saved: " . $this->atach_path.$filename . "\n";
                        }
                    }
                }
            }
         }
        return [SITE_URL."/upload/".$filename,$filename];
    }


    public function parse_header($headers,$mail_bdoy,$attach){
        $data_list = array();
        foreach ($headers as $k=>$data) {
            if (!in_array($k, ['to', 'from', 'Msgno', 'MailDate', 'Size', 'udate','subject','Subject'])) {
                continue;
            } elseif ($k == 'to') {
                $data_list[$k] = $data[0]->mailbox . '@' . $data[0]->host;
            } elseif ($k == 'subject') {
                $attach_flag = '';
                if(!empty($attach)){
                    $attach_flag = "<span style='background-color: red;color: #FFFFFF;width: 100px;'>有附件</span>";
                }
                $data_list[$k] = $this->charset(imap_mime_header_decode($data)[0]->text).$attach_flag;
            } elseif ($k == 'from') {
                $data_list[$k] = $data[0]->mailbox . '@' . $data[0]->host;
            } elseif ($k == 'Msgno') {
                $data_list[$k]= trim($data);
            } elseif ($k == 'MailDate') {
                $data_list[$k] = date("Y-m-d H:i:s",strtotime($data));
            } elseif ($k == 'Size') {
                $data_list[$k] = $data;
            } elseif ($k == 'subject') {
                $data_list[$k] = $data;
            }
        }
        $data_list['body'] = $mail_bdoy;
        if($this->is_base64_encoded($mail_bdoy)){
            $data_list['body'] =$this->charset(base64_decode($mail_bdoy));
        }

        $data_list['attach'] = '';
        if(!empty($attach[1])){
            if(strpos($data_list['body'],'>')==false){
                /**************************程序自动对文章进行排版****************************/
                /* P标签换成BR */
                $data_list['body'] = preg_replace('/\s/i','<br>',$data_list['body']);
                $data_list['body'] = preg_replace('/<\/?p[^>]*>/i','<br>',$data_list['body']);
                /* 换成2个BR */
                $data_list['body'] = preg_replace('/<br[\s\/br><&nbsp;]*>(\s*|&nbsp;)*/i','<br><br>&nbsp;&nbsp;&nbsp;&nbsp;',$data_list['body']);
                /**************************排版结束**************************************/
            }

            $data_list['attach'] = "<a href='{$attach[0]}'>附件下载 {$attach[1]}</a>";
        }
        return $data_list;
    }

    function charset($data) {
        if(!empty($data)) {
            $fileType = mb_detect_encoding($data, array('UTF-8','GBK','GB2312','LATIN1','BIG5'));
            if($fileType != 'UTF-8') {
                $data = mb_convert_encoding($data ,'utf-8', $fileType);
            }
        }
        return $data;
    }

    public function get_mail_detail($mail_id){
        $inbox = imap_open($this->hostname, $this->username, $this->password);
        $is_attach = $this->is_attach($inbox,$mail_id);
        $attach = '';
        if($is_attach[$mail_id]){

            $headers = imap_headerinfo($inbox, $mail_id); //获取信件标头
            $mail_bdoy = imap_fetchbody($inbox, $mail_id,1.1); //获取信件正文
            $attach = $this->get_attach($inbox,$mail_id);
        }else{
            $headers = imap_headerinfo($inbox, $mail_id); //获取信件标头
            $mail_bdoy = imap_fetchbody($inbox, $mail_id,1); //获取信件正
            if($this->is_base64_encoded($mail_bdoy)){
                $mail_bdoy = imap_fetchbody($inbox, $mail_id,2); //获取信件正文
            }
        }


        $mail_data =  $this->parse_header($headers,$mail_bdoy,$attach);
        return $mail_data;
    }

    function is_base64_encoded($string) {
        $decoded = base64_decode($string, true);
        return ($decoded !== false && json_encode($decoded) !== false);
    }



    function isBase64ByDecoding($str) {
        $decoded = base64_decode($str, true); // 第二个参数true会返回原始二进制数据，失败时返回false
        if ($decoded === false) {
            return false;
        }
        // 对于非二进制数据，可以进一步比较重新编码后的字符串是否与原字符串相同
        // 注意：对于二进制数据，此方法不适用，因为重新编码后的字符串可能包含不可打印字符
        $reencoded = base64_encode($decoded);
        return $reencoded === $str;
    }

}
/*
 *
imap_append:    附加字符串到指定的邮箱中。
imap_base64:    解 BASE64 编码。
imap_body:    读信的内文。
imap_check:    返回邮箱信息。
imap_close:    关闭 IMAP 链接。
imap_createmailbox:    建立新的信箱。
imap_delete:    标记欲删除邮件。
imap_deletemailbox:    删除既有信箱。
imap_expunge:    删除已标记的邮件。
imap_fetchbody:    从信件内文取出指定部分。
imap_fetchstructure:    获取某信件的结构信息。
imap_header:    获取某信件的标头信息。
imap_headers:    获取全部信件的标头信息。
imap_listmailbox:    获取邮箱列示。
imap_listsubscribed:    获取订阅邮箱列示。
imap_mail_copy:    复制指定信件到它处邮箱。
imap_mail_move:    移动指定信件到它处邮箱。
imap_num_msg:    取得信件数。
imap_num_recent:    取得新进信件数。
imap_open:    打开 IMAP 链接。
imap_ping:    检查 IMAP 是否连接。
imap_renamemailbox:    更改邮箱名字。
imap_reopen:    重开 IMAP 链接。
imap_subscribe:    订阅邮箱。
imap_undelete:    取消删除邮件标记。
imap_unsubscribe:    取消订阅邮箱。
imap_qprint:    将 qp 编码转成八位。
imap_8bit:    将八位转成 qp 编码。
imap_binary:    将八位转成 base64 编码。
imap_scanmailbox:    寻找信件有无特定字符串。
imap_mailboxmsginfo:    取得目前邮箱的信息。
imap_rfc822_write_address:    电子邮件位址标准化。
imap_rfc822_parse_adrlist:    解析电子邮件位址。
imap_setflag_full:    配置信件标志。
imap_clearflag_full:    清除信件标志。
imap_sort:    将信件标头排序。
imap_fetchheader:    取得原始标头。
imap_uid:    取得信件 UID。
imap_getmailboxes:    取得全部信件详细信息。
imap_getsubscribed:    列出所有订阅邮箱。
imap_msgno:    列出 UID 的连续信件。
imap_search:    搜寻指定标准的信件。
imap_last_error:    最后的错误信息。
imap_errors:    所有的错误信息。
imap_alerts:    所有的警告信息。
imap_status:    目前的状态信息。
 * */