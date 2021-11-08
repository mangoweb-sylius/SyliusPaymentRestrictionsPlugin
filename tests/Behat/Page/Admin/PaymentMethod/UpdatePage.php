<?php

declare(strict_types=1);

namespace Tests\ThreeBRS\SyliusPaymentRestrictionPlugin\Behat\Page\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\Channel\UpdatePage as BaseUpdatePage;

final class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    public function changeZone(string $zoneCode): void
    {
        $this->getElement('zone')->setValue($zoneCode);
    }

    public function isSingleResourceOnPage(string $elementName)
    {
        return $this->getElement($elementName)->getValue();
    }

    public function activateForShippinMethod(int $id): void
    {
        $Page = $this->getSession()->getPage();
        $Page->find('css', '#sylius_payment_method_shippingMethods_' . $id)->setValue(true);
    }

    public function isActivateForShippinMethod(int $id): bool
    {
        $Page = $this->getSession()->getPage();

        return (bool) $Page->find('css', '#sylius_payment_method_shippingMethods_' . $id)->getValue();
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'zone' => '#sylius_payment_method_zone',
        ]);
    }
}
