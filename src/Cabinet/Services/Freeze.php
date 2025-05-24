<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Services;

use DateTime;
use Haikiri\MikBiLL\ResponseWrapper;

class Freeze extends ResponseWrapper
{

	/**
	 * Метод проверяет доступность активации услуги.
	 * @return bool
	 */
	public function isAvailable(): bool
	{
		return (bool)$this->getData("available", false);
	}

	/**
	 * Метод проверяет статус активации услуги.
	 * @return bool
	 */
	public function isActive(): bool
	{
		return (bool)$this->getData("active", false);
	}

	/**
	 * Метод возвращает информацию об услуге.
	 * @return array|null
	 */
	public function getInfo(): array|null
	{
		return $this->getData("info");
	}

	public function getActivationCost(): int|float|string|null
	{
		return $this->getData("info.cost_activate");
	}

	public function getCostDay(): float|int|string|null
	{
		return $this->getData("info.cost_day");
	}

	public function getDeactivationCost(): float|int|string|null
	{
		return $this->getData("info.cost_deactivate");
	}

	public function getMinDat(): int|string|null
	{
		return $this->getData("info.min_day");
	}

	public function getFreeCount(): int|string|null
	{
		return $this->getData("info.count_free");
	}

	public function getFreeCountUsed(): int|string|null
	{
		return $this->getData("info.count_free_used");
	}

	public function getDateStop(): DateTime|null
	{
		return DateTime::createFromFormat("Y-m-d", $this->getData("info.date_start"));
	}

	public function getDateStart(): DateTime|null
	{
		return DateTime::createFromFormat("Y-m-d", $this->getData("info.date_stop"));
	}

	public function getDateStopEver(): mixed
	{
		return $this->getData("info.date_stop_ever");
	}

	public function getUnfreezeEver(): mixed
	{
		return $this->getData("info.freeze_ever");
	}

	public function getReturnAp(): mixed
	{
		return $this->getData("info.return_ap");
	}

	public function isBalancePlus(): mixed
	{
		return $this->getData("info.balanse_plus");
	}

	public function isFixedMonth(): bool|null
	{
		return $this->getData("info.fixed_month");
	}

	public function canUnfreezeEarlierPay(): bool|null
	{
		return $this->getData("info.unfreeze_earlier_pay");
	}

	public function canUnfreezeEarlierDisallow(): bool|null
	{
		return $this->getData("info.unfreeze_earlier_disallow");
	}

	/**
	 * Метод возвращает валюту расчёта.
	 * @return string|null
	 */
	public function getCurrency(): string|null
	{
		return $this->getData("info.currency");
	}

}
