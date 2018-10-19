import pymysql
import random

db = pymysql.connect("localhost", "root", "", "db_project")
cur = db.cursor()

status = [
	"Mengirimkan PO ke supplier",
	"PO diterima supplier",
	"PO ditolak supplier",
	"PO diproses supplier",
	"DO sedang dikirim oleh supplier",
	"DO diterima",
	"PO sedang dicek",
	"DO ditolak"
]

for i in range(len(status)):
	# get propinsi name from array
	nama = status[i]

	sql = "INSERT INTO tb_status(nama) VALUES('%s');" %(nama)
	cur.execute(sql)
	db.commit()