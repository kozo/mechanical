<?php
declare(strict_types=1);
namespace Mechanical\Shell;

use Cake\Cache\Cache;
use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Core\Plugin;

/**
 * Simple console wrapper around Psy\Shell.
 */
class MechanicalShell extends Shell
{
    public $tasks = ['Mechanical.Create'];

    public function startup()
    {
        parent::startup();
        Cache::disable();
        // Loading WyriHaximus/TwigView Plugin through the Plugin::load() for backward compatibility.
        if (!Plugin::isLoaded('WyriHaximus/TwigView')) {
            Plugin::load('WyriHaximus/TwigView', ['bootstrap' => true]);
        }
    }
    /**
     * Start the shell and interactive console.
     *
     * @return int|null
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
        /*if (!class_exists('Psy\Shell')) {
            $this->err('<error>Unable to load Psy\Shell.</error>');
            $this->err('');
            $this->err('Make sure you have installed psysh as a dependency,');
            $this->err('and that Psy\Shell is registered in your autoloader.');
            $this->err('');
            $this->err('If you are using composer run');
            $this->err('');
            $this->err('<info>$ php composer.phar require --dev psy/psysh</info>');
            $this->err('');

            return self::CODE_ERROR;
        }

        $this->out("You can exit with <info>`CTRL-C`</info> or <info>`exit`</info>");
        $this->out('');

        Log::drop('debug');
        Log::drop('error');
        $this->_io->setLoggers(false);
        restore_error_handler();
        restore_exception_handler();

        $psy = new PsyShell();
        $psy->run();*/
        /*$app = $this->getApp();
        $input = new ArgvInput($this->argv);
        $app->setAutoExit(false);
        $exitCode = $app->run($input, $this->getOutput());*/
    }

    /**
     * Display help for this console.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = new ConsoleOptionParser('mechanical');
        /*$parser->setDescription(
            'This shell provides a REPL that you can use to interact with ' .
            'your application in a command line designed to run PHP code. ' .
            'You can use it to run adhoc queries with your models, or ' .
            'explore the features of CakePHP and your application.' .
            "\n\n" .
            'You will need to have psysh installed for this Shell to work.'
        );*/


        $parser->addSubcommand('create', [
            'help' => 'Execute The Sound Task.',
            'parser' => $this->Create->getOptionParser(),
        ]);


        return $parser;
    }

//    protected function getApp()
//    {
//        return new MechanicalDispatcher();
//    }

    /**
     * Returns the instance of OutputInterface the MigrationsDispatcher will have to use.
     *
     * @return \Symfony\Component\Console\Output\ConsoleOutput
     */
//    protected function getOutput()
//    {
//        return new ConsoleOutput();
//    }

    /**
     * Display the help in the correct format
     *
     * @param string $command The command to get help for.
     * @return int|bool|null Exit code or number of bytes written to stdout
     */
    protected function displayHelp($command)
    {
        return $this->main();
    }

    /**
     * {@inheritDoc}
     */
    // @codingStandardsIgnoreStart
    protected function _displayHelp($command)
    {
        // @codingStandardsIgnoreEnd
        return $this->displayHelp($command);
    }
}
