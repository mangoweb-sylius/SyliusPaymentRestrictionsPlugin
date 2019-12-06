<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\ZoneChoiceType;
use Sylius\Bundle\PaymentBundle\Form\Type\PaymentMethodType;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method iterable getExtendedTypes()
 */
final class RestrictionPaymentMethodExtension extends AbstractTypeExtension
{
	/**
	 * @var string
	 */
	private $shippingMethodClass;

	public function __construct(
		string $shippingMethodClass
	) {
		$this->shippingMethodClass = $shippingMethodClass;
	}

	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('zone', ZoneChoiceType::class, [
				'label' => 'sylius.form.address.zone',
				'constraints' => [
					new NotBlank(['groups' => ['sylius']]),
				],
			])
			->add('shippingMethods', EntityType::class, [
				'label' => 'mangoweb.admin.paymentMethod.form.shippingMethods',
				'class' => $this->shippingMethodClass,
				'expanded' => true,
				'multiple' => true,
				'required' => true,
				'choice_label' => function (ShippingMethodInterface $shippingMethod = null) {
					return $shippingMethod ? $shippingMethod->getName() . ' (' . $shippingMethod->getCode() . ')' : '';
				},
			]);
	}

	public function getExtendedType(): string
	{
		return PaymentMethodType::class;
	}
}
