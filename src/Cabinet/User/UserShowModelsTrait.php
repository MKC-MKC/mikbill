<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserShowModelsTrait
{

	public function isUserAllowedToShowSpeedIn(): bool|null
	{
		return $this->getData("show.speed_in");
	}

	public function isUserAllowedToShowSpeedOut(): bool|null
	{
		return $this->getData("show.speed_out");
	}

	public function isUserAllowedToShowDaysLeft(): bool|null
	{
		return $this->getData("show.index_daysleft");
	}

	public function isUserAllowedToShowEndDate(): bool|null
	{
		return $this->getData("show.index_enddate");
	}

	public function isUserAllowedToShowFee(): bool|null
	{
		return $this->getData("show.fee");
	}

	public function isUserAllowedToShowInn(): bool|null
	{
		return $this->getData("show.inn");
	}

	public function isUserAllowedToShowDogovor(): bool|null
	{
		return $this->getData("show.numdogovor");
	}

	public function isUserAllowedToShowUid(): bool|null
	{
		return $this->getData("show.uid");
	}

	public function isUserAllowedToShowPaymentsTile(): bool|null
	{
		return $this->getData("show.payments_tile");
	}

	public function isUserAllowedToShowDiscount(): bool|null
	{
		return $this->getData("show.discount");
	}

}
