<?php

namespace Wandi\ToolsBundle\Util;

interface TokenGeneratorInterface
{
    /**
     * @return string
     */
    public function generate($length);
}
