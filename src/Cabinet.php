<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

use Haikiri\MikBiLL\Cabinet as MikBiLLCabinet;

class Cabinet implements CabinetInterface
{

	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	public function Auth(): object
	{
		return new MikBiLLCabinet\AuthController(interface: $this->billInterface);
	}

	public function Tickets(): object
	{
		return new MikBiLLCabinet\TicketsController(interface: $this->billInterface);
	}

	public function Common(): object
	{
		return new MikBiLLCabinet\CommonController(interface: $this->billInterface);
	}

	public function Packet(): object
	{
		return new MikBiLLCabinet\PacketController(interface: $this->billInterface);
	}

	public function User(): object
	{
		return new MikBiLLCabinet\UserController(interface: $this->billInterface);
	}

	public function RegisterHotPost(): object
	{
		return new MikBiLLCabinet\RegisterHotPostController(interface: $this->billInterface);
	}

	public function Payments(): object
	{
		return new MikBiLLCabinet\PaymentsController(interface: $this->billInterface);
	}

	public function Services(): object
	{
		return new MikBiLLCabinet\ServicesController(interface: $this->billInterface);
	}

	public function Subscriptions(): object
	{
		return new MikBiLLCabinet\SubscriptionsController(interface: $this->billInterface);
	}

	public function Devices(): object
	{
		return new MikBiLLCabinet\DevicesController(interface: $this->billInterface);
	}

	public function Reports(): object
	{
		return new MikBiLLCabinet\ReportsController(interface: $this->billInterface);
	}

	public function News(): object
	{
		return new MikBiLLCabinet\NewsController(interface: $this->billInterface);
	}

}
