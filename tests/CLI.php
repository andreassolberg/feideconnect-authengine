<?php


namespace tests;

use FeideConnect\Config;
use FeideConnect\Router;
use FeideConnect\HTTP\JSONResponse;
use FeideConnect\Data\StorageProvider;
use FeideConnect\Data\Models;

class CLI extends \PHPUnit_Framework_TestCase {


	protected $cli;

	function __construct() {

		// $config = json_decode(file_get_contents(__DIR__ . '/../etc/ci/config.json'), true);
		$this->cli = new CLI();


	}

    public function testOAuthConfig() {

    }




}