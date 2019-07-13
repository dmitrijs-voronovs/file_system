create table users(
    id int primary key AUTO_INCREMENT not null,
    username varchar(100) unique not null,
    hashed_password varchar(60) not null
);


insert into users (username, hashed_password) VALUES 
('dima','$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'); 
/* pass1234 */
insert into users (username, hashed_password) VALUES 
('boss','$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'); 
/* pass1234 */
insert into users (username, hashed_password) VALUES 
('user123','$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'); 
/* pass1234 */

create table topics(
    id int primary key AUTO_INCREMENT not null,
    level int not null default 0,
    prev_id int,
    title varchar(200) not null,
    description varchar(500) default 'This is some boring default description for this very topic' not null,
    user_id int not null default 1,
    created_at datetime not null default CURRENT_TIMESTAMP(),
    foreign key (prev_id) references topics(id),
    foreign key (user_id) references users(id)
);

insert into topics (level, prev_id, title, user_id) values 
('0', NULL, 'Me and Friends',1),
('1', '1', 'This explains the beginning of my life all',2),
('0', NULL, 'Another one',3),
('1', '2', 'What is it',2),
('1', '3',  'My life from the beginning was very fun',2),
('1', '3', 'Why am i that good',2),
('2', '5', 'In order to go',1),
('3', '7', 'Decided to stay here',1),
('0', NULL, 'the way to the end of my life.',1),
('2', '2', 'bla bla bla',1),
('1', '9',  'as I grew up living with my moms',2),
('2', '11',  'friend and my friend. But there were a',3),
('2', '11', 'Right now',1),
('2', '2', 'lot of fights and I was very hyper',1),
('1', '3', 'Maybe another',2),
('2', '6',  'back then. I have ADHD so back then',1),
('2', '5',  'when I was little; I was very hyper',3),
('0', NULL, 'What was it',1),
('1', '18',  'and would not stop moving around the place. I',3);


