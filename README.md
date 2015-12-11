# README #

# installation #
1. git clone https://acaballes@bitbucket.org/acaballes/my-api.git
2. You may set up a virtual host in the server or just the default is still okay
3. create a database
4. import the .sql file (data/product.sql) in your created database.
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