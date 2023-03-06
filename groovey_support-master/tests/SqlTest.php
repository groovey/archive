<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class SqlTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);

        $app->register('sql', 'Groovey\Support\Providers\Sql');

        $this->app = $app;
    }

    public function testFormat()
    {
        $app = $this->app;
        $sql = $app->get('sql')->getInstance();

        $query = "SELECT count(*),`Column1`,`Testing`, `Testing Three` FROM `Table1`
            WHERE Column1 = 'testing' AND ( (`Column2` = `Column3` OR Column4 >= NOW()) )
            GROUP BY Column1 ORDER BY Column3 DESC LIMIT 5,10";

        $output = $sql::format($query);
        $this->assertRegExp('/NOW()/', $output);
    }
}
