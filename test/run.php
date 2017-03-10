<?php

require '../bin/Samus.php';

$test = new STest();
$test->assert_equals("Test", "Test", "test 1", "notes 1");
$test->assert_equals(true, false, "test 2", "notes 2");
$test->assert_is_empty(array(), "test 3", "notes 3");
$test->assert_is_not_empty(array(), "test 4", "notes 4");
$test->assert_is_null(null, "test 5", "notes 5");
$test->assert_is_not_null(array(), "test 6", "notes 6");
$test->assert_is_not_null("asds", "test 7", "notes 7");

//var_dump($test->get_tests());

$test->report();