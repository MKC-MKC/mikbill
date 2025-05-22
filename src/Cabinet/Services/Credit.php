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
		return $this->getData("available", false);
	}

	/**
	 * Метод проверяет статус активации услуги.
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->getData("active", false);
	}

	/**
	 * Метод возвращает информацию о кредите.
	 * @return array|null
	 */
	public function getInfo(): array|null
	{
		return $this->getData("info");
	}

	/**
	 * Метод возвращает стоимость активации кредита.
	 * @return float
	 */
	public function getActivateCost(): float
	{
		return $this->getData("info.active_cena", 0);
	}

	/**
	 * Метод возвращает процент кредита.
	 * @return int
	 */
	public function getCreditPercent(): int
	{
		return $this->getData("info.credit_procent", 0);
	}

	/**
	 * Метод возвращает тип кредита.
	 * @return int
	 */
	public function getType(): int
	{
		return $this->getData("info.type", 0);
	}

	/**
	 * Метод возвращает тип кредита.
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->getData("info.currency", "N");
	}

	/**
	 * Метод возвращает сумму кредита.
	 * @return float
	 */
	public function getCreditSum(): float
	{
		return $this->getData("info.credit_summa", 0);
	}

	/**
	 * Метод проверяет возможность досрочного погашения кредита.
	 * @return bool
	 */
	public function canEarlyLoanRepayment(): bool
	{
		return $this->getData("info.early_loan_repayment", false);
	}

	/**
	 * Метод возвращает количество дней, на которое будут доступны услуги.
	 * @return int
	 */
	public function getAvailableDays(): int
	{
		return $this->getData("info.will_be_avilable_days", 0);
	}

	/**
	 * Метод возвращает число 'G' активации кредита.
	 * @return string
	 */
	public function getCreditDayStart(): string
	{
		return $this->getData("info.start_credit_day", "0");
	}

	/**
	 * Метод возвращает число 'G' отключения кредита.
	 * @return string
	 */
	public function getCreditDayStop(): string
	{
		return $this->getData("info.stop_credit_day", "0");
	}

	/**
	 * Метод возвращает объект даты активации кредита.
	 * @return DateTime|bool
	 */
	public function getDateStart(): DateTime|bool
	{
		return DateTime::createFromFormat("Y-m-d", $this->getData("info.date_start"));
	}

	/**
	 * Метод возвращает объект даты отключения кредита.
	 * @return DateTime|bool
	 */
	public function getDateStop(): DateTime|bool
	{
		return DateTime::createFromFormat("Y-m-d", $this->getData("info.date_stop"));
	}

	/**
	 * Метод возвращает количество дней на которое будет активирован кредит.
	 * @return int
	 */
	public function getActivationDays(): int
	{
		return $this->getData("info.credit_active_days", 0);
	}

}
