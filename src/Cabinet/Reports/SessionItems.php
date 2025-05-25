<?php

namespace Haikiri\MikBiLL\Cabinet\Reports;

use Haikiri\MikBiLL\ResponseWrapper;

class SessionItems extends ResponseWrapper
{
	private array $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new Session($i), $data);
	}

	/**
	 * Метод возвращает результат как массив моделей.
	 * @return Session[]
	 */
	public function getSessions(): array
	{
		return $this->items;
	}

	/**
	 * Метод возвращает только первый результат массива.
	 * @return Session
	 */
	public function getOne(): Session
	{
		return $this->items[0];
	}

}
