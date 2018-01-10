# README #

# installation #
1. There no special technique, just clone this repository into you local server or development machine
2. You may set up a virtual host in the web server to run the application
3. Create a mysql database
4. Import the .sql file (data/product.sql) in your created database.
  - in order to have a working example, i created a sample product table
5. Change your database configurations in config/config.php.
6. Everything is ready to go you can now call a simple api request

# API reference #
# GET request #
	url: /index.php?api_name=product
	description: get all the product lists
	
# GET request #
	url: /index.php?api_name=product&id=2
	description: get the product by its id
	
# POST request #
	url: /index.php?api_name=product
	params in the request body: name, description, price
	description: add a new product
	
# DELETE request #
	url: /index.php?api_name=product&id=2
	description: Delete a product by its id
	
# PUT request #
	url: /index.php?api_name=product&id=2
	params in the request body: name, description, price
	description: update product
	
# TEST  #
	You can test the api request by using a Postman. It is a chrome tool for the REST client.
