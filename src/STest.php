<?php


class STestItem {
	const PASSED = true;
	const FAILED = false;

	public $name;
	public $result;
	public $expected;
	public $received;
	public $notes;

}


class STest {

	private $_tests = array();

	function __construct() {
		$this->_tests = array();
	}

	public function assert_equals($expected, $received, $name="", $notes="") {
		$result = $expected == $received;

		$this->assert($this->to_string($expected), $this->to_string($received), $result, $name, $notes);
	}

	public function assert_not_equals($expected, $received, $name="", $notes="") {
		$result = $expected != $received;
		
		$this->assert($expected, $this->to_string($received), $result, $name, $notes);
	}

	public function assert_is_null($received, $name="", $notes="") {
		$result = is_null($received);
		
		$this->assert("null", $this->to_string($received), $result, $name, $notes);
	}

	public function assert_is_not_null($received, $name="", $notes="") {
		$result = !is_null($received);
		
		$this->assert("!null", $this->to_string($received), $result, $name, $notes);
	}

	public function assert_is_empty($received, $name="", $notes="") {
		$result = empty($expected);
		
		$this->assert("empty", $this->to_string($received), $result, $name, $notes);
	}

	public function assert_is_not_empty($received, $name="", $notes="") {
		$result = !empty($expected);
		
		$this->assert("!empty", $this->to_string($received), $result, $name, $notes);
	}

	private function to_string($received) {
		if(is_null($received))
			return "null";

		if(is_bool($received)) {
			if($received)
				return "true";
			else
				return "false";
		}

		if(is_array($received))
			return "Array()";

		return $received;
	}

	public function get_tests() {
		return $this->_tests;
	}

	private function assert($expected, $received, $result, $name, $notes) {
		$item 			= new STestItem();
		$item->expected = $expected;
		$item->received = $received;
		$item->result 	= $result;
		$item->name 	= $name;
		$item->notes 	= $notes;

		array_push($this->_tests, $item);
	}

	public function report() {
		$passeds 		= 0;
		$faileds 		= 0;
		$total_tests 	= count($this->_tests);
		$tests 			= $this->_tests;

		foreach ($this->_tests as $item) {
			if($item->result)
				$passeds++;
			else
				$faileds++;
		}

		?>

			<html>
			<head>
				<title></title>

				<style type="text/css">
					* {
						font-family: Arial;
					}

					table {
						width: 700px;
						border-collapse: separate;
						-webkit-border-horizontal-spacing: 2px;
						-webkit-border-vertical-spacing: 2px;
					}

					table td, table th {
					  padding: 10px 4px 10px 4px;
					  font-size: 13px;
					}

					table thead {

					}

					table thead th {
						background: #000 !important;
						font-weight: bold;
						color: #fff;
					}

					table tbody td {
					  
					}

					td.v-align-middle   { vertical-align: middle; }
					td.v-align-top      { vertical-align: top; }
					td.v-align-bottom   { vertical-align: bottom; }
					td.v-align-baseline { vertical-align: baseline; }


					.test-result {

					}

					.passed, .passed * {
						color: #55b867;
					}

					.failed, .failed * {
						color: #db4f51;
					}

					.text-center {
						text-align: center;
					}

				</style>
			</head>
			<body>
				<h2>Report:</h2>
				<p><strong>Tests: </strong><?= $total_tests ?></p>
				<p class="passed"><strong>Passed: </strong><?= $passeds ?></p>
				<p class="failed"><strong>Failed: </strong><?= $faileds ?></p>

				<h3>Summary</h3>
				
				<table border="1">
					<thead>
						<tr>
							<th>Name</th>
							<th>Expected</th>
							<th>Received</th>
							<th>Result</th>
							<th>Notes</th>
						</tr>
					</thead>

					<tbody>
						<? foreach ($tests as $item): ?>
							<tr>
								<td><?= $item->name ?></td>
								<td class="text-center"><?= $item->expected ?></td>
								<td class="text-center"><?= $item->received ?></td>
								<td class="text-center">
									<? if($item->result): ?>
										<strong class="test-result passed">Passed</strong>
									<? else: ?>
										<strong class="test-result failed">Failed</strong>
									<? endif; ?>
								</td>
								<td><?= $item->notes ?></td>
							</tr>
						<? endforeach; ?>
					</tbody>
				</table>
			</body>
			</html>


		<?
	}
}


