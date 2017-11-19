<div id="chart1" style="height: 425px;" class="col-md-12"></div>

<?php 
	$nm = "";
	$total = "";

	foreach($chart1 as $row){
		$nm .= "'" . $row->status . "',";
		$total .= $row->total . ",";
	}
?>

<script>
	$(function () {
		$('#chart1').highcharts({
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
				text: 'Summary per Status Permohonan'
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
				name: 'Status Permohonan',
				data: [<?= $total ?>]
			}
			]
		});
	});
</script>