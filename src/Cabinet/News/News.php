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
	 * @deprecated
	 * @use self::getNews
	 */
	public function getAllNews(): array
	{
		return $this->getNews();
	}

	/**
	 * Метод возвращает результат как массив моделей.
	 *
	 * @return NewsModel[]
	 */
	public function getNews(): array
	{
		return $this->items;
	}

}
