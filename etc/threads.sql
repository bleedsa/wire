CREATE TABLE threads (id integer primary key, name text not null, author integer not null, board integer not null, hidden boolean not null);
INSERT INTO threads VALUES(1,'hello world',5,1,false);
INSERT INTO threads VALUES(2,'what are you working on',3,3,false);
INSERT INTO threads VALUES(3,'sports',6,1,false);
INSERT INTO threads VALUES(4,'/today/ what did you do today',3,1,false);
INSERT INTO threads VALUES(5,'/mus/ music',3,2,false);
INSERT INTO threads VALUES(6,'penny for your thoughts?',3,1,false);
INSERT INTO threads VALUES(7,'/wire/ meta',3,1,false);
INSERT INTO threads VALUES(8,'status updates',3,1,false);
