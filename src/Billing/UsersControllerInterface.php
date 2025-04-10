<?php

namespace Haikiri\MikBiLL\Billing;

interface UsersControllerInterface {

	public function getUserToken(string $uid);

	public function searchUser(string $key, string $value, string $operator);

	public function kickUser(string $uid);

	/** @deprecated */
	public function bindUser($uid, $user_id);

}