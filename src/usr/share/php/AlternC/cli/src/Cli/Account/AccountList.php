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

    public function onConstruct()
    {
        $this->option('--fields', "Fields to display, use , as separator")->on(
            fn ($value) => $this->set('fields', array_merge($this->fields ?? [], explode(',', $value))) && false
        );
        $this->option('--field', "Field to display, option can be use many time")->on(
            fn ($value) => $this->set('fields', array_merge($this->fields ?? [], [$value])) && false
        );
    }

    // When app->handle() locates `init` command it automatically calls `execute()`
    // with correct $ball and $apple values
    public function execute($fields = [])
    {
        global $admin;

        $fields_invalid = [];

        // List all fiels adsked, force to lowercase
        if (!empty($fields)) {
            $fields = array_map('strtolower', $fields);
        }

        $io = $this->app()->io();

        $accountList = $admin->get_list(1);

        // Get only named fields
        foreach ($accountList as &$account) {
            foreach ($account as $index => $column) {
                if (is_numeric($index)) {
                    unset($account[$index]);
                }
            }
        }

        //Restrict result to fields asked
        //List fields asked but invalid
        if (!empty($fields)) {
            $accountList = array_map(function ($row) use ($fields, &$fields_invalid) {
                $intersect = array_intersect_key($row, array_flip($fields));
                $fields_invalid = array_diff_key(array_flip($fields), $intersect);
                return $intersect;
            }, $accountList);
        }

        $io->write('AlternC listing', true);

        if (!empty($fields_invalid)) {
            $fields_invalid = implode(",", array_flip($fields_invalid));
            $io->warn('Some fields are invalids : '.$fields_invalid."\n");
        }

        $io->table($accountList);
    }
};
