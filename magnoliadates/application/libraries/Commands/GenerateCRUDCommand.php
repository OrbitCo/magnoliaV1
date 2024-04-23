<?php

namespace Pg\Libraries\Commands;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Pg\modules\install\models\Generators\CreateCRUD;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;

class GenerateCRUDCommand extends Command
{
    /**
     * @var null|PDO
     */
    private $db = null;

    /**
     * @var array|false
     */
    private $table_data;

    protected function configure()
    {
        $this->setName('generate:crud')
            ->setDescription('This generator generates a methods and views that implement CRUD (Create, Read, Update, Delete) operations for the specified data model.');
    }

    /**
     * @throws FileNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        require_once __DIR__ . '/../../../config.php';

        $helper = $this->getHelper('question');
        $question = new Question('<comment>Enter <options=bold,underscore>module</> name:</comment>');
        $module_name = $helper->ask($input, $output, $question);
        if (in_array($module_name, $this->modulesList(), false) !== true) {
            $output->writeln('<error>Module not exists!!!</error>');
        } else {
            $question = new Question('<comment>Enter <options=bold,underscore>database table</> name:</comment>');
            $table_name = $helper->ask($input, $output, $question);
            if (empty($table_name) || empty($this->tableData($table_name))) {
                $output->writeln('<error>Table not exists!!!</error>');
            } else {
                $example_model_name = $this->formatNameModel($module_name, str_replace(DB_PREFIX, '', $table_name));
                $question = new Question("<comment>Enter <options=bold,underscore>model</> name: (example {$example_model_name})</comment>", $example_model_name);
                $model_name = $helper->ask($input, $output, $question);
                $model_name = $this->formatNameModel($module_name, $model_name, false);
                if ($this->hasModel($module_name, $model_name) !== true) {
                    $question = new ChoiceQuestion(
                        'User or admin',
                        ['user', 'admin'],
                        0
                    );
                    $question->setErrorMessage('This usertype % does not exist.');
                    $controller_side = $helper->ask($input, $output, $question);
                    $output->writeln('you have just chosen: ' . $controller_side);

                    $start = microtime(true);
                    $model = new CreateCRUD($table_name, $this->table_data, $module_name, $model_name, $controller_side);
                    $model->generate();
                    $end = microtime(true);

                    $output->writeln([
                        'Complete.',
                        "Module <info>{$module_name}</info> created. [" . SITE_SUBFOLDER . "application/modules/{$module_name}/]",
                        '<comment>All Done. Took ' . sprintf('%.4fs', $end - $start) . '</comment>'
                    ]);
                } else {
                    $output->writeln('<error>Model already exists!!!</error>');
                }
            }
        }
    }

    /**
     * Modules list
     *
     * @return array
     */
    private function modulesList(): array
    {
        $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . 'application/modules/');
        $filesystem = new Filesystem($adapter);
        $list = $filesystem->listContents();

        return array_column($list, 'basename');
    }

    /**
     * Format name model
     *
     * @param string $module_name
     * @param string $model_name
     * @param bool $is_example
     *
     * @return array|string|string[]
     */
    private function formatNameModel(string $module_name, string $model_name, bool $is_example = true)
    {
        $model = str_replace(' ', '', ucwords(str_replace('_', ' ', $model_name)));
        $prefix = ucfirst($module_name);
        $postfix = 'Model';
        $is_prefix = strrpos($model, $prefix);
        if ($is_prefix === false && $is_example === true) {
            $model = $prefix . $model;
        } elseif ($is_prefix !== false && $is_example === false) {
            $model = str_replace($prefix, '', $model);
        }

        $is_postfix = strrpos($model, $postfix);
        if ($is_postfix === false) {
            $model = $model . $postfix;
        }

        return $model;
    }

    /**
     * Has model
     *
     * @param string $module_name
     * @param string $model_name
     *
     * @return bool
     */
    private function hasModel(string $module_name, string $model_name): bool
    {
        return file_exists(SITE_PATH . SITE_SUBFOLDER .
            "application/modules/{$module_name}/models/{$model_name}.php");
    }

    /**
     * Database connect
     *
     * @return \PDO
     */
    private function db(): \PDO
    {
        if (is_null($this->db)) {
            try {
                $dsn = 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_HOSTNAME;
                $this->db = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        return $this->db;
    }

    /**
     * Database table
     *
     * @param string $table_name
     *
     * @return array|false
     */
    private function tableData(string $table_name)
    {
        $data = $this->db()->prepare("SHOW COLUMNS FROM `{$table_name}`");
        $data->execute();
        $this->table_data = $data->fetchAll(\PDO::FETCH_ASSOC);

        return $this->table_data;
    }
}
