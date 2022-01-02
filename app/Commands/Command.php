<?php

namespace App\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use Illuminate\Http\Client\PendingRequest;
use LaravelZero\Framework\Commands\Command as BaseCommand;
use Symfony\Component\Process\Exception\ProcessFailedException;

abstract class Command extends BaseCommand
{
    /**
     * The Gitlab uri.
     *
     * @var string
     */
    protected $api_uri;

    /**
     * The Gitlab personal access token.
     *
     * @var string
     */
    protected $api_token;

    /**
     * The current project id.
     *
     * @var int
     */
    protected $project_id;

    /**
     * The HTTP client.
     *
     * @var PendingRequest
     */
    protected $http_client;

    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setApiUri();
        $this->setApiToken();
        $this->setHttpClient();
        $this->setProjectId();
    }

    /**
     * Set Gitlab API URI
     *
     * @return void
     */
    private function setApiUri()
    {
        $this->api_uri = 'https://gitlab.com/api/v4/';
    }

    /**
     * Set Gitlab personal access token
     *
     * @return void
     */
    private function setApiToken()
    {
        $process = new Process([
            'composer', 'config', '--global', 'gitlab-token.gitlab.com',
        ]);

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->api_token = $process->getOutput();
    }

    /**
     * Set HTTP client.
     *
     * @return void
     */
    private function setHttpClient()
    {
        $this->http_client = Http::withToken($this->api_token)
            ->baseUrl($this->api_uri);
    }

    /**
     * Set current Gitlab project id.
     *
     * @return void
     */
    private function setProjectId()
    {
        $response = $this->http_client->get('projects', [
            'search' => $this->getProjectName(),
        ]);

        if ($response->failed()) {
            $this->error('The API call failed.');

            return;
        }

        /** @var \stdClass */
        $project = $response->collect()->first();

        $this->project_id = $project['id'];
    }

    /**
     * Get project name from Git
     *
     * @return string
     */
    private function getProjectName()
    {
        $process = new Process([
            'git', 'config', '--get', 'remote.origin.url',
        ]);

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $remote_url = $process->getOutput();

        $parts = explode('/', $remote_url);

        return Str::remove('.git', end($parts));
    }
}
