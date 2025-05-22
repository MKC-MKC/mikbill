<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

use Haikiri\MikBiLL\ResponseWrapper;

class PacketsModel extends ResponseWrapper
{

	public function getId(): int
	{
		return $this->getData("gid", 0);
	}

	public function getNum(): int
	{
		return $this->getData("num", 0);
	}

	public function getName(): string
	{
		return $this->getData("packet", "");
	}

	public function getPrice(): float
	{
		return $this->getData("full_price", 0);
	}

	public function getPriceDiscounted(): float
	{
		return $this->getData("full_price_discounted", 0);
	}

	public function getCurrency(): string
	{
		return $this->getData("currency", "");
	}

	public function getDoPerevodAkciya(): int
	{
		return $this->getData("do_perevod_akciya", 0);
	}

	public function getDoPerevodAkciyaCena(): int
	{
		return $this->getData("do_perevod_akciya_cena", 0);
	}

	public function getResidualPrice(): int
	{
		return $this->getData("residual_price", 0);
	}

	public function getResidualPriceDiscounted(): float
	{
		return $this->getData("residual_price_discounted", 0);
	}

}
