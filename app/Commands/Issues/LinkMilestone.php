<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class LinkMilestone extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:milestone:link
                                {issue : The internal ID of an issue}
                                {milestone : The internal ID of a milestone}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Link issue to milestone';

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
            'milestone_id' => $this->argument('milestone'),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue and milestone have been linked.');

        return Command::SUCCESS;
    }
}
