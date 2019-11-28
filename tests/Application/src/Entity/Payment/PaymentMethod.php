<?php

declare(strict_types=1);

namespace Tests\MangoSylius\PaymentRestrictionPlugin\Application\src\Entity\Payment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\Table;
use MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface;
use MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionTrait;
use Sylius\Component\Core\Model\PaymentMethod as BasePaymentMethod;

/**
 * @MappedSuperclass
 * @Table(name="sylius_payment_method")
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
