<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Billing;

use Haikiri\MikBiLL\ResponseWrapper;
use Haikiri\MikBiLL\Billing\Search\UserSearch;

class UsersSearchController extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new UserSearch($i), $data);
	}

	/**
	 * Метод возвращает результат как массив моделей.
	 * @return UserSearch[]
	 */
	public function getUsers(): array
	{
		return $this->items;
	}

	/**
	 * Метод возвращает модель первого клиента.
	 * Используйте с осторожностью, и только если уверены что вернётся только один клиент.
	 * @return UserSearch|null
	 */
	public function getOne(): ?UserSearch
	{
		return $this->getUsers()[0] ?? null;
	}

}
