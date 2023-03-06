<?php

namespace Groovey\Generator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class Create extends Command
{
    public $input;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('generate:create')
            ->setDescription('Creates a predefined template')
            ->addArgument(
                'arg',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'The required arguments.'
            )
        ;
    }

    public function replaceArguments($text)
    {
        $input = $this->input;
        $arg   = $input->getArgument('arg');

        $cnt   = 0;
        foreach ($arg as $value) {
            $text = str_replace("ARG{$cnt}", $arg[$cnt], $text);
            ++$cnt;
        }

        return $text;
    }

    public function replaceContent($data)
    {
        $temp = [];
        foreach ($data as $key => $value) {
            if (strpos($value, '|')) {
                $temp[$key] = $this->processDelimeter($value);
            } else {
                $temp[$key] = $value;
            }
        }

        return $temp;
    }

    public function processDelimeter($data)
    {
        $text = '';
        foreach (explode('|', $data) as $value) {
            if (substr($value, 0, 3) == 'ARG') {
                $text = $this->replaceArguments($value);
            } else {
                switch ($value) {
                    case 'strtoupper':  $text = strtoupper($text);  break;
                    case 'strtolower':  $text = strtolower($text);  break;
                    case 'ucfirst':     $text = ucfirst($text);     break;
                    default: break;
                }
            }
        }

        return $text;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $arg         = $input->getArgument('arg');
        $fs          = new Filesystem();
        $generators  = getcwd().'/resources/generators';
        $loader      = new \Twig_Loader_Filesystem($generators);
        $twig        = new \Twig_Environment($loader);
        $config      = include getcwd().'/config/generator.php';
        $config      = element($arg[0], $config);
        $source      = $generators.'/'.element('source', $config);
        $destination = element('destination', $config);
        $destination = $this->replaceArguments($destination);

        if (!$config) {
            $output->writeln("<error>{$arg[0]} does not exist. Please check your confile file.</error>");

            return;
        }

        if (!$fs->exists($source)) {
            $output->writeln('<error>The source file does not exist</error>');

            return;
        }

        if (!$fs->exists(dirname($destination))) {
            $output->writeln('<error>The destination folder does not exist</error>');
            $output->writeln('<info>Create the destination folder at ('.dirname($destination).').</info>');

            return;
        }

        if ($fs->exists($destination)) {
            $output->writeln('<error>Unable to create the destination file.</error>');
            $output->writeln("<info>File already exist ($destination).</info>");

            return;
        }

        $contents = $twig->render(
            basename($source),
            $this->replaceContent($config['replace'])
        );

        file_put_contents($destination, $contents);

        $output->writeln("<info>Sucessfully created template ($destination).</info>");
    }
}
