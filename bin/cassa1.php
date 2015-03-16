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


$CC = [ 
	'host'   		 => '127.0.0.1',
    'port'   		 => 9042,
    'class'     	 => 'Cassandra\Connection\Stream',//use stream instead of socket, default socket. Stream may not work in some environment
    'connectTimeout' => 4, // connection timeout, default 5,  stream transport only
    'timeout'   	 => 8 // write/recv timeout, default 30, stream transport only
];

// $this->db = new \evseevnn\Cassandra\Database($config['nodes'], $config['keyspace']);
$db = new \Cassandra\Connection($nodes, $keyspace);

echo "Constructor done\n";
$db->connect();
echo "Connected done\n";
