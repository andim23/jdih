<!-- PAGE TITLE SMALL -->
<!--background-image: url(<?= base_url() ?>theme/templates/frontend2/images/about-me.jpg)-->
<div class="page-title-cont page-title-large grey-dark-bg page-title-img  pt-100" 
	style="background-image: url(<?= base_url() ?>theme/templates/frontend2/images/about-me.jpg"
>
  	<?php $this->load->view('pages/frontend/pencarian/cari_single'); ?>
</div>

<!-- COTENT CONTAINER -->
<div class="container p-140-cont">
  <div class="row">
  
    <!-- CONTENT -->
    <div class="col-sm-12 blog-main-posts">
  		<?php
        	for($i=0; $i<5; $i++){
		?>
      	<!-- Post Item -->
        <div class="wow fadeIn pb-70">
        
            <div class="post-prev-title">
              <h3><a href="blog-single-sidebar-right.html">TIME FOR MINIMALISM</a></h3>
            </div>
          
            <div class="post-prev-info">
                JULE 10
                <span class="slash-divider">/</span>
                <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">JOHN DOE</a>
                <span class="slash-divider">/</span>
                <a href="#">DESIGN</a>, <a href="#">DEVELOPMENT</a>
            </div>
        
          
            <div class="post-prev-text">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, nostrum, 
              cumque culpa provident aliquam commodi assumenda laudantium magnam illo nostrum. 
              Donec nibh sapien, molestie quis elementum et, dim non atino ipsum. 
            </div>
          
            <div class="post-prev-more-cont clearfix">
                <div class="post-prev-more left">
                	<a href="blog-single-sidebar-right.html" class="blog-more">READ MORE</a>
              	</div>
                
                <div class="right" >
                    <a href="blog-single-sidebar-right.html#comments" class="post-prev-count">
                    	<span aria-hidden="true" class="icon_comment_alt"></span>
                    	<span class="icon-count">21</span>
                    </a>
                    
                    <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" class="post-prev-count">
                    	<span aria-hidden="true" class="icon_heart_alt"></span>
                    	<span class="icon-count">53</span>
                    </a>
                    
                    <a href="#" class="post-prev-count dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                      	<span aria-hidden="true" class="social_share"></span>
                    </a>
                    
                    <ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#"><span aria-hidden="true" class="social_facebook"></span></a></li>
                        <li><a href="#"><span aria-hidden="true" class="social_twitter"></span></a></li>
                        <li><a href="#"><span aria-hidden="true" class="social_dribbble"></span></a></li>
                    </ul>
              	</div>
            </div>
        </div>
		<!-- Post Item -->
        <?php } ?>
    </div>
	<!-- CONTENT -->
    
    <!-- PAGINATION -->
    <div class="mt-0">
      <nav class="blog-pag">
        <ul class="pagination m-0">
        <li><a href="#"><i class="fa fa-angle-left"></i><span class="sr-only">Previous</span></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#"><i class="fa fa-angle-right"></i><span class="sr-only">Next</span></a></li>
        </ul>
      </nav>
    </div>
    
  </div>
</div>