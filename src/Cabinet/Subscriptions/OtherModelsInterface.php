<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

interface OtherModelsInterface {
	public function getId();
	public function getName();
	public function getType();
	public function isConnected();
	public function isActive();
	public function isAvailable();

	public function getServiceId();
	public function getServiceAlias();
	public function getServiceName();
	public function getServiceType();
	public function getTriggerCondition();
	public function getServiceLikePacket();
	public function getPeriod();
	public function getServiceGroupId();
	public function getPriority();
	public function getDescription();
	public function getServicePortal();
	public function getUsersStates();
	public function getSqlCondition();
	public function getTariffService();
	public function getSuspended();
	public function getServicePrice();
	public function isServiceLoyalRecalculation();
	public function isActivationByAdmin();
	public function isActivationByUser();
	public function isDeactivationByAdmin();
	public function isDeactivationByUser();
	public function getDiscountOn();
	public function getCurrency();
	public function getServiceDateStart();
	public function getServiceDateStop();
	public function getTrial();
	public function getTrialPrice();
	public function getTrialPeriodOn();
	public function getTrialPeriodDays();
	public function getTrialChangeOn();
	public function getTrialChangeServiceId();

}