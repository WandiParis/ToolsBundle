<?php

namespace Wandi\ToolsBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Wandi\ToolsBundle\Tests\Entity\Entity;
use Wandi\ToolsBundle\Tests\Form\Type\EntityFormType;
use Wandi\ToolsBundle\Util\Form;

class FormTest extends WebTestCase
{
    public function testGetErrors()
    {
        $form = new Form();
        static::bootKernel();
        $formFactory = static::$kernel->getContainer()->get('form.factory');

        $entity = new Entity();
        $entity
            ->setNone('lorem')
            ->setLength('lorem ipsum')
            ->setNotBlank(null);

        $f = $formFactory->create(EntityFormType::class, $entity);
        $f->submit(array(), false);

        $errors = $form->getErrors($f);
        $this->assertEquals(2, count($errors));
        $this->assertTrue(array_key_exists('notBlank', $errors));
        $this->assertTrue(array_key_exists('length', $errors));
    }
}