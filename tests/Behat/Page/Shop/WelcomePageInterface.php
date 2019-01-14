<?php

declare(strict_types=1);

namespace Tests\MangoSylius\PaymentRestrictionPlugin\Behat\Page\Shop;

use Sylius\Behat\Page\PageInterface;

interface WelcomePageInterface extends PageInterface
{
	public function getGreeting(): string;
}
