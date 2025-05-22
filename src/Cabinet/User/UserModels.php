<?php /** @noinspection PhpUnused */

namespace Haikiri\MikBiLL\Cabinet\User;

use Haikiri\MikBiLL\ResponseWrapper;

class UserModels extends ResponseWrapper
{
	use UserFeeModelsTrait;
	use UserShowModelsTrait;

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @in-search
	 * @return int|string
	 */
	public function getUserId(): int|string
	{
		return (int)$this->getData("uid", "");
	}

	/**
	 * @in-search
	 * @return int|string|null
	 */
	public function getUserGid(): int|string|null
	{
		return $this->getData("gid");
	}

	/**
	 * Метод возвращает ID удалённого клиента.
	 *
	 * @in-search
	 * @return int|string|null
	 */
	public function getUserDeletedId(): int|string|null
	{
		return $this->getData("delid");
	}

	/**
	 * Метод возвращает Логин от личного кабинета клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserLogin(): string
	{
		return $this->getData("user", "");
	}

	/**
	 * Метод возвращает Пароль от личного кабинета клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPassword(): string
	{
		return $this->getData("password", "");
	}

	/**
	 * Метод возвращает клиентский номер договора.
	 *
	 * @in-search
	 * @return int|string
	 */
	public function getUserDogovor(): int|string
	{
		return $this->getData("numdogovor", 0);
	}

	/**
	 * Метод возвращает заметки/примечания к клиенту.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserNotes(): string
	{
		return $this->getData("prim", "");
	}

	/**
	 * Метод возвращает Баланс клиента.
	 *
	 * @in-search
	 * @return float|int|string
	 */
	public function getUserDeposit(): float|int|string
	{
		return $this->getData("deposit", 0);
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return float|int|string
	 */
	public function getUserTotalMoney(): float|int|string
	{
		return $this->getData("total_money", 0);
	}

	/**
	 * Метод возвращает состояние клиента.
	 *
	 * @in-search
	 * @return int|string
	 */
	public function getUserState(): int|string
	{
		return $this->getData("state", 0);
	}

	/**
	 * Метод возвращает true если клиент заблокирован.
	 *
	 * @in-search
	 * @return bool|int|string
	 */
	public function isUserBlocked(): bool|int|string
	{
		return $this->getData("blocked", false);
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return bool|int|string
	 */
	public function isUserActivated(): bool|int|string
	{
		return $this->getData("activated", false);
	}

	/**
	 * Метод возвращает Ф. И. О. Клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserFIO(): string
	{
		return $this->getData("fio", "");
	}

	/**
	 * Метод возвращает имя клиента.
	 *
	 * @return string
	 */
	public function getUserFirstName(): string
	{
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[1] ?? "";
	}

	/**
	 * Метод возвращает фамилию клиента.
	 *
	 * @return string
	 */
	public function getUserLastName(): string
	{
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[0] ?? "";
	}

	/**
	 * Метод возвращает отчество клиента.
	 *
	 * @return string
	 */
	public function getUserMiddleName(): string
	{
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[2] ?? "";
	}

	/**
	 * Метод возвращает дату рождения клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserBirthday(): string
	{
		return $this->getData("date_birth", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return bool|int|string
	 */
	public function getUserBirthdayDo(): bool|int|string
	{
		return $this->getData("date_birth_do", false);
	}

	/**
	 * Метод возвращает скорость клиента.
	 *
	 * @in-search
	 * @return string|int
	 */
	public function getUserSpeedRate(): string|int
	{
		return $this->getData("speed_rate", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string|int
	 */
	public function getUserSpeedBurst(): string|int
	{
		return $this->getData("speed_burst", "");
	}

	/**
	 * Метод возвращает e-mail клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserEmail(): string
	{
		return $this->getData("email", "");
	}

	/**
	 * Метод возвращает телефон клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPhone(): string
	{
		return $this->getData("phone", "");
	}

	/**
	 * Метод возвращает телефон клиента для смс.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPhoneSms(): string
	{
		return $this->getData("sms_tel", "");
	}

	/**
	 * Метод возвращает мобильный телефон клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPhoneMobile(): string
	{
		return $this->getData("mob_tel", "");
	}

	/**
	 * Метод возвращает дату регистрации клиента.
	 *
	 * Маска: 'Y-m-d'
	 * @in-search
	 * @return string
	 */
	public function getUserAddDate(): string
	{
		return $this->getData("add_date", "");
	}

	/**
	 * Метод возвращает дату удаления клиента.
	 *
	 * Маска: 'Y-m-d H:i:s'
	 * @in-search
	 * @return string|null
	 */
	public function getUserDelDate(): string|null
	{
		return $this->getData("del_date");
	}

	/**
	 * Метод возвращает дату последнего подключения к сети.
	 *
	 * Маска: 'Y-m-d H:i:s'
	 * @in-search
	 * @return string
	 */
	public function getUserLastConnectionDate(): string
	{
		return $this->getData("last_connection", "");
	}

	/**
	 * Метод возвращает ИНН клиента.
	 *
	 * @in-search
	 * @return string|int
	 */
	public function getUserInn(): string|int
	{
		return $this->getData("inn", "");
	}

	/**
	 * Метод возвращает серию паспорта клиента.
	 *
	 * @in-search
	 * @return string|int
	 */
	public function getUserPassportSeries(): string|int
	{
		return $this->getData("passportserie", "");
	}

	/**
	 * Метод возвращает адрес регистрации (прописку) по паспорту.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPassportRegistration(): string
	{
		return $this->getData("passportpropiska", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPassportVoenkomat(): string
	{
		return $this->getData("passportvoenkomat", "");
	}

	/**
	 * Метод возвращает орган выдачи паспорта.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserPassportAuthority(): string
	{
		return $this->getData("passportgdevidan", "");
	}

	/**
	 * Метод возвращает порт свитча.
	 *
	 * @in-search
	 * @return int
	 */
	public function getUserSwitchPort(): int
	{
		return $this->getData("switchport", 0);
	}

	/**
	 * Метод возвращает сектор.
	 *
	 * @in-search
	 * @return bool|int|string
	 */
	public function getUserSector(): bool|int|string
	{
		return $this->getData("sectorid", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return bool|int|string
	 */
	public function isUserUseRouter(): bool|int|string
	{
		return $this->getData("use_router", false);
	}

	/**
	 * Метод возвращает модель/производителя роутера.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterModel(): string
	{
		return $this->getData("router_model", "");
	}

	/**
	 * Метод возвращает SSID названия сети клиентского роутера.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterSsid(): string
	{
		return $this->getData("router_ssid", "");
	}

	/**
	 * Метод возвращает логин к роутеру клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterLogin(): string
	{
		return $this->getData("router_login", "");
	}

	/**
	 * Метод возвращает пароль к роутеру клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterPassword(): string
	{
		return $this->getData("router_pass", "");
	}

	/**
	 * Метод возвращает дату добавления роутера.
	 *
	 * Маска: '00/00/0000'
	 * @in-search
	 * @return string
	 */
	public function getUserRouterAddDate(): string
	{
		return $this->getData("router_add_date", "");
	}

	/**
	 * Метод возвращает порт клиентского роутера.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterPort(): string
	{
		return $this->getData("router_port", "");
	}

	/**
	 * Метод возвращает серийный номер клиентского роутера.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRouterSerialNumber(): string
	{
		return $this->getData("router_serial", "");
	}

	/**
	 * Возвращает true если роутер куплен у нас.
	 *
	 * @in-search
	 * @return bool
	 */
	public function isUserRouterAcquiredFromUs(): bool
	{
		return $this->getData("router_we_saled", false);
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return float|int|string
	 */
	public function getUserCredit(): float|int|string
	{
		return $this->getData("credit", 0);
	}

	/**
	 * Метод возвращает процентную ставку по кредиту.
	 *
	 * @in-search
	 * @return string|int
	 */
	public function getUserCreditPercent(): string|int
	{
		return $this->getData("credit_procent", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserCreditUnlimited(): string
	{
		return $this->getData("credit_unlimited", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserRating(): string
	{
		return $this->getData("rating", "");
	}

	/**
	 * Метод возвращает назначенный адрес.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserFramedIp(): string
	{
		return $this->getData("framed_ip", "");
	}

	/**
	 * Метод возвращает назначенную маску адреса.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserFramedMask(): string
	{
		return $this->getData("framed_mask", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserLocalIp(): string
	{
		return $this->getData("local_ip", "");
	}

	/**
	 * #
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserLocalMac(): string
	{
		return $this->getData("local_mac", "");
	}

	/**
	 * Метод возвращает адрес клиента.
	 *
	 * @in-search
	 * @return string
	 */
	public function getUserAddress(): string
	{
		return $this->getData("address", "");
	}

	/**
	 * Метод возвращает условную единицу расчёта с клиентом (Валюта).
	 *
	 * @return string|null
	 */
	public function getUserCurrency(): string|null
	{
		return $this->getData("UE");
	}

	/**
	 * Метод возвращает название тарифа клиента.
	 *
	 * @return string|null
	 */
	public function getUserTariffName(): string|null
	{
		return $this->getData("packet_name");
	}

	/**
	 * Метод возвращает входящую скорость клиента.
	 *
	 * @return string|null
	 */
	public function getUserTariffSpeedIn(): string|null
	{
		return $this->getData("speed_in");
	}

	/**
	 * Метод возвращает исходящую скорость клиента.
	 *
	 * @return string|null
	 */
	public function getUserTariffSpeedOut(): string|null
	{
		return $this->getData("speed_out");
	}

	/**
	 * Метод возвращает фиксированную стоимость тарифа.
	 *
	 * @return float|int|string|null
	 */
	public function getUserTariffFixedCost(): float|int|string|null
	{
		return $this->getData("tarif_fixed_cost", 0);
	}

	/**
	 * #
	 *
	 * @return float|int|string|null
	 */
	public function getUserFixedCost2(): float|int|string|null
	{
		return $this->getData("fixed_cost2", 0);
	}

	/**
	 * #
	 *
	 * @return float|int|string|null
	 */
	public function getUserCharge(): float|int|string|null
	{
		return $this->getData("abonplata", 0);
	}

	/**
	 * Метод возвращает что-то связанное с тарифом.
	 *
	 * @return string|null
	 */
	public function getPacket(): string|null
	{
		return $this->getData("packet");
	}

	/**
	 * Метод возвращает название тарифа.
	 *
	 * @return string|null
	 */
	public function getPacketName(): string|null
	{
		return $this->getData("packet_name");
	}

	/**
	 * Метод возвращает время на которое активируется турбо.
	 *
	 * @return string|null
	 */
	public function getUserTurboTime(): string|null
	{
		return $this->getData("turbo_time");
	}

	/**
	 * Возвращает true если у клиента активен турбо.
	 *
	 * @return bool|null
	 */
	public function isUserTurboActivated(): bool|null
	{
		return $this->getData("turbo_active");
	}

	/**
	 * #
	 *
	 * @return bool|null
	 */
	public function isUserTurboDo(): bool|null
	{
		return $this->getData("do_turbo");
	}

	/**
	 * Метод возвращает стоимость активации кредита.
	 *
	 * @return float|int|string|null
	 */
	public function getUserCreditCost(): float|int|string|null
	{
		return $this->getData("credit_active_cena");
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserPaymentMethods(): array|null
	{
		return $this->getData("payment_methods");
	}

	/**
	 * Метод возвращает массив связанный с правами доступа клиента.
	 *
	 * @return array|null
	 */
	public function getUserShow(): array|null
	{
		return $this->getData("show");
	}

	/**
	 * Метод возвращает массив связанный с финансовой частью клиента.
	 *
	 * @return array|null
	 */
	public function getUserFee(): array|null
	{
		return $this->getData("fee");
	}

}
