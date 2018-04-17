<?php

namespace Tools\Tests\Pattern\Structural\Composite;

use Tools\Pattern\Structural\Composite\Form;
use Tools\Pattern\Structural\Composite\InputElement;
use Tools\Pattern\Structural\Composite\TextElement;
use Tools\Tests\TestCase;

class CompositeTest extends TestCase
{
    public function testPattern()
    {
        $form = new Form();
        $form->addElement(new TextElement('Email:'));
        $form->addElement(new InputElement());
        
        $embed = new Form();
        $embed->addElement(new TextElement('Password:'));
        $embed->addElement(new InputElement());
        
        $form->addElement($embed);
        
        $this->assertEquals(
            '<form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>',
            $form->render()
        );
    }
}
