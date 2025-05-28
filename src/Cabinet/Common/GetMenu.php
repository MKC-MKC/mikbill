<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetMenu extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	public function getName(): string
	{
		return (string)$this->getData("name");
	}

	public function getUri(): string
	{
		return (string)$this->getData("link");
	}

	public function getUserGroupId(): int
	{
		return (int)$this->getData("usersgroupid");
	}

	public function getParent(): int
	{
		return (int)$this->getData("parent");
	}

	public function getSort(): int
	{
		return (int)$this->getData("sort");
	}

	public function getHide(): int
	{
		return (int)$this->getData("hide");
	}

	public function getIcon(): string
	{
		return (string)$this->getData("icon");
	}

	public function getHook(): string
	{
		return (string)$this->getData("hook");
	}

	public function getTitle(): string
	{
		return (string)$this->getData("title");
	}

	public function getDescription(): string
	{
		return (string)$this->getData("description");
	}

	public function getKeywords(): string
	{
		return (string)$this->getData("keywords");
	}

}
