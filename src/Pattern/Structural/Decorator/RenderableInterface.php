<?php

namespace Tools\Pattern\Structural\Decorator;

/**
 * 创建渲染接口。
 * 这里的装饰方法 renderData() 返回的是字符串格式数据。
 * @package Tools\Pattern\Structural\Decorator
 */
interface RenderableInterface
{
    public function renderData(): string;
}
