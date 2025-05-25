<?php

namespace Haikiri\MikBiLL\Cabinet\Reports;

use Haikiri\MikBiLL\ResponseWrapper;

class PaymentItems extends ResponseWrapper
{
	private array $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new Payment($i), $data);
	}

	/**
	 * Метод возвращает результат как массив моделей.
	 * @return Payment[]
	 */
	public function getPayments(): array
	{
		return $this->items;
	}

	/**
	 * Метод возвращает только первый результат массива.
	 * @return Payment
	 */
	public function getOne(): Payment
	{
		return $this->items[0];
	}

}
