<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered" id="realisasi_per_prov_table">
<thead>
  <tr class="heading">
    <th width="30">No</th>
    <th>Kabupaten</th>
    <th>Pagu</th>
    <th>Realisasi Keuangan</th>
    <th>% Realisasi</th>
  </tr>
</thead>
<tbody>
<?php
	$no = 0;
	foreach( $ch2 as $row ){
?>
  <tr>
    <td align="right"><?= $no+1 ?></td>
    <td><?= $row->nmkab ?></td>
    <td align="right"><?= number_format($row->pagu) ?></td>
    <td align="right"><?= number_format($row->sas_real) ?></td>
    <td align="right"><?= number_format($row->sas_real_persen) ?></td>
  </tr>
<?php
		$no++;
	}
?>  
</tbody>
</table>


<script>
	var table = $('#realisasi_per_prov_table');
	table.dataTable({
		"lengthMenu": [
			[5, 10, 50, -1],
			[5, 10, 50, "All"] // change per page values here
		],
		// set the initial value
		"pageLength": 5,            
		"columnDefs": [{  // set default column settings
			'orderable': false,
			'targets': [0]
		}, {
			"searchable": false,
			"targets": [0]
		}],
		"aaSorting": [],
	});
</script>