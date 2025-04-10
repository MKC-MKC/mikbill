<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

use Haikiri\MikBiLL\Cabinet as MikBiLLCabinet;

class Cabinet implements CabinetInterface {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	public function Auth(): MikBiLLCabinet\AuthController {
		return new MikBiLLCabinet\AuthController(interface: $this->billInterface);
	}

	public function Tickets(): MikBiLLCabinet\TicketsController {
		return new MikBiLLCabinet\TicketsController(interface: $this->billInterface);
	}

	public function Common(): MikBiLLCabinet\CommonController {
		return new MikBiLLCabinet\CommonController(interface: $this->billInterface);
	}

	public function Packet(): MikBiLLCabinet\PacketController {
		return new MikBiLLCabinet\PacketController(interface: $this->billInterface);
	}

	public function User(): MikBiLLCabinet\UserController {
		return new MikBiLLCabinet\UserController(interface: $this->billInterface);
	}

	public function RegisterHotPost(): MikBiLLCabinet\RegisterHotPostController {
		return new MikBiLLCabinet\RegisterHotPostController(interface: $this->billInterface);
	}

	public function Payments(): MikBiLLCabinet\PaymentsController {
		return new MikBiLLCabinet\PaymentsController(interface: $this->billInterface);
	}

	public function Services(): MikBiLLCabinet\ServicesController {
		return new MikBiLLCabinet\ServicesController(interface: $this->billInterface);
	}

	public function Subscriptions(): MikBiLLCabinet\SubscriptionsController {
		return new MikBiLLCabinet\SubscriptionsController(interface: $this->billInterface);
	}

	public function Reports(): MikBiLLCabinet\ReportsController {
		return new MikBiLLCabinet\ReportsController(interface: $this->billInterface);
	}

	public function News(): MikBiLLCabinet\NewsController {
		return new MikBiLLCabinet\NewsController(interface: $this->billInterface);
	}

	public function OmniCell(): MikBiLLCabinet\OmniCellController {
		return new MikBiLLCabinet\OmniCellController(interface: $this->billInterface);
	}

}