import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor();

jabatan = [
	['Kasir', 'Kasir'],
	['Gudang', 'Pegawai gudang'],
	['Kebersihan', 'Pegawai kebersihan'],
	['Manager', 'Manager']
]

for i in range(len(jabatan)):
	nama = str(jabatan[i][0])
	keterangan = str(jabatan[i][1])

	sql = "INSERT INTO tb_jabatan(nama, keterangan) VALUES('%s', '%s');" %(nama, keterangan)
	cur.execute(sql)
	db.commit()