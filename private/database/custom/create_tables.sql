create table topics(
    id int primary key AUTO_INCREMENT not null,
    level int not null default 0,
    prev_id int,
    title varchar(200) not null ,
    created_at datetime not null default CURRENT_TIMESTAMP(),
    foreign key (prev_id) references topics(id)
)

create table users(
    id int primary key AUTO_INCREMENT not null,
    username varchar(100) unique not null,
    hashed_password varchar(60) not null
);

insert into users (username, hashed_password) VALUES 
('dima','$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'); 
--pass1234