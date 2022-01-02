<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class UnlinkEpic extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:epic:unlink {issue : The internal ID of an issue}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Unlink issue to epic';

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
            'epic_id' => 0,
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue and epic have been unlinked.');

        return Command::SUCCESS;
    }
}
