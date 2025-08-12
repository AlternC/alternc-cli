<?php

namespace AlternC\Cli\Account;


class Account extends Ahc\Cli\Input\Command
{
    public function __construct()
    {
        parent::__construct('init', 'Init something');

        $help = '<cyan>Custom help screen</end>';
        $writer = new Ahc\Cli\Output\Writer();

        $this
            ->argument('<arrg>', 'The Arrg')
            ->argument('[arg2]', 'The Arg2')
            ->option('-a --apple', 'The Apple')
            ->option('-b --ball', 'The ball')
            ->help($writer->colorizer()->colors($help))
            // Usage examples:
            ->usage(
                // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  init</end> <comment>--apple applet --ball ballon <arggg></end> ## details 1<eol/>' .
                // $0 will be interpolated to actual command name
                '<bold>  $0</end> <comment>-a applet -b ballon <arggg> [arg2]</end> ## details 2<eol/>'
            )
            ->logo('Ascii art logo of your command');
    }

    // This method is auto called before `self::execute()` and receives `Interactor $io` instance
    public function interact(Ahc\Cli\IO\Interactor $io) : void
    {
        // Collect missing opts/args
        if (!$this->apple) {
            $this->set('apple', $io->prompt('Enter apple'));
        }

        if (!$this->ball) {
            $this->set('ball', $io->prompt('Enter ball'));
        }

        // ...
    }

    // When app->handle() locates `init` command it automatically calls `execute()`
    // with correct $ball and $apple values
    public function execute($ball, $apple)
    {
        $io = $this->app()->io();

        $io->write('Apple ' . $apple, true);
        $io->write('Ball ' . $ball, true);

        // more codes ...

        // If you return integer from here, that will be taken as exit error code
    }
}
