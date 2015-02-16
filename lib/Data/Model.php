<?php

namespace FeideConnect\Data;
use FeideConnect\Data\StorageProvider;

abstract class Model {

	protected $_repo;
	protected static $_properties = array();

	function __construct($props = array()) {
		$this->_repo = StorageProvider::getStorage();

		foreach($props AS $k => $v) {
			if (!in_array($k, static::$_properties)) {
				error_log("Trying to set a property [" . $k . "] that is not legal.");
				continue;
			}
			$this->{$k} = $v;
		}

	}


	public function has($attrname) {
		return (!empty($this->{$attrname}));
	}

	public function getAsArray() {
		$a = array();
		foreach(static::$_properties AS $k) {
			if (isset($this->{$k})) {
				$a[$k] = $this->{$k};
			}
		}
		return $a;
	}


	public function debug() {

		echo "Debug object " . get_class($this) . "\n";
		// print_r($this->getAsArray());
		echo json_encode($this->getAsArray(), JSON_PRETTY_PRINT) . "\n";

	}

	public static function genUUID() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,

			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}

}