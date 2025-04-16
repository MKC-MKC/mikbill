<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

class Additional
{
	private array|null $data;

	public function __construct(?array $data = [])
	{
		$this->data = $data;
	}

	/**
	 * Метод возвращает результат как-есть, без каких либо обработок.
	 *
	 * @return array|null
	 */
	public function getAsIs(): ?array
	{
		return $this->data;
	}

}