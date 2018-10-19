import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

kota = [
	"Kabupaten Badung",
	"Kabupaten Bangli",
	"Kabupaten Buleleng",
	"Kabupaten Gianyar",
	"Kabupaten Jembrana",
	"Kabupaten Karangasem",
	"Kabupaten Klungkung",
	"Kabupaten Tabanan",
	"Kabupaten Denpasar"
]

for i in range(len(kota)):
	# get propinsi name from array
	nama = kota[i]

	sql = "INSERT INTO tb_kota(nama, id_propinsi) VALUES('%s', %s);" %(nama, "17")
	cur.execute(sql)
	db.commit()