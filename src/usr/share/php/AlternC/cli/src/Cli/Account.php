<?php

namespace AlternC\Cli;

use Ahc;
use League\ConstructFinder\ConstructFinder;

class Account extends Ahc\Cli\Input\Command
{
    protected string $_groupname = 'account';
    protected string $_name = '';
    protected string $_desc = '';

    protected string $_help = 'Manage AlternC account';
    protected string $_usage = '
            <bold>  $0 account <eol/>
    ';

    protected static $subCommands = [];

    public function __construct()
    {
        $name = $this->_name;
        if (!empty($this->_groupname)) {
            $name = $this->_groupname;
            if (!empty($this->_name)) {
                $name .= " ".$this->_name;
            }
        }

        parent::__construct($name, $this->_desc);

        if (!empty($this->_groupname)) {
            $this->inGroup($this->_groupname);
        }

        $writer = new Ahc\Cli\Output\Writer();

        $this
            ->help($writer->colorizer()->colors($this->_help))
            ->usage($this->_usage)
        ;

        $this->onConstruct();
    }

    public function getSubCommands()
    {

        if (empty(self::$subCommands)) {
            self::$subCommands = ConstructFinder::locatedIn(__DIR__)->exclude(__FILE__)->findClassNames();

            foreach (self::$subCommands as $index => $subClassName) {
                self::$subCommands[$index] = new $subClassName();
            }
        }
        return self::$subCommands;
    }

    public function onConstruct()
    {
    }

    public function execute($name, $password)
    {
        $io = $this->app()->io();

        $io->write('AlternC account asked , missing verb', true);
    }
}
