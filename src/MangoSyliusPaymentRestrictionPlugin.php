<?php

declare(strict_types=1);

namespace MangoSylius\PaymentRestrictionPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MangoSyliusPaymentRestrictionPlugin extends Bundle
{
	use SyliusPluginTrait;
}
