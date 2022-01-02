<?php

namespace App\Commands\Issues;

use App\Commands\Command;
use Symfony\Component\Process\Process;

class Browse extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'issue:browse {issue : The internal ID of an issue}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Browse an issue on your default browser (only works on macOS)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var string */
        $issue_id = $this->argument('issue');

        $response = $this->http_client->put("issues/{$issue_id}");

        if ($response->failed()) {
            $this->error('The API call failed.');

            return Command::FAILURE;
        }

        /** @var \stdClass */
        $issue = $response->object();

        $process = new Process(['open', $issue->web_url]);
        $process->run();

        if (! $process->isSuccessful()) {
            $this->error('The url can\'t be opened.');
        }

        return Command::SUCCESS;
    }
}
