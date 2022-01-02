<?php

namespace App\Commands;

class RegisterHost extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'register:host {host}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Register your self-hosted Gitlab instance';

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = $this->argument('host');

        // TODO: save host in .env

        return Command::SUCCESS;
    }
}
