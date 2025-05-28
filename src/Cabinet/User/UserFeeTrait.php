<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserFeeTrait
{

	public function getUserFeePacket(): array
	{
		return (array)$this->getData("fee.packet");
	}

	public function getUserFeeSubscriptions(): array
	{
		return (array)$this->getData("fee.subscriptions");
	}

	public function getUserFeeDevices(): array
	{
		return (array)$this->getData("fee.devices");
	}

	public function getUserFeePacketPrice(): int
	{
		return (int)$this->getData("fee.packet.price");
	}

	public function getUserFeePacketDiscount(): array
	{
		return (array)$this->getData("fee.packet.discount");
	}

	public function getUserFeePacketPriceWithDiscount(): int
	{
		return (int)$this->getData("fee.packet.price_with_discount");
	}

	public function getUserFeePacketDiscountValue(): int
	{
		return (int)$this->getData("fee.packet.discount.value");
	}

	public function getUserFeePacketDiscountSign(): string
	{
		return (string)$this->getData("fee.packet.discount.sign");
	}

	public function getUserFeeSubscriptionsTotal(): int
	{
		return (int)$this->getData("fee.subscriptions.total");
	}

	public function getUserFeeSubscriptionsTotalWithDiscount(): int
	{
		return (int)$this->getData("fee.subscriptions.total_with_discount");
	}

	public function getUserFeeSubscriptionsDiscount(): array
	{
		return (array)$this->getData("fee.subscriptions.discount");
	}

	public function getUserFeeSubscriptionsDetailed(): array
	{
		return (array)$this->getData("fee.subscriptions.detailed");
	}

	public function getUserFeeSubscriptionsDiscountValue(): int
	{
		return (int)$this->getData("fee.subscriptions.discount.value");
	}

	public function getUserFeeSubscriptionsDiscountSign(): string
	{
		return (string)$this->getData("fee.subscriptions.discount.sign");
	}

	public function getUserFeeDevicesTotal(): int
	{
		return (int)$this->getData("fee.devices.total");
	}

	public function getUserFeeDevicesTotalWithDiscount(): int
	{
		return (int)$this->getData("fee.devices.total_with_discount");
	}

	public function getUserFeeDevicesDetailed(): array
	{
		return (array)$this->getData("fee.devices.detailed");
	}

	public function getUserFeeDevicesDiscount(): array
	{
		return (array)$this->getData("fee.devices.discount");
	}

	public function getUserFeeDevicesDiscountValue(): int
	{
		return (int)$this->getData("fee.devices.discount.value");
	}

	public function getUserFeeDevicesDiscountSign(): string
	{
		return (string)$this->getData("fee.devices.discount.sign");
	}

	public function getUserFeeRealIp(): int
	{
		return (int)$this->getData("fee.realip");
	}

	public function getUserFeeInstallments(): int
	{
		return (int)$this->getData("fee.installments");
	}

	public function getUserFeeTotal(): int
	{
		return (int)$this->getData("fee.total");
	}

	public function getUserFeeTotalWithDiscount(): int
	{
		return (int)$this->getData("fee.total_with_discount");
	}

}
