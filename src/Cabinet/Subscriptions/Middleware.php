<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

class Middleware {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = $this->createMiddlewareItems(array: $data);
	}

	/**
	 * Метод подготавливает модель с элементами.
	 *
	 * @param array|null $array
	 * @return array
	 */
	private function createMiddlewareItems(?array $array): array {
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
	 *
	 * @return array|null
	 */
	public function getAsIs(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает массив ["id", "name"] доступных middleware.
	 *
	 * @return array
	 */
	public function getAsArray(): array {
		return array_map(fn($i) => [
			"id" => $i->getId(),
			"name" => $i->getName()
		], $this->items);
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return MiddlewareModel[]
	 */
	public function getMiddleware(): array {
		return $this->items;
	}

}