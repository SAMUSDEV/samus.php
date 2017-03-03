<?php

class STimer {

	private $_map;

	function __construct() {
		$this->_map = array();
	}

	public function start($key) {
		$this->check($key);

		$this->_map[$key]["start"] = microtime(true);
	}

	public function stop($key) {
		$this->_map[$key]["stop"] 	= microtime(true);
		$this->_map[$key]["result"] = $this->_map[$key]["stop"] - $this->_map[$key]["start"];
	}

	public function result($key, $full=false) {
		if(!$full)
			return $this->_map[$key]["result"];

		$result = $this->_map[$key]["result"];

		return gmdate("H:i:s.u", $result);
	}

	private function check($key) {
		if(!isset($this->_map[$key])) {
			$this->_map[$key] = array("start" => 0, "stop" => 0, "result" => 0);
		}
	}

}