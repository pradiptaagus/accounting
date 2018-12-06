import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
cur = db.cursor()

kategori = [
	"Makanan",
	"Minuman",
	"Pakaian",
	"Alat Tulis",
	"Olahraga",
	"Perlengkapan Upacara",
	"Perlengkapan Dapur",
	"Kebutuhan Mandi",
	"Suvenir & Kado",
	"Kebutuhn Kebersihan",
	"Elektronik"
]

# truncate table tb_kategori before insert
sql = "TRUNCATE tb_kategori;"
cur.execute(sql)
db.commit()

for i in range(len(kategori)):
	# get propinsi name from array
	nama = kategori[i]

	sql = "INSERT INTO tb_kategori(nama) VALUES('%s');" %(nama)
	cur.execute(sql)
	db.commit()