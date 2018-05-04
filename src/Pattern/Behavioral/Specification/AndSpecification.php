<?php

namespace Tools\Pattern\Behavioral\Specification;

class AndSpecification implements SpecificationInterface
{
    private $specifications;
    
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }
    
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($item)) {
                return false;
            }
        }
        
        return true;
    }
}
