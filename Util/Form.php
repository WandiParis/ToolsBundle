<?php

namespace Wandi\ToolsBundle\Util;

class Form
{
    public function __construct()
    {
    }

    public function getErrors(\Symfony\Component\Form\Form $form)
    {
        $properties = array();
        $errors = array();

        foreach ($form->all() as $property => $object) {
            $properties[] = $property;
        }

        foreach ($properties as $attribute) {
            $attributeErrors = $form->get($attribute)->getErrors(true);

            foreach ($attributeErrors as $attributeError) {
                $errors[$attribute][] = $attributeError->getMessage();
            }
        }

        return $errors;
    }
}
