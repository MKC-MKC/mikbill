<?php

namespace Haikiri\MikBiLL\Cabinet\News;

use Haikiri\MikBiLL\ResponseWrapper;

class News extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new NewsModel($i), $data);
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
