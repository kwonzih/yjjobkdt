
create table apply (
	num int not null auto_increment,
	class char(100) not null,
	name char(15) not null,
	birth char(10) not null,
	gender char(1) not null,
	phone char(15) not null,
	start char(5) not null,
	end char(5) not null,
	school char(15),
	major char(20),
	question char(200),
	primary key(num)
)
	