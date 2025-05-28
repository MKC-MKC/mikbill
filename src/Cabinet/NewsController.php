<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class NewsController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает список новостей.
	 *
	 * @return News\News[]
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#d0716ec8-0af2-46ae-97d4-56a47ea888aa
	 */
	public function getNews(): array
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/news",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return array_map(fn(array $item): News\News => new News\News($item), $response->getData());
	}

}
