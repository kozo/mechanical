<?php
declare(strict_types=1);

namespace Mechanical;

use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;
use Mechanical\Command\MechanicalCommand;
use Mechanical\Command\MechanicalCreateCommand;
use Mechanical\Command\MechanicalInstallCommand;
use Mechanical\Command\MechanicalShowCommand;

class Plugin extends BasePlugin
{
    /**
     * @param \Cake\Console\CommandCollection $commands
     * @return \Cake\Console\CommandCollection
     */
    public function console(CommandCollection $commands): CommandCollection
    {
        $commands->add('mechanical', MechanicalCommand::class);
        $commands->add('mechanical create', MechanicalCreateCommand::class);
        $commands->add('mechanical install', MechanicalInstallCommand::class);
        $commands->add('mechanical show', MechanicalShowCommand::class);

        return $commands;
    }
}
