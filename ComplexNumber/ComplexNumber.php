<?php


namespace ComplexNumber;


interface ComplexNumberInterface
{
	public function getComplexNumber();
	public function getStaticNumber();
}

class ComplexNumber implements ComplexNumberInterface
{
	private $complex_bit;
	private $static_bit;

	public function __construct($complex_bit, $static_bit = 0)
	{
		if (!$complex_bit)
		{
			throw new \Exception('Передайте значение комплексного числа');
		}

		$this->complex_bit = $complex_bit;
		$this->static_bit = $static_bit;
	}

	public function getComplexNumber()
	{
		return $this->complex_bit;
	}

	public function getStaticNumber()
	{
		return $this->static_bit;
	}

	/**
	 * @return string
	 */
	public function toString()
	{
		return $this->complex_bit . 'i' . ( ( $this->static_bit > 0 ) ? '+' : '' ) . $this->static_bit;
	}

}

class ComplexOperation
{
	private $first;
	private $second;
	private $so;

	/**
	 * ComplexOperation constructor.
	 *
	 * @param   ComplexNumberInterface  $first
	 * @param   ComplexNumberInterface  $second
	 *
	 * @throws \Exception
	 *
	 */
	public function __construct(ComplexNumberInterface $first, ComplexNumberInterface $second )
	{
		if (!$first || !$second)
		{
			throw new \Exception('Необходимы два комплексных числа');
		}
		$this->first = $first;
		$this->second = $second;
		//Создать комплексно сопряженное из делителя (для деления)
		$this->so = new ComplexNumber($this->second->getComplexNumber()*-1, $this->second->getStaticNumber());
	}

	public function getSumm()
	{
		$c = $this->first->getComplexNumber() + $this->second->getComplexNumber();
		$s = $this->first->getStaticNumber() + $this->second->getStaticNumber();
		return self::toString($c,$s);
	}

	public function getDiff()
	{
		$c = $this->first->getComplexNumber() - $this->second->getComplexNumber();
		$s = $this->first->getStaticNumber() - $this->second->getStaticNumber();
		return self::toString($c,$s);
	}

	public function getMulti()
	{
		// (Ai + B)(Ci + D) = -AC + ADi + CBi + BD = (AD+CB)i + (BD - AC)
		$c = $this->first->getComplexNumber() * $this->second->getStaticNumber() + $this->second->getComplexNumber() * $this->first->getStaticNumber();
		$s = $this->first->getStaticNumber() * $this->second->getStaticNumber() - $this->first->getComplexNumber() * $this->second->getComplexNumber();
		return self::toString($c,$s);
	}

	public function getDivision()
	{
		//Умножить на сопряженное
		// Получить натуральный делитель
		$d = $this->so->getStaticNumber() * $this->second->getStaticNumber() - $this->so->getComplexNumber() * $this->second->getComplexNumber();

		// Получить умножение
		$c = $this->first->getComplexNumber() * $this->so->getStaticNumber() + $this->so->getComplexNumber() * $this->first->getStaticNumber();
		$s = $this->first->getStaticNumber() * $this->so->getStaticNumber() - $this->first->getComplexNumber() * $this->so->getComplexNumber();

		//Поделить почленно на натуральное
		$c = $c/$d;
		$s = $s/$d;

		return self::toString($c,$s);
	}

	public static function toString($a,$b)
	{
		return ( ( $a ) ? $a . 'i' : '' ) . ( ( $b > 0 ) ? '+' : '' ) . ( ( $b ) ? $b : '' );
	}

}

