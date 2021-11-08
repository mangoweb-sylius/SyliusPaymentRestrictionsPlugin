<?php

declare(strict_types=1);

namespace Tests\ThreeBRS\SyliusPaymentRestrictionPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\Repository\PaymentMethodRepositoryInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use ThreeBRS\SyliusPaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface;

final class PaymentMethodContext implements Context
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var PaymentMethodRepositoryInterface */
    private $paymentMethodRepository;

    /** @var ShippingMethodRepositoryInterface */
    private $shippingMethodRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ShippingMethodRepositoryInterface $shippingMethodRepository
    ) {
        $this->entityManager = $entityManager;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }

    /**
     * @Given /^(this payment method) has (zone "([^"]+)")$/
     */
    public function thisPaymentMethodHasZone(PaymentMethodInterface $paymentMethod, ZoneInterface $zone)
    {
        assert($paymentMethod instanceof PaymentMethodRestrictionInterface);
        $paymentMethod->setZone($zone);
        $this->entityManager->flush();
    }

    /**
     * @Given /^(this payment method) is valid for (shipping method "([^"]+)")$/
     */
    public function thispaymentMethodIsValidForShippingMethod(PaymentMethodInterface $paymentMethod, ShippingMethodInterface $shippingMethod)
    {
        assert($paymentMethod instanceof PaymentMethodRestrictionInterface);
        $paymentMethod->getShippingMethods()->add($shippingMethod);
        $this->entityManager->flush();
    }

    /**
     * @Given all payment methods are valid for all shipping methods
     */
    public function allpaymentMethodsAreValidForAllShippingMethods()
    {
        /** @var PaymentMethodRestrictionInterface[] $paymentMethods */
        $paymentMethods = $this->paymentMethodRepository->findAll();
        /** @var ShippingMethodInterface $shippingMethods */
        $shippingMethods = $this->shippingMethodRepository->findAll();

        foreach ($paymentMethods as $paymentMethod) {
            foreach ($shippingMethods as $shippingMethod) {
                $paymentMethod->getShippingMethods()->add($shippingMethod);
            }
        }

        $this->entityManager->flush();
    }

    /**
     * @Given /^("([^"]+)" shipping method) allows paying with ("([^"]+)" payment method)$/
     */
    public function shippingMethodAllowsPayingWith(ShippingMethodInterface $shippingMethod, PaymentMethodInterface $paymentMethod)
    {
        throw new \Exception();
    }
}
