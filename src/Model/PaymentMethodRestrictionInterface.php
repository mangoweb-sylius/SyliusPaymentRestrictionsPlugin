<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Addressing\Model\ZoneInterface;

interface PaymentMethodRestrictionInterface
{
	public function getZone(): ?ZoneInterface;

	public function getShippingMethods(): Collection;

	public function setShippingMethods(Collection $shippingMethods): void;
}
