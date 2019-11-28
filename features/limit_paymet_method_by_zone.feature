@limit_paymet_method_by_zone
Feature: Limit paymet method by zone
	In order to select payment method by zone by delivery address
	As a Customer
	I want to select payment method by zone by delivery address

	Background:
		Given the store operates on a single channel
		And the store operates in "United States"
		And the store operates in "Germany"
		And the store has a zone "USA" with code "USA"
		And this zone has the "United States" country member
		And the store also has a zone "EU" with code "EU"
		And this zone has the "Germany" country member
		And the store has a product "PHP T-Shirt" priced at "$19.99"
		And the store has "DHL" shipping method with "$1.99" fee within the "USA" zone
		And the store has "PPL" shipping method with "$0.99" fee within the "EU" zone
		And the store allows paying with "CSOB"
		And this payment method has zone "USA"
		And all payment methods are valid for all shipping methods
		And I am a logged in customer

	@ui
	Scenario: See a payment method in zone
		Given I have product "PHP T-Shirt" in the cart
		And I specified the shipping address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
		And I select "DHL" shipping method
		And I complete the shipping step
		And I select "CSOB" payment method

	@ui
	Scenario: Not see a payment method in zone
		Given I have product "PHP T-Shirt" in the cart
		And I specified the shipping address as "Ankh Morpork", "Frost Alley", "90210", "Germany" for "Jon Snow"
		And I select "PPL" shipping method
		And I complete the shipping step
		And I can not see "CSOB" payment method
