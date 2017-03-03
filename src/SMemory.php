<?php

class SMemory {

	private $_limit;
	private $_usage;
	private $_percent;

	function __construct() {
		$this->_limit = ((int)str_replace("M", "", ini_get("memory_limit"))) * 1000000;
	}

	public function get_percent() {
		$this->update_usage();

		return number_format(($this->_usage / $this->_limit) * 100, 2);
	}

	public function get_limit() {
		return $this->_limit;
	}

	public function get_usage() {
		return $this->_usage;
	}

	private function update_usage() {
		$this->_usage = memory_get_usage();
	}

}
