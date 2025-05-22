<?php

namespace Haikiri\MikBiLL;

abstract class ResponseWrapper
{
	private ?array $data;

	public function __construct(?array $data)
	{
		$this->data = $data;
	}

	public function getAsArray(): array|null
	{
		return $this->data;
	}

	/**
	 * Извлечение и фильтрация данных.
	 * @param string|null $key
	 * @param mixed|null $default
	 * @return mixed
	 */
	public function getData(string|null $key = null, mixed $default = null): mixed
	{
		$data = $this->data;
		if ($key === null) return $data;

		foreach (explode(".", $key) as $segment) {
			if (!is_array($data) || !array_key_exists($segment, $data)) {
				return $default;
			}
			$data = $data[$segment];
		}

		return $data;
	}

}
