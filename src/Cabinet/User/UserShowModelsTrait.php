<?php

namespace Haikiri\MikBiLL\Cabinet\User;

trait UserShowModelsTrait {

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowSpeedIn(): bool {
		return (bool)$this->getUserShow()["speed_in"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowSpeedOut(): bool {
		return (bool)$this->getUserShow()["speed_out"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserShowDaysLeft(): bool {
		return (bool)$this->getUserShow()["index_daysleft"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserShowEndDate(): bool {
		return (bool)$this->getUserShow()["index_enddate"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowFee(): bool {
		return (bool)$this->getUserShow()["fee"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowInn(): bool {
		return (bool)$this->getUserShow()["inn"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 * @noinspection SpellCheckingInspection
	 */
	public function getUserShowDogovor(): bool {
		return (bool)$this->getUserShow()["numdogovor"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowUid(): bool {
		return (bool)$this->getUserShow()["uid"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowPaymentsTile(): bool {
		return (bool)$this->getUserShow()["payments_tile"] ?? false;
	}

	/**
	 * #
	 *
	 * @return bool
	 */
	public function getUserShowDiscount(): bool {
		return (bool)$this->getUserShow()["discount"] ?? false;
	}

}