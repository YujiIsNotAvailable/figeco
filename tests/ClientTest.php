<?php
namespace Tests;
require_once(dirname(__FILE__)."/../vendor/autoload.php");

use Figeco\Client;
use Figeco\Request\Query;
use Figeco\Request\Uri;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testDoRequest()
    {
        $client = new Client();
        $response = $client->request(
            (new Uri('https://avatars.githubusercontent.com/'))
                ->addPath("u/63526333/")
                ->withQuery(new Query([
                    "s" => 460,
                    "v" => 4
                ]))
        );

        $this->assertEquals(
            file_get_contents('https://avatars.githubusercontent.com/u/63526333?s=460&v=4'),
            $response->get()
        );
    }
}