<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use Haikiri\MikBiLL\ResponseWrapper;

class Subscription extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new SubscriptionModel($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return SubscriptionModel[]
	 */
	public function getSubscription(): array
	{
		return $this->items;
	}

}
