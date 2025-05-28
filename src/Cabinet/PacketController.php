<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class PacketController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает массив объектов доступных тарифов.
	 *
	 * @return Packet\Packet[]
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#293d8da0-8967-4367-b74f-92db69e839aa
	 */
	public function getPackets(): array
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/packets",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return array_map(fn(array $item): Packet\Packet => new Packet\Packet($item), $response->getData());
	}

	/**
	 * Метод возвращает информацию о тарифе по его ID.
	 * Нет планов по реализации моделей для данного API метода.
	 * Используйте ->getData() для получения массива данных.
	 *
	 * @param $packetId
	 * @return Packet\PacketInfo
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#11e9027f-c26e-4927-b25f-898d63c2664a
	 */
	public function getPacketInfo($packetId): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/packets/$packetId",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Packet\PacketInfo($response->getData());
	}

}
