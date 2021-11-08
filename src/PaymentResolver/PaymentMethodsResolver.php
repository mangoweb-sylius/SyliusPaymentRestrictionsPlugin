<?php

declare(strict_types=1);

namespace ThreeBRS\SyliusPaymentRestrictionPlugin\PaymentResolver;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Repository\PaymentMethodRepositoryInterface;
use Sylius\Component\Payment\Model\PaymentInterface as BasePaymentInterface;
use Sylius\Component\Payment\Resolver\PaymentMethodsResolverInterface;
use ThreeBRS\SyliusPaymentRestrictionPlugin\Model\ThreeBRSSyliusResolvePaymentMethodForOrder;
use Webmozart\Assert\Assert;

class PaymentMethodsResolver implements PaymentMethodsResolverInterface
{
    /** @var PaymentMethodRepositoryInterface */
    private $paymentMethodRepository;

    /** @var ThreeBRSSyliusResolvePaymentMethodForOrder */
    private $paymentOrderResolver;

    public function __construct(
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ThreeBRSSyliusResolvePaymentMethodForOrder $paymentOrderResolver
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentOrderResolver = $paymentOrderResolver;
    }

    /**
     * @inheritdoc
     */
    public function getSupportedMethods(BasePaymentInterface $payment): array
    {
        \assert($payment instanceof PaymentInterface);
        Assert::true($this->supports($payment), 'This payment method is not support by resolver');

        $order = $payment->getOrder();
        \assert($order instanceof OrderInterface);

        $channel = $order->getChannel();
        \assert($channel instanceof ChannelInterface);

        $enabledForChannel = $this->paymentMethodRepository->findEnabledForChannel($channel);
        $result = [];
        foreach ($enabledForChannel as $paymentMethod) {
            if ($this->paymentOrderResolver->isEligible($paymentMethod, $order)) {
                $result[] = $paymentMethod;
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function supports(BasePaymentInterface $payment): bool
    {
        if (
            !$payment instanceof PaymentInterface ||
            $payment->getOrder() === null
        ) {
            return false;
        }

        $order = $payment->getOrder();

        return
            $order instanceof OrderInterface &&
            $order->getChannel() !== null;
    }
}
