<?php /** @noinspection SpellCheckingInspection */

namespace Haikiri\MikBiLL\Cabinet\User;

interface UserModelsInterface {
	public function getAsArray();
	public function getUserId();
	public function getUserId_();
	public function getUserDeletedId();
	public function getUserDogovor();
	public function getUserNotes();
	public function getUserDeposit();
	public function getUserState();
	public function isUserBlocked();
	public function isUserActivated();
	public function getUserLogin();
	public function getUserPassword();
	public function getUserFIO();
	public function getUserFirstName();
	public function getUserLastName();
	public function getUserMiddleName();
	public function getUserBirthday();
	public function getUserBirthdayDo();
	public function getUserSpeedRate();
	public function getUserSpeedBurst();
	public function getUserEmail();
	public function getUserPhone();
	public function getUserPhoneSms();
	public function getUserPhoneMobile();
	public function getUserCurrency();
	public function getUserTariffName();
	public function getUserTariffSpeedIn();
	public function getUserTariffSpeedOut();
	public function getUserTariffFixedCost();
	public function getUserFixedCost2();
	public function getUserCharge();
	public function getUserAddDate();
	public function getUserDelDate();
	public function getUserLastConnectionDate();
	public function getUserInn();
	public function getUserPassportSeries();
	public function getUserPassportRegistration();
	public function getUserPassportVoenkomat();
	public function getUserSwitchPort();
	public function getUserSector();
	public function isUserUseRouter();
	public function getUserRouterModel();
	public function getUserRouterSsid();
	public function getUserRouterLogin();
	public function getUserRouterPassword();
	public function getUserRouterAddDate();
	public function getUserRouterPort();
	public function getUserRouterSerialNumber();
	public function isUserRouterAcquiredFromUs();
	public function getUserTurboTime();
	public function isUserTurboActivated();
	public function isUserTurboDo();
	public function getUserCredit();
	public function getUserCreditCost();
	public function getUserCreditPercent();
	public function getUserCreditUnlimited();
	public function getUserRating();
	public function getUserFramedIp();
	public function getUserFramedMask();
	public function getUserLocalIp();
	public function getUserLocalMac();
	public function getUserPaymentMethods();
	public function getUserAddress();

	#	show:
	public function getUserShow();
	public function getUserShowSpeedIn();
	public function getUserShowSpeedOut();
	public function getUserShowDaysLeft();
	public function getUserShowEndDate();
	public function getUserShowFee();
	public function getUserShowInn();
	public function getUserShowDogovor();
	public function getUserShowUid();
	public function getUserShowPaymentsTile();
	public function getUserShowDiscount();

	#	fee:
	public function getUserFee();

	#	fee: packet
	public function getUserFeePacket();
	public function getUserFeePacketPrice();
	public function getUserFeePacketDiscount();
	public function getUserFeePacketDiscountValue();
	public function getUserFeePacketDiscountSign();
	public function getUserFeePacketPriceWithDiscount();

	#	fee: subscriptions
	public function getUserFeeSubscriptions();
	public function getUserFeeSubscriptionsTotal();
	public function getUserFeeSubscriptionsTotalWithDiscount();
	public function getUserFeeSubscriptionsDiscount();
	public function getUserFeeSubscriptionsDiscountValue();
	public function getUserFeeSubscriptionsDiscountSign();
	public function getUserFeeSubscriptionsDetailed();

	#	fee: devices
	public function getUserFeeDevices();
	public function getUserFeeDevicesTotal();
	public function getUserFeeDevicesTotalWithDiscount();
	public function getUserFeeDevicesDiscount();
	public function getUserFeeDevicesDiscountValue();
	public function getUserFeeDevicesDiscountSign();
	public function getUserFeeDevicesDetailed();

	#	fee: other
	public function getUserFeeRealIp();
	public function getUserFeeInstallments();
	public function getUserFeeTotal();
	public function getUserFeeTotalWithDiscount();

}