<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class SubscriptionModel extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	public function getName(): string
	{
		return $this->getData("name", "");
	}

	public function getType(): string
	{
		return $this->getData("type", "");
	}

	public function isConnected(): bool
	{
		return (bool)$this->getData("connected");
	}

	public function isActive(): bool
	{
		return (bool)$this->getData("active");
	}

	public function isAvailable(): bool
	{
		return (bool)$this->getData("available");
	}

	public function getInfo(): array|null
	{
		return $this->getData("info");
	}

	public function getServiceId(): string
	{
		return $this->getData("info.serviceid", "");
	}

	public function getServiceAlias(): string
	{
		return $this->getData("info.service_alias", "");
	}

	public function getServiceName(): string
	{
		return $this->getData("info.servicename", "");
	}

	public function getServiceType(): string
	{
		return $this->getData("info.service_type", "");
	}

	public function getTriggerCondition(): string
	{
		return $this->getData("info.trigger_condition", "");
	}

	public function getServiceLikePacket(): string
	{
		return $this->getData("info.service_like_packet", "");
	}

	public function getPeriod(): string
	{
		return $this->getData("info.period", "");
	}

	public function getServiceGroupId(): string
	{
		return $this->getData("info.service_groupid", "");
	}

	public function getPriority(): string
	{
		return $this->getData("info.priority", "");
	}

	public function getDescription(): string
	{
		return $this->getData("info.description", "");
	}

	public function getServicePortal(): string
	{
		return $this->getData("info.service_portal", "");
	}

	public function getUsersStates(): string
	{
		return $this->getData("info.users_states", "");
	}

	public function getSqlCondition(): string
	{
		return $this->getData("info.sql_condition", "");
	}

	public function getTariffService(): string
	{
		return $this->getData("info.tarifservice", "");
	}

	public function getSuspended(): string
	{
		return $this->getData("info.suspended", "");
	}

	public function getServicePrice(): float
	{
		return (float)$this->getData("info.service_price");
	}

	public function isServiceLoyalRecalculation(): bool
	{
		return (bool)$this->getData("info.service_loyal_recalculation");
	}

	public function isActivationByAdmin(): bool
	{
		return (bool)$this->getData("info.activation_by_admin");
	}

	public function isActivationByUser(): bool
	{
		return (bool)$this->getData("info.activation_by_user");
	}

	public function isDeactivationByAdmin(): bool
	{
		return (bool)$this->getData("info.deactivation_by_admin");
	}

	public function isDeactivationByUser(): bool
	{
		return (bool)$this->getData("info.deactivation_by_user");
	}

	public function getDiscountOn(): int
	{
		return (int)$this->getData("info.discount_on");
	}

	public function getCurrency(): string
	{
		return $this->getData("info.currency", "");
	}

	public function getServiceDateStart(): string
	{
		return $this->getData("info.service_date_start", "");
	}

	public function getServiceDateStop(): string
	{
		return $this->getData("info.service_date_stop", "");
	}

	public function startedAt(): DateTime|null
	{
		try {
			return new DateTime($this->getServiceDateStart());
		} catch (Exception) {
			return null;
		}
	}

	public function stoppedAt(): DateTime|null
	{
		try {
			return new DateTime($this->getServiceDateStop());
		} catch (Exception) {
			return null;
		}
	}

	public function getTrial(): ?string
	{
		return $this->getData("info.trial");
	}

	public function getTrialPrice(): ?string
	{
		return $this->getData("info.trial_price");
	}

	public function getTrialPeriodOn(): ?string
	{
		return $this->getData("info.trial_period_on");
	}

	public function getTrialPeriodDays(): ?string
	{
		return $this->getData("info.trial_period_days");
	}

	public function getTrialChangeOn(): ?string
	{
		return $this->getData("info.trial_change_on");
	}

	public function getTrialChangeServiceId(): ?string
	{
		return $this->getData("info.trial_change_serviceid");
	}

}
