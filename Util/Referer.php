<?php

namespace Wandi\ToolsBundle\Util;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouterInterface;

class Referer
{
    /** @var RequestStack */
    private $requestStack;
    /** @var RouterInterface */
    private $router;

    public function __construct(RequestStack $requestStack, RouterInterface $router)
    {
        $this->requestStack = $requestStack;
        $this->router       = $router;
    }

    public function getReferer()
    {
        $request = $this->requestStack->getMasterRequest();

        if ($request === null){
            return null;
        }

        $referer = (string) $request->headers->get('referer');
        $refererParsed = parse_url($referer);
        $path = str_replace('/app_dev.php/', '/', $refererParsed['path']);

        try {
            $route = $this->router->match($path);
        } catch (ResourceNotFoundException $e) {
            return null;
        }

        return $route;
    }
}