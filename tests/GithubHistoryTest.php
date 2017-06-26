<?php


namespace Alnutile\Codereview;

use GuzzleHttp\Client;
use Mockery;
use Mockery\Mock;

/**
 * @covers \Alnutile\Codereview\GithubClientProvider
 */
class GithubHistoryTest extends TestCase
{


    /**
     * @coversDefaultClass getLatestCommits
     * @coversDefaultClass getGithubToken
     * @coversDefaultClass transformResults
     */
    public function testGetHistoryForUser()
    {


        //setup the config file
        /** @var GithubClientProvider $client */

        $mocked = Mockery::mock(\GuzzleHttp\Client::class);
        $fixture = json_decode(file_get_contents(__DIR__ . '/fixtures/results_of_query.json'), true);
        $mocked->shouldReceive('get')->andReturn($fixture);

        $client = new GithubClientProvider($this->app->getContainer()['app'], $mocked);

        $results = $client->getLatestCommits(['committer' => 'alnutile', 'org' => 'alfred-nutile-inc']);

        $this->assertCount(1, $results);

        $this->assertContains('2017/06/23 13:37', $results[0]['date']);
        $this->assertContains('https://github.com/alnutile/foo', $results[0]['repository']);
        $this->assertContains(
            'https://github.com/alnutile/foo/commit/200bf818b04b7f8aea2f2b224e3faf40882e9442',
            $results[0]['commit']
        );
    }

    /**
     * @coversDefaultClass setQueryString
     */
    public function testOutputOfQueryString()
    {

        $config = [
            'github_token' => 'foo'
        ];

        $this->app->getContainer()['config'] = $config;

        $query = [
            'org' => 'foo',
            'committer' => 'bar',
        ];

        /** @var GithubClientProvider $client */
        $client = $this->app->getContainer()['github_client'];

        $client->setQueryString($query);

        $this->assertEquals(
            "q=committer:bar+sort:committer-date-desc+org:foo&access_token=foo",
            $client->getQueryString()
        );
    }

    /**
     * @coversDefaultClass setGithubToken
     */
    public function testSetGithubToken()
    {
        $config = [
            'github_token' => 'foo'
        ];

        $this->app->getContainer()['config'] = $config;

        $query = [
            'org' => 'foo',
            'committer' => 'bar',
        ];

        /** @var GithubClientProvider $client */
        $client = $this->app->getContainer()['github_client'];

        $client->setGithubToken();

        $this->assertEquals("foo", $client->getGithubToken());
    }


    public function testMultipleOrgs()
    {
        $this->markTestIncomplete("@TODO");
    }
}
