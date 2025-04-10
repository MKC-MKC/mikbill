<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Phone;

interface PhoneOtpModelsInterface {
	public function getAsArray();
	public function getUserId();
	public function getUserToken();

}