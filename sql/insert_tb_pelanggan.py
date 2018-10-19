import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

for i in range(1, 1001):
	name = "customer" + str(i)
	jk = random.randint(1, 2)
	idpel = "CUST_" + str(i)

	sql = "INSERT INTO tb_pelanggan(idpel, nama, jk, created_date, updated_date) VALUES('%s', '%s',  %s, NOW(), NOW());" %(idpel, name, jk)
	cur.execute(sql)
	db.commit()