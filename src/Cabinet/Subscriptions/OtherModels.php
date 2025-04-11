<?php /** @noinspection SpellCheckingInspection */

declare(strict_types=0); # TODO: Отключаем строгую типизацию. Временная опция.

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

/**
 * Этот класс нуждается в доработке.
 * Не стесняйтесь сообщать о проблемах и недочетах.
 * Актуальные данные в composer.json
 */
class OtherModels {
	private		array|null				$data;

	public function __construct(?array $data = []) {
		$this->data = $data;
	}

	public function getData(): ?array { return $this->data ?? []; }
	public function getId(): int { return (int)$this->getData()["id"] ?? 0; }
	public function getName(): string { return (string)$this->getData()["name"] ?? ""; }
	public function getType(): string { return (string)$this->getData()["type"] ?? ""; }
	public function isConnected(): bool { return (bool)($this->getData()["connected"] ?? 0) == 1; }
	public function isActive(): bool { return (bool)($this->getData()["active"] ?? 0) == 1; }
	public function isAvailable(): bool { return (bool)($this->getData()["available"] ?? 0) == 1; }

	public function getInfo(): ?array { return (array)$this->getData()["info"] ?? []; }
	public function getServiceId(): string { return (string)$this->getInfo()["serviceid"] ?? ""; }
	public function getServiceAlias(): string { return (string)$this->getInfo()["service_alias"] ?? ""; }
	public function getServiceName(): string { return (string)$this->getInfo()["servicename"] ?? ""; }
	public function getServiceType(): string { return (string)$this->getInfo()["service_type"] ?? ""; }
	public function getTriggerCondition(): string { return (string)$this->getInfo()["trigger_condition"] ?? ""; }
	public function getServiceLikePacket(): string { return (string)$this->getInfo()["service_like_packet"] ?? ""; }
	public function getPeriod(): string { return (string)$this->getInfo()["period"] ?? ""; }
	public function getServiceGroupId(): string { return (string)$this->getInfo()["service_groupid"] ?? ""; }
	public function getPriority(): string { return (string)$this->getInfo()["priority"] ?? ""; }
	public function getDescription(): string { return (string)$this->getInfo()["description"] ?? ""; }
	public function getServicePortal(): string { return (string)$this->getInfo()["service_portal"] ?? ""; }
	public function getUsersStates(): string { return (string)$this->getInfo()["users_states"] ?? ""; }
	public function getSqlCondition(): string { return (string)$this->getInfo()["sql_condition"] ?? ""; }
	public function getTariffService(): string { return (string)$this->getInfo()["tarifservice"] ?? ""; }
	public function getSuspended(): string { return (string)$this->getInfo()["suspended"] ?? ""; }
	public function getServicePrice(): float { return (float)$this->getInfo()["service_price"] ?? 0.0; }
	public function isServiceLoyalRecalculation(): bool { return (bool)$this->getInfo()["service_loyal_recalculation"] ?? 0; }
	public function isActivationByAdmin(): bool { return (bool)$this->getInfo()["activation_by_admin"] ?? 0; }
	public function isActivationByUser(): bool { return (bool)$this->getInfo()["activation_by_user"] ?? 0; }
	public function isDeactivationByAdmin(): bool { return (bool)$this->getInfo()["deactivation_by_admin"] ?? 0; }
	public function isDeactivationByUser(): bool { return (bool)$this->getInfo()["deactivation_by_user"] ?? 0; }
	public function getDiscountOn(): int { return (int)$this->getInfo()["discount_on"] ?? 0; }
	public function getCurrency(): string { return (string)$this->getInfo()["currency"] ?? ""; }
	public function getServiceDateStart(): string { return (string)$this->getInfo()["service_date_start"] ?? ""; }
	public function getServiceDateStop(): string { return (string)$this->getInfo()["service_date_stop"] ?? ""; }
	public function getTrial(): string { return (string)$this->getInfo()["trial"] ?? ""; }
	public function getTrialPrice(): string { return (string)$this->getInfo()["trial_price"] ?? ""; }
	public function getTrialPeriodOn(): string { return (string)$this->getInfo()["trial_period_on"] ?? ""; }
	public function getTrialPeriodDays(): string { return (string)$this->getInfo()["trial_period_days"] ?? ""; }
	public function getTrialChangeOn(): string { return (string)$this->getInfo()["trial_change_on"] ?? ""; }
	public function getTrialChangeServiceId(): string { return (string)$this->getInfo()["trial_change_serviceid"] ?? ""; }

}