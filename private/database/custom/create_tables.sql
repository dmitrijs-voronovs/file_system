create table topics(
    id int primary key AUTO_INCREMENT not null,
    level int not null default 0,
    prev_id int,
    title varchar(200) not null ,
    created_at datetime not null default CURRENT_TIMESTAMP(),
    foreign key (prev_id) references topics(id)
)

create talbe users(
    id primary key AUTO_INCREMENT not null,
    username varchar(100) unique nut null,
    hashed_password varchar(200) not null
)