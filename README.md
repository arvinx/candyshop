candyshop
=========

PHP + CodeIgniter


Todo features:
- Add candy to shopping cart.
- Edit shopping cart content's (change item quantity, delete items)
- Checkout flow. This function should collect payment information (credit card number and expiry date) and display a printable receipt
	- display the total for the order and show form for CC info
	- on succesful form validation on the checkout screen when user hits submit, there
	  should be a call to the controller so that it can insert the Order and OrderItems into our 		database.(Also send an email of the receipt)
- Email receipt to customer. 
- Admin panel (code inside controller that can be reused)

Todo minor:
- front end design on forms
- test forms on invalid inputs.
