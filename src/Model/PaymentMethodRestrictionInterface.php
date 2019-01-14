<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Model;

use Sylius\Component\Addressing\Model\ZoneInterface;

interface PaymentMethodRestrictionInterface
{
	public function getZone(): ?ZoneInterface;
}
