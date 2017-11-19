select		x.id_permohonan_status, x.`status`,  ifnull(y.total,0) as total
from			permohonan_status x
left join	
(
		select	y.id_permohonan_status, count(*) as total
		from		permohonan y
		group by	y.id_permohonan_status
) y on y.id_permohonan_status = x.id_permohonan_status 
;

select		x.id_kategori, x.kategori, ifnull(y.total,0) as total
from			produk_hukum_kategori x
left join	
(
	select		y.id_kategori, count(*) as total
	from			permohonan y
	where			1=1 and y.user_id = 1
					and year(y.tanggal) = 2017
	group by		y.id_kategori
	
) y on y.id_kategori = x.id_kategori
where			x.is_permohonan = 1
;