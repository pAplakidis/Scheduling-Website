-- Create table classes that take place in the university every week
create table Class(
  CID int,
  lecturer_name varchar (32) not null,
  title varchar (64) not null,
  c_room_name varchar (16) not null,
  num_students int,
  primary key (CID)
);

