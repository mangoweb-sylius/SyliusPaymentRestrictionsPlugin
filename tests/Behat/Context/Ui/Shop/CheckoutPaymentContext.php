<?php

declare(strict_types=1);

namespace Tests\ThreeBRS\SyliusPaymentRestrictionPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Sylius\Behat\Context\Ui\Shop\Checkout\CheckoutPaymentContext as BaseCheckoutPaymentContext;
use Webmozart\Assert\Assert;

final class CheckoutPaymentContext implements Context
{
    /** @var BaseCheckoutPaymentContext */
    private $checkoutPaymentContext;

    public function __construct(
        BaseCheckoutPaymentContext $checkoutPaymentContext
    ) {
        $this->checkoutPaymentContext = $checkoutPaymentContext;
    }

    /**
     * @Given /^I can not see ("([^"]+)" payment method) in the list of payment methods$/
     */
    public function shippingMethodAllowsPayingWith(string $name)
    {
        Assert::throws(function () use ($name) {
            $this->checkoutPaymentContext->iSelectPaymentMethod($name);
        }, \Behat\Mink\Exception\ElementNotFoundException::class);
    }
}
