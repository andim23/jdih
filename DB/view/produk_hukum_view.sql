create or replace  view produk_hukum_view as
select		x.tanggal,
				year(x.tanggal) as tahun,
				x.id_produk_hukum, x.id_kategori,  x.produk_hukum, x.judul,
				x.subjudul, x.abstrak, x.isi, x.catatan, x.id_dokumen,  x.dateinput, 
				x.userinput, x.dateupdate, x.userupdate,
				k.kategori,
				ui.fullname as userinput_name,
				uu.fullname as userupdate_name,
				ifnull(kk.total,0) as total_komentar
from			produk_hukum x
left join	produk_hukum_kategori k on k.id_kategori = x.id_kategori
left join	auth_users ui on ui.user_id = x.userinput
left join	auth_users uu on uu.user_id = x.userinput
left join	produk_hukum_komentar_count_view kk on kk.id_produk_hukum = x.id_produk_hukum