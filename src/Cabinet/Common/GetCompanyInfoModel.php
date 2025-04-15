<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetCompanyInfoModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Возвращаем данные как массив.
	 *
	 * @return array|null
	 */
	public function getData(): ?array
	{
		return $this->data ?? [];
	}

	/**
	 * Метод возвращает адрес команпании.
	 *
	 * @return string
	 * @noinspection SpellCheckingInspection
	 */
	public function getAddress(): string
	{
		return (string)$this->getData()["company_adress"] ?? "";
	}

	public function getEmail(): string
	{
		return (string)$this->getData()["company_email"] ?? "";
	}

	public function getName(): string
	{
		return (string)$this->getData()["company_name"] ?? "";
	}

	public function getSite(): string
	{
		return (string)$this->getData()["company_site"] ?? "";
	}

	public function getPhoneNumber1(): string
	{
		return (string)$this->getData()["phone_mobile_1"] ?? "";
	}

	public function getPhoneNumber2(): string
	{
		return (string)$this->getData()["phone_mobile_2"] ?? "";
	}

	public function getPhoneNumber3(): string
	{
		return (string)$this->getData()["phone_mobile_3"] ?? "";
	}

	public function getPhoneName1(): string
	{
		return (string)$this->getData()["name_mobile_1"] ?? "";
	}

	public function getPhoneName2(): string
	{
		return (string)$this->getData()["name_mobile_2"] ?? "";
	}

	public function getPhoneName3(): string
	{
		return (string)$this->getData()["name_mobile_3"] ?? "";
	}

	public function isShowMap(): bool
	{
		return (bool)$this->getData()["show_map"] ?? false;
	}

}
