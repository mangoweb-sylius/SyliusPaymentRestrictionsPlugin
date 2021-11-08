<?php

declare(strict_types=1);

namespace ThreeBRS\SyliusPaymentRestrictionPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\ZoneChoiceType;
use Sylius\Bundle\PaymentBundle\Form\Type\PaymentMethodType;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class RestrictionPaymentMethodExtension extends AbstractTypeExtension
{
    /** @var string */
    private $shippingMethodClass;

    public function __construct(
        string $shippingMethodClass
    ) {
        $this->shippingMethodClass = $shippingMethodClass;
    }

    /** @param array<mixed> $options */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zone', ZoneChoiceType::class, [
                'label' => 'sylius.form.address.zone',
                'placeholder' => 'sylius.form.zone.scopes.all',
            ])
            ->add('shippingMethods', EntityType::class, [
                'label' => 'threebrs.admin.paymentMethod.form.shippingMethods',
                'class' => $this->shippingMethodClass,
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'choice_label' => function (ShippingMethodInterface $shippingMethod = null) {
                    return $shippingMethod ? $shippingMethod->getName() . ' (' . $shippingMethod->getCode() . ')' : '';
                },
            ]);
    }

    /** @return array<string> */
    public static function getExtendedTypes(): array
    {
        return [
            PaymentMethodType::class,
        ];
    }
}
