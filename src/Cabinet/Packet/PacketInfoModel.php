<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

use Haikiri\MikBiLL\ResponseWrapper;

class PacketInfoModel extends ResponseWrapper
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

	public function getCost(): float
	{
		return (float)$this->getData("fixed_cost");
	}

	public function getDailyCost(): float
	{
		return (float)$this->getData("fixed_cost2", "");
	}

	public function getCurrency(): string
	{
		return (string)$this->getData("currency");
	}

	public function getSpeedRate(): string
	{
		return (string)$this->getData("speed_rate");
	}

	public function getSpeedBurst(): string
	{
		return (string)$this->getData("speed_burst");
	}

	public function getTurboTime(): string
	{
		return (string)$this->getData("turbo_time");
	}

	public function getTurboActivationCost(): string
	{
		return (string)$this->getData("turbo_active_cena");
	}

	public function getTurboSpeedIn(): string
	{
		return (string)$this->getData("turbo_speed_in");
	}

	public function getTurboSpeedOut(): string
	{
		return (string)$this->getData("turbo_speed_out");
	}

	public function isMinusAllowed(): bool
	{
		return (bool)$this->getData("razresh_minus", false);
	}

	public function getHowMuch(): array
	{
		return (array)$this->getData("howmuch");
	}

}
