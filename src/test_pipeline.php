<?php
/**
 * User: Lingance<lingtima@gmail.com>
 * Date: 2019/4/24 10:36
 */

$middleware = [
    A::class,
    B::class,
    C::class,
];

$carry = function ($carry, $item) {
    return function ($request) use ($carry, $item) {
        $middleware = new $item();
        if (method_exists($middleware, 'handle')) {
            return $middleware->{'handle'}($request, $carry);
        }
        return 'other';
    };
};

$initial = function ($destination) {
    return function ($passable) use ($destination) {
        return $destination($passable);
    };
};

$destination = function ($request) {
    return 'this is ' . $request . ', now is response';
};


$pipeline = array_reduce(array_reverse($middleware), $carry, $initial($destination));

$ret = $pipeline('request');
echo $ret;

class A
{
    public function handle($request, Closure $next)
    {
        $request .= __CLASS__;
        $response = $next($request);
        $response .= __CLASS__;
        return $response;
    }
}

class B
{
    public function handle($request, Closure $next)
    {
        $request .= __CLASS__;
        return $next($request);
    }
}

class C
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response .= __CLASS__;

        return $response;
    }
}