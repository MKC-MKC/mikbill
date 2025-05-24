<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Services;

use Haikiri\MikBiLL\ResponseWrapper;

class Turbo extends ResponseWrapper
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

	/**
	 * Метод возвращает стоимость активации услуги.
	 * @return float|string|null
	 */
	public function getActivationCost(): float|string|null
	{
		return $this->getData("info.cost_activate");
	}

	/**
	 * @return int|float|string|null
	 * @deprecated Метод возвращает стоимость активации услуги.
	 * @use self::getActivationCost
	 */
	public function getActivateCost(): int|float|string|null
	{
		return $this->getData("info.activate_cost");
	}

	/**
	 * Метод возвращает входящую скорость в байтах-в-секунду.
	 * @return int|string|null
	 */
	public function getSpeedInBites(): int|string|null
	{
		return $this->getData("info.speed_in");
	}

	/**
	 * Метод возвращает исходящую скорость в байтах-в-секунду.
	 * @return int|string|null
	 */
	public function getSpeedOutBites(): int|string|null
	{
		return $this->getData("info.speed_out");
	}

	/**
	 * @return int|float|string|null
	 * @deprecated Метод возвращает стоимость услуги.
	 */
	public function getCost(): int|float|string|null
	{
		return $this->getData("info.cost");
	}

	/**
	 * Метод возвращает время на которое будет активирована услуга.
	 * @return int|string|null
	 */
	public function getTime(): int|string|null
	{
		return $this->getData("info.time");
	}

	/**
	 * Метод возвращает время когда будет остановлена услуга.
	 * @return int|string|null
	 */
	public function getStopTime(): int|string|null
	{
		return $this->getData("info.stop_time");
	}

	/**
	 * Метод возвращает входящую скорость в мегабитах-в-секунду.
	 * @return int|null
	 */
	public function getSpeedIn(): int|null
	{
		return $this->getData("info.in");
	}

	/**
	 * Метод возвращает исходящую скорость в мегабитах-в-секунду.
	 * @return int|null
	 */
	public function getSpeedOut(): int|null
	{
		return $this->getData("info.out");
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
