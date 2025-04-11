<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class OmniCellController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

}