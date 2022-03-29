CREATE DATABASE IF NOT EXISTS bookstore;
USE bookstore;


CREATE table users(
	email char(40), 
	name char(40), 
	primary key(email)
);


CREATE table author(
	author_id char(40), 
	email char(40), 
	name char(40), 
	primary key(author_id), 
	foreign key(email) references users(email)
);


CREATE table customer(
	email char(40),
	name char(40), 
	phone_number char(40), 
	foreign key(email) references users(email)
);


CREATE table member(
	email char(40), 
	name char(40), 
	phone_number char(40), 
	member_fee decimal(10,2), 
	password char(40), 
	foreign key(email) references users(email)
);


CREATE table non_member(
	email char(40), 
	name char(40), 
	phone_number char(40),
	password char(40), 
	foreign key(email) references users(email)
);


CREATE table publisher( 
	publisher_name char(60),
	publisher_id char(40), 
	url char(40), 
	address char(255), 
	primary key (publisher_id)
);



CREATE table orders( 
	order_id char(40),
	order_date date, 
	primary key(order_id)
);



CREATE table payment(
	card_number char(25), 
	card_type char(40), 
	exp_date date,
	cvv_code int, 
	billing_address char(255), 
	primary key (card_number)
);



CREATE table book( 
	book_id int, 
	year int, 
	genre char(40), 
	title char(40), 
	isbn char(13), 
	book_condition char(40), 
	price decimal(10,2), 
	book_type char(40), 
	total_rating decimal(5,2), 
	primary key(book_id)
);


CREATE table shipping_address(
	address char(40), 
	zip char(10), 
	state char(40), 
	country char(40), 
	primary key(address,zip,state,country)
);

CREATE Table shipping_modes(
	shipping_type char(20),
	shipping_cost decimal (10,2),
	primary key(shipping_type)
);


CREATE table cart(
	cart_id int, 
	user_email char(40), 
	item_cost decimal(10,2), 
	shipping_type char(20), 
	tax decimal(10,2), 
	primary key(cart_id),
	foreign key(user_email) references users(email),
	foreign key(shipping_type) references shipping_modes(shipping_type)
);



CREATE table grab(
	order_id char(40) ,
	book_id int ,
	year_bought date,
	foreign key(order_id) references orders(order_id),
	foreign key(book_id) references book(book_id)
);

CREATE table purchased(
	amount_pay decimal(10,2),
	order_id char(40) ,
	card_number char(25),
	foreign key(order_id) references orders(order_id),
	foreign key(card_number) references payment(card_number)
);


CREATE table rate(
	cus_comment char(255),
	rating int, 
	book_id int ,
	email char(40) ,
	foreign key(email) references customer(email),
	foreign key(book_id) references book(book_id)
);


CREATE TABLE published (
	publisher_id char(40),
	book_id int,
	FOREIGN KEY (publisher_id) REFERENCES publisher(publisher_id),
	FOREIGN KEY (book_id) REFERENCES book(book_id)
);

CREATE TABLE wrote (
	author_id char(40),
	book_id int,
	FOREIGN KEY (author_id) REFERENCES author(author_id),
	FOREIGN KEY (book_id) REFERENCES book(book_id)
);

CREATE TABLE history (
	email char(40),
	order_id char(40),
	FOREIGN KEY (email) REFERENCES customer(email),
	FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

CREATE TABLE have (
	email char(40),
	card_number char(40),
	FOREIGN KEY (email) REFERENCES customer(email),
	FOREIGN KEY (card_number) REFERENCES payment(card_number)
);

CREATE TABLE stores (
	email char(40), 
	shipping_address char(40), 
	shipping_zip char(10), 
	shipping_state char(40), 
	shipping_country char(40),
	foreign key(email) references customer(email),
	foreign key(shipping_address,shipping_zip, shipping_state, shipping_country) references shipping_address(address,zip,state,country)
);

CREATE TABLE hold (
	cart_id int,
	book_id int,
	foreign key(cart_id) references cart(cart_id),
	foreign key(book_id) references book(book_id)
);
	
INSERT into publisher (publisher_name, publisher_id, url, address)
VALUES
('Penguin','A001', 'www.coolbooks.com', '40 Main Street, NY'), 
('Starsign','A002', 'www.penguinpublishing.com', '333 Vox  Street, NJ'), 
('Random House','A003', 'www.Archie.com', '70 Main Street, NY'),
('The Guardian','A004', 'www.wackyComics.com', '88 Tom Street, CN'),
('Pearson','A005', 'www.cheapbooks.com', '33 Street, MA');



insert into book (book_id , year, genre , title , isbn, book_condition , price , book_type, total_rating ) 
values 
(1, 1990, 'sci-fi', 'Star War', '8769674523245', 'renewed', '49.50', 'e-book', '4.00'),
(2, 2001, 'thriller', 'IT', '2344589187312', 'new', '39.99', 'hard_cover', '4.60'),
(3, 1997, 'mystery', 'The Haunting of The Hill House', '8719958232345', 'old', '29.49', 'hard_cover', '4.30'),
(4, 2010, 'comedy', 'You', '2891282361032', 'new', '59.99', 'e-book', '3.90'),
(5, 2020, 'romance', 'The Notebook', '9827339278426', 'renewed', '69.50', 'hard_cover', '4.30');


insert into users(email,name) 
values 
('admin@gmail.com', 'Super User'),
('carolinek@gmail.com', 'Caroline Kepnes'),
('Fake2@gmail.com', 'Fake Boy 2'),
('fake@gmail.com', 'A person'),
('jkrowling@gmail.com', 'J.K Rowling'),
('likhitha@gmail.com', 'Likhitha Patel'),
('nnguyen@gmail.com', 'Ngan Nguyen'),
('stephenk@gmail.com', 'Stephen King'),
('Zack@gmail.com', 'z23'),
('zackk@gmail.com', 'Zachary Pelley');


insert into author(author_id,email,name) 
values 
('Au001','stephenk@gmail.com','Stepehen King'), 
('Au002', 'carolinek@gmail.com','Caroline Kepnes'), 
('Au003', 'jkrowling@gmail.com','J.K Rowling');

insert into shipping_modes(shipping_type,shipping_cost)
values
('standard',0.00);

insert into cart(cart_id , user_email,  item_cost, shipping_type , tax)
values
(1, 'likhitha@gmail.com', '0.00', 'standard', '5'),
(2, 'nnguyen@gmail.com', '0.00', 'standard', '3'),
(3, 'zackk@gmail.com', '0.00', 'standard', '1'),
(4, 'carolinek@gmail.com', '0.00', 'standard', '0'),
(5, 'stephenk@gmail.com', '0.00', 'standard', '0'),
(6, 'jkrowling@gmail.com', '0.00', 'standard', '0'),
(7, 'admin@gmail.com', '0.00', 'standard', '0');

insert into customer(email,name,phone_number) 
values 
('likhitha@gmail.com', 'Likhitha Patel', '617-900-1010'),
('nnguyen@gmail.com', 'Ngan Nguyen', '978-908-9699'),
('carolinek@gmail.com', 'Caroline Kepnes', '895-345-1231'),
('zackk@gmail.com', 'Zachary Pelley', '111-111-1111'),
('stephenk@gmail.com', 'Stepehen King', '778-496-0716'),
('jkrowling@gmail.com', 'J.K Rowling', '519-702-0534'),
('admin@gmail.com', 'Super User', '111-111-1111');


insert into member(email,name,phone_number,member_fee,password) 
values
('likhitha@gmail.com', 'Likitha Patel', '617-900-1010', '30.00', 'cigolisnotlogic'),
('nnguyen@gmail.com', 'Ngan Nguyen', '978-908-9699', '99.99', 'ngan123456'),
('zackk@gmail.com', 'Zachary Pelley', '515-282-4698', '50.00', 'zpzpzp'),
('admin@gmail.com', 'Super User', '111-111-1111', '0.00', '12345678');


insert into non_member(email,name,phone_number,password) 
values
('carolinek@gmail.com', 'Caroline Kepnes', '895-345-1231', '3dc69c88'),
('stephenk@gmail.com', 'Stepehen King', '778-496-0716', '123456789'),
('jkrowling@gmail.com', 'J.K Rowling', '519-702-0534', 'decad56f');


insert into wrote(author_id,book_id)
values
('Au001', 1),
('Au002', 2),
('Au003', 3),
('Au001', 4),
('Au002', 5);


insert into published(publisher_id , book_id)
values
('A001', 1),
('A002', 2),
('A003', 3),
('A001', 4),
('A002', 5);

insert into orders(order_id, order_date) 
values
('a00001', '2020-11-11'),
('a00002', '2021-11-11'),
('a00003', '2022-11-11');

insert into history(email, order_id)
values
('admin@gmail.com', 'a00001'),
('admin@gmail.com', 'a00002'),
('admin@gmail.com', 'a00003');

insert into grab(order_id, book_id, year_bought)
values
('a00001', 1 ,'2020-11-11'),
('a00002', 2 ,'2021-11-11'),
('a00003', 3 ,'2022-11-11'),
('a00001', 1 ,'2020-11-11'),
('a00002', 2 ,'2021-11-11'),
('a00003', 3 ,'2022-11-11'),
('a00001', 3 ,'2020-11-11'),
('a00002', 2 ,'2021-11-11'),
('a00003', 1 ,'2022-11-11');

insert into payment(card_number, card_type, exp_date, cvv_code, billing_address)
values
('44444444444', 'credit', '2027-11-11', 1234, '123 fake street, USA');

insert into purchased(amount_pay, order_id, card_number)
values
(200,'a00001', '44444444444'),
(100,'a00002', '44444444444'),
(150,'a00003', '44444444444');


insert into rate(cus_comment, rating, book_id, email)
values
('This book is great!', 5, 1, 'admin@gmail.com'),
('This book is okay', 3, 2, 'admin@gmail.com'),
('This book is bad!', 1, 3, 'admin@gmail.com');
