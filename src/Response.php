<?php
namespace Figeco;

class Response
{
    private $data = null;
    public function __construct(string $data = null)
    {
        if ($data) {
            $decoded = json_decode($data);
            $this->data = $decoded ?: $data;
        }
    }

    /** @return \stdClass|null|string */
    public function get()
    {
        return $this->data;
    }
}