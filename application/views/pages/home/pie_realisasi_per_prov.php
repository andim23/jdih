<div id="chart1" class="col-md-12"></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td><strong>Total Pagu</strong></td>
    <td align="right"><strong>
      <?= number_format($ch1[0]->pagu) ?>
    </strong></td>
  </tr>
  <tr>
    <td>Realisasi</td>
    <td align="right"><?= number_format($ch1[0]->sas_real) ?></td>
  </tr>
  <tr>
    <td>Sisa</td>
    <td align="right"><?= number_format($ch1[0]->sas_sisa) ?></td>
  </tr>
</table>


<script type="text/javascript">
	$(function () {
		$('#chart1').highcharts({
			chart: {
				type: 'pie',
				options3d: {
					enabled: true,
					alpha: 45,
					beta: 0
				}
			},
			title: {
				text: 'REALISASI KEUANGAN <?= $ch1[0]->nmprov; ?>'
			},
			subtitle: {
				text: 'Sumber: MPO<br><?= $ch1[0]->sas_lastupdate_display; ?>'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					depth: 35,
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Realisasi Keuangan <?= $ch1[0]->nmprov; ?>',
				data: 
				[
					['Sisa',    <?= !empty($ch1[0]->sas_sisa_persen)?$ch1[0]->sas_sisa_persen:0; ?>],
					{
						name: 'Realisasi',
						y: <?= !empty($ch1[0]->sas_real_persen)?$ch1[0]->sas_real_persen:0; ?>,
						sliced: true,
						selected: true
					}
					
				]
			}]
		});
	});
</script>