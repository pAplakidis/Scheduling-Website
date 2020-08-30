-- Create and use database
 create database scheduling_website;
 use scheduling_website;

-- Create table classes that take place in the university every week
create table if not exists classes(
  lecturer_name varchar (32) not null,
  title varchar (64) not null,
  c_room_name varchar (16) not null,
  num_students int not null,
  days_avail varchar (16) not null,
  hours_avail varchar (8) not null
);

-- Create the users database for authentication
create table if not exists users(
  username varchar (32) not null,
  password varchar (60) not null,
);

