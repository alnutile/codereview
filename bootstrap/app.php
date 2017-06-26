<?php


use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

load_dotenv();

$app = new Silly\Edition\Pimple\Application();


$app->getContainer()[\Alnutile\Codereview\Application::class] = function() use ($app) {
    $core = new \Alnutile\Codereview\Application($app);
    return $core;
};

$app->getContainer()['config'] = function() use ($app) {

    $path = getenv("HOME") . "/.codereview";

    if(file_exists($path . "/config.yml")) {
        return config($path);
    }

    return config();
};

$app->getContainer()[\Alnutile\Codereview\GithubClientProvider::class] = function() use ($app) {
    $config = [
        'headers' => [
            'Accept' => "application/vnd.github.cloak-preview+json",
            'Content-Type' => "application/json",
            'X-GitHub-Media-Type' => "github.v3"
        ]
    ];
    $client = new \GuzzleHttp\Client($config);

    $skel = new \Alnutile\Codereview\GithubClientProvider($app->getContainer()['app'], $client);


    return $skel;
};


$app->getContainer()['app'] = $app->getContainer()[\Alnutile\Codereview\Application::class];

$app->getContainer()['github_client'] = $app->getContainer()[\Alnutile\Codereview\GithubClientProvider::class];

$app->getContainer()['output'] = function() use ($app) {

    return new Symfony\Component\Console\Output\ConsoleOutput();

};

return $app;