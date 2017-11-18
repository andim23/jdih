<link href="<?= base_url() ?>theme/assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-md-12">
        <ul class="timeline">
            <?php
				$i = 0; 
				$c = count($his);
				
				$class = '';
				
				$arrc = array(
					'timeline-yellow', 'timeline-blue', 'timeline-green',
					'timeline-purple', 'timeline-red', 'timeline-grey'
				);
				
				foreach($his as $rh){ 
				$i++;
				$class = "";
				if($i == $c)
					$class = 'timeline-noline';
					
				$x = round($i % 5);

				$class .= ' ' . $arrc[$x];
			?>
            <li class="<?= $class ?>">
                <div class="timeline-time">
                    <span class="date">
                    <?= $rh->dateinput_char ?> </span>
                    <span class="">
                    	<h3><?= $rh->status ?> </h3>
                    </span>
                </div>
                <div class="timeline-icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="timeline-body">
                    <h2 style="font-size:20px;"><?= $rh->judul ?></h2>
                    <div class="timeline-content">
                        <?= $rh->notes ?>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>