<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class RemoveLabels extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:label:remove
                                {issue : The internal ID of an issue}
                                {labels : Comma-separated label names to remove from an issue.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Remove issue labels';

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
            'remove_labels' => $this->argument('old_label'),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue labels have been removed.');

        return Command::SUCCESS;
    }
}
