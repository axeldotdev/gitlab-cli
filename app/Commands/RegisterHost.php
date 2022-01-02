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
