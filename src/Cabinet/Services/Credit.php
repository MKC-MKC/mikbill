<?php

namespace Haikiri\MikBiLL\Cabinet\Services;

use DateTime;
use Haikiri\MikBiLL\ResponseWrapper;

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
	 * @return array|null
	 */
	public function getInfo(): array|null
	{
		return $this->getData("info");
	}

	/**
	 * Метод возвращает стоимость активации услуги.
	 * @return float|null
	 */
	public function getActivateCost(): float|null
	{
		return $this->getData("info.active_cena");
	}

	/**
	 * Метод возвращает процент кредита.
	 * @return int|null
	 */
	public function getCreditPercent(): int|null
	{
		return $this->getData("info.credit_procent");
	}

	/**
	 * Метод возвращает тип кредита.
	 * @return int|null
	 */
	public function getType(): int|null
	{
		return $this->getData("info.type");
	}

	/**
	 * Метод возвращает валюту расчёта.
	 * @return string|null
	 */
	public function getCurrency(): string|null
	{
		return $this->getData("info.currency");
	}

	/**
	 * Метод возвращает сумму кредита.
	 * @return float|null
	 */
	public function getCreditSum(): float|null
	{
		return $this->getData("info.credit_summa");
	}

	/**
	 * Метод проверяет возможность досрочного погашения кредита.
	 * @return bool|null
	 */
	public function canEarlyLoanRepayment(): bool|null
	{
		return $this->getData("info.early_loan_repayment");
	}

	/**
	 * Метод возвращает количество дней, на которое будут доступны услуги.
	 * @return int|null
	 */
	public function getAvailableDays(): int|null
	{
		return $this->getData("info.will_be_avilable_days") ?? $this->getData("info.will_be_available_days");
	}

	/**
	 * Метод возвращает число 'G' активации кредита.
	 * @return string|null
	 */
	public function getCreditDayStart(): string|null
	{
		return $this->getData("info.start_credit_day");
	}

	/**
	 * Метод возвращает число 'G' отключения кредита.
	 * @return string|null
	 */
	public function getCreditDayStop(): string|null
	{
		return $this->getData("info.stop_credit_day");
	}

	/**
	 * Метод возвращает объект даты активации кредита.
	 * @return DateTime|null
	 */
	public function getDateStart(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("info.date_start", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает объект даты отключения кредита.
	 * @return DateTime|null
	 */
	public function getDateStop(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("info.date_stop", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает количество дней на которое будет активирован кредит.
	 * @return int|null
	 */
	public function getActivationDays(): int|null
	{
		return $this->getData("info.credit_active_days");
	}

}
