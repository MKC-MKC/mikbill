<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

use Haikiri\MikBiLL\ResponseWrapper;

class Packets extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("gid");
	}

	public function getNum(): int
	{
		return (int)$this->getData("num");
	}

	public function getName(): string
	{
		return (string)$this->getData("packet");
	}

	public function getPrice(): float
	{
		return (float)$this->getData("full_price");
	}

	public function getPriceDiscounted(): float
	{
		return (float)$this->getData("full_price_discounted");
	}

	public function getCurrency(): string
	{
		return (string)$this->getData("currency");
	}

	public function getDoPerevodAkciya(): int
	{
		return (int)$this->getData("do_perevod_akciya");
	}

	public function getDoPerevodAkciyaCena(): int
	{
		return (int)$this->getData("do_perevod_akciya_cena");
	}

	public function getResidualPrice(): int
	{
		return (int)$this->getData("residual_price");
	}

	public function getResidualPriceDiscounted(): float
	{
		return (float)$this->getData("residual_price_discounted");
	}

}
