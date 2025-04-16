<?php

namespace Haikiri\MikBiLL;

interface CabinetInterface
{

	public function Auth();

	public function Tickets();

	public function Common();

	public function Packet();

	public function User();

	public function RegisterHotPost();

	public function Payments();

	public function Services();

	public function Subscriptions();

	public function Devices();

	public function Reports();

	public function News();

}