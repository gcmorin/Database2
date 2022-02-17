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


create table user (
	id int(20) NOT NULL AUTO_INCREMENT,
	primary key (id)
)AUTO_INCREMENT=1;

create table publisher (
	login char(20),
	password char(20),
	publisher_id int,
	name char(255),
	constraint foreign key (publisher_id) references user(id),
	primary key (login)
);

create table admin (
	login char(20),
	password char(20),
	admin_id int,
	name char(255),
	constraint foreign key (admin_id) references user(id),
	primary key (login)
);

create table customer (
	customer_id int(20),
	constraint foreign key (customer_id) references user(id)
);

create table account (
	login char(20),
	password char(20),
	customer_id int,
	name char(255),
	address char(255),
	email char(255),
	memberstatus bool,
	constraint foreign key (customer_id) references customer(customer_id),
	primary key (login)
);

create table author (
	author_id int,
	constraint foreign key (author_id) references user(id)
);

create table book (
	isbn char(255),
	publisher_id int,
	author_id int,
	type char(255),
	title char(255),
	price double,
	genre char(255),
	series char(255),
	constraint foreign key (publisher_id) references publisher(publisher_id),
	constraint foreign key (author_id) references author(author_id),
	primary key (isbn)
);

create table reviews (
	isbn char,
	customer_id int,
	comment char(255),
	rating int(1),
	constraint foreign key (isbn) references book(isbn),
	constraint foreign key (customer_id) references customer(customer_id)
);

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

create table orders (
	order_id int(20) NOT NULL AUTO_INCREMENT,
	customer_id int,
	payment_id int,
	total double,
	name char(20),
	address char(255),
	date date default (CURRENT_DATE),
	email char(255),
	constraint foreign key (customer_id) references customer(customer_id),
	constraint foreign key (payment_id) references paymentinfo(payment_id),
	primary key (order_id)
)AUTO_INCREMENT=1;

create table cart (
	cart_id int(20) NOT NULL AUTO_INCREMENT,
	isbn char,
	order_id int,
	quantity int(2),
	constraint foreign key (isbn) references book(isbn),
	constraint foreign key (order_id) references orders(order_id),
	primary key (cart_id)	
)AUTO_INCREMENT=1;





