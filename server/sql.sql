create table alarmSets
(
	aid int AUTO_INCREMENT primary key,
	tdate varchar(10),
	ttime varchar(10),
	status varchar(3),
	sid varchar(3),
	name varchar(10)
);

insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-02','11:02','on','nm2','test1');
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-07','11:02','on','nm3','test2');
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-06','12:02','on','nm1','test3');
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-05','13:02','on','nm3','test4');
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-04','10:02','on','nm5','test5');	
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-03-13','09:02','on','nm4','test6');
insert into alarmsets (tdate,ttime,status,sid,name) values ('2017-01-18','09:02','on','nm1','test7');