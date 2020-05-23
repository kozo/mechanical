<?php
declare(strict_types=1);

namespace Mechanical\Shell\Task;

use Bake\Shell\Task\SimpleBakeTask;
use Cake\Console\Shell;
use Cake\Utility\Inflector;

/**
 * Hoge shell task.
 */
class CreateTask extends SimpleBakeTask
{
    public $pathFragment = 'Mechanical/';
    /**
     * Get the generated object's name.
     *
     * @return string
     */
    public function name() {
        return 'mechanical';
    }

    /**
     * Get the generated object's filename without the leading path.
     *
     * @param string $name The name of the object being generated
     * @return string
     */
    public function fileName($name) {
        return $name . '.php';
    }

    /**
     * Get the template name.
     *
     * @return string
     */
    /*public function template() {
        return 'Mechanical.Mechanical/mechanical';
    }*/
    public function template()
    {
        return 'Mechanical.Mechanical/mechanical';
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->addOption('class', [
            'short' => 'c',
            'help' => 'Create a new Mechanical class',
            'default' => 'MechanicalCron',
        ]);

        return $parser;
    }
    /*
     * $name = $args->getArgumentAt(0) ?? self::DEFAULT_CLASS_NAME;
        if (empty($name)) {
            $io->err('You must provide a name to bake a ' . $this->name());
            $this->abort();

            return null;
        }
        $name = $this->_getName($name);
        $this->fileName = $name;

        $name = Inflector::camelize($name);
        $this->bake($name);

        return static::CODE_SUCCESS;
     */

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main($name = null)
    {
        $className = $this->param('class');

        parent::main($className);
    }
}
