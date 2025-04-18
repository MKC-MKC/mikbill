<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

class Subscription {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = array_map(fn($i) => new SubscriptionModel($i), $data);
	}

	/**
	 * Метод возвращает результат как массив.
	 * С этим методом вы можете сами управлять возвращаемыми данными, или построить свою модель.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return SubscriptionModel[]
	 */
	public function getSubscription(): array {
		return $this->items;
	}

}