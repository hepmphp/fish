<?php
/**
 *  fiename: fish/FileObserver.php$🐘
 *  date:  2024/10/31   17:55$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\base\observer;

use app\helpers\Log;

class FileObserver implements \SplObserver{

    public function update(\SplSubject $subject) :void{
        Log::write($subject->get_name()."|".$subject->get_data(),'observer');
    }
}
