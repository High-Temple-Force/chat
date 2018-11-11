create table chat.t_message 
(
    id int(8) not null AUTO_INCREMENT PRIMARY KEY,
    member_id varchar(256) not null,
    talk_id varchar(256) not null,
    m_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    m_text varchar(1024) not null
);

create table chat.t_member
(
    member_id varchar(256) not null PRIMARY KEY,
    member_name varchar(256) not null
);

create table chat.t_talk
(
    talk_id varchar(256) not null PRIMARY KEY,
    talk_name varchar(256) not null
);

create table chat.t_auth
(
    id int(8) not null AUTO_INCREMENT PRIMARY KEY,
    talk_id varchar(256) not null,
    member_id varchar(256) not null
);

insert into chat.t_talk values ("test_talk_id","test_talk");
insert into chat.t_member values ("test_usr_id","test_usr");
insert into chat.t_auth  (talk_id, member_id) values ("test_talk_id", "test_usr_id");