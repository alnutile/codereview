<?php


namespace Alnutile\Codereview;

trait CreateApp
{
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        return $app;
    }
}
