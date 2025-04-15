<?php

namespace Haikiri\MikBiLL\Cabinet\User;

class UserModels {
	use UserFeeModelsTrait;
	use UserShowModelsTrait;
	private		?array				$data;

	public function __construct(?array $data) {
		$this->data = $data;
	}

	/**
	 * Метод возвращает результат как массив.
	 * С этим методом вы можете сами управлять возвращаемыми данными, или построить свою модель.
	 *
	 * @return array|null
	 */
	public function getData(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int {
		return (int)$this->getData()["uid"] ?? 0;
	}

	/**
	 * Метод возвращает UID клиента?
	 *
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserId_(): int {
		return (int)$this->getData()["useruid"] ?? 0;
	}

	/**
	 * Метод возвращает ID удалённого клиента.
	 *
	 * @return int|null
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserDeletedId(): ?int {
		return (int)$this->getData()["delid"] ?? null;
	}

	/**
	 * Метод возвращает Логин от личного кабинета клиента.
	 *
	 * @return string
	 */
	public function getUserLogin(): string {
		return (string)$this->getData()["user"] ?? "";
	}

	/**
	 * Метод возвращает Пароль от личного кабинета клиента.
	 *
	 * @return string
	 */
	public function getUserPassword(): string {
		return (string)$this->getData()["password"] ?? "";
	}

	/**
	 * Метод возвращает клиентский номер договора.
	 *
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserDogovor(): int {
		return (int)$this->getData()["numdogovor"] ?? 0;
	}

	/**
	 * Метод возвращает заметки/примечания к клиенту.
	 *
	 * @return string
	 */
	public function getUserNotes(): string {
		return (string)$this->getData()["prim"] ?? "";
	}

	/**
	 * Метод возвращает Баланс клиента.
	 *
	 * @return string # float -> string
	 */
	public function getUserDeposit(): string {
		return (string)$this->getData()["deposit"] ?? "";
	}

	/**
	 * Метод возвращает состояние клиента.
	 *
	 * @return int
	 */
	public function getUserState(): int {
		return (int)$this->getData()["state"] ?? 0;
	}

	/**
	 * Метод возвращает true если клиент заблокирован.
	 *
	 * @return bool
	 */
	public function isUserBlocked(): bool {
		return (bool)$this->getData()["blocked"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function isUserActivated(): bool {
		return (bool)$this->getData()["activated"] ?? false;
	}

	/**
	 * Метод возвращает Ф. И. О. Клиента.
	 *
	 * @return string
	 */
	public function getUserFIO(): string {
		return (string)$this->getData()["fio"];
	}

	/**
	 * Метод возвращает имя клиента.
	 *
	 * @return string
	 */
	public function getUserFirstName(): string {
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[1] ?? "";
	}

	/**
	 * Метод возвращает фамилию клиента.
	 *
	 * @return string
	 */
	public function getUserLastName(): string {
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[0] ?? "";
	}

	/**
	 * Метод возвращает отчество клиента.
	 *
	 * @return string
	 */
	public function getUserMiddleName(): string {
		$fioParts = explode(" ", $this->getUserFIO());
		return $fioParts[2] ?? "";
	}

	/**
	 * Метод возвращает дату рождения клиента.
	 *
	 * @return string
	 */
	public function getUserBirthday(): string {
		return (string)$this->getData()["date_birth"] ?? "";
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserBirthdayDo(): bool {
		return (bool)$this->getData()["date_birth_do"] ?? false;
	}

	/**
	 * Метод возвращает скорость клиента.
	 *
	 * @return string
	 */
	public function getUserSpeedRate(): string {
		return (string)$this->getData()["speed_rate"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserSpeedBurst(): string {
		return (string)$this->getData()["speed_burst"] ?? "";
	}

	/**
	 * Метод возвращает e-mail клиента.
	 *
	 * @return string
	 */
	public function getUserEmail(): string {
		return (string)$this->getData()["email"] ?? "";
	}

	/**
	 * Метод возвращает телефон клиента.
	 *
	 * @return string
	 */
	public function getUserPhone(): string {
		return (string)$this->getData()["phone"] ?? "";
	}

	/**
	 * Метод возвращает телефон клиента для смс.
	 *
	 * @return string
	 */
	public function getUserPhoneSms(): string {
		return (string)$this->getData()["sms_tel"] ?? "";
	}

	/**
	 * Метод возвращает мобильный телефон клиента.
	 *
	 * @return string
	 */
	public function getUserPhoneMobile(): string {
		return (string)$this->getData()["mob_tel"] ?? "";
	}

	/**
	 * Метод возвращает условную единицу расчёта с клиентом (Валюта).
	 *
	 * @return string
	 */
	public function getUserCurrency(): string {
		return (string)$this->getData()["UE"] ?? "";
	}

	/**
	 * Метод возвращает название тарифа клиента.
	 *
	 * @return string
	 */
	public function getUserTariffName(): string {
		return (string)$this->getData()["packet_name"] ?? "";
	}

	/**
	 * Метод возвращает входящую скорость клиента.
	 *
	 * @return string
	 */
	public function getUserTariffSpeedIn(): string {
		return (string)$this->getData()["speed_in"] ?? "";
	}

	/**
	 * Метод возвращает исходящую скорость клиента.
	 *
	 * @return string
	 */
	public function getUserTariffSpeedOut(): string {
		return (string)$this->getData()["speed_out"] ?? "";
	}

	/**
	 * Метод возвращает фиксированную стоимость тарифа.
	 *
	 * @return float
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserTariffFixedCost(): float {
		return (float)$this->getData()["tarif_fixed_cost"] ?? 0.0;
	}

	/**
	 * #
	 *
	 * @return float
	 */
	public function getUserFixedCost2(): float {
		return (float)$this->getData()["fixed_cost2"] ?? 0.0;
	}

	/**
	 * #
	 *
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserCharge(): int {
		return (int)$this->getData()["abonplata"] ?? 0;
	}

	/**
	 * Метод возвращает дату регистрации клиента.
	 *
	 * @return string
	 */
	public function getUserAddDate(): string {
		return (string)$this->getData()["add_date"] ?? "";
	}

	/**
	 * Метод возвращает дату удаления клиента.
	 *
	 * @return string
	 */
	public function getUserDelDate(): string {
		return (string)$this->getData()["del_date"] ?? "";
	}

	/**
	 * Метод возвращает дату последнего подключения к сети.
	 *
	 * @return string
	 */
	public function getUserLastConnectionDate(): string {
		return (string)$this->getData()["last_connection"] ?? "";
	}

	/**
	 * Метод возвращает ИНН клиента.
	 *
	 * @return string
	 */
	public function getUserInn(): string {
		return (string)$this->getData()["inn"] ?? "";
	}

	/**
	 * Метод возвращает серию паспорта клиента.
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserPassportSeries(): string {
		return (string)$this->getData()["passportserie"] ?? "";
	}

	/**
	 * Метод возвращает адрес регистрации (прописку) по паспорту.
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserPassportRegistration(): string {
		return (string)$this->getData()["passportpropiska"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserPassportVoenkomat(): string {
		return (string)$this->getData()["passportvoenkomat"] ?? "";
	}

	/**
	 * Метод возвращает порт свитча.
	 *
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserSwitchPort(): int {
		return (int)$this->getData()["switchport"] ?? 0;
	}

	/**
	 * Метод возвращает сектор.
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserSector(): string {
		return (string)$this->getData()["sectorid"] ?? "";
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function isUserUseRouter(): bool {
		return (bool)$this->getData()["use_router"] ?? false;
	}

	/**
	 * Метод возвращает модель/производителя роутера.
	 *
	 * @return string
	 */
	public function getUserRouterModel(): string {
		return (string)$this->getData()["router_model"] ?? "";
	}

	/**
	 * Метод возвращает SSID названия сети клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterSsid(): string {
		return (string)$this->getData()["router_ssid"] ?? "";
	}

	/**
	 * Метод возвращает логин к роутеру клиента.
	 *
	 * @return string
	 */
	public function getUserRouterLogin(): string {
		return (string)$this->getData()["router_login"] ?? "";
	}

	/**
	 * Метод возвращает пароль к роутеру клиента.
	 *
	 * @return string
	 */
	public function getUserRouterPassword(): string {
		return (string)$this->getData()["router_pass"] ?? "";
	}

	/**
	 * Метод возвращает дату добавления роутера.
	 *
	 * @return string
	 */
	public function getUserRouterAddDate(): string {
		return (string)$this->getData()["router_add_date"] ?? "";
	}

	/**
	 * Метод возвращает порт клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterPort(): string {
		return (string)$this->getData()["router_port"] ?? "";
	}

	/**
	 * Метод возвращает серийный номер клиентского роутера.
	 *
	 * @return string
	 */
	public function getUserRouterSerialNumber(): string {
		return (string)$this->getData()["router_serial"] ?? "";
	}

	/**
	 * Возвращает true если роутер куплен у нас.
	 *
	 * @return bool
	 * @noinspection SpellCheckingInspection
	 */
	public function isUserRouterAcquiredFromUs(): bool {
		return (bool)$this->getData()["router_we_saled"] ?? false;
	}

	/**
	 * Метод возвращает время на которое активируется турбо.
	 *
	 * @return string
	 */
	public function getUserTurboTime(): string {
		return (string)$this->getData()["turbo_time"] ?? "";
	}

	/**
	 * Возвращает true если у клиента активен турбо.
	 *
	 * @return bool
	 */
	public function isUserTurboActivated(): bool {
		return (bool)$this->getData()["turbo_active"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function isUserTurboDo(): bool {
		return (bool)$this->getData()["do_turbo"] ?? false;
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserCredit(): string {
		return (string)$this->getData()["credit"] ?? "";
	}

	/**
	 * Метод возвращает стоимость активации кредита.
	 *
	 * @return float
	 */
	public function getUserCreditCost(): float {
		return (float)$this->getData()["credit_active_cena"] ?? 0.0;
	}

	/**
	 * Метод возвращает процентную ставку по кредиту.
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserCreditPercent(): string {
		return (string)$this->getData()["credit_procent"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserCreditUnlimited(): string {
		return (string)$this->getData()["credit_unlimited"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserRating(): string {
		return (string)$this->getData()["rating"] ?? "";
	}

	/**
	 * Метод возвращает назначенный адрес.
	 *
	 * @return string
	 */
	public function getUserFramedIp(): string {
		return (string)$this->getData()["framed_ip"] ?? "";
	}

	/**
	 * Метод возвращает назначенную маску адреса.
	 *
	 * @return string
	 */
	public function getUserFramedMask(): string {
		return (string)$this->getData()["framed_mask"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserLocalIp(): string {
		return (string)$this->getData()["local_ip"] ?? "";
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserLocalMac(): string {
		return (string)$this->getData()["local_mac"] ?? "";
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserPaymentMethods(): ?array {
		return (array)$this->getData()["payment_methods"] ?? [];
	}

	/**
	 * Метод возвращает адрес клиента.
	 *
	 * @return string
	 */
	public function getUserAddress(): string {
		return (string)$this->getData()["address"] ?? "";
	}

	/**
	 * Метод перечисляет права клиента, что он может видеть, а что нет?
	 *
	 * @return array|null
	 */
	public function getUserShow(): ?array {
		return $this->getData()["show"] ?? null;
	}

	/**
	 * Метод возвращает модель связанную с финансовой частью клиента.
	 *
	 * @return array|null
	 */
	public function getUserFee(): ?array {
		return $this->getData()["fee"] ?? null;
	}

}