create or replace view produk_hukum_komentar_count_view as
select		x.id_produk_hukum, count(x.id_produk_hukum) as total
from			produk_hukum_komentar x
where			x.publish = 'Y'
group by		x.id_produk_hukum