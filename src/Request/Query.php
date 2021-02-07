<?php
namespace Figeco\Request;

use Figeco\EncodeQueryOptions;
use Figeco\Exceptions;

class Query
{
    private array $query;
    private string $encodeType;

    public function __construct(array $q = [], string $encodeType = null)
    {
        foreach($q as $k => $v) {
            if (!is_scalar($k) || !is_scalar($v)) throw new Exceptions\QueryException("Key and Value of Query params should be string");
        }
        $this->query = $q;

        switch ($encodeType) {
            case null:
                $this->encodeType = EncodeQueryOptions::ENCODE_BOTH;
                break;
            case EncodeQueryOptions::ENCODE_BOTH || EncodeQueryOptions::ENCODE_KEY || EncodeQueryOptions::ENCODE_VALUE:
                $this->encodeType = $encodeType;
                break;
            default:
                throw new Exceptions\QueryException("Invalid encode query option.");
        }
    }

    public function __toString() :string
    {
        switch ($this->encodeType) {
            case null || EncodeQueryOptions::ENCODE_BOTH:
                return http_build_query($this->query, '', '&', \PHP_QUERY_RFC3986);
            
            case EncodeQueryOptions::ENCODE_KEY || EncodeQueryOptions::ENCODE_VALUE:
                $qs = '';
                $i = 0;
                foreach ($this->query as $key => $_q) {
                    if (EncodeQueryOptions::ENCODE_KEY) $key = urlencode($key);
                    if (EncodeQueryOptions::ENCODE_VALUE) $_q = urlencode($_q);

                    $qs .= "{$key}={$_q}";
                    $i++;
                    if (count($this->query) > $i) $qs .= "&";
                }
                return $qs;

            default:
                throw new Exceptions\QueryException("Invalid encode query option.");
        }
    }

    public function get(): array
    {
        return $this->query;
    }

}