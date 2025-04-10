<?php

namespace Haikiri\MikBiLL\Cabinet;

interface AuthControllerInterface {

	public function login($login, $pass);
	public function phone($phone);
	public function phoneOtp($otp);

}