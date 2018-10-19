import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

for i in range(1, 101):
	nama = "SUPPLIER_" + str(i)
	addresses = "Jl. Mawar", "Jl. Melati", "Jl. Kamboja", "Jl. Nanas", "Jl. Patimura", "Jl. Agung", "Jl. Tukad Balian", "Jl. Sejarah"
	address = random.choice(addresses)
	# get kota
	kota = random.randint(1, 9)
	# get propinsi
	propinsi = random.randint(1, 34)
	# get negara
	negara = "1"

	sql = "INSERT INTO tb_supplier(nama, alamat, id_kota, id_propinsi, id_negara) VALUES('%s', '%s',  '%s', '%s', '%s');" %(nama, address, kota, propinsi, negara)
	cur.execute(sql)
	db.commit()