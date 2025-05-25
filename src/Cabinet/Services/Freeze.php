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

	public function getActivationCost(): float
	{
		return (float)$this->getData("info.cost_activate");
	}

	public function getDeactivationCost(): float
	{
		return (float)$this->getData("info.cost_deactivate");
	}

	public function getCostDay(): float
	{
		return (float)$this->getData("info.cost_day");
	}

	public function getMinDay(): int
	{
		return (int)$this->getData("info.min_day");
	}

	public function getFreeCount(): int
	{
		return (int)$this->getData("info.count_free");
	}

	public function getFreeCountUsed(): int
	{
		return (int)$this->getData("info.count_free_used");
	}

	public function getDateStop(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("info.date_stop", ""));
		return $date !== false ? $date : null;
	}

	public function getDateStart(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("info.date_start", ""));
		return $date !== false ? $date : null;
	}

	public function hasDateStopEver(): bool
	{
		return (bool)$this->getData("info.date_stop_ever");
	}

	public function getFreezeEver(): bool
	{
		return (bool)$this->getData("info.freeze_ever");
	}

	public function getReturnAp(): bool
	{
		return (bool)$this->getData("info.return_ap");
	}

	public function isBalancePlus(): bool
	{
		return (bool)$this->getData("info.balance_plus") ?? (bool)$this->getData("info.balanse_plus");
	}

	public function isFixedMonth(): bool
	{
		return (bool)$this->getData("info.fixed_month");
	}

	public function canUnfreezeEarlierPay(): bool
	{
		return (bool)$this->getData("info.unfreeze_earlier_pay");
	}

	public function canUnfreezeEarlierDisallow(): bool
	{
		return (bool)$this->getData("info.unfreeze_earlier_disallow");
	}

	/**
	 * Метод возвращает валюту расчёта.
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->getData("info.currency", "");
	}

}
