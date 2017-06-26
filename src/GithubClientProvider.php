<?php


namespace Alnutile\Codereview;


use Carbon\Carbon;
use GuzzleHttp\Client;


class GithubClientProvider extends Application
{


    protected $github_token = "";

    protected $client;

    protected $base_url = "https://api.github.com/search/commits";

    protected $query_string = "";


    /**
     * GithubClientProvider constructor.
     * @param null|\Silly\Edition\Pimple\Application $app
     * @param Client $client
     * @codeCoverageIgnore
     */
    public function __construct($app, Client $client)
    {
        parent::__construct($app);

        $this->client = $client;
    }


    public function getLatestCommits($query = []) {

        $this->setQueryString($query);

        $url = sprintf(
            "%s?%s",
            $this->base_url,
            $this->getQueryString()
        );

        $results = $this->getClient()->get($url);

        return $this->returnResults($results);

    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getGithubToken()
    {
        if(!$this->github_token) {
            $this->setGithubToken();
        }
        return $this->github_token;
    }

    /**
     * @param string $github_token
     */
    public function setGithubToken($github_token = null)
    {
        if(!$github_token) {

            $github_token = $this->app->getConfigValueByKey('github_token');
        }
        $this->github_token = $github_token;
    }

    /**
     * @return Client
     * @codeCoverageIgnore
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @codeCoverageIgnore
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param $results
     * @return array|mixed
     * @codeCoverageIgnore
     */
    private function returnResults($results)
    {
        if($this->isGuzzleResponse($results)) {
            $results = json_decode($results->getBody(), true);
        }

        $results = $this->transformResults($results);

        return $results;
    }

    public function getQueryString()
    {
        return $this->query_string;
    }



    /**
     * @param string $query_string
     */
    public function setQueryString($query = [])
    {
        $items[] = 'sort:committer-date-desc';

        if(isset($query['committer'])) {
            $items[] = sprintf("committer:%s", $query['committer']);
        }

        if(isset($query['org'])) {
            $items[] = sprintf("org:%s", $query['org']);
        }

        $query = sprintf("q=%s", implode("+", $items));

        $query = sprintf('%s&access_token:%s', $query, $this->getGithubToken());

        $this->query_string = $query;
    }

    private function transformResults($results = [])
    {
        $items = [];
        foreach($results['items'] as $key => $value) {
            $items[] = $this->getResult($value);
        }

        return $items;
    }

    /**
     * @param $value
     * @return array
     * @codeCoverageIgnore
     */
    private function getResult($value)
    {
        return [
            'repository' => $value['repository']['html_url'],
            'commit' => $value['url'],
            'date' => $this->getDate($value)
        ];
    }

    /**
     * @param $results
     * @return bool
     * @codeCoverageIgnore
     */
    private function isGuzzleResponse($results)
    {
        return is_object($results) && get_class($results) == 'GuzzleHttp\Psr7\Response';
    }

    /**
     * @param $value
     * @return string
     * @codeCoverageIgnore
     */
    private function getDate($value)
    {
        return Carbon::parse($value['commit']['committer']['date'])->format('Y/m/d H:i');
    }


}