<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class NewsController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	public function getNews(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/news",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new News\News($response["data"] ?? []);
	}

}