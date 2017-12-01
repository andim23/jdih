create or replace view permohonan_status_h_view as
select		x.recid, x.id_permohonan, x.id_permohonan_status,
				x.notes, x.dateinput, x.userinput,
				y.`status`,
				z.pengusul, z.judul,
				concat(mid(x.dateinput,9,2), '-', 
				mid(x.dateinput,6,2), '-' ,
				left(x.dateinput,4)) as dateinput_char,
				right(x.dateinput,8) as timeinput_char,
				x.id_berkas
from			permohonan_status_h x
left join	permohonan_status y on y.id_permohonan_status = x.id_permohonan_status
left join	permohonan z on z.id_permohonan = x.id_permohonan