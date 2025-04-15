<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetMenu
{

	private array|null $data;
	private array|null $items;

	public function __construct(?array $data = [])
	{
		$this->data = $data;
		$this->items = array_map(fn($i) => new GetMenuModel($i), $data);
	}

	/**
	 * Метод возвращает результат как массив всех доступных подписок для клиента.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array
	{
		return $this->data;
	}

	/**
	 * Метод возвращает модели меню.
	 *
	 * @return GetMenuModel[]
	 */
	public function getMenus(): array
	{
		return $this->items;
	}

}
