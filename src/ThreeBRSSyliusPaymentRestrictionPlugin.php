<?php

declare(strict_types=1);

namespace ThreeBRS\SyliusPaymentRestrictionPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ThreeBRSSyliusPaymentRestrictionPlugin extends Bundle
{
    use SyliusPluginTrait;
}
