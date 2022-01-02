<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class LinkEpic extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:epic:link
                                {issue : The internal ID of an issue}
                                {epic : The internal ID of an epic}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Link issue to epic';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var string */
        $issue_id = $this->argument('issue');

        $response = $this->http_client->put("projects/{$this->project_id}/issues/{$issue_id}", [
            'epic_id' => $this->argument('epic'),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue and epic have been linked.');

        return Command::SUCCESS;
    }
}
