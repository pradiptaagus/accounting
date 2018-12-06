import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
cur = db.cursor()

# truncate database table penjualan
sql = "INSERT INTO tb_user;"
cur.execute(sql)
db.commit()

for i in range(1, 6):
	name = "user" + str(i)
	angka = random.randint(1, 1000)
	nik = "USER_" + str(i)
	pas = "111111"
	
	# jabatan
	pos = random.randint(1, 4)
	jabatan = str(pos)

	# aktif
	a = random.randint(1, 2)
	aktif = str(a)
	

	sql = "INSERT INTO tb_user(nik, nama, username, password, id_jabatan, status, created_at, updated_at) VALUES('%s', '%s', '%s', SHA('%s'), %s, %s, NOW(), NOW());" %(nik, name, name, pas, jabatan, aktif)
	cur.execute(sql)
	db.commit()