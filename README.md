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
    <a href="https://travis-ci.org/mangoweb-sylius/SyliusPaymentRestrictionsPlugin" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/mangoweb-sylius/SyliusPaymentRestrictionsPlugin/master.svg" />
    </a>
</h1>

## Features

 - Restrict payment method by zone.

<p align="center">
	<img src="https://raw.githubusercontent.com/mangoweb-sylius/SyliusPaymentRestrictionsPlugin/master/doc/admin.png"/>
</p>

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-payment-restrictions-plugin`.
1. Add plugin class to your `config/bundles.php`:
 
   ```php
   return [
      ...
      MangoSylius\PaymentRestrictionPlugin\MangoSyliusPaymentRestrictionPlugin::class => ['all' => true],
   ];
   ```
   
1. Your Entity `PaymentMethod` has to implement `\MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface`. You can use Trait `MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionTrait`.
 
   ```php
   <?php 
   
   declare(strict_types=1);
   
   namespace App\Entity\Payment;
   
   use Doctrine\Common\Collections\ArrayCollection;
   use Doctrine\ORM\Mapping as ORM;
   use Sylius\Component\Core\Model\Payment as BasePayment;
   use MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionInterface;
   use MangoSylius\PaymentRestrictionPlugin\Model\PaymentMethodRestrictionTrait;
   
   /**
    * @ORM\Entity
    * @ORM\Table(name="sylius_payment")
    */
   class PaymentMethod extends BasePayment implements PaymentMethodRestrictionInterface
   {
       use PaymentMethodRestrictionTrait;
   
       public function __construct()
       {
           parent::__construct();
       
           $this->shippingMethods = new ArrayCollection();
       }
   }
   ```

1. Change `@SyliusAdmin/PaymentMethod/_form.html.twig`.
 
```twig
...
<div class="ui segment">
	<h4 class="ui dividing header">{{ 'sylius.ui.details'|trans }}</h4>
	{{ form_errors(form) }}

	<div class="three fields">
		{{ form_row(form.code) }}
		{{ form_row(form.zone) }}
		{{ form_row(form.position) }}
	</div>
	{{ form_row(form.enabled) }}
	<div class="two fields">
		{{ form_row(form.channels) }}
		{{ form_row(form.shippingMethods) }}
	</div>
</div>
...
```

For guide to use your own entity see [Sylius docs - Customizing Models](https://docs.sylius.com/en/1.3/customization/model.html)

## Development

### Usage

- Develop your plugin in `/src`
- See `bin/` for useful commands

### Testing


After your changes you must ensure that the tests are still passing.

```bash
$ composer install
$ bin/console doctrine:schema:create -e test
$ bin/behat
$ bin/phpstan.sh
$ bin/ecs.sh
```

License
-------
This library is under the MIT license.

Credits
-------
Developed by [manGoweb](https://www.mangoweb.eu/).
