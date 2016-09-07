<?php

namespace Wandi\ToolsBundle\Util\TokenGenerator;

interface TokenGeneratorInterface
{
    /**
     * @return string
     */
    public function generate($length);
}
