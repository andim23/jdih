create or replace view sys_privilege_view as 
select		x.sitemapid, x.roleid, x.dateinput, x.dateupdate, x.userinput, x.userupdate,
			y.sitemapid_parent, y.name, y.url, y.sortno, y.is_active, y.icon, y.displayname,
            z.name as role_name
from		sys_privilege x
left join	sys_sitemap y on x.sitemapid = y.sitemapid
left join	sys_role z  on z.roleid = x.roleid