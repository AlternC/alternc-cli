<?php

namespace AlternC\Ahc;

use Ahc;
use Ahc\Cli\Input\Command;

class Application extends Ahc\Cli\Application
{
    public function commandFor(array $argv): Command
    {
        $argv += [null, null, null];
        $command = null;

        //sort by key length
        //find maximal command compatibility by arguments
        $keys = array_map('strlen', array_keys($this->commands));
        array_multisort($keys, SORT_ASC, $this->commands);

        foreach ($this->commands as $command_name => $value) {
            $nb_args = count(explode(' ', $command_name));
            $args = implode(' ', array_slice($argv, 1, $nb_args));
            if (! empty($this->commands[$args])) {
                $command = $this->commands[$args];
            }
        }
        return
            //cmd found by multi arguments
            $command
            // cmd
            ?? $this->commands[$argv[1]]
            // cmd alias
            ?? $this->commands[$this->aliases[$argv[1]] ?? null]
            // default.
            ?? $this->commands[$this->default];
    }

    public function add(Command $command, string $alias = '', bool $default = false): self
    {
        parent::add($command, $alias, $default);
        if (method_exists($command, "getSubCommands")) {
            foreach ($command->getSubCommands() as $subcommand) {
                parent::add($subcommand);
            }
        }
        return $this;
    }
}
