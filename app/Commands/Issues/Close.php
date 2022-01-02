<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class Close extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:close {issue : The internal ID of an issue}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Close issue';

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
            'state_event' => 'close',
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue have been closed.');

        return Command::SUCCESS;
    }
}
