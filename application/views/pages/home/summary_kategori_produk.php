<div id="chart2" style="height: 425px;" class="col-md-12"></div>

<?php 
	$nm = "";
	$total = "";

	foreach($chart2 as $row2){
		$nm .= "'" . $row2->kategori . "',";
		$total .= $row2->total . ",";
	}
?>

<script>
	$(function () {
		$('#chart2').highcharts({
			chart: {
				type: 'bar',
				options3d: {
					enabled: true,
					alpha: 0,
					beta: 26
				},
			},
			exporting: { enabled: false },
			title: {
				text: 'Summary per Kategori Permohonan'
			},
			subtitle: {
				text: ''
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
				title: {
					text: 'Jumlah Permohonan',
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
				bar: {
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
				name: 'Kategori Permohonan',
				data: [<?= $total ?>]
			}
			]
		});
	});
</script>