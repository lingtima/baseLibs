<?php

namespace Tools\Pattern\Behavioral\Observer;

/**
 * User 实现观察者模式（成为主体），他维护一个观察者列表
 * 当对象发生变化时通知User
 * @package Tools\Pattern\Behavioral\Observer
 */
class User implements \SplSubject
{
    private $email;
    
    private $observers;
    
    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }
    
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }
    
    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }
    
    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }
    
    public function notify()
    {
        /**
         * @var \SplObserver $observer
         */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
