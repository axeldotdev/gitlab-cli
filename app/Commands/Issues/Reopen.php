<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class Reopen extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:reopen {issue : The internal ID of an issue}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Reopen issue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->setProjectId();

        /** @var string */
        $issue_id = $this->argument('issue');

        $response = $this->http_client->put("projects/{$this->project_id}/issues/{$issue_id}", [
            'state_event' => 'reopen',
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue have been reopened.');

        return Command::SUCCESS;
    }
}
