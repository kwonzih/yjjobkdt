
create table counsel (
	num int not null auto_increment,
	class char(100) not null,
	name char(15) not null,
	phone char(15) not null,
	start char(5) not null,
	end char(5) not null,
	question char(200),
	primary key(num)
)