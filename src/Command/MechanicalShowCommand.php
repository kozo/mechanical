<?php
declare(strict_types=1);

namespace Mechanical\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Watchmaker\Config;
use Watchmaker\error\ClassNotFoundException;
use Watchmaker\Watchmaker;

/**
 * Mechanical command.
 */
class MechanicalShowCommand extends Command
{
    /**
     * @inheritDoc
     */
    public static function defaultName(): string
    {
        return 'show';
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser
            ->addOption('class', [
                'short' => 'c',
                'help' => 'class name',
                'default' => 'MechanicalCron',
            ])
            ->addOption('namespace', [
                'short' => 'n',
                'help' => 'namespace',
                'default' => '\App\Mechanical',
            ])
            ->addOption('ansi', [
                'help' => 'ansi',
                'default' => false,
                'boolean' => true,
            ]);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return void
     * @throws \Watchmaker\error\ClassNotFoundException
     */
    public function execute(Arguments $args, ConsoleIo $io): void
    {
        $namespace = $args->getOption('namespace');
        $className = $args->getOption('class');

        $class = sprintf('%s\\%s', $namespace, $className);
        if (class_exists($class) === false) {
            throw new ClassNotFoundException();
        }

        $options = $args->getOptions();
        $config = new Config($options);

        $watchmaker = new Watchmaker($config);
        $quarts = new $class();
        $watchmaker = $quarts->handle($watchmaker);
        $text = $watchmaker->show();

        $io->out($text);
    }
}
