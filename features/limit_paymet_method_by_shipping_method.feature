@limit_paymet_method_by_shipping_method
Feature: Limit paymet method by shipping method
	In order to select payment method by shipping method
	As a Customer
	I want to select payment method by shipping method

	Background:
		Given the store operates on a channel named "manGoweb Channel"
		And the store operates in "Czechia"
		And the store also has a zone "EU" with code "EU"
		And this zone has the "Czechia" country member
		And the store has a product "PHP T-Shirt" priced at "$19.99"
		And the store has "DHL" shipping method with "$1.99" fee within the "EU" zone
		And the store has "PPL" shipping method with "$0.99" fee within the "EU" zone
		And the store allows paying with "CSOB"
		And this payment method has zone "EU"
		And this payment method is valid for shipping method "DHL"
		And I am a logged in customer

	@ui
	Scenario: See a payment method with shipping method
		Given I have product "PHP T-Shirt" in the cart
		And I specified the shipping address as "Ankh Morpork", "Frost Alley", "90210", "Czechia" for "Jon Snow"
		And I select "DHL" shipping method
		And I complete the shipping step
		And I select "CSOB" payment method

	@ui
	Scenario: Not see a payment method with shipping method
		Given I have product "PHP T-Shirt" in the cart
		And I specified the shipping address as "Ankh Morpork", "Frost Alley", "90210", "Czechia" for "Jon Snow"
		And I select "PPL" shipping method
		And I complete the shipping step
		And I can not see "CSOB" payment method


