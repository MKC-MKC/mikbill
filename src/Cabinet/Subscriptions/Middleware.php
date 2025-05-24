<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use Haikiri\MikBiLL\ResponseWrapper;

class Middleware extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = $this->createMiddlewareItems(array: $data);
	}

	/**
	 * Метод подготавливает модель с элементами.
	 *
	 * @param array|null $array
	 * @return array
	 */
	private function createMiddlewareItems(?array $array): array
	{
		if (empty($array)) return [];
		return array_map(fn($i, $s) => new MiddlewareModel(
			data: [
				"id" => (int)$i,
				"name" => (string)$s,
			],
		), array_keys($array), $array);
	}

	/**
	 * Метод возвращает результат как-есть, без каких либо обработок.
	 * @return array|null
	 * @deprecated Используй getData();
	 */
	public function getAsIs(): array|null
	{
		return $this->getData();
	}

	/**
	 * Метод возвращает массив ["id", "name"] доступных middleware.
	 *
	 * @return array
	 */
	public function getAsArray(): array
	{
		return array_map(fn($i) => [
			"id" => $i->getId(),
			"name" => $i->getName()
		], $this->items);
	}

	/**
	 * @deprecated
	 * @use self::getMiddlewares
	 */
	public function getMiddleware(): array
	{
		return $this->getMiddlewares();
	}

	/**
	 * Метод возвращает результат как массив моделей.
	 *
	 * @return MiddlewareModel[]
	 */
	public function getMiddlewares(): array
	{
		return $this->items;
	}

}
