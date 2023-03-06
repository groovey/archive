<?php

namespace Groovey\Security;

use Pimple\Container;

class Cryptography
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function encrypt($data, $key)
    {
        return openssl_encrypt($data, 'AES-128-ECB', $key);
    }

    public function decrypt($data, $key)
    {
        return openssl_decrypt($data, 'AES-128-ECB', $key);
    }

    public function hash($data)
    {
        return hash('ripemd160', $data);
    }
}
