<!-- CONTENT -->    
    <div class="col-sm-12 blog-main-posts">
        <?php
            foreach($result as $row){
        ?>
        <!-- Post Item -->
        <div class="wow fadeIn pb-70">
        
            <div class="post-prev-title">
              <h3><a href="<?= base_url() ?>frontend/detail/<?= $row->id_kategori ?>/<?= $row->id_produk_hukum ?>"><?= $row->judul ?></a></h3>
            </div>
          
            <div class="post-prev-info">
                <?= TglIndoSaja($row->tanggal) ?>
                <span class="slash-divider">/</span>
                <?= $row->userinput_name ?>
                <span class="slash-divider">/</span>
                <?= $row->kategori ?>
            </div>
        
          
            <div class="post-prev-text">
              <?= PotongKata(strip_tags($row->abstrak),100) ?>
            </div>
          
            <div class="post-prev-more-cont clearfix">
                <div class="post-prev-more left">
                    <a href="<?= base_url() ?>frontend/detail/<?= $row->id_kategori ?>/<?= $row->id_produk_hukum ?>" class="blog-more">Selengkapnya</a>
                </div>
                
                <div class="right" >
                    <a href="blog-single-sidebar-right.html#comments" class="post-prev-count">
                        <span aria-hidden="true" class="icon_comment_alt"></span>
                        <span class="icon-count"><?= $row->total_komentar ?></span>
                    </a>
                    
                    <!--<a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" class="post-prev-count">
                        <span aria-hidden="true" class="icon_heart_alt"></span>
                        <span class="icon-count">53</span>
                    </a>-->
                    
                    <!--<a href="#" class="post-prev-count dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                        <span aria-hidden="true" class="social_share"></span>
                    </a>-->
                    
                    <!--<ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#"><span aria-hidden="true" class="social_facebook"></span></a></li>
                        <li><a href="#"><span aria-hidden="true" class="social_twitter"></span></a></li>
                        <li><a href="#"><span aria-hidden="true" class="social_dribbble"></span></a></li>
                    </ul>-->
                </div>
            </div>
        </div>
        <!-- Post Item -->
        <?php } ?>
        <?php if(empty($result)){ ?>
        <div class="col-md-12">
            <div class="alert alert-danger">
                Data tidak ditemukan
            </div>
        </div>
        <?php } ?>
    </div>
<!-- CONTENT -->

<!-- PAGINATION -->
    <div class="mt-0">
      <nav class="blog-pag">
      	<center>
        <?= $pagination ?>
      	</center>
      </nav>
    </div>