<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class TesterTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);
        $app->register('tester', 'Groovey\Tester\Providers\Tester');

        $tester = $app->get('tester')->getInstance();

        $tester->add([
                'Groovey\Tester\Commands\Sample',
                'Groovey\Tester\Commands\About',
                'Groovey\Tester\Commands\Ask',
            ]);

        $this->app = $app;
    }

    public function testAbout()
    {
        $app = $this->app;
        $tester = $app->get('tester')->getInstance();
        $display = $tester->command('sample:about')->execute()->display();
        $this->assertRegExp('/Groovey/', $display);
    }

    public function testGreet()
    {
        $app = $this->app;
        $tester = $app->get('tester')->getInstance();
        $display = $tester
                        ->command('sample:greet')
                        ->execute([
                                'person' => 'Kim',
                                'message' => 'How are you today?',
                            ])
                        ->display()
                    ;

        $this->assertRegExp('/How are you today?/', $display);
    }

    public function testAsk()
    {
        $app = $this->app;
        $tester = $app->get('tester')->getInstance();
        $display = $tester->command('sample:ask')->input('Y\n')->execute()->display();

        $this->assertRegExp('/Success/', $display);
    }
}
