<?php

namespace Wandi\ToolsBundle\Util;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;

class Error
{
    public function __construct()
    {
    }

    protected function getViolationsErrors(ConstraintViolationList $violationList)
    {
        $errors = array();

        foreach ($violationList as $violation) {
            /** @var ConstraintViolation $violation */
            $errors[] = $violation->getMessage();
        }

        return $errors;
    }

    private function getFormErrors(Form $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getFormErrors($child);
            }
        }

        return $errors;
    }
}
