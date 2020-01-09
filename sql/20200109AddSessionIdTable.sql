-- drop table sessionId;
-- delete from sessionId;

create table sessionId(
    datum datetime default current_timestamp,
    sessionId varchar(255)
);