<?php

declare(strict_types=1);

namespace ThreeBRS\SyliusPaymentRestrictionPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;

trait PaymentMethodRestrictionTrait
{
    /**
     * @var ZoneInterface|null
     * @ORM\ManyToOne(targetEntity="Sylius\Component\Addressing\Model\ZoneInterface")
     */
    private $zone;

    /**
     * @var Collection<array-key, ShippingMethodInterface>|ShippingMethodInterface[]
     * @ORM\ManyToMany(targetEntity="Sylius\Component\Core\Model\ShippingMethod", inversedBy="paymentMethods")
     * @ORM\JoinTable(name="threebrs_payment_method_shipping_method",
     *     joinColumns={@ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="method_shipping_id", referencedColumnName="id")}
     * )
     */
    private $shippingMethods;

    public function getZone(): ?ZoneInterface
    {
        return $this->zone;
    }

    public function setZone(?ZoneInterface $zone): void
    {
        $this->zone = $zone;
    }

    /**
     * @return Collection<array-key, ShippingMethodInterface>
     */
    public function getShippingMethods(): Collection
    {
        return $this->shippingMethods;
    }

    /**
     * @param Collection<array-key, ShippingMethodInterface> $shippingMethods
     */
    public function setShippingMethods(Collection $shippingMethods): void
    {
        $this->shippingMethods = $shippingMethods;
    }
}
