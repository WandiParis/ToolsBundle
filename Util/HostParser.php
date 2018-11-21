<?php

namespace Wandi\ToolsBundle\Util;

class HostParser
{
    /**
     * Parse a host.
     *
     * @param string $host
     *
     * @return array
     */
    public static function parse(string $host = ''): array
    {
        $exploded = explode('.', $host);
        $nb = count($exploded);

        if ($nb > 2) {
            $subdomain = array_slice($exploded, 0, 1);
        } else {
            $subdomain = [];
        }

        $domain = array_slice($exploded, count($subdomain), $nb);

        return [
            'subdomain' => implode('.', $subdomain),
            'domain' => implode('.', $domain),
        ];
    }
}
