@set_zone_restrictions_to_payment_method
Feature: Set zone restrictions to payment method
	In order to add a zone to payment method settings in admin panel
	As an Administrator
	I want to set the zone on the payment method edit page

	Background:
		Given the store operates on a channel named "manGoweb Channel"
		And the store has zones "NorthAmerica", "SouthAmerica" and "Europe"
		And the store has a payment method "Offline" with a code "offline"
		And this payment method has zone "Europe"
		And I am logged in as an administrator

	@ui
	Scenario: Set zone to payment method
		Given I want to modify the "Offline" payment method
		When I change this payment method zone to zone "NorthAmerica"
		And I save my changes
		Then I should be notified that it has been successfully edited
		And this payment method zone should be zone "NorthAmerica"


