<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\User;

use DateTime;

/**
 * @in-search Данные методы доступны в поиске Billing.
 */
trait UserTrait
{

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return (int)$this->getData("uid");
	}

	/**
	 * @return int
	 */
	public function getUserGid(): int
	{
		return (int)$this->getData("gid");
	}

	/**
	 * Метод возвращает ID удалённого клиента.
	 *
	 * @return int
	 */
	public function getUserDeletedId(): int
	{
		return (int)$this->getData("delid");
	}

	/**
	 * Метод возвращает Логин от личного кабинета клиента.
	 *
	 * @return string
	 */
	public function getUserLogin(): string
	{
		return $this->getData("user", "");
	}

	/**
	 * Метод возвращает Пароль от личного кабинета клиента.
	 *
	 * @return string
	 */
	public function getUserPassword(): string
	{
		return $this->getData("password", "");
	}

	/**
	 * Метод возвращает клиентский номер договора.
	 *
	 * @return string
	 */
	public function getUserDogovor(): string
	{
		return $this->getData("numdogovor");
	}

	/**
	 * Метод возвращает заметки/примечания к клиенту.
	 *
	 * @return string
	 */
	public function getUserNotes(): string
	{
		return $this->getData("prim", "");
	}

	/**
	 * Метод возвращает Баланс клиента.
	 *
	 * @return float
	 */
	public function getUserDeposit(): float
	{
		return (float)$this->getData("deposit", 0.0);
	}

	/**
	 * @return float
	 */
	public function getUserTotalMoney(): float
	{
		return (float)$this->getData("total_money", 0.0);
	}

	/**
	 * Метод возвращает состояние клиента.
	 *
	 * @return int
	 */
	public function getUserState(): int
	{
		return (int)$this->getData("state", 0);
	}

	/**
	 * Метод возвращает true если клиент заблокирован.
	 *
	 * @return bool
	 */
	public function isUserBlocked(): bool
	{
		return (bool)$this->getData("blocked", false);
	}

	/**
	 * @return bool
	 */
	public function isUserActivated(): bool
	{
		return (bool)$this->getData("activated", false);
	}

	/**
	 * Метод возвращает Ф. И. О. Клиента.
	 *
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
	 * @return DateTime|null
	 */
	public function getUserBirthday(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("date_birth", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * @return bool
	 */
	public function isUserBirthdayDo(): bool
	{
		return (bool)$this->getData("date_birth_do", false);
	}

	/**
	 * @return bool
	 * @deprecated
	 */
	public function getUserBirthdayDo(): bool
	{
		return (bool)$this->getData("date_birth_do", false);
	}

	/**
	 * Метод возвращает скорость клиента.
	 *
	 * @return int
	 */
	public function getUserSpeedRate(): int
	{
		return (int)$this->getData("speed_rate");
	}

	/**
	 * @return int
	 */
	public function getUserSpeedBurst(): int
	{
		return (int)$this->getData("speed_burst");
	}

	/**
	 * Метод возвращает e-mail клиента.
	 *
	 * @return string
	 */
	public function getUserEmail(): string
	{
		return $this->getData("email", "");
	}

	/**
	 * Метод возвращает телефон клиента.
	 *
	 * @return string
	 */
	public function getUserPhone(): string
	{
		return $this->getData("phone", "");
	}

	/**
	 * Метод возвращает телефон клиента для смс.
	 *
	 * @return string
	 */
	public function getUserPhoneSms(): string
	{
		return $this->getData("sms_tel", "");
	}

	/**
	 * Метод возвращает мобильный телефон клиента.
	 *
	 * @return string
	 */
	public function getUserPhoneMobile(): string
	{
		return $this->getData("mob_tel", "");
	}

	/**
	 * Метод возвращает дату регистрации клиента.
	 *
	 * @return DateTime|null
	 */
	public function getUserAddDate(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d", $this->getData("add_date", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает дату удаления клиента.
	 *
	 * @return DateTime|null
	 */
	public function getUserDelDate(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d H:i:s", $this->getData("del_date", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает дату последнего подключения к сети.
	 *
	 * @return DateTime|null
	 */
	public function getUserLastConnectionDate(): DateTime|null
	{
		$date = DateTime::createFromFormat("Y-m-d H:i:s", $this->getData("last_connection", ""));
		return $date !== false ? $date : null;
	}

	/**
	 * Метод возвращает ИНН клиента.
	 *
	 * @return string
	 */
	public function getUserInn(): string
	{
		return $this->getData("inn", "");
	}

	/**
	 * Метод возвращает серию паспорта клиента.
	 *
	 * @return string
	 */
	public function getUserPassportSeries(): string
	{
		return $this->getData("passportserie", "");
	}

	/**
	 * Метод возвращает адрес регистрации (прописку) по паспорту.
	 *
	 * @return string
	 */
	public function getUserPassportRegistration(): string
	{
		return $this->getData("passportpropiska", "");
	}

	/**
	 * @return string
	 */
	public function getUserPassportVoenkomat(): string
	{
		return $this->getData("passportvoenkomat", "");
	}

	/**
	 * Метод возвращает орган выдачи паспорта.
	 *
	 * @return string
	 */
	public function getUserPassportAuthority(): string
	{
		return $this->getData("passportgdevidan", "");
	}

	/**
	 * Метод возвращает порт свитча.
	 *
	 * @return int
	 */
	public function getUserSwitchPort(): int
	{
		return (int)$this->getData("switchport", 0);
	}

	/**
	 * Метод возвращает сектор.
	 *
	 * @return string
	 */
	public function getUserSector(): string
	{
		return $this->getData("sectorid", "");
	}

	/**
	 * @return bool
	 */
	public function isUserUseRouter(): bool
	{
		return (bool)$this->getData("use_router", false);
	}

	/**
	 * Метод возвращает модель/производителя роутера.
	 *
	 * @return string
	 */
	public function getUserRouterModel(): string
	{
		return $this->getData("router_model", "");
	}

	/**
	 * Метод возвращает SSID названия сети клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterSsid(): string
	{
		return $this->getData("router_ssid", "");
	}

	/**
	 * Метод возвращает логин к роутеру клиента.
	 *
	 * @return string
	 */
	public function getUserRouterLogin(): string
	{
		return $this->getData("router_login", "");
	}

	/**
	 * Метод возвращает пароль к роутеру клиента.
	 *
	 * @return string
	 */
	public function getUserRouterPassword(): string
	{
		return $this->getData("router_pass", "");
	}

	/**
	 * Метод возвращает дату добавления роутера.
	 *
	 * @return DateTime|null
	 */
	public function getUserRouterAddDate(): DateTime|null
	{
		$data = $this->getData("router_add_date", "");
		$date = DateTime::createFromFormat("d/m/Y", $data);
		if (!$data || $data === "00/00/0000") return null; # Вы ещё те кадры, знайте это, зайки ❤️

		# Парс ошибок...
		$err = DateTime::getLastErrors();
		return $err["warning_count"] > 0 || $err["error_count"] > 0 ? null : $date;
	}

	/**
	 * Метод возвращает порт клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterPort(): string
	{
		return $this->getData("router_port", "");
	}

	/**
	 * Метод возвращает серийный номер клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterSerialNumber(): string
	{
		return $this->getData("router_serial", "");
	}

	/**
	 * Возвращает true если роутер куплен у нас.
	 *
	 * @return bool
	 */
	public function isUserRouterAcquiredFromUs(): bool
	{
		return (bool)$this->getData("router_we_saled", false);
	}

	/**
	 * @return bool
	 */
	public function isUseDualRouter(): bool
	{
		return (bool)$this->getData("router_use_dual", false);
	}

	/**
	 * @return int
	 */
	public function getUserCredit(): int
	{
		return (int)$this->getData("credit", 0);
	}

	/**
	 * Метод возвращает процентную ставку по кредиту.
	 *
	 * @return int
	 */
	public function getUserCreditPercent(): int
	{
		return (int)$this->getData("credit_procent", 0);
	}

	/**
	 * @return bool
	 */
	public function isCreditUnlimited(): bool
	{
		return (bool)$this->getData("credit_unlimited", false);
	}

	/**
	 * @deprecated Вероятнее всего это boolean
	 * @use self::isCreditUnlimited
	 */
	public function getUserCreditUnlimited(): string
	{
		return $this->getData("credit_unlimited", "");
	}

	/**
	 * @return int
	 */
	public function getUserRating(): int
	{
		return (int)$this->getData("rating");
	}

	/**
	 * Метод возвращает назначенный адрес.
	 *
	 * @return string
	 */
	public function getUserFramedIp(): string
	{
		return $this->getData("framed_ip", "");
	}

	/**
	 * Метод возвращает назначенную маску адреса.
	 *
	 * @return string
	 */
	public function getUserFramedMask(): string
	{
		return $this->getData("framed_mask", "");
	}

	/**
	 * @return string
	 */
	public function getUserLocalIp(): string
	{
		return $this->getData("local_ip", "");
	}

	/**
	 * @return string
	 */
	public function getUserLocalMac(): string
	{
		return $this->getData("local_mac", "");
	}

	/**
	 * Метод возвращает адрес клиента.
	 *
	 * @return string
	 */
	public function getUserAddress(): string
	{
		return $this->getData("address", "");
	}

}
