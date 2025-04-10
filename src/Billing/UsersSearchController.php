<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Billing;

use Haikiri\MikBiLL\Cabinet\User;

class UsersSearchController implements UsersSearchControllerInterface {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = array_map(fn($i) => new User\UserModels($i), $data);
	}

	/**
	 * Метод возвращает результат как массив всех клиентов.
	 * С этим методом вы можете сами управлять возвращаемыми данными, или построить свою модель.
	 * @return array|null
	 */
	public function getAsArray(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает модели всех клиентов.
	 * Обратите внимание, что модель User содержит в себе больше данных чем может вернуть метод поиска по клиенту MikBiLL.
	 * @return User\UserModels[]
	 */
	public function getUsers(): array {
		return $this->items;
	}

	/**
	 * Метод возвращает модель первого клиента.
	 * Используйте с осторожностью, и только если уверены что вернётся только один клиент.
	 * @return User\UserModels|null
	 */
	public function getOne(): ?User\UserModels {
		return $this->getUsers()[0] ?? null;
	}

}