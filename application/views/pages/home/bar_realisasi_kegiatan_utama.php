<div id="chart2" style="height: 425px;" class="col-md-12"></div>

<?php 
	$nm = "";
	$smt_real = "";
	$smt_sisa = "";

	foreach($ch2 as $row){
		$nm .= "'" . $row->nmoutput . "',";
		$smt_real .= $row->smt_real_persen . ",";
		$smt_sisa .= $row->smt_sisa_persen . ",";
	}
?>

<script>
	$(function () {
		$('#chart2').highcharts({
			chart: {
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 0,
					beta: 26
				},
			},
			exporting: { enabled: false },
			title: {
				text: 'REALISASI KEUANGAN PER KEGIATAN UTAMA '
			},
			subtitle: {
				text: 'Sumber: SMART<br><?= $ch2[0]->smt_lastupdate_display ?>'
			},
			xAxis: {
				categories: [<?= $nm ?>],
				title: {
					text: null
				},
				labels: {
					style: {
						fontSize: '10px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				max:100,
				title: {
					text: 'Persentase',
					align: 'middle'
				},
				labels: {
					overflow: 'justify'
				}
			},
			tooltip: {
				valueSuffix: ''
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
					}
				}
			},
			
			credits: {
				enabled: false
			},
			series: [
			{
				name: 'Sisa',
				data: [<?= $smt_sisa ?>]
			},
			{
				name: 'Realisasi',
				data: [<?= $smt_real ?>]
			}
			]
		});
	});
</script>