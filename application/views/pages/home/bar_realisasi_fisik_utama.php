<div id="chart3" style="height: 425px;" class="col-md-12"></div>

<?php 
	$nm = "";
	$fisik_realisasi = "";
	$fisik_sisa = "";
	foreach($ch3 as $row){
		$nm .= "'" . $row->nmoutput . "',";
		$fisik_realisasi .= $row->fisik_realisasi_persen . ",";
		$fisik_sisa .= $row->fisik_sisa_persen . ",";
	}
?>

<script>
	$(function () {
		$('#chart3').highcharts({
			chart: {
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 0,
					beta: 26
				}
			},
			exporting: { enabled: false },
			title: {
				text: 'REALISASI FISIK KEGIATAN UTAMA'
			},
			subtitle: {
				text: 'Sumber: MPO<br><?= $ch3[0]->lastupdate_display ?>'
			},
			xAxis: {
				categories: [<?= $nm ?>],
				title: {
					text: null
				}
			},
			yAxis: {
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
				data: [<?= $fisik_sisa ?>]
			},
			{
				name: 'Realisasi',
				data: [<?= $fisik_realisasi ?>]
			}]
		});
	});
</script>