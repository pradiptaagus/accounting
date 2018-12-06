import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
cur = db.cursor()

# truncate table tb_penjualan
# sql = "TRUNCATE tb_penjualan;"
# cur.execute(sql)
# db.commit()

# truncate table tb_detail_penjualan
# sql = "TRUNCATE tb_detail_penjualan;"
# cur.execute(sql)
# db.commit()

for i in range(0, 1000):
	id_barang = random.randint(1, 42)
	jml_barang = random.randint(1, 5)
	# get harga barang
	sql_barang = "SELECT tb_barang.`harga_jual` FROM tb_barang WHERE id = %s" %(id_barang)
	cur.execute(sql_barang)
	harga_barang = cur.fetchone()
	harga_barang = harga_barang[0]
	print(harga_barang)
	total_bayar = harga_barang * jml_barang
	timestamp = '2018-11-01 00:00:00'

# ===============================================
	kode = "TRX_" + str(i)
	id_pelanggan = random.randint(1, 1000)
	id_user = random.randint(1, 5)
	status = 1

	# insert data di tabel penjualan
	sql = "INSERT INTO tb_penjualan(kode, id_pelanggan, id_user, status, created_at, updated_at) VALUES('%s', %s, %s, %s, '%s', '%s');" %(kode, id_pelanggan, id_user, status, timestamp, timestamp)
	cur.execute(sql)
	db.commit()

	# insert data di tabel tb_detail_penjualan
	id_penjualan = i
	sql_detail_penjualan = "INSERT INTO tb_detail_penjualan(id_penjualan, id_barang, jml_barang, harga_barang, total_bayar, created_at) VALUES(%s, %s, %s, %s, %s, '%s');" %(id_penjualan, id_barang, jml_barang, harga_barang, total_bayar, timestamp)
	cur.execute(sql_detail_penjualan)
	db.commit()