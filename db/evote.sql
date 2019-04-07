-- create the table
create table if not exists movie (
    id integer primary key AUTO_INCREMENT,
    title text,
    price float,
	  categoryId integer
);

-- insert some data
insert into movie values (1, 'Jaws', 9.99, 1);
insert into movie values (2, 'Jaws2', 6.99, 1);
insert into movie values (3, 'Alien', 9.99, 1);
insert into movie values (4, 'Predator', 7, 1);
insert into movie values (5, 'Mama Mia', 9.99, 2);
insert into movie values (6, 'Forget Paris', 8, 3);
insert into movie values (7, 'You have mail', 5, 3);
insert into movie values (8, 'The Sound of Music', 2, 3);

-- create the table
create table if not exists category (
    id integer primary key AUTO_INCREMENT,
    title text
);

-- insert some data
insert into category values (1, 'horror');
insert into category values (2, 'romance');
insert into category values (3, 'musical');


-- create the table
create table if not exists chart (
    id integer primary key AUTO_INCREMENT,
    name text
);

-- insert some data
insert into chart values (1, 'online');
insert into chart values (2, 'dvd');

-- create the table
create table if not exists chartmovie (
    id integer primary key AUTO_INCREMENT,
    chartId integer,
    movieId integer
);

-- insert some data
insert into chartmovie values (1, 1, 1); -- online - Jaws
insert into chartmovie values (2, 1, 3); -- online - Alien
insert into chartmovie values (3, 1, 6); -- online - Forget Paris
insert into chartmovie values (4, 2, 3); -- dvd - Alien
insert into chartmovie values (5, 2, 2); -- dvd - Jaws2
insert into chartmovie values (6, 2, 8); -- dvd - Sound of Music


