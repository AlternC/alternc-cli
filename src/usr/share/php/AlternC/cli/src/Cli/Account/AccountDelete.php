<?php

namespace AlternC\Cli\Account;

use Ahc;

class AccountDelete extends \AlternC\Cli\Account
{
    protected string $_name = 'delete';

    public function onConstruct()
    {
        $this
            ->option('--login', 'AlternC login (mandatory)', 'strval', '')
            ->option('--confirm', 'Confirm deletion (mandatory)', 'boolval', 0)
        ;
    }

    // This method is auto called before `self::execute()` and receives `Interactor $io` instance
    public function interact(Ahc\Cli\IO\Interactor $io): void
    {
        // Collect missing opts/args
        if (!$this->login) {
            $this->set('login', $io->prompt('Enter an account name'));
        }

        if (!$this->confirm) {
            $this->set('confirm', $io->confirm('Do you confirm this deletion ?', 'n'));
        }
    }

    // When app->handle() locates `init` command it automatically calls `execute()`
    // with correct $ball and $apple values
    public function execute($login = '', $confirm = 0)
    {
        global $admin, $msg;
        $io = $this->app()->io();
        $error = false;

        if (!$confirm) {
            $io->warn('Deletion confirmation is missing', true);
            return 1;
        }

        $uid = $admin->get_uid_by_login($login);

        if (!$error && !$admin->checkcreator($uid)) {
            $msg->raise("ERROR", "admin", _("This page is restricted to authorized staff"));
            $error = true;
        }

        if (!$error && !$admin->get($uid)) {
            $msg->raise("ERROR", "admin", _("Member '%s' does not exist"), $login);
            $error = true;
        }
        if (!$error && !$admin->del_mem($uid)) {
            $msg->raise("ERROR", "admin", _("Member '%s' can\'t be deleted"), $login);
            $error = true;
        }

        if (!$error) {
            $io->green('Account deleted', true);
        } else {
            $io->error($msg->msg_str(), true);
            return 1;
        }
    }
};
