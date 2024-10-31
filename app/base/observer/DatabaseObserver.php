<?php
/**
 *  fiename: fish/DatabaseObserver.php$🐘
 *  date:  2024/10/31   17:55$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\observer;

class DatabaseObserver implements \SplObserver{

    public function update(\SplSubject $subject) :void{
     //   echo date('Y-m-d H:i:s').__CLASS__ . ' - ' . $subject->get_name()."".$subject->get_data().PHP_EOL;
    }
}
