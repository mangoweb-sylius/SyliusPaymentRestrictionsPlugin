<?php

declare(strict_types=1);

namespace Tests\MangoSylius\PaymentRestrictionPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Tests\MangoSylius\PaymentRestrictionPlugin\Behat\Page\Admin\PaymentMethod\UpdatePageInterface;
use Webmozart\Assert\Assert;

final class ManagingPaymentMethodContext implements Context
{
	/**
	 * @var UpdatePageInterface
	 */
	private $updatePage;
	/**
	 * @var SharedStorageInterface
	 */
	private $sharedStorage;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(
		UpdatePageInterface $updatePage,
		SharedStorageInterface $sharedStorage,
		EntityManagerInterface $entityManager
	) {
		$this->updatePage = $updatePage;
		$this->sharedStorage = $sharedStorage;
		$this->entityManager = $entityManager;
	}

	/**
	 * @When /^I select (shipping method "([^"]+)")$/
	 */
	public function iSelectShippingMethod(ShippingMethodInterface $shippingMethod)
	{
		$this->updatePage->activateForShippinMethod($shippingMethod->getId());
	}

	/**
	 * @When /^(this payment method) has (shipping method "([^"]+)")$/
	 */
	public function thisPaymentMethodHasShippingMethod(PaymentMethodInterface $paymentMethod, ShippingMethodInterface $shippingMethod)
	{
		Assert::true($this->updatePage->isActivateForShippinMethod($shippingMethod->getId()));
	}

	/**
	 * @When /^I change (this payment method) zone to (zone "([^"]+)")$/
	 */
	public function thisPaymentMethodHasZone(PaymentMethodInterface $paymentMethod, ZoneInterface $zone)
	{
		$this->updatePage->changeZone($zone->getCode());
	}

	/**
	 * @When /^(this payment method) zone should be (zone "([^"]+)")$/
	 */
	public function thisPaymentMethodZoneShouldBe(PaymentMethodInterface $paymentMethod, ZoneInterface $zone)
	{
		Assert::eq($this->updatePage->isSingleResourceOnPage('zone'), $zone->getCode());
	}
}
