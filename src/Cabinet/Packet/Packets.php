<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

use Haikiri\MikBiLL\ResponseWrapper;

class Packets extends ResponseWrapper
{

	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new PacketsModel($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return PacketsModel[]
	 */
	public function getPacket(): array
	{
		return $this->items;
	}

}
