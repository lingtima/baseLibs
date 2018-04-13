<?php

namespace Lingance\Pattern\Builder;

use Lingance\Pattern\Builder\Builder\BorrowerBuilder;

class Test
{
    public function test()
    {
        $userId = '089c7efcbd16480aad9719eb94c06ca2';
        
        $BorrowerBuilder = new BorrowerBuilder();
        $Borrower = (new Director())->build($BorrowerBuilder, $userId);
        
        $Borrower->signId();
    }
}