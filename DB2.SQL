CREATE database bookstore;
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
	isbn int, 
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

CREATE table cart(
	O_id char(40), 
	user_email char(40), 
	shipping_address char(40), 
	shipping_zip char(10), 
	shipping_state char(40), 
	shipping_country char(40),
	item_cost decimal(10,2), 
	shipping_cost decimal(10,2), 
	tax decimal(10,2), 
	total_cost decimal(10,2),
	book_quantity int, 
	date_of_purchase date, 
	primary key(shipping_address,shipping_zip,shipping_state,shipping_country),
	foreign key(user_email) references users(email),
	foreign key(O_id) references orders(order_id),
	foreign key(shipping_address,shipping_zip, shipping_state, shipping_country) references shipping_address(address,zip,state,country)
);



CREATE table grab(
	order_id char(40) ,
	book_id int ,
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

INSERT into publisher (publisher_name, publisher_id, url, address)
VALUES
('Penguin','A001', 'www.coolbooks.com', '40 Main Street, NY'), 
('Starsign','A002', 'www.penguinpublishing.com', '333 Vox  Street, NJ'), 
('Random House','A003', 'www.Archie.com', '70 Main Street, NY'),
('The Guardian','A004', 'www.wackyComics.com', '88 Tom Street, CN'),
('Pearson','A005', 'www.cheapbooks.com', '33 Street, MA');

INSERT into orders (order_id ,order_date)
VALUES
('O001', '2021-02-12'),
('O002', '2021-04-16'),
('O003', '2021-01-17'),
('O004', '2021-07-19'),
('O005', '2021-12-13');

insert into payment (card_number , card_type, exp_date, cvv_code , billing_address)
values
('786954324156', 'debit', '2025-12-01', 278, '22 White St, MA'),
('954378624156', 'credit', '2022-12-31', 371, '89 Middlesex St, NH'),
('415654322396', 'debit', '2023-11-21', 498, '213 Marshall St, CA'),
('198295437862', 'credit', '2028-09-21', 176, '91 University Ave, TX'),
('543289764156', 'debit', '2026-05-11', 421, '292 Pawtucket St, LA');

insert into book (book_id , year, genre , title , isbn, book_condition , price , book_type, total_rating ) 
values 
(1231, 1990, 'sci-fi', 'Star War', 87692345, 'renewed', 49.50, 'e-book', 4.5 ), 
(7894, 2001, 'thriller', 'IT' , 23458912, 'new' , 39.99, 'hard_cover', 4.6),
(8932, 1997, 'mystery' , 'The Haunting of The Hill House' , 87192345, 'old', 29.49, 'hard_cover',4.3) ,
(2956, 2010, 'comedy', 'You' , 28912032, 'new' , 59.99,'e-book',3.9),
(3891, 2020, 'romance' , 'The Notebook', 98273326, 'renewed',69.50, 'hard_cover',4.3 );

insert into users(email,name) 
values 
('likhitha@gmail.com','Likhitha Patel'),
('nnguyen@gmail.com','Ngan Nguyen'),
('zackk@gmail.com','Zachary Pelley'),
('carolinek@gmail.com','Caroline Kepnes'),
('stephenk@gmail.com','Stephen King'),
('jkrowling@gmail.com','J.K Rowling'),
('iper.pfeffer@buckridge.com','Owen Houston'),
('roxane.johns@turner.com','Raiden Simpson'),
('marvin.wendell@yahoo.com','Cooper Gibson');

insert into shipping_address(address,zip,state,country) 
values
('123 Middlesex St, Lowell', '01850' , 'MA', 'United States'),
('22 Lowell St, Peabody', '01960', 'MA', 'United States');

insert into author(author_id,email,name) 
values 
('Au001','stephenk@gmail.com','Stepehen King'), 
('Au002', 'carolinek@gmail.com','Caroline Kepnes'), 
('Au003', 'jkrowling@gmail.com','J.K Rowling');

insert into cart(O_id , user_email, shipping_address , shipping_zip, shipping_state , shipping_country, item_cost, shipping_cost , tax , total_cost,book_quantity, date_of_purchase)
values
('O001','likhitha@gmail.com','123 Middlesex St, Lowell', '01850', 'MA', 'United States', 50.00, 8.00, 3.00, 61.00, 1, '2021-02-12'),
('O002','nnguyen@gmail.com','22 Lowell St, Peabody', '01960', 'MA', 'United States', 55.00, 9.00, 4.00, 178.00, 3, '2021-04-16');

insert into customer(email,name,phone_number) 
values 
('likhitha@gmail.com', 'Likhitha Patel', '617-900-1010'), 
('nnguyen@gmail.com', 'Ngan Nguyen','978-908-9699'),
('carolinek@gmail.com','Caroline Kepnes','895-345-1231'),
('zackk@gmail.com','Zachary Pelley ','515-282-4698');

insert into grab(order_id,book_id)
values
('O001',1231),
('O002',8932);

insert into member(email,name,phone_number,member_fee,password) 
values
('likhitha@gmail.com','Likitha Patel','617-900-1010',30.00,'cigolisnotlogic'),
('nnguyen@gmail.com','Ngan Nguyen','978-908-9699','99.99','ngan123456'),
('zackk@gmail.com','Zachary Pelley','515-282-4698','59.99','zpzpzp');

insert into non_member(email,name,phone_number,password) 
values
('iper.pfeffer@buckridge.com','Owen Houston','432-384-8266','3dc69c88'),
('roxane.johns@turner.com','Raiden Simpson','778-496-0716','a96333d8'),
('marvin.wendell@yahoo.com','Cooper Gibson','519-702-0534','decad56f');

insert into history (email, order_id)
values
('likhitha@gmail.com','O001'),
('nnguyen@gmail.com','O002');

insert into wrote(author_id,book_id)
values
('Au001',1231),
('Au002',8932);

insert into rate(cus_comment ,rating , book_id ,email)
values
('This books great',4, 1231,'likhitha@gmail.com' ),
('One of the interesting books I have ever read',4, 2956,'zackk@gmail.com' ),
('Great book. Helpful',3, 8932,'nnguyen@gmail.com' );

insert into published(publisher_id , book_id)
values
('A001',1231),
('A003',8932);

insert into have(email, card_number)
values
('likhitha@gmail.com','786954324156'),
('nnguyen@gmail.com','543289764156');

insert into stores(email, shipping_address , shipping_zip, shipping_state , shipping_country)
values
('likhitha@gmail.com','123 Middlesex St, Lowell', '01850', 'MA', 'United States'),
('nnguyen@gmail.com','22 Lowell St, Peabody', '01960', 'MA', 'United States');

insert into purchased(amount_pay, order_id, card_number)
values
(61.00,'O001','786954324156'),
(178.00,'O002','543289764156');

