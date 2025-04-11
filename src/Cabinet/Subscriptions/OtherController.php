<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

class OtherController {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = array_map(fn($i) => new OtherModels($i), $data);
	}

	/**
	 * Метод возвращает результат как массив всех доступных подписок для клиента.
	 * С этим методом вы можете сами управлять возвращаемыми данными, или построить свою модель.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает модели всех доступных подписок для клиента.
	 *
	 * @return OtherModels[]
	 */
	public function getSubscriptions(): array {
		return $this->items;
	}

}