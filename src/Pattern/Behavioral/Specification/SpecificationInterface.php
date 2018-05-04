<?php

namespace Tools\Pattern\Behavioral\Specification;

interface SpecificationInterface
{
    public function isSatisfiedBy(Item $item): bool;
}
