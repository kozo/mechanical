<?php
declare(strict_types=1);

namespace Mechanical\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Migrations\Command\MigrationsDumpCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Mechanical command.
 */
class MechanicalCommand extends Command
{

    /**
     * @inheritDoc
     */
    /*protected function configure()
    {
        $this
            ->setName('orm-cache-build')
            ->setDescription(
                'Build all metadata caches for the connection. ' .
                'If a table name is provided, only that table will be cached.'
            )
            ->addOption(
                'connection',
                null,
                InputOption::VALUE_OPTIONAL,
                'The connection to build/clear metadata cache data for.',
                'default'
            )
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'A specific table you want to clear/refresh cached data for.'
            );
    }//*/

    /**
     * @inheritDoc
     */
    /*public static function defaultName(): string
    {
        return 'hoge';
    }*/

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        // ここでヘルプを出したい
        // Migrationsを参考に getAppが関係してる.Applicationからプラグインを追加してる
        echo "aaa";
        //$dumpExitCode = $this->executeCommand(MechanicalCommand::class, [], $io);
    }
}
