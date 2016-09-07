<?php

namespace Wandi\ToolsBundle\Util\TokenGenerator;

class TokenGenerator implements TokenGeneratorInterface
{
    public function generate($length = 16)
    {
        $length = min(max(1, $length), 32);

        return substr(sha1(uniqid()), 0, $length);
    }
}
