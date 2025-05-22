<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetMenu extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new GetMenuModel($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return GetMenuModel[]
	 */
	public function getMenus(): array
	{
		return $this->items;
	}

}
