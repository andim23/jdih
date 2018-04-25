<!-- Post Item carousel -->
<div class="wow fadeIn pb-10" >
    <!-- CAOUSEL  -->
    <div class="fullwidth-slider-auto owl-carousel owl-dark-bg owl-pag-2 owl-arrows-bg post-prev-img" style="height:300px;">
    	<?php
        	foreach($dslide as $rs){
		?>
    	<!-- ITEM -->		
        <div class="item m-0">	
            <div>
            <img alt="about us" src="<?= base_url() ?>upload/slider/<?= $rs->gambar ?>">
            </div>
        </div>
		<?php } ?>
    
    </div>
    <!-- CAOUSEL  -->
</div>
<!-- Post Item carousel -->