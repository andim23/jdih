<!-- PAGE TITLE SMALL -->
<div class="page-title-cont page-title-large grey-dark-bg page-title-img  pt-100" 
	style="background-image: url(<?= base_url() ?>theme/templates/frontend2/images/about-me.jpg"
>
  	<?php $this->load->view('pages/frontend/pencarian/cari_multi'); ?>
</div>

<!-- COTENT CONTAINER -->
<div class="container pt-50">
    <div class="row">
        <!-- CONTENT -->
        <div class="col-sm-8 blog-main-posts">
            <?php include("detail.php") ?>
        </div>
        
        <!-- SIDEBAR -->
        <div class="col-sm-4 col-md-3 col-md-offset-1">
            <!-- WIDGET -->
            <div class="widget">        
        		<h5 class="widget-title">Produk Hukum Terbaru</h5>        
                <div class="widget-body">
                  <ul class="clearlist widget-posts">
                    <?php foreach( $terbaru as $rt ){ ?>
                    <li class="clearfix">
                      <a href=""><img src="images/blog/recent/1.jpg" alt="" class="widget-posts-img"></a>
                      <div class="widget-posts-descr">
                        <a href="<?= base_url() ?>frontend/detail/<?= $this->uri->segment(3) ?>/<?= $this->uri->segment(4) ?>" title="">
						<?= $rt->judul ?>
                        </a>
                        <div><?= TglIndoSaja($rt->tanggal) ?><span class="slash-divider">/</span> <?= $rt->userinput_name ?></div> 
                      </div>
                    </li>
                	<?php } ?>
                  </ul>
                </div>
        	</div>
        </div>
    </div>
</div>