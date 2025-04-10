<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class PacketController implements PacketControllerInterface {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

}