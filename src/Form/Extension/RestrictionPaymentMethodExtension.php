<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\ZoneChoiceType;
use Sylius\Bundle\PaymentBundle\Form\Type\PaymentMethodType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class RestrictionPaymentMethodExtension extends AbstractTypeExtension
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('zone', ZoneChoiceType::class, [
				'label' => 'sylius.form.address.zone',
				'constraints' => [
					new NotBlank(['groups' => ['sylius']]),
				],
			]);
	}

	public function getExtendedType(): string
	{
		return PaymentMethodType::class;
	}
}
