<?php

namespace AlternC\Cli\Account;

use Ahc;

class AccountAdd extends \AlternC\Cli\Account
{
    protected string $_name = 'add';
    protected string $_desc = 'Add a new AlternC account';

    protected string $_help = 'Add a new AlternC account
    Options :
            <--login> AlternC login (mandatory)
            <--password> Password set at creation (mandatory)
            <--email> email (mandatory)
            [--firstname] Firstname
            [--lastname] Lastname
            [--notes] Internal note
    ';
    protected string $_usage = '
        <bold>  $0 account add</end> <comment>--login demo --password Ap@sswo0rd --email demo@domain.tld</end> ## details 1<eol/>
    ';

    public function onConstruct()
    {
        $this
            ->option('--login', 'AlternC login (mandatory)', 'strval', '')
            ->option('--password', 'password set at creation (mandatory)', 'strval', '')
            ->option('--email', 'email (mandatory)', 'strval', '')
            ->option('--firstname', 'Firstname', 'strval', '')
            ->option('--lastname', 'Lastname', 'strval', '')
            ->option('--notes', 'Internal note', 'strval', '')
        ;
    }

    // This method is auto called before `self::execute()` and receives `Interactor $io` instance
    public function interact(Ahc\Cli\IO\Interactor $io): void
    {
        // Collect missing opts/args
        if (!$this->login) {
            $this->set('login', $io->prompt('Enter an account name'));
        }

        if (!$this->password) {
            $this->set('password', $io->prompt('Enter a password to the account'));
        }

        if (!$this->email) {
            $this->set('email', $io->prompt('Enter an email related to the account'));
        }
    }

    // When app->handle() locates `init` command it automatically calls `execute()`
    // with correct $ball and $apple values
    public function execute($login = '', $password = '', $email = '', $firstname = '', $lastname = '', $notes = '')
    {
        global $admin, $msg;
        $io = $this->app()->io();

        $login = trim($login);
        $password = trim($password);
        $email = trim($email);


        if (empty($login) || empty($password) || empty($email)) {
            $io->error('Somme options are invalid', true);
            return 1;
        }

        $io->write('AlternC account', true);
        $io->write("\t name : " . $login, true);
        $io->write("\t password : " . $password, true);
        $io->write("\t email : " . $email, true);

        // Attemp to create, exit if fail
        if (!($u = $admin->add_mem($login, $password, $lastname, $firstname, $email, 1, 1, 0, $notes, 0, 0, 1))) {
            $error = $msg->msg_str();
            if (empty($error)) {
                $error = 'Can\'t create account';
            }
            $io->error($error, true);
        } else {
            $io->green('Account created',true);
        }

    }
};
