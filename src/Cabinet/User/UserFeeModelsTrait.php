<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserFeeModelsTrait
{

	public function getUserFeePacket(): array|null
	{
		return $this->getData("fee.packet");
	}

	public function getUserFeeSubscriptions(): array|null
	{
		return $this->getData("fee.subscriptions");
	}

	public function getUserFeeDevices(): array|null
	{
		return $this->getData("fee.devices");
	}

	public function getUserFeePacketPrice(): float|int|string|null
	{
		return $this->getData("fee.packet.price");
	}

	public function getUserFeePacketDiscount(): array|null
	{
		return $this->getData("fee.packet.discount");
	}

	public function getUserFeePacketPriceWithDiscount(): float|int|string|null
	{
		return $this->getData("fee.packet.price_with_discount");
	}

	public function getUserFeePacketDiscountValue(): int|string|null
	{
		return $this->getData("fee.packet.discount.value");
	}

	public function getUserFeePacketDiscountSign(): string|null
	{
		return $this->getData("fee.packet.discount.sign");
	}

	public function getUserFeeSubscriptionsTotal(): float|int|string|null
	{
		return $this->getData("fee.subscriptions.total");
	}

	public function getUserFeeSubscriptionsTotalWithDiscount(): float|int|string|null
	{
		return $this->getData("fee.subscriptions.total_with_discount");
	}

	public function getUserFeeSubscriptionsDiscount(): array|null
	{
		return $this->getData("fee.subscriptions.discount");
	}

	public function getUserFeeSubscriptionsDetailed(): array|null
	{
		return $this->getData("fee.subscriptions.detailed");
	}

	public function getUserFeeSubscriptionsDiscountValue(): int|string|null
	{
		return $this->getData("fee.subscriptions.discount.value");
	}

	public function getUserFeeSubscriptionsDiscountSign(): string|null
	{
		return $this->getData("fee.subscriptions.discount.sign");
	}

	public function getUserFeeDevicesTotal(): float|int|string|null
	{
		return $this->getData("fee.devices.total");
	}

	public function getUserFeeDevicesTotalWithDiscount(): float|int|string|null
	{
		return $this->getData("fee.devices.total_with_discount");
	}

	public function getUserFeeDevicesDetailed(): array|null
	{
		return $this->getData("fee.devices.detailed");
	}

	public function getUserFeeDevicesDiscount(): array|null
	{
		return $this->getData("fee.devices.discount");
	}

	public function getUserFeeDevicesDiscountValue(): int|string|null
	{
		return $this->getData("fee.devices.discount.value");
	}

	public function getUserFeeDevicesDiscountSign(): string|null
	{
		return $this->getData("fee.devices.discount.sign");
	}

	public function getUserFeeRealIp(): int|string|null
	{
		return $this->getData("fee.realip");
	}

	public function getUserFeeInstallments(): int|string|null
	{
		return $this->getData("fee.installments");
	}

	public function getUserFeeTotal(): float|int|string|null
	{
		return $this->getData("fee.total");
	}

	public function getUserFeeTotalWithDiscount(): float|int|string|null
	{
		return $this->getData("fee.total_with_discount");
	}

}
