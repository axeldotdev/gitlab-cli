<?php

namespace App\Commands;

class RegisterToken extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'register:token {token}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Register your personal access token';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = $this->argument('token');

        // TODO: save token in .env

        return Command::SUCCESS;
    }
}
