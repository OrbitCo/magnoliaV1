<?php

namespace Pg\Libraries\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Pg\modules\install\models\Generators\CreateModule;

class GenerateModuleCommand extends Command
{
    protected function configure()
    {
        $this->setName('generate:module')
            ->setDescription('The base structure for the module is created.')
            ->addArgument('name', InputArgument::OPTIONAL, 'Enter module name');
    }

    /**
     * @throws FileNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        require_once __DIR__ . '/../../../config.php';

        $module_name = $input->getArgument('name');
        if (empty($module_name)) {
            $helper = $this->getHelper('question');
            $question = new Question('<comment>Enter module name:</comment>');
            $module_name = $helper->ask($input, $output, $question);
        }

        if (empty($module_name)) {
            $output->writeln('<error>Module name not specified!!!</error>');
        } elseif (in_array($module_name, $this->modulesList(), false) === true) {
            $output->writeln('<error>Module already exists!!!</error>');
        } else {
            $output->writeln([
                'Module is being created...',
                '<comment>==========================</comment>',
                ''
            ]);

            // run the migrations
            $start = microtime(true);

            $model = new CreateModule($module_name);
            $model->generate();

            $end = microtime(true);

            $output->writeln([
                'Complete.',
                "Module <info>{$module_name}</info> created. [" . SITE_SUBFOLDER . "application/modules/{$module_name}/]",
                '<comment>All Done. Took ' . sprintf('%.4fs', $end - $start) . '</comment>'
            ]);
        }
    }

    private function modulesList(): array
    {
        $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . 'application/modules/');
        $filesystem = new Filesystem($adapter);
        $list = $filesystem->listContents();

        return array_column($list, 'basename');
    }
}
