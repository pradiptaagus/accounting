import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_accounting")
cur = db.cursor()

for i in range(1, 289):
	id_barang = random.randint(1, 42)
	jml_barang = random.randint(1, 5)
	# get harga barang
	sql_barang = "SELECT tb_barang.`harga_jual` FROM tb_barang WHERE id = %s" %(id_barang)
	cur.execute(sql_barang)
	harga_barang = cur.fetchone()
	harga_barang = harga_barang[0]
	total_bayar = harga_barang * jml_barang
	timestamp = '2018-01-08 00:00:00'

	# insert data di tabel tb_detail_penjualan
	sql_detail_penjualan = "INSERT INTO tb_detail_penjualan(id_barang, jml_barang, harga_barang, total_bayar, createdate) VALUES(%s, %s, %s, %s, '%s');" %(id_barang, jml_barang, harga_barang, total_bayar, timestamp)
	cur.execute(sql_detail_penjualan)
	db.commit()

# ===============================================
	kode = "TRX_" + str(i)
	id_detail_penjualan = i
	id_pelanggan = random.randint(1, 1000)
	id_user = random.randint(1, 1000)
	status = 1

	# insert data di tabel penjualan
	sql = "INSERT INTO tb_penjualan(kode, id_detail_penjualan, id_pelanggan, id_user, status, createdate) VALUES('%s', %s,  %s, %s, %s, '%s');" %(kode, id_detail_penjualan, id_pelanggan, id_user, status, timestamp)
	cur.execute(sql)
	db.commit()