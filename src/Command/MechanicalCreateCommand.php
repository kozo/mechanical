<?php
declare(strict_types=1);

namespace Mechanical\Command;

use Bake\Command\SimpleBakeCommand;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Utility\Inflector;

/**
 * Mechanical command.
 */
class MechanicalCreateCommand extends SimpleBakeCommand
{
    /**
     * Default class name.
     *
     * @var string
     */
    private const DEFAULT_CLASS_NAME = 'MechanicalCron';
    private $fileName;

    /**
     * Task name used in path generation.
     *
     * @var string
     */
    public $pathFragment = 'Mechanical/';

    /**
     * @inheritDoc
     */
    public static function defaultName(): string
    {
        return 'create';
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'mechanical';
    }

    /**
     * @inheritDoc
     */
    public function fileName(string $name): string
    {
        return $name . '.php';
    }

    /**
     * @inheritDoc
     */
    public function template(): string
    {
        return 'Mechanical.Mechanical/mechanical';
    }

    /**
     * Execute the command.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $this->extractCommonProperties($args);
        $name = $args->getArgumentAt(0) ?? self::DEFAULT_CLASS_NAME;
        if (empty($name)) {
            $io->err('You must provide a name to bake a ' . $this->name());
            $this->abort();

            return null;
        }
        $name = $this->_getName($name);
        $this->fileName = $name;

        $name = Inflector::camelize($name);
        $this->bake($name, $args, $io);
        $this->bakeTest($name, $args, $io);

        return static::CODE_SUCCESS;
    }
}
