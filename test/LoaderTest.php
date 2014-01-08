<?php

require_once 'vendor/autoload.php';

use Foo\HandlesCommands;
use Foo\IdentifiesAggregate;
use Foo\PupilId;

class LoaderTest extends \PHPUnit_Framework_TestCase {

	public function testSomething() {
		\PreHParser\Loader::register();

		$ret = (new PupilId())->bar(new HandlesCommands());

		$this->assertEquals('baz', $ret);
	}

}
