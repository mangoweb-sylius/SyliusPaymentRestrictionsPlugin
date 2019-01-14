<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Model;

use Sylius\Component\Addressing\Matcher\ZoneMatcherInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;

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

		$zones = $this->zoneMatcher->matchAll($shippingAddress);
		foreach ($zones as $zone) {
			assert($zone instanceof ZoneInterface);
			if ($paymentMethod->getZone() === $zone) {
				return true;
			}
		}

		return false;
	}
}
