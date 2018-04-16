<?php

namespace Tools\Pattern\Creational\Pool;

/**
 * Class WorkerPool
 * @package Tools\Pattern\Creational\Pool
 * @author lingtima@gmail.com
 */
class WorkerPool implements \Countable
{
    private $occupiedWorkers = [];
    
    private $freeWorkers = [];
    
    public function get()
    {
        if (count($this->freeWorkers) === 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }
        
        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;
        
        return $worker;
    }
    
    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);
        
        if (isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }
    
    public function count(): int
    {
        return count($this->occupiedWorkers) + count($this->freeWorkers);
    }
}
