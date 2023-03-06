<?php

namespace Groovey\Tester\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Sample extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('sample:greet')
            ->setDescription('Sample script for tester.')
             ->addArgument(
                'person',
                InputArgument::REQUIRED,
                'Person name'
            )
            ->addArgument(
                'message',
                InputArgument::OPTIONAL,
                'Message to be displayed'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $person = $input->getArgument('person');
        $message = $input->getArgument('message');
        $hello = trim("Hello {$person}! {$message}").'.';

        $output->writeln($hello);
    }
}
