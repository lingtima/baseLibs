<?php

namespace Tools\Pattern\Behavioral\Observer;

class UserObserver implements \SplObserver
{
    /**
     * @var User[]
     */
    private $changeUsers = [];
    
    /**
     * 他通常使用 SplSubject::notify() 通知
     *
     * @param \SplSubject $subject
     */
    public function update(\SplSubject $subject)
    {
        $this->changeUsers[] = clone $subject;
    }
    
    public function getChangedUsers()
    {
        return $this->changeUsers;
    }
}
