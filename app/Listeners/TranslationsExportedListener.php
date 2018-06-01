<?php

namespace App\Listeners;

use Symfony\Component\Process\Process;

class TranslationsExportedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     *
     * @return boolean
     */
    public function handle( $event )
    {
        if ( config( 'translation-manager.npm_build' ) ) {

            $process = new Process( 'npm run prod' );
            $process->start();

            info( 'Translations exported, npm prod finished.' );
        }

        return true;
    }
}
