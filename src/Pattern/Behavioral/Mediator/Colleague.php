<?php

namespace Tools\Pattern\Behavioral\Mediator;

/**
 * Colleague类是一个抽象类，该类对象对象虽彼此协调却不知彼此，只知中介者 Mediator 类
 * @package Tools\Pattern\Behavioral\Mediator
 */
abstract class Colleague
{
    /**
     * 确保子类不变化
     *
     * @var MediatorInterface
     */
    protected $mediator;
    
    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}
