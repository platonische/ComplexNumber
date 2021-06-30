<?php

use ComplexNumber\ComplexOperation;
use ComplexNumber\ComplexNumber;

function autoload($class)
{
	require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\',DIRECTORY_SEPARATOR,$class . '.php');
}
spl_autoload_register('autoload');

// Use Complex Number

$a = new ComplexNumber(1,-2);
$b = new ComplexNumber(-5,5);

$result = new ComplexOperation($a,$b);

echo 'First  : ' . $a->toString().PHP_EOL;
echo 'Second : ' . $b->toString().PHP_EOL;

echo 'Result : ' . $result->getSumm().PHP_EOL;
echo 'Result : ' . $result->getDiff().PHP_EOL;
echo 'Result : ' . $result->getMulti().PHP_EOL;
echo 'Result : ' . $result->getDivision().PHP_EOL;

