import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

propinsi = [
	"Nanggro Aceh Darussalam",
	"Sumatera Utara",
	"Sumatera Barat",
	"Riau",
	"Kepulauan Riau",
	"Jambi",
	"Sumatera Selatan",
	"Bangka Belitung",
	"Bengkulu",
	"Lampung",
	"DKI Jakarta",
	"Jawa Barat",
	"Banten",
	"Jawa Tengah",
	"Daerah Istimewa Yogyakarta",
	"Jawa Timur",
	"Bali",
	"Nusa Tenggara Barat",
	"Nusa Tenggara Timur",
	"Kalimantan Barat",
	"Kalimantan Tengah",
	"Kalimantan Selatan",
	"Kalimantan Timur",
	"Kalimantan Utara",
	"Sulawesi Utara",
	"Sulawesi Barat",
	"Sulawesi Tengah",
	"Sulawesi Tenggara",
	"Sulawesi Selatan",
	"Gorontalo",
	"Maluku",
	"Maluku Utara",
	"Papua Barat",
	"Papua"
]

for i in range(len(propinsi)):
	# get propinsi name from array
	nama = propinsi[i]

	sql = "INSERT INTO tb_propinsi(nama, negara) VALUES('%s', %s);" %(nama, "1")
	cur.execute(sql)
	db.commit()