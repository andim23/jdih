<div id="chart3" style="height: auto;" class="col-md-12"></div>

<?php 
	$nm = "";
	$total_poin = "";
	foreach($ch3 as $row){
		$nm .= "'" . $row->logtypename . "',";
		$total_poin .= $row->total_poin . ",";
	}
?>

<script>
	$(function () {
		
		Highcharts.setOptions({
			colors: ['#2980b9']
		});
		
		$('#chart3').highcharts({
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
				text: 'USER RATING'
			},
			subtitle: {
				text: 'Periode 1 Januari s/d 31 Desember <?= date('Y') ?>'
			},
			xAxis: {
				categories: [<?= $nm ?>],
				title: {
					text: null
				}
			},
			yAxis: {
				min: 0,

				title: {
					text: 'Total Poin',
					align: 'middle'
				},
				labels: {
					overflow: 'justify'
				}
			},
			tooltip: {
				valueSuffix: ''
			},
			credits: {
				enabled: false
			},
			series: [
				{
					name: 'Total Poin',
					data: [<?= $total_poin ?>]
				}
			]
		});
	});
</script>