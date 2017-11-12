create or replace view konten_statis_view as
select		x.recid, x.nama, x.judul, x.isi,
				x.id_gambar, x.id_dokumen,  
				x.dateinput, x.dateupdate, x.userinput, x.userupdate,
				y.filename
from			konten_statis x
left join	sys_attach_dtl y on y.attachid = x.id_gambar
;