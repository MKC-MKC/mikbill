<?php /** @noinspection PhpUnused */

namespace Haikiri\MikBiLL\Cabinet\User;

use DateTime;
use Haikiri\MikBiLL\ResponseWrapper;
use Throwable;

class User extends ResponseWrapper
{
	use UserTrait;
	use UserFeeTrait;
	use UserShowTrait;

	/**
	 * Метод возвращает условную единицу расчёта с клиентом (Валюта).
	 *
	 * @return string
	 */
	public function getUserCurrency(): string
	{
		return (string)$this->getData("UE");
	}

	/**
	 * Метод возвращает название тарифа клиента.
	 *
	 * @return string
	 */
	public function getUserTariffName(): string
	{
		return (string)$this->getData("packet_name");
	}

	/**
	 * Метод возвращает входящую скорость клиента.
	 *
	 * @return int
	 */
	public function getUserTariffSpeedIn(): int
	{
		return (int)$this->getData("speed_in");
	}

	/**
	 * Метод возвращает исходящую скорость клиента.
	 *
	 * @return int
	 */
	public function getUserTariffSpeedOut(): int
	{
		return (int)$this->getData("speed_out");
	}

	/**
	 * Метод возвращает фиксированную стоимость тарифа.
	 *
	 * @return float
	 */
	public function getUserTariffFixedCost(): float
	{
		return (float)$this->getData("tarif_fixed_cost", 0.0);
	}

	/**
	 * Метод возвращает суточную стоимость тарифа.
	 *
	 * @return float
	 */
	public function getFixedCostOnPerDay(): float
	{
		return (float)$this->getData("fixed_cost2", 0.0);
	}

	/**
	 * @return float (string->int->float)
	 */
	public function getUserCharge(): float
	{
		return (float)$this->getData("abonplata", 0.0);
	}

	/**
	 * Метод возвращает название тарифа.
	 *
	 * @return string
	 */
	public function getPacket(): string
	{
		return (string)$this->getData("packet");
	}

	/**
	 * Метод возвращает название тарифа.
	 *
	 * @return string
	 */
	public function getPacketName(): string
	{
		return (string)$this->getData("packet_name");
	}

	/**
	 * Метод возвращает время на которое активируется услуга "Турбо".
	 *
	 * @return int
	 */
	public function getUserTurboTime(): int
	{
		return (int)$this->getData("turbo_time");
	}

	/**
	 * Возвращает true если у клиента активна услуга "Турбо".
	 *
	 * @return bool
	 */
	public function isUserTurboActivated(): bool
	{
		return (bool)$this->getData("turbo_active", false);
	}

	/**
	 * @return bool
	 */
	public function isUserTurboDo(): bool
	{
		return (bool)$this->getData("do_turbo", false);
	}

	/**
	 * Метод возвращает стоимость активации кредита.
	 *
	 * @return float
	 */
	public function getUserCreditCost(): float
	{
		return (float)$this->getData("credit_active_cena", 0.0);
	}

	/**
	 * Метод возвращает массив с методами оплат.
	 */
	public function getUserPaymentMethods(string|null $sub = null): mixed
	{
		return $this->getData($sub !== null ? "payment_methods.$sub" : "payment_methods");
	}

	/**
	 * Метод возвращает массив связанный с правами доступа клиента.
	 */
	public function getUserShow(string|null $sub = null): mixed
	{
		return $this->getData($sub !== null ? "show.$sub" : "show");
	}

	/**
	 * Метод возвращает массив связанный с финансовой частью клиента.
	 */
	public function getUserFee(string|null $sub = null): mixed
	{
		return $this->getData($sub !== null ? "fee.$sub" : "fee");
	}

	/**
	 * Метод возвращает количество оставшихся дней до отключения услуги интернет.
	 * @return int
	 */
	public function getDaysLeft(): int
	{
		return (int)$this->getData("days_left");
	}

	/**
	 * Метод возвращает объект времени - дату окончания услуги интернета.
	 * @return DateTime|null
	 */
	public function getEndDate(): DateTime|null
	{
		try {
			$date = $this->getDateItog();
			return $date ? new DateTime($date) : null;
		} catch (Throwable) {
			return null;
		}
	}

	/**
	 * Метод необработанное значение - дату окончания услуги интернета.
	 * @return string|null
	 */
	public function getDateItog(): string|null
	{
		return $this->getData("date_itog");
	}

	/**
	 * Метод возвращает объект времени - когда был активирован кредит.
	 * @return DateTime|null
	 */
	public function getCreditActivationDate(): DateTime|null
	{
		try {
			$value = $this->getData("do_credit_vremen_start_date");
			return empty($value) ? null : new DateTime($value);
		} catch (Throwable) {
			return null;
		}
	}

}
