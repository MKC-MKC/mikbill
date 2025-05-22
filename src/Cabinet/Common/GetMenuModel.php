<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetMenuModel extends ResponseWrapper
{

	public function getId(): int
	{
		return $this->getData("id", 0);
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
		return $this->getData("usersgroupid", 0);
	}

	public function getParent(): int
	{
		return $this->getData("parent", 0);
	}

	public function getSort(): int
	{
		return $this->getData("sort", 0);
	}

	public function getHide(): int
	{
		return $this->getData("hide", 0);
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
