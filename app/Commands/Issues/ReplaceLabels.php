<?php

namespace App\Commands\Issues;

use App\Commands\Command;

class ReplaceLabels extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:label:replace
                                {issue : The internal ID of an issue}
                                {old_labels : Comma-separated label names to remove from an issue.}
                                {new_labels : Comma-separated label names to add to an issue.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Replace issue labels with others';

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
            'add_labels' => $this->argument('new_labels'),
            'remove_labels' => $this->argument('old_label'),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        $this->info('Issue labels have been replaced.');

        return Command::SUCCESS;
    }
}
