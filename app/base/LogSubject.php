<?php
/**
 *  fiename: fish/LogSubject.php$🐘
 *  date:  2024/10/31   17:54$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base;

class LogSubject implements \SplSubject {
    public $_observers;
    public $_name;
    public $data = '';


    public function __construct($name) {
        $this->_name = $name;
        $this->_observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer) :void{
        if(!$this->_observers->contains($observer)){
            $this->_observers->attach($observer);
        }

    }

    public function detach(\SplObserver $observer) :void{
        if($this->_observers->contains($observer)){
            $this->_observers->detach($observer);
        }
    }

    public function notify() :void{
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    public function get_name() {
        return $this->_name;
    }
    public function set_data($data){
        $this->data = $data;
    }
    public function get_data(){
        return $this->data;
    }
}