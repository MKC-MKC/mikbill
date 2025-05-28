<?php

namespace Haikiri\MikBiLL\Cabinet\News;

use Haikiri\MikBiLL\ResponseWrapper;

class NewsModel extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("newsid");
	}

	public function getSubject(): string
	{
		return (string)$this->getData("subject");
	}

	public function getText(): string
	{
		return (string)$this->getData("text");
	}

}
