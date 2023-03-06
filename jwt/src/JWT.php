<?php

namespace Groovey\JWT;

use Pimple\Container;
use Firebase\JWT\JWT as Token;

class JWT
{
    private $app;
    private $issuer;
    private $audience;
    private $expiration;
    private $key;

    public function __construct(Container $app, $config)
    {
        $this->app        = $app;
        $this->issuer     = element('issuer', $config);
        $this->audience   = element('audience', $config);
        $this->expiration = element('expiration', $config);
        $this->key        = element('key', $config);
    }

    public function encode($payload)
    {
        $expiration = element('expiration', $payload);

        if ($expiration) {
            unset($payload['expiration']);
            $payload['exp'] = $expiration;
        } else {
            $payload['exp'] = $this->expiration;
        }

        $token = Token::encode($payload, $this->key);

        return $token;
    }

    public function decode($token)
    {
        $decoded = Token::decode($token, $this->key, ['HS256']);

        return (array) $decoded;
    }
}
