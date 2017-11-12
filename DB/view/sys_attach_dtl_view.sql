create or replace view sys_attach_dtl_view as
select		x.recid, x.attachid, x.title,
				x.description, x.filename, x.filetype,
				x.filesize, x.tumbnail, x.remarks,
				round((x.filesize),0) as filesize_kb
from			sys_attach_dtl x