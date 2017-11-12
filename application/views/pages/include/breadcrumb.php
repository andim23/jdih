<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= base_url() ?>page">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <?php
			$i=0; 
			foreach( $breadcrumb as  $row=>$key ){ 
				$i++;
		?>
        <li><a href="<?= $key ?>"><?= $row ?></a>
        	<?php if( $i != count($breadcrumb) ){ ?>
                <i class="fa fa-angle-right"></i>
            <?php } ?>
        </li>
        <?php } ?>
    </ul>
</div>