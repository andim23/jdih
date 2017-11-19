create or replace view permohonan_view as
select		x.id_permohonan, x.user_id, x.id_kategori, x.id_permohonan_status,
				x.no_permohonan, x.tanggal, x.pengusul, x.judul, x.no_nota_dinas, x.tanggal_nota_dinas,
				x.id_dok_notadinas, x.id_dok_position_paper, x.id_dok_draft_rancangan, 
				x.id_dok_tahap_pembahasan,
				x.notes, x.dateupdate, x.userupdate,
				y.`status`,
				z.kategori,
				dnd.filename as berkas_nota_dinas,
				dpp.filename as berkas_position_paper,
				ddr.filename as berkas_draft_rancangan,
				dtb.filename as berkas_tahap_pembahasan,
				concat(mid(x.tanggal,9,2), '-', 
				mid(x.tanggal,6,2), '-' ,
				left(x.tanggal,4), ' ', 
				right(x.tanggal,8)) as tanggal_char
from 			permohonan x
left join	permohonan_status y on y.id_permohonan_status = x.id_permohonan_status
left join	produk_hukum_kategori z on z.id_kategori = x.id_kategori
left join	sys_attach_dtl dnd on dnd.attachid = x.id_dok_notadinas
left join	sys_attach_dtl dpp on dpp.attachid = x.id_dok_position_paper
left join	sys_attach_dtl ddr on ddr.attachid = x.id_dok_draft_rancangan
left join	sys_attach_dtl dtb on dtb.attachid = x.id_dok_tahap_pembahasan