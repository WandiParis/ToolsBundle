<?php

namespace Wandi\ToolsBundle\Services;

class HostParser
{
    public function parse($host = ''){
        $exploded = explode('.', $host);
        $nb = count($exploded);
        return [
            'subdomain' => implode('.', array_slice($exploded, 0, $nb - 2)),
            'domain' => implode('.', array_slice($exploded, $nb - 2, 2)),
        ];
    }
}
