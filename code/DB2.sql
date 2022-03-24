-- usage: mysql -u root bookstore < DB2.sql

SET FOREIGN_KEY_CHECKS=0;

drop table if exists book;
drop table if exists publisher;
drop table if exists admin;
drop table if exists customer;
drop table if exists account;
drop table if exists author;
drop table if exists reviews;
drop table if exists paymentinfo;
drop table if exists orders;
drop table if exists cart;
drop table if exists user;
drop table if exists shipping_cost;


create table user (
	id int(20) NOT NULL AUTO_INCREMENT,
	primary key (id)
)AUTO_INCREMENT=1;

insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();
insert into user values ();

--reserved for bookstore 
insert into user values (0);


create table publisher (
	login char(20),
	password char(20),
	publisher_id int,
	name char(255),
	constraint foreign key (publisher_id) references user(id),
	primary key (login)
);

insert into publisher values ("awlogin", "Test123", 1, "Allen & Unwin");
insert into publisher values ("pub2", "Test123", 2, "Cool Writing");
insert into publisher values ("pub3", "Test123", 3, "Car Magazine");
--reserved for bookstore
insert into publisher values ("BookStore", "Test123", 0, "Book Store");

create table admin (
	login char(20),
	password char(20),
	admin_id int,
	name char(255),
	constraint foreign key (admin_id) references user(id),
	primary key (login)
);

insert into admin values("admin1", "AdLogin123", 4, "Shane");
insert into admin values("admin2", "AdLogin123", 5, "Gage");


create table customer (
	customer_id int(20),
	constraint foreign key (customer_id) references user(id)
);

insert into customer values (6);
insert into customer values (7);
insert into customer values (8);
insert into customer values (9);
insert into customer values (10);

create table account (
	login char(20),
	password char(20),
	customer_id int,
	name char(255),
	address char(255),
	email char(255),
	memberstatus bool DEFAULT 0,
	constraint foreign key (customer_id) references customer(customer_id),
	primary key (login)
);

insert into account values ("cust1", "CLogin123", 6, "Sam Low", "121 Earth St.", "sam@gmail.com", '');
insert into account values ("cust2", "CLogin123", 7, "Tom Gibbs", "100 Pluto Rd.", "tom@gmail.com", '');
insert into account values ("cust3", "CLogin123", 8, "Liam Krike", "75 Venus St.", "liam@gmail.com", '');

create table author (
	author_id int,
	author_name char(255),
	constraint foreign key (author_id) references user(id)
);
insert into author values (11, "J. R. R. Tolkien");
insert into author values (12, "Ton Wiley");
--reserved for bookstore
insert into author values (0, "Book Store");

create table book (
	isbn char(255),
	publisher_id int,
	author_id int,
	type char(255),
	title char(255),
	price double,
	genre char(255),
	series char(255) default "NA",
	constraint foreign key (publisher_id) references publisher(publisher_id),
	constraint foreign key (author_id) references author(author_id),
	primary key (isbn)
);

insert into book values ("978-1-14-123456-1", 2, 12, "hardcover", "The Bible: Part 3", 15.99, "Religous", "Cristianity");
insert into book values ("978-1-14-177776-1", 2, 12, "audio", "Budism is cool", 20.99, "Religous", "Budism");
insert into book values ("978-1-09-654321-1", 2, 12, "ebook", "The walking man", 5.99, "Horror", '');
insert into book values ("978-7-15-583928-4", 3, 12, "paperback", "Honeymoon mistake", 10.99, "Comedy", '');
insert into book values ("978-9-01-126556-1", 3, 12, "paperback", "Ant Boy and Spider Girl", 10.99, "Kids", "Ant Boy Adventures");
insert into book values ("970-1-64-876540-1", 1, 11, "paperback", "The Fellowship of the Ring", 8.99, "Fantasy", "Lord of the Rings");
insert into book values ("970-1-64-013950-1", 1, 11, "paperback", "The Two Towers", 6.99, "Fantasy", "Lord of the Rings");
insert into book values ("958-8-31-013345-7", 1, 11, "paperback", "The Return of the King", 10.99, "Fantasy", "Lord of the Rings");
-- reserved for membership 
insert into book values ("Buy Now!", 0, 0, "NA", "BookStore MemberShip", 19.99, "MemberShip", '');

create table reviews (
	review_id int(20) NOT NULL AUTO_INCREMENT,
	isbn char(255),
	customer_id int,
	comment char(255),
	rating int(1),
	constraint foreign key (isbn) references book(isbn),
	constraint foreign key (customer_id) references customer(customer_id),
	primary key (review_id)
)AUTO_INCREMENT=1;
insert into reviews values ('',"978-7-15-583928-4", 7, "My wife and I had a similar experince LOL", 5);
insert into reviews values ('',"978-1-14-123456-1", 6, "My love for the world grew 2x after reading this", 4);
insert into reviews values ('',"970-1-64-013950-1", 7, "I tired to get into this bit it's just not for me", 1);
insert into reviews values ('',"970-1-64-013950-1", 6, "I love these books so much, I have all of them", 5);

create table paymentinfo (
	payment_id int(20) NOT NULL AUTO_INCREMENT,
	customer_id int,
	card_number int,
	experation_date char(5),
	cvv int(3),
	customer_name char(20),
	constraint foreign key (customer_id) references customer(customer_id),
	primary key (payment_id)
)AUTO_INCREMENT=1;

insert into paymentinfo values ('',6, 6543666678911234, "02/24", 123, "Sam Low");
insert into paymentinfo values ('',7, 8348932345670101, "12/22", 456, "Marry Cost");
insert into paymentinfo values ('',9, 0193018591771213, "05/24", 112, "Larry David");
insert into paymentinfo values ('',8, 1029384756102938, "07/23", 676, "Liam Krike");
insert into paymentinfo values ('',6, 6543666678911234, "02/24", 123, "Sam Low");

create table orders (
	order_id int(20) NOT NULL AUTO_INCREMENT,
	customer_id int,
	payment_id int,
	total double,
	name char(20),
	address char(255),
	date date,
	email char(255),
	constraint foreign key (customer_id) references customer(customer_id),
	constraint foreign key (payment_id) references paymentinfo(payment_id),
	primary key (order_id)
)AUTO_INCREMENT=1;

insert into orders values ('', 6, 1, 20.98, "Sam Low", "121 Earth St.", '2021-4-1',"sam@gmail.com");
insert into orders values ('', 7, 2, 11.99, "Tom Gibbs", "100 Pluto Rd.", '2021-6-11',"tom@gmail.com");
insert into orders values ('', 9, 3, 34.98, "Greg Bowtin", "9 Earth St.", '2022-1-1',"greg@gmail.com");
insert into orders values ('', 8, 4, 10.98, "Liam Krike", "75 Venus St.", '2020-6-6',"liam@gmail.com");
insert into orders values ('', 6, 5, 34.98, "Sam Low", "121 Earth St.", '2021-4-1',"sam@gmail.com");


create table cart (
	cart_id int(20) NOT NULL AUTO_INCREMENT,
	order_id int,
	isbn char(17),
	quantity int(2),
	constraint foreign key (order_id) references orders(order_id),
	constraint foreign key (isbn) references book(isbn),
	primary key (cart_id)	
)AUTO_INCREMENT=1;

insert into cart values ('',1,"970-1-64-876540-1", 1);
insert into cart values ('',1,"978-1-14-123456-1", 1);
insert into cart values ('',2,"978-1-14-123456-1", 1);
insert into cart values ('',3,"978-1-14-123456-1", 2);
insert into cart values ('',2,"970-1-64-013950-1", 1);
insert into cart values ('',4,"978-1-14-123456-1", 1);
insert into cart values ('',5,"970-1-64-876540-1", 1);
insert into cart values ('',5,"970-1-64-013950-1", 1);
insert into cart values ('',5,"958-8-31-013345-7", 1);

create table shipping_cost (
        type char(5),
	price double
);

insert into shipping_cost values ("mail", 9.99);
insert into shipping_cost values ("email", 2.99);
insert into shipping_cost values ("free", 0.00);





