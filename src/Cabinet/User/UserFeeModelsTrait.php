<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserFeeModelsTrait {

	/**
	 * Метод возвращает данные тарифа.
	 *
	 * @return array|null
	 */
	public function getUserFeePacket(): ?array {
		return (array)$this->getUserFee()["packet"] ?? [];
	}

	/**
	 * Метод возвращает данные подписок.
	 *
	 * @return array|null
	 */
	public function getUserFeeSubscriptions(): ?array {
		return (array)$this->getUserFee()["subscriptions"] ?? [];
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeeDevices(): ?array {
		return (array)$this->getUserFee()["devices"] ?? [];
	}

	/**
	 * Метод возвращает стоимость тарифа.
	 *
	 * @return int
	 */
	public function getUserFeePacketPrice(): int {
		return (int)$this->getUserFeePacket()["price"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeePacketDiscount(): ?array {
		return (array)$this->getUserFeePacket()["discount"] ?? [];
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeePacketDiscountValue(): int {
		return (int)$this->getUserFeePacketDiscount()["value"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserFeePacketDiscountSign(): string {
		return (string)$this->getUserFeePacketDiscount()["sign"] ?? "";
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeePacketPriceWithDiscount(): int {
		return (int)$this->getUserFeePacket()["price_with_discount"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeSubscriptionsTotal(): int {
		return (int)$this->getUserFeeSubscriptions()["total"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeSubscriptionsTotalWithDiscount(): int {
		return (int)$this->getUserFeeSubscriptions()["total_with_discount"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeeSubscriptionsDiscount(): ?array {
		return (array)$this->getUserFeeSubscriptions()["discount"] ?? [];
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeSubscriptionsDiscountValue(): int {
		return (int)$this->getUserFeeSubscriptionsDiscount()["value"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserFeeSubscriptionsDiscountSign(): string {
		return (string)$this->getUserFeeSubscriptionsDiscount()["sign"] ?? "";
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeeSubscriptionsDetailed(): ?array {
		return (array)$this->getUserFeeSubscriptions()["detailed"] ?? [];
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeDevicesTotal(): int {
		return (int)$this->getUserFeeDevices()["total"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeDevicesTotalWithDiscount(): int {
		return (int)$this->getUserFeeDevices()["total_with_discount"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeeDevicesDiscount(): ?array {
		return (array)$this->getUserFeeDevices()["discount"] ?? [];
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeDevicesDiscountValue(): int {
		return (int)$this->getUserFeeDevicesDiscount()["value"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return string
	 */
	public function getUserFeeDevicesDiscountSign(): string {
		return (string)$this->getUserFeeDevicesDiscount()["sign"] ?? "";
	}

	/**
	 * #
	 *
	 * @return array|null
	 */
	public function getUserFeeDevicesDetailed(): ?array {
		return (array)$this->getUserFeeDevices()["detailed"] ?? [];
	}

	/**
	 * #
	 *
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserFeeRealIp(): int {
		return (int)$this->getUserFee()["realip"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeInstallments(): int {
		return (int)$this->getUserFee()["installments"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeTotal(): int {
		return (int)$this->getUserFee()["total"] ?? 0;
	}

	/**
	 * #
	 *
	 * @return int
	 */
	public function getUserFeeTotalWithDiscount(): int {
		return (int)$this->getUserFee()["total_with_discount"] ?? 0;
	}

}