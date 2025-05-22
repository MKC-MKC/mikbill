<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

use Haikiri\MikBiLL\ResponseWrapper;

class PacketInfoModel extends ResponseWrapper
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

	public function getCost(): float
	{
		return $this->getData("fixed_cost", 0);
	}

	public function getDailyCost(): float
	{
		return $this->getData("fixed_cost2", "");
	}

	public function getCurrency(): string
	{
		return $this->getData("currency", "");
	}

	public function getSpeedRate(): string
	{
		return $this->getData("speed_rate", "");
	}

	public function getSpeedBurst(): string
	{
		return $this->getData("speed_burst", "");
	}

	public function getTurboTime(): string
	{
		return $this->getData("turbo_time", "");
	}

	public function getTurboActivationCost(): string
	{
		return $this->getData("turbo_active_cena", "");
	}

	public function getTurboSpeedIn(): string
	{
		return $this->getData("turbo_speed_in", "");
	}

	public function getTurboSpeedOut(): string
	{
		return $this->getData("turbo_speed_out", "");
	}

	public function isMinusAllowed(): bool
	{
		return $this->getData("razresh_minus", false);
	}

	public function getHowMuch(): array|null
	{
		return $this->getData("howmuch");
	}

}
