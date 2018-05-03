<?php

namespace Tools\Pattern\Behavioral\Iterator;

class Book
{
    private $author;
    
    private $title;
    
    public function __construct(string $title, string $author)
    {
        $this->title = $title;
        $this->author = $author;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getAuthor(): string
    {
        return $this->author;
    }
    
    public function getAuthorAndTitle(): string
    {
        return $this->title . ' by ' . $this->author;
    }
}
