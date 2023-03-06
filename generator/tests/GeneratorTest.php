<?php

use Silex\Application;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Groovey\Tester\Providers\TesterServiceProvider;
use Groovey\Console\Providers\ConsoleServiceProvider;
use Groovey\Generator\Commands\About;
use Groovey\Generator\Commands\Create;

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new TesterServiceProvider());

        $app->register(new ConsoleServiceProvider(), [
            'console.name'    => 'Groovey',
            'console.version' => '1.0.0',
        ]);

        $app['tester']->add([
                new About(),
                new Create(),
            ]);

        $this->app = $app;
    }

    public function testAbout()
    {
        $app     = $this->app;
        $display = $app['tester']->command('generate:about')->execute()->display();
        $this->assertRegExp('/Groovey/', $display);
    }

    public function testCreateFolder()
    {
        $fs = new Filesystem();
        try {
            $fs->mkdir('./output', 0775);
        } catch (IOExceptionInterface $e) {
            echo 'An error while creating the folder '.$e->getPath();
        }
    }

    public function testCreate()
    {
        $app     = $this->app;
        $display = $app['tester']->command('generate:create')->execute(['arg' => ['Controller', 'Users']])->display();
        $this->assertRegExp('/Sucessfully/', $display);
    }

    public function testDelete()
    {
        $fs = new Filesystem();
        try {
            $fs->remove(['./output/Users.php']);
        } catch (IOExceptionInterface $e) {
            echo 'An error while deleting the file '.$e->getPath();
        }
    }
}
