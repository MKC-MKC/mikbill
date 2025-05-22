<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Billing;

use Haikiri\MikBiLL\Cabinet\User;
use Haikiri\MikBiLL\ResponseWrapper;

class UsersSearchController extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new User\UserModels($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 * Обратите внимание, что модель User содержит в себе больше данных чем может вернуть метод поиска по клиенту MikBiLL.
	 * @return User\UserModels[]
	 */
	public function getUsers(): array
	{
		return $this->items;
	}

	/**
	 * Метод возвращает модель первого клиента.
	 * Используйте с осторожностью, и только если уверены что вернётся только один клиент.
	 * @return User\UserModels|null
	 */
	public function getOne(): ?User\UserModels
	{
		return $this->getUsers()[0] ?? null;
	}

}
