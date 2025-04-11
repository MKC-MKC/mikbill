<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class ServicesController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

}