<?php

namespace Haikiri\MikBiLL\Cabinet\Services;

interface ServicesInterface
{

	public function isAvailable(): bool;

	public function isActive(): bool;

	public function getInfo(): array;

	public function getActivationCost(): float;

	public function getCurrency(): string;

}
