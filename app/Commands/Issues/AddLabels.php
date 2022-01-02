<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class AddLabels extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:label:add
                                {issue : The internal ID of an issue}
                                {labels : Comma-separated label names to add to an issue.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add issue labels';

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
            'add_labels' => $this->argument('new_labels'),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue labels have been added.');

        return Command::SUCCESS;
    }
}
