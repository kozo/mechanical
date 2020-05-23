<?php
declare(strict_types=1);

namespace Mechanical\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;
use Cake\Console\Shell;
use Cake\Utility\Inflector;
use Watchmaker\Config;
use Watchmaker\error\ClassNotFoundException;
use Watchmaker\Watchmaker;

/**
 * Hoge shell task.
 */
class InstallTask extends Shell
{
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser
            ->addOption('class', [
                'short' => 'c',
                'help' => 'Create a new Mechanical class',
                'default' => 'MechanicalCron',
            ])
            ->addOption('namespace', [
                'short' => 'n',
                'help' => 'Set the namespace.',
                'default' => '\App\Mechanical'
            ])
            ->addOption('ansi', [
                'help' => 'ansi',
                'default' => false,
                'boolean' => true
            ])
        ;

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     * @throws ClassNotFoundException
     */
    public function main()
    {
        $options = $this->params;

        $namespace = $options['namespace'];
        $className = $options['class'];
        $class = sprintf("%s\\%s", $namespace, $className);
        if (class_exists($class) === false) {
            throw new ClassNotFoundException();
        }

        $config = new Config($options);

        $watchmaker = new Watchmaker($config);
        $quarts = new $class();
        $watchmaker = $quarts->handle($watchmaker);

        if ($options['quiet'] === true || $this->getIo()->askChoice('Do you want to install? (yes/no)', ['yes', 'no'],  'no') === 'yes') {
            try {
                $text = $watchmaker->install();

                $this->getIo()->out($text);
            } catch (\Exception $e) {
                $this->getIo()->error($e->getMessage());
            }
        }
    }
}
