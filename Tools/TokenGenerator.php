<?php

namespace Wandi\ToolsBundle\Tools;

class TokenGenerator
{
    /**
     * Generate a token with number and chars.
     *
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length = 16): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars, 'utf-8');

        for ($i = 0, $token = ''; $i < $length; ++$i) {
            $index = rand(0, $count - 1);
            $token .= mb_substr($chars, $index, 1);
        }

        return $token;
    }
}
