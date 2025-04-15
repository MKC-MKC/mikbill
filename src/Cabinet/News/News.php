<?php

namespace Haikiri\MikBiLL\Cabinet\News;

class News
{

	private array|null $data;
	private array|null $items;

	public function __construct(?array $data = [])
	{
		$this->data = $data;
		$this->items = array_map(fn($i) => new NewsModel($i), $data);
	}

	/**
	 * Метод возвращает результат как массив.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array
	{
		return $this->data;
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return NewsModel[]
	 */
	public function getAllNews(): array
	{
		return $this->items;
	}

}
