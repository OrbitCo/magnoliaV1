<?php

namespace Pg\Libraries\Commands;

use Pg\Libraries\View\Driver\Twig;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ClearTwigCacheCommand extends Command
{
    protected function configure()
    {
        $this->setName('clear:cache')
            ->setDescription('Clears the twig application cache.')
            ->setHelp('Allows you to delete the application cache. Pass the --modules parameter to clear caches of specific modules.')
            ->addOption(
                'modules',
                'm',
                InputOption::VALUE_OPTIONAL,
                'Pass the comma separated module names if you don\'t want to clear all caches.',
                ''
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Cache is about to cleared...');
        require_once __DIR__ . '/../../../config.php';
        define('TEMPPATH', SITE_PATH . SITE_SUBFOLDER . 'temp/');
        $twig = new Twig();
        if ($input->getOption('modules')) {
            $modules = explode(",", $input->getOption('modules'));

            if (is_array($modules) && count($modules)) {
                foreach ($modules as $module) {
                    $twig->clearCache($module);
                    $output->writeln(sprintf('%s cache is cleared', $module));
                }
            }
        } else {
            $twig->clearCache();
            $output->writeln('All caches are cleared.');
        }

        $output->writeln('Complete.');
    }
}
