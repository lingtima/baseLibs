<?php

namespace Tools\Pattern\Structural\Bridge;

class HtmlFormatter implements FormatterInterface
{
    public function format(string $text)
    {
        return sprintf('<p>%s</p>', $text);
    }
}
