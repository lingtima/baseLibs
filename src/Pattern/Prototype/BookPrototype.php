<?php

namespace Tools\Pattern\Prototype;

abstract class BookPrototype
{
    protected $title;

    protected $category;
    
    abstract public function __clone();

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}