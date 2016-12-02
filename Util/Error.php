<?php

namespace Wandi\ToolsBundle\Util;

use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;

class Error
{
    public function __construct()
    {
    }

    public function getViolationsErrors(ConstraintViolationList $violationList)
    {
        $errors = array();

        foreach ($violationList as $violation) {
            /** @var ConstraintViolation $violation */
            $errors[] = $violation->getMessage();
        }

        return $errors;
    }

    public function getFormErrors(Form $form)
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
                $childErrors = $this->getFormErrors($child);
                if (!empty($childErrors)) {
                    $errors[$child->getName()] = $childErrors;
                }

            }
        }

        return $errors;
    }
}
