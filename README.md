# PHP FileGetContent Client #

## Install ##
```php
composer install figeco/figeco 
```

## Motivation ##
- Trying to use GuzzleHttp, some cases, I've had err 56: "OpenSSL SSL_read:" making it impossible to get receive data.
- Some of APIs ask for not urlencoded key and values, so this lib makes possible to only encode the key, value or both of query parameters.

## Usage ##
```php
$client = new \Figeco\Client;
$response = $client->request(
    (new \Figeco\Request\Uri('http://someuri.com.br/'))
        ->addPath('/test/')
        ->withQuery(new \Figeco\Request\Query([
            'param1' => 'data',
            'param2' => 'data',
        ] /*, EncodeQueryOptions::VALUE to encode only value */)
    )
);

$data = $response->data();
```

## Test ##
```php
php ./vendor/phpunit/phpunit/phpunit .
```