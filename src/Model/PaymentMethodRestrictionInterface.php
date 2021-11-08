<?php

declare(strict_types=1);

namespace ThreeBRS\SyliusPaymentRestrictionPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

interface PaymentMethodRestrictionInterface
{
    public function setZone(?ZoneInterface $zone): void;

    public function getZone(): ?ZoneInterface;

    /**
     * @return Collection<array-key, ShippingMethodInterface>
     */
    public function getShippingMethods(): Collection;

    /**
     * @param Collection<array-key, ShippingMethodInterface> $shippingMethods
     */
    public function setShippingMethods(Collection $shippingMethods): void;
}
