<?php

// Example implementation of Observer design pattern:

class FileObserver implements SplObserver {
    public function update(SplSubject $subject) :void{
        echo date('Y-m-d H:i:s').__CLASS__ . ' - ' . $subject->getName().PHP_EOL;
    }
}

class DatabaseObserver implements SplObserver{
    public function update(SplSubject $subject) :void{
        echo date('Y-m-d H:i:s').__CLASS__ . ' - ' . $subject->getName().PHP_EOL;
    }
}

class MailObserver implements SplObserver {
    public function update(SplSubject $subject) :void{
        // 检查邮件是否设置正确
        error_log(date('Y-m-d H:i:s').__CLASS__ . ' - ' . $subject->getName().PHP_EOL, 1,
            "306863208@qq.com");
//        if (mail('306863208@qq.com', 'log_mail', date('Y-m-d H:i:s').__CLASS__ . ' - ' . $subject->getName().PHP_EOL, '', '')) {
//            echo "Email sent successfully".PHP_EOL;
//        } else {
//            echo "Email sending failed".PHP_EOL;
//        }
    }
}

class LogSubject implements SplSubject {
    public $_observers;
    public $_name;

    public function __construct($name) {
        $this->_name = $name;
        $this->_observers = new SplObjectStorage();
    }
    public function attach(SplObserver $observer) :void{
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer) :void{
        $this->_observers->detach($observer);
    }

    public function notify() :void{
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    public function getName() {
        return $this->_name;
    }
}

$observer1 = new FileObserver();
$observer2 = new MailObserver();
$observer3 = new DatabaseObserver();
$subject = new LogSubject(date("Y-m-d H:i:s").'日志主题...');

$subject->attach($observer1);
$subject->attach($observer2);
$subject->attach($observer3);
$subject->attach($observer1);
$subject->notify();

/*
will output:

MyObserver1 - test
MyObserver2 - test
*/

$subject->detach($observer2);
$subject->notify();

/*
will output:

MyObserver1 - test
*/
