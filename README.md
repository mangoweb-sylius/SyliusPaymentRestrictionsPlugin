<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">
    Payment Restrictions Plugin
    <br />
    <a href="https://packagist.org/packages/mangoweb-sylius/sylius-payment-restrictions-plugin" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/mangoweb-sylius/sylius-payment-restrictions-plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/mangoweb-sylius/sylius-payment-restrictions-plugin" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/mangoweb-sylius/sylius-payment-restrictions-plugin.svg" />
    </a>
    <a href="http://travis-ci.org/mangoweb-sylius/PaymentRestrictionPlugin" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/mangoweb-sylius/PaymentRestrictionPlugin/master.svg" />
    </a>
</h1>

## Features

 - Restrict payment method by zone.

<p align="center">
	<img src="https://raw.githubusercontent.com/mangoweb-sylius/SyliusPaymentRestrictionsPlugin/master/doc/admin.png"/>
</p>

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-payment-restrictions-plugin`.
2. Register `\MangoSylius\PaymentRestrictionPlugin\MangoSyliusPaymentRestrictionPlugin` in your Kernel.
3. Your Entity `PaymentMethod` has to implement `\MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface`. You can use Trait `MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionTrait`.
4. Add `{{ form_row(form.zone) }}` to `@SyliusAdmin/PaymentMethod/_form.html.twig`.

For guide to use your own entity see [Sylius docs - Customizing Models](https://docs.sylius.com/en/1.3/customization/model.html)

## Development

### Usage

- Create symlink from .env.dist to .env or create your own .env file
- Develop your plugin in `/src`
- See `bin/` for useful commands

### Testing

After your changes you must ensure that the tests are still passing.
* Easy Coding Standard
  ```bash
  bin/ecs.sh
  ```
* PHPStan
  ```bash
  bin/phpstan.sh
  ```
License
-------
This library is under the MIT license.

Credits
-------
Developed by [manGoweb](https://www.mangoweb.eu/).
