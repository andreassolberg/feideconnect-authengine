#!/usr/bin/env php
<?php

namespace FeideConnect;

use FeideConnect\Data\StorageProvider;

require(dirname(dirname(__FILE__)) . '/vendor/autoload.php');


$keyspace = 'feideconnct';
$nodes = [
	'127.0.0.1'
];

echo("connecting to nodes"); 
$db = new \evseevnn\Cassandra\Database($nodes, $keyspace);

echo "Constructor done\n";
$db->connect();
echo "Connected done\n";

