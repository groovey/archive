<?php

use Silex\Application;
use Groovey\Support\Providers\TraceServiceProvider;
use Groovey\JWT\Providers\JWTServiceProvider;

class JWTTest extends PHPUnit_Framework_TestCase
{
    public $app;
    private $token;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new TraceServiceProvider());
        $app->register(new JWTServiceProvider(), [
                'jwt.issuer'     => 'localhost',
                'jwt.audience'   => 'http://sso.onekey.dev',
                'jwt.key'        => 'testkey',
            ]);

        $this->app = $app;
    }

    public function testEncode()
    {
        $app = $this->app;

        $payload = [
            'email'    => 'test1@gmail.com',
            'password' => 'test1',
        ];

        $token   = $app['jwt']->encode($payload);
        $decoded = $app['jwt']->decode($token);

        $this->assertArrayHasKey('email', $decoded);
        $this->assertArrayHasKey('password', $decoded);
        $this->assertArrayHasKey('exp', $decoded);
        $this->assertEquals('test1@gmail.com', $decoded['email']);
        $this->assertEquals('test1', $decoded['password']);
    }

    public function testExpiredToken()
    {
        $app = $this->app;

        $this->setExpectedException('Firebase\JWT\ExpiredException');

        $payload = [
            'email'      => 'test1@gmail.com',
            'password'   => 'test1',
            'expiration' => time() - 3600,
        ];

        $token = $app['jwt']->encode($payload);
        $app['jwt']->decode($token);
    }
}
