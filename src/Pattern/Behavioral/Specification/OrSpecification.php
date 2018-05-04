<?php

namespace Tools\Pattern\Behavioral\Specification;

class OrSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;
    
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }
    
    /**
     * 如果有一条规则符合条件，返回true，否则返回 false
     * @param Item $item
     * @return bool
     */
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($item)) {
                return true;
            }
        }
        
        return false;
    }
}
