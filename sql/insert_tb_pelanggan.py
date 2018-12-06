import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
cur = db.cursor()

# truncate table tb_pelanggan before insert
sql = "TRUNCATE tb_pelanggan;"
cur.execute(sql)
db.commit()

for i in range(1, 1001):
	name = "customer" + str(i)
	jk = random.randint(1, 2)
	idpel = "CUST_" + str(i)

	sql = "INSERT INTO tb_pelanggan(idpel, nama, jk, created_date, updated_date) VALUES('%s', '%s',  %s, NOW(), NOW());" %(idpel, name, jk)
	cur.execute(sql)
	db.commit()