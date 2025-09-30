<?php

namespace AlternC\Cli\Account;

use Ahc;

class AccountList extends \AlternC\Cli\Account
{
    protected string $_name = 'list';

    protected string $_desc = 'List a new AlternC account';

    protected string $_help = 'Add a new AlternC account';
    protected string $_usage = '
            <bold>  $0 account add</end> <comment>--name demo --password Ap@sswo0rd </end> ## details 1<eol/>
    ';


    // When app->handle() locates `init` command it automatically calls `execute()`
    // with correct $ball and $apple values
    public function execute($name, $password)
    {
        $io = $this->app()->io();

        $io->write('AlternC listing started', true);

    }
};
