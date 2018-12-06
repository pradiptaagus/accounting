import pymysql
import random

db = pymysql.connect("localhost", "root", "", "source")
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

# truncate table tb_propinsi
sql = "INSERT table tb_propinsi;"
cur.execute(sql)
db.commit()

for i in range(len(propinsi)):
	# get propinsi name from array
	nama = propinsi[i]

	sql = "INSERT INTO tb_propinsi(nama, id_negara) VALUES('%s', %s);" %(nama, "1")
	cur.execute(sql)
	db.commit()