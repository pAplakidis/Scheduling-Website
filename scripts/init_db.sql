-- Create and use database
 create database scheduling_website;
 use scheduling_website;

-- Create table classes that take place in the university every week
create table if not exists classes(
  CID int not null auto_increment,
  lecturer_name varchar (32) not null,
  title varchar (64) not null,
  c_room_name varchar (16) not null,
  num_students int not null,
  primary key (CID)
);

-- Create the users database for authentication
create table if not exists users(
  id int not null auto_increment,
  username varchar (32) not null,
  password varchar (60) not null,
  primary key (id)
);

