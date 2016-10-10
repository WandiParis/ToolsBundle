<?php

namespace Wandi\ToolsBundle\Util;

class HostParser
{
    public function parse($host = '')
    {
        $exploded = explode('.', $host);
        $nb = count($exploded);

        return [
            'subdomain' => implode('.', array_slice($exploded, 0, 1)),
            'domain' => implode('.', array_slice($exploded, 1, $nb - 1)),
        ];
    }
}
