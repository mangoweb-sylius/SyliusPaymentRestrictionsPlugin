@set_shipping_method_restrictions_to_payment_method
Feature: Set shipping method restrictions to payment method
	In order to add a shipping methods to payment method settings in admin panel
	As an Administrator
	I want to set shipping methods on the payment method edit page

	Background:
		Given the store operates on a channel named "manGoweb Channel"
		And the store has zones "NorthAmerica", "SouthAmerica" and "Europe"
		And the store has a payment method "Offline" with a code "offline"
		And the store has "Free" shipping method with "$0.00" fee
		And this payment method has zone "Europe"
		And I am logged in as an administrator

	@ui
	Scenario: Set zone to payment method
		Given I want to modify the "Offline" payment method
		When I select shipping method "Free"
		And I save my changes
		Then I should be notified that it has been successfully edited
		And this payment method has shipping method "Free"
