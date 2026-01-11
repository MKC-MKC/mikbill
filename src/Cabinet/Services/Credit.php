<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Services;

use DateTime;
use Haikiri\MikBiLL\ResponseWrapper;
use Throwable;

class Credit extends ResponseWrapper
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
	 * @return array
	 */
	public function getInfo(): array
	{
		return (array)$this->getData("info");
	}

	/**
	 * Метод возвращает стоимость активации услуги.
	 * @return float
	 */
	public function getActivationCost(): float
	{
		return (float)$this->getData("info.active_cena");
	}

	/**
	 * Метод возвращает процент кредита.
	 * @return int
	 */
	public function getCreditPercent(): int
	{
		return (int)$this->getData("info.credit_procent");
	}

	/**
	 * Метод возвращает тип кредита.
	 * @return int
	 */
	public function getType(): int
	{
		return (int)$this->getData("info.type");
	}

	/**
	 * Метод возвращает валюту расчёта.
	 * @return string
	 */
	public function getCurrency(): string
	{
		return (string)$this->getData("info.currency");
	}

	/**
	 * Метод возвращает сумму кредита.
	 * @return float
	 */
	public function getCreditSum(): float
	{
		return (float)$this->getData("info.credit_summa");
	}

	/**
	 * Метод проверяет возможность досрочного погашения кредита.
	 * @return bool
	 */
	public function canEarlyLoanRepayment(): bool
	{
		return (bool)$this->getData("info.early_loan_repayment");
	}

	/**
	 * Метод возвращает количество дней, на которое будут доступны услуги.
	 * @return int
	 */
	public function getAvailableDays(): int
	{
		return $this->getData("info.will_be_avilable_days") ?? (int)$this->getData("info.will_be_available_days");
	}

	/**
	 * Метод возвращает число 'G' активации кредита.
	 * @return string
	 */
	public function getCreditDayStart(): string
	{
		return (string)$this->getData("info.start_credit_day");
	}

	/**
	 * Метод возвращает число 'G' отключения кредита.
	 * @return string
	 */
	public function getCreditDayStop(): string
	{
		return (string)$this->getData("info.stop_credit_day");
	}

	/**
	 * Метод возвращает объект даты активации кредита.
	 * @return DateTime|null
	 */
	public function getDateStart(): DateTime|null
	{
		try {
			$date = $this->getData("info.date_start", "");
			return $date ? new DateTime($date) : null;
		} catch (Throwable) {
			return null;
		}
	}

	/**
	 * Метод возвращает объект даты отключения кредита.
	 * @return DateTime|null
	 */
	public function getDateStop(): DateTime|null
	{
		try {
			$date = $this->getData("info.date_stop", "");
			return $date ? new DateTime($date) : null;
		} catch (Throwable) {
			return null;
		}
	}

	/**
	 * Метод возвращает количество дней на которое будет активирован кредит.
	 * @return int
	 */
	public function getActivationDays(): int
	{
		return (int)$this->getData("info.credit_active_days");
	}

}
