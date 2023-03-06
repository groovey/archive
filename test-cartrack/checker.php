<?php

require 'vendor/autoload.php';
 
use App\Services\DB;
 
// Connect to postgres datababase
$db = (new DB())->getConnection();

print "<br/> DB host = " . getenv('DB_HOST');
print "<br/> DB username = " . getenv('DB_USERNAME');

print "<br/><br/> Connection DB Resource: ";

var_dump($db);

exit();
