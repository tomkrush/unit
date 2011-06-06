# Unit

### What is Unit
Unit is a lightweight unit test library for PHP.

### Downloading Unit
You can either download a zip of Unit or clone it (http://github.com/tomkrush/unit.git).

### Writing Test Cases

Writing test cases are simple. Lets say we have a class named *hello* and we want to make sure it will function correctly. Create a class named *HelloTestCase.php*. You can place this file anywhere in your project.

HelloTestCase.php
	class HelloTestCase 
	{
		public function test_hello_message()
		{
			$hello = new Hello;
			
			$this->assertEquals('Hello World', $hello, '__toString should return string Hello World');
		}
	}

### Running Unit

You want to run tests for a class named *hello*. To quickly do this, create an index.php and require the unit library, class, and tests. You would follow by creating an instance of a UnitTestSuite, adding the tests and running it.

index.php
	require 'hello/hello.php';

	require 'unit/unit.php';
	require 'hello/tests.php';

	$suite = new UnitTestSuite;
	$suite->addTestCase('MariConnectionTestCase');
	$suite->run();

If configured correctly the browser should show you which tests passed or failed.

### UnitTestSuite API

UnitTestSuite manages, runs, and draws results from unit test cases.

#### addTestCase($className)
$className is a string identifier of Test Case.

#### run()
Executes the tests and displays the results.

### UnitTestCase
Base Test Case. This class contains all the functionality for assertions.

#### setup()

#### teardown()

#### assertion

#### assertTrue($test, $message)

#### assertFalse($test, $message)

#### assertEquals($expected, $actual, $message)

#### assertNotEquals($expected, $actual, $message)

#### run()