<div id="serapan_anggaran_chart" style="height: 800px;" class="col-md-12"></div>

<script type="text/javascript">
	$(function () {
		$('#serapan_anggaran_chart').highcharts({
			chart: {
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 12,
					beta: 22
				},
				backgroundColor: "#FFFFFF",
				borderWidth: 0,
				borderColor: "#FFFFFF"
			},
			exporting: { enabled: false },
			title: {
				text: 'REALISASI KEGIATAN DITJEN PSP SMART VS MPO'
			},
			pane:{
				background: [{
					borderWidth: 0
				}]
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				categories: ['SMART', 'SAS']
			},
			yAxis: {
				min: 0,
				max: 100,
				title: {
					text: 'Persentase'
				}
			},
			tooltip: {
				formatter: function () {
					return this.series.name + ': ' + this.y;
				}
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style: {
							textShadow: '0 0 3px black'
						}
					},
					borderWidth: 0 // < set this option
				}
			},
				series: 
				[
					{
						name: 'Sisa',
						data: [<?= $ch1[0]->smt_sisa_persen ?>, <?= $ch1[0]->sas_sisa_persen ?>]
					},
					{
						name: 'Realisasi',
						data: [<?= $ch1[0]->smt_real_persen ?>, <?= $ch1[0]->sas_real_persen ?>]
					}
				]
		});
	});
</script>