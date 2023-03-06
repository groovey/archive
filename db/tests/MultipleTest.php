<?php

use Silex\Application;
use Groovey\DB\Providers\DBServiceProvider;

class MultipleTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new DBServiceProvider(), [
            'db.connections' => [
                'default' => [
                    'host'      => 'localhost',
                    'driver'    => 'mysql',
                    'database'  => 'test_db',
                    'username'  => 'root',
                    'password'  => '',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                    'logging'   => true,
                ],
                'migration' => [
                    'host'      => 'localhost',
                    'driver'    => 'mysql',
                    'database'  => 'test_db',
                    'username'  => 'root',
                    'password'  => '',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                    'logging'   => true,
                ],
            ],
        ]);

        $this->app = $app;
    }

    public function test()
    {
        $app = $this->app;

        Database::create();

        $results = $app['db']::table('users')->where('id', '>=', 1)->get();
        $this->assertInternalType('array', $results);

        $results = $app['db']::connection('migration')->table('users')->where('id', '>=', 1)->get();
        $this->assertInternalType('array', $results);

        Database::drop();
    }
}
