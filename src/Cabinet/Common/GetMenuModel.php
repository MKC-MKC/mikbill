<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetMenuModel extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	public function getName(): string
	{
		return $this->getData("name", "");
	}

	public function getUri(): string
	{
		return $this->getData("link", "");
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
		return $this->getData("icon", "");
	}

	public function getHook(): string
	{
		return $this->getData("hook", "");
	}

	public function getTitle(): string
	{
		return $this->getData("title", "");
	}

	public function getDescription(): string
	{
		return $this->getData("description", "");
	}

	public function getKeywords(): string
	{
		return $this->getData("keywords", "");
	}

}
