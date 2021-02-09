<?php
namespace Figeco;

use Figeco\Request\Uri;

/**
 * Client for file get contents requests.
 */
class Client implements ClientInterface
{
    private array $config;
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function request(Uri $uri): Response
    {
        /** add exception handler. */
        return new Response(file_get_contents((string)$uri));
    }
}