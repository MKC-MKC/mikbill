<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserShowTrait
{

	public function isUserAllowedToShowSpeedIn(): bool
	{
		return (bool)$this->getData("show.speed_in");
	}

	public function isUserAllowedToShowSpeedOut(): bool
	{
		return (bool)$this->getData("show.speed_out");
	}

	public function isUserAllowedToShowDaysLeft(): bool
	{
		return (bool)$this->getData("show.index_daysleft");
	}

	public function isUserAllowedToShowEndDate(): bool
	{
		return (bool)$this->getData("show.index_enddate");
	}

	public function isUserAllowedToShowFee(): bool
	{
		return (bool)$this->getData("show.fee");
	}

	public function isUserAllowedToShowInn(): bool
	{
		return (bool)$this->getData("show.inn");
	}

	public function isUserAllowedToShowDogovor(): bool
	{
		return (bool)$this->getData("show.numdogovor");
	}

	public function isUserAllowedToShowUid(): bool
	{
		return (bool)$this->getData("show.uid");
	}

	public function isUserAllowedToShowPaymentsTile(): bool
	{
		return (bool)$this->getData("show.payments_tile");
	}

	public function isUserAllowedToShowDiscount(): bool
	{
		return (bool)$this->getData("show.discount");
	}

}
