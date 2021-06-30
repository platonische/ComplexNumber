<?php
namespace tests;
use ComplexNumber\ComplexNumber;


class ComplexNumberTest extends \PHPUnit_Framework_TestCase
{

	function testCreate()
	{
		$a = new ComplexNumber(-1, 2);
		$this->assertEquals(-1, $a->getComplexNumber());
		$this->assertEquals(2, $a->getStaticNumber());

	}
}
