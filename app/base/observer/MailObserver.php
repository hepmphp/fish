<?php
/**
 *  fiename: fish/MailObserver.php$🐘
 *  date:  2024/10/31   17:55$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\observer;

class MailObserver implements \SplObserver{

    public function update(\SplSubject $subject) :void{
     //   mail('306863208@qq.com', 'php_error_log_mail', $subject->get_name()."|".$subject->get_data().PHP_EOL, '', '');
    }
}