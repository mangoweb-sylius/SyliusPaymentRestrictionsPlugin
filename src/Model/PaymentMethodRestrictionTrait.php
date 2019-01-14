<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin\Model;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Addressing\Model\ZoneInterface;

trait PaymentMethodRestrictionTrait
{
	/**
	 * @var ZoneInterface|null
	 * @ORM\ManyToOne(targetEntity="Sylius\Component\Addressing\Model\Zone")
	 */
	private $zone;

	public function getZone(): ?ZoneInterface
	{
		return $this->zone;
	}

	public function setZone(?ZoneInterface $zone): void
	{
		$this->zone = $zone;
	}
}
