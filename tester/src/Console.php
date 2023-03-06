<?php

namespace Groovey\Tester;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class Console
{
    private $console;
    private $cli;
    private $command;
    private $tester;

    public function __construct($app, Application $cli)
    {
        $this->cli = $cli;
        $this->app = $app;
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);

        return $stream;
    }

    public function add(array $commands = [])
    {
        $cli = $this->cli;

        foreach ($commands as $command) {
            $cli->add($command);
        }
    }

    public function command($name)
    {
        $cli = $this->cli;
        $this->command = $cli->find($name);
    }

    public function input($value)
    {
        $command = $this->command;
        $helper = $command->getHelper('question');

        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['y']);
        $commandTester->execute(array('command' => $command->getName()));

        return $this;
    }

    public function execute(array $param = [])
    {
        $command = $this->command;

        $datas['command'] = $command->getName();
        foreach ($param as $key => $value) {
            $datas[$key] = $value;
        }

        $tester = new CommandTester($command);
        $tester->execute($datas);

        $this->tester = $tester;

        return $this;
    }

    public function display()
    {
        $tester = $this->tester;

        return $tester->getDisplay();
    }
}
