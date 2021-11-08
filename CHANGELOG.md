# CHANGELOG

## v2.0.0 (2021-11-09)

#### Details

- Support for Sylius 1.8|1.9|1.10, Symfony ^4.4|^5.2, PHP ^7.3|^8.0
- Change namespace from `MangoSylius\PaymentRestrictionPlugin` to `ThreeBRS\SyliusPaymentRestrictionPlugin`
- Change table name from `mango_payment_method_shipping_method` to `threebrs_payment_method_shipping_method`
- *BC break: Version 3.0.0 is NOT compatible with previous versions due to namespace change*

## v1.0.0 (2020-06-17)

#### Details

- Update to Sylius ^1.7
- Update to php ^7.3
- Zone is not required

## v0.3.3 (2020-01-23)

#### Details

- Change zone mapping in PaymentMethodRestrictionTrait. 

## v0.3.2 (2020-01-21)

#### Details

- Compare zones by codes. 

## v0.3.1 (2019-12-10)

#### Details

- Now works even with overridden shipment entity.

## v0.3.0 (2019-11-28)

#### Details

- Restrict payment methods by shipping methods
- Behat tests

## v0.2.0 (2019-03-11)

#### Details

- Restrict payment methods by zone
