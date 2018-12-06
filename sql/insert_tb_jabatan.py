import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
cur = db.cursor()

jabatan = [
	['Kasir', 'Kasir'],
	['Gudang', 'Pegawai gudang'],
	['Kebersihan', 'Pegawai kebersihan'],
	['Manager', 'Manager']
]

# truncate table tb_jabatan before insert
sql = "TRUNCATE tb_jabatan;"
cur.execute(sql)
db.commit()

for i in range(len(jabatan)):
	nama = str(jabatan[i][0])
	keterangan = str(jabatan[i][1])

	sql = "INSERT INTO tb_jabatan(nama, keterangan) VALUES('%s', '%s');" %(nama, keterangan)
	cur.execute(sql)
	db.commit()