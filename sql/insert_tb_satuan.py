import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

satuan = {
	"bh": "Buah",
	"bks": "Bungkus",
	"box": "Box",
	"btl": "Botol",
	"dus": "Kardus",
	"gln": "Galon",
	"gram": "Gram",
	"ikt": "Ikat",
	"kg": "Kilogram",
	"ktn": "Karton",
	"lbr": "Lembar",
	"lsn": "Lusin",
	"ltr": "Liter",
	"ml": "Mililiter",
	"mtr": "Meter",
	"ons": "Ons",
	"pak": "Pak",
	"pcs": "Potong",
	"psg": "Pasang",
	"sak": "Sak",
	"set": "Set",
	"tabung": "Tabung"
}

for i, j in satuan.items():
	# get propinsi name from array
	nama = i
	keterangan = j

	sql = "INSERT INTO tb_satuan(nama, keterangan) VALUES('%s', '%s');" %(nama, keterangan)
	cur.execute(sql)
	db.commit()