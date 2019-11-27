<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Model;

use Sylius\Component\Addressing\Matcher\ZoneMatcherInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Shipping\Model\Shipment;
use Sylius\Component\Shipping\Model\ShippingMethodInterface;

class MangoSyliusResolvePaymentMethodForOrder
{
	/** @var ZoneMatcherInterface */
	private $zoneMatcher;

	public function __construct(
		ZoneMatcherInterface $zoneMatcher
	) {
		$this->zoneMatcher = $zoneMatcher;
	}

	public function isEligible(PaymentMethodRestrictionInterface $paymentMethod, OrderInterface $order): bool
	{
		$shippingAddress = $order->getShippingAddress();
		assert($shippingAddress instanceof AddressInterface);

		if (!$this->isAllowedForShippingMethod($paymentMethod, $order)) {
			return false;
		}

		$zones = $this->zoneMatcher->matchAll($shippingAddress);
		foreach ($zones as $zone) {
			assert($zone instanceof ZoneInterface);
			if ($paymentMethod->getZone() === $zone) {
				return true;
			}
		}

		return false;
	}

	public function isAllowedForShippingMethod(PaymentMethodRestrictionInterface $paymentMethod, OrderInterface $order): bool
	{
		$shipment = $order->getShipments()->last();
		if (!($shipment instanceof Shipment)) {
			return true;
		}

		$shippingMethod = $shipment->getMethod();
		assert($shippingMethod instanceof ShippingMethodInterface);
		assert($paymentMethod instanceof PaymentMethodRestrictionInterface);

		return $paymentMethod->getShippingMethods()->contains($shippingMethod);
	}
}
