<?php
namespace Figeco\Request;

use Figeco\EncodeQueryOptions;

class Uri
{
    private string $base;
    private array $path = [];
    private ?Query $query;

    public function __construct(string $baseUri)
    {
        $this->base = $baseUri;
    }

    public function addPath(string $path): self
    {
        $this->path[] = $path;
        return $this;
    }

    public function withQuery(Query $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function __toString(): string
    {
        $uri = $this->base;
        $path = '';
        foreach ($this->path as $_path) {
            $path .= "/{$_path}/";
        }

        $path = $this->removeExcedentSlashes($path);

        $uri = $this->removeExcedentSlashes($uri) . $path;
        
        if (isset($this->query)) $uri .= "?".(string)$this->query;
        return $uri;
    }

    private function removeExcedentSlashes(string $data)
    {
        $replacement = ['/', ''];
        $_d = preg_replace_callback('/(^\:\/\/|\/$|\/\/$)/', function () use (&$replacement) {
            foreach ($replacement as $key => $value) {
                return array_shift($replacement);
            }
        }, $data);

        $_d = preg_replace("/\/$/", '', $_d);

        return $_d;
    }
}