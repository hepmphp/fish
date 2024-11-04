<?php
/**
 *  fiename: fish/Event.php$🐘
 *  date:  2024/10/31   18:39$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\base;
use app\base\observer\DatabaseObserver;
use app\base\observer\FileObserver;
use app\base\observer\MailObserver;

class Event
{
    public static $subject = null;
    static function attach($name='app'){
        $file = new FileObserver();
      //  $database = new DatabaseObserver();
        $mail = new MailObserver();
        self::$subject = new LogSubject($name);
        self::$subject->attach($file);
     //   self::$subject->attach($database);
        self::$subject->attach($mail);
    }

    static function trigger(){
        self::$subject->notify();
    }

}