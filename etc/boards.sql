CREATE TABLE boards (
id INTEGER PRIMARY KEY,
name TEXT NOT NULL,
description TEXT NOT NULL,
hidden boolean not null
);
INSERT INTO boards VALUES(1,'general','open discussion',false);
INSERT INTO boards VALUES(2,'art','posts about art',false);
INSERT INTO boards VALUES(3,'tech','technology, computer science, electronics, engineering',false);
insert into boards values(4,'test','internal development testing',true);
