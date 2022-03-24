Gage Morin and Shane Calla
Group 1

Date: 3/22/2022

Purpose: The purpose of this project was to create a bookstore database that at least accomplished the 8 given queries.


Below are instructions on how to go about using the 8 given queries as well as additional things we added. There is also some databsase entries where you can see that the queries work.

In order to install the database run the command "mysql -u root bookstore < DB2.sql"
In order to start the program launch the login.html file. There is no admin password to the database. 

Given Queries:

1. A new customer registers, upgrades from non-member to member.

	To do this select new customer on the main login page, once you create the account you sign in under the customer login with the username and password you chose. 
	You then have the option to upgrade to a member when you login.
	
	If you want to sign into an already created customer account use the username: cust1 and the password: CLogin123 	

2. A publisher adds a new book with author information to the database, updates price of a book.

	Once you login as publisher on the main page you will have the ability to add new books, the authors in the database are listed on the bottom of that page. 
	They can also change the price of books they published, books they can change are also listed at the bottom of that page.

	If you want to sign into an already created publisher account use the username: awlogin and the password: Test123

3. The admin (super user) updates the cost of shipping methods for books.

	Once signed in as an admin you can change the cost of shipping a book and emailing a book.

	If you want to sign into an already created admin account use the username: admin1 and the password: AdLogin123

4. A customer searches for a particular book by title and/or author and purchases the book.

	Customers and Guests can search up a book by the title or author, add it to their cart, and then purchase it.

5. A guest searches for the best-selling book of a given year, if no year is given, return the best-selling book for the entire history.

	On the same page of the last query you have the option to search a book by best seller, if a year is given it will search within that year, if not it will search the entire database. 

6. A customer checks their order history and reorder a book.

	A customer can sign into their account and view their orders, once they view their order they can reorder it which will automatically bring them to an order page with the contents of the old order.

	You can sign in with the account listed in query 1 and view their already created orders.

7. An author purchases their own books.

	If an author wants to purchase a book they would create a customer account or sign in as guest and search by author name to order their book. 

8. A customer gives rating and comment to a book they have purchased, checks rating and comments of a book.

	To comment on a book they ordered a customer should sign into their account and view their orders, from their they can review the book.

	You can sign in with the account listed in query 1 and view their already created orders to review 1 of those books. To view an already created review look at thw book "The Two Towers".
	
Additional Queries:

1. Books have an additional series option, when you search up a book you can search up by series, that will show all the books in the series such as Lord of the Rings.

2. When signed into a customer account you can search for recomendations. It will show all of the books with the genre of ones you have purchased in the past. If you search by recomendation when you are not signed into an account it will show all of the books.