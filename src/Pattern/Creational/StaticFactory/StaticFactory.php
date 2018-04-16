<?php

namespace Tools\Pattern\Creational\StaticFactory;

final class StaticFactory
{
    public static function factory(string $type)
    {
        switch($type) {
            case 'number':
                return new FormatNumber();
            case 'string':
                return new FormatString();
            default:
                throw new \InvalidArgumentException('Unknown format given');
        }
    }
}