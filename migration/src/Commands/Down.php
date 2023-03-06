<?php

namespace Groovey\Migration\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Yaml\Parser;
use Groovey\Migration\Migration;
use Groovey\Support\Output;

class Down extends Command
{
    private $app;

    public function __construct($app)
    {
        parent::__construct();

        $this->app = $app;
    }

    protected function configure()
    {
        $this
            ->setName('migrate:down')
            ->setDescription('Reverese the migration')
            ->addArgument(
                'version',
                InputArgument::OPTIONAL,
                'Version number to rollback'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app      = $this->app;
        $dir      = Migration::getDirectory();
        $output   = Output::style($output);
        $yaml     = new Parser();
        $version  = $input->getArgument('version');
        $helper   = $this->getHelper('question');
        $question = new ConfirmationQuestion('<question>Are you sure you want to proceed? (y/N):</question> ', false);

        if ($version) {
            $record = $app['db']->table('migrations')->where('version', '=', $version)->first();

            if (!$record) {
                $output->writeln('<error>Unable to find migration version.</error>');

                return;
            }

            $records = $app['db']->table('migrations')->where('id', '>=', $record->id)
                            ->orderBy('version', 'DESC')
                            ->get();
        } else {
            $records = $app['db']->table('migrations')->orderBy('version', 'DESC')->take(1)->get();
        }

        if (count($records) == 0) {
            $output->writeln('<error>Nothing to downgrade.</error>');

            return;
        }

        $output->writeln('<highlight>Migration will downgrade to the following files:</highlight>');

        foreach ($records as $record) {
            $output->writeln("<info>- {$record->version}.yml</info>");
        }

        if (!$helper->ask($input, $output, $question)) {
            return;
        }

        foreach ($records as $record) {
            $id       = $record->id;
            $version  = $record->version;
            $filename = $version.'.yml';

            $output->writeln("<info>- Downgrading ($filename)</info>");

            $value = $yaml->parse(file_get_contents($dir.'/'.$filename));
            $down  = explode(';', trim($value['down']));
            $down  = array_filter($down);

            foreach ($down as $query) {
                $app['db']::statement(trim($query));
            }

            $app['db']->table('migrations')->delete($id);
        }
    }
}
