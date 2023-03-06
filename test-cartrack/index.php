<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\Services\DB;
use Symfony\Component\HttpFoundation\Request;

// Load all the .env variables
if ($_SERVER['SERVER_NAME'] === 'tester.test') {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Create the http request
$request = Request::createFromGlobals();

// Connect to postgres datababase
$db = (new DB())->getConnection();

// Load all the api's router data
include_once 'routes/api.php';

return;
