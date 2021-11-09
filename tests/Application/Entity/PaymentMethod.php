<?php

declare(strict_types=1);

namespace Tests\ThreeBRS\SyliusPaymentRestrictionPlugin\Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\PaymentMethod as BasePaymentMethod;
use ThreeBRS\SyliusPaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface;
use ThreeBRS\SyliusPaymentRestrictionPlugin\Model\PaymentMethodRestrictionTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_payment_method")
 */
class PaymentMethod extends BasePaymentMethod implements PaymentMethodRestrictionInterface
{
    use PaymentMethodRestrictionTrait;

    public function __construct()
    {
        parent::__construct();

        $this->shippingMethods = new ArrayCollection();
    }
}
