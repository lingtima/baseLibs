<?php
/**
 * User: Lingance<lingtima@gmail.com>
 * Date: 2019/5/3 10:29
 */

namespace Tools\Services;

use ReflectionClass;
use ReflectionParameter;
use Closure;

class Container
{
    protected $bindings = [];
    protected $instances = [];

    public function bind($abstract, $concrete = null, $shared = false)
    {
        if (! $concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    public function singleton($abstract, $concrete)
    {
        $this->bind($abstract, $concrete, true);
    }

    public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;

        return $instance;
    }

    protected function getClosure($abstract, $concrete)
    {
        return function ($c) use ($abstract, $concrete)
        {
            $method = ($abstract === $concrete) ? 'build' : 'make';
            return $c->$method($concrete);
        };
    }

    public function make($abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->getConcrete($abstract);

        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    protected function isBuildable($concrete, $abstract)
    {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    protected function getConcrete($abstract)
    {
        if (! isset($this->bindings[$abstract])) {
            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    public function isShared($abstract)
    {
        return isset($this->instances[$abstract]) || (isset($this->bindings[$abstract]['shared']) && $this->bindings[$abstract]['shared'] == true);
    }

    public function build($concrete)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        $reflector = new ReflectionClass($concrete);
        if (! $reflector->isInstantiable()) {
            echo $message = "Target [$concrete] is not instantiable.";
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instance = $this->getDependencies($dependencies);
        return $reflector->newInstanceArgs($instance);
    }

    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                $dependencies[] = null;
            } else {
                $dependencies[] = $this->resolveClass($parameter);
            }
        }

        return (array) $dependencies;
    }

    protected function resolveClass(ReflectionParameter $parameter)
    {
        return $this->make($parameter->getClass()->name);
    }
}