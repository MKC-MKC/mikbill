<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Services;

use DateTime;
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
	 * @return float
	 */
	public function getActivationCost(): float
	{
		return (float)$this->getData("info.cost_activate");
	}

	/**
	 * Метод возвращает входящую скорость в байтах-в-секунду.
	 * @return int
	 */
	public function getSpeedInBites(): int
	{
		return (int)$this->getData("info.speed_in");
	}

	/**
	 * Метод возвращает исходящую скорость в байтах-в-секунду.
	 * @return int
	 */
	public function getSpeedOutBites(): int
	{
		return (int)$this->getData("info.speed_out");
	}

	/**
	 * Метод возвращает время на которое будет активирована услуга.
	 * @return int
	 */
	public function getTime(): int
	{
		return (int)$this->getData("info.time");
	}

	/**
	 * Метод возвращает время когда будет остановлена услуга.
	 * @return DateTime|null
	 */
	public function getStopTime(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d H:i:s", $this->getData("info.stop_time", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает входящую скорость в мегабитах-в-секунду.
	 * @return int
	 */
	public function getSpeedIn(): int
	{
		return (int)$this->getData("info.in");
	}

	/**
	 * Метод возвращает исходящую скорость в мегабитах-в-секунду.
	 * @return int
	 */
	public function getSpeedOut(): int
	{
		return (int)$this->getData("info.out");
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
