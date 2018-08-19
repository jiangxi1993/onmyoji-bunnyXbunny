/*drop schema onmyoji;

create schema onmyoji;*/

create table visitor(

vid   int(11) NOT NULL  auto_increment ,

vname  varchar(25)  not null ,

constraint visitor_pk primary key (vid) 
  
);



create table player(

pid  int(11) NOT NULL  auto_increment,

pname  varchar(25)  not null ,

constraint player_pk primary key(pid)

);



create table gameresult(

gid  int(11) NOT NULL auto_increment,

gscore int(11)   ,

gphase int(11)   ,

gplayer int(11)  not null ,

constraint gameresult_pk primary key(gid),

constraint gameresult_fk foreign key (gplayer) references player(pid)


);




select * from gameresult as g left join player as p on g.gplayer = p.pid;



select gid,pid,pname,gscore,gphase 
                     from((select * from gameresult as g left join player as p on g.gplayer = p.pid) as temp) 
                     where temp.gscore in
                     (select max(gscore) from gameresult as g left join player as p on g.gplayer = p.pid group by p.pid) 
                     order by gscore desc limit 10;



