<?php
namespace Figeco;

use Figeco\Request\Uri;

interface ClientInterface
{
    public function request(Uri $uri);
}