import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

barang = [
	["Aqua", "2", "1000", "1", "500"],
	["Teh Pucuk Botol", "2", "4000", "4", "3000"],
	["Teh Gelas", "2", "1000", "1", "800"],
	["Teh Gelas Botol", "2", "4000", "4", "3000"],
	["Pocari Sweat Kaleng", "2", "6000", "1", "5000"],
	["Roti Tawar Sari Roti", "1", "8000", "2", "7000"],
	["Lays", "1", "5000", "2", "4000"],
	["Chitato", "1", "4500", "2", "3000"],
	["Tango", "1", "3000", "2", "2000"],
	["Beng-Beng", "1", "2000", "2", "1000"],
	["Kaos Kaki", "3", "10000", "19", "9000"],
	["Singlet", "3", "15000", "1", "14000"],
	["Kemeja", "3", "60000", "1", "5000"],
	["Celana Olahraga (Training)", "3", "70000", "1", "60000"],
	["Kaos Oblong", "3", "40000", "1", "35000"],
	["Buku Tulis Sidu HVS 50 lbr", "4", "3000", "1", "2500"],
	["Pulpen Snowman", "4", "2000", "1", "1500"],
	["Pensil Steadler 2B", "4", "3000", "1", "2500"],
	["Penggaris Besi", "4", "5000", "1", "4000"],
	["Penghapus Steadler", "4", "2000", "1", "1600"],
	["Bola Plastik", "5", "10000", "1", "8000"],
	["Dupa", "6", "10000", "2", "8000"],
	["Tangkih", "6", "5000", "2", "4000"],
	["Penek", "6", "5000", "2", "4000"],
	["Kain Kasa Putih", "6", "4000", "15", "3000"],
	["Kain Kasa Hitam", "6", "5000", "15", "4000"],
	["Kain Kasa Kuning", "6", "6000", "15", "5000"],
	["Panci", "7", "30000", "1", "25000"],
	["Wajan", "7", "25000", "1", "20000"],
	["Sunlight", "7", "5000", "4", "4000"],
	["Spon", "7", "3000", "1", "2500"],
	["Kain pembersih", "7", "3000", "11", "2500"],
	["Sabun Shinzui", "8", "3000", "1", "2500"],
	["Shampo Clear (Shachet)", "8", "500", "1", "400"],
	["Sikat Gigi", "8", "4000", "1", "3000"],
	["Pasta Gigi Pepsodent", "8", "7500", "1", "6000"],
	["Sabun Muka Garnier", "8", "35000", "1", "30000"],
	["Kado", "9", "30000", "1", "25000"],
	["Sapu", "10", "15000", "1", "10000"],
	["Kain Pel", "10", "8000", "1", "7000"],
	["Cairan Pel Pembersih", "10", "11000", "4", "10000"],
	["Baterai ABC (per pasang)", "11", "4000", "19", "3500"]
]

for i in range(len(barang)):
	# get propinsi name from array
	kode = "PRODUCT_" + str(i+1)
	nama = str(barang[i][0])
	kategori = int(barang[i][1])
	harga_jual = int(barang[i][2])
	stok = 10
	diskon = 0
	id_satuan = int(barang[i][3])
	harga_beli = int(barang[i][4])
	pajak = 0
	id_supplier = int(random.randint(1, 100))

	sql = "INSERT INTO tb_barang(kode, nama, id_kategori, harga_jual, stok, diskon, id_satuan, harga_beli, pajak, id_supplier, created_date, updated_date) VALUES('%s', '%s', %s, %s, %s, %s, %s, %s, %s, %s, NOW(), NOW());" %(kode, nama, kategori, harga_jual, stok, diskon, id_satuan, harga_beli, pajak, id_supplier)
	cur.execute(sql)
	db.commit()