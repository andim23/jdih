<?php
    foreach($result as $row){
?>  
<!-- POST ITEM -->
<div class="blog-post wow fadeIn pb-50">        
    <div class="post-prev-title">
      <h3><a href="#"><?= $row->produk_hukum ?></a></h3>
      <h4><a href="#"><?= $row->judul ?></a></h4>
      <h5><a href="#"><?= $row->subjudul ?></a></h5>
    </div>
  
    <div class="post-prev-info">
      <?= TglIndoSaja($row->tanggal) ?><span class="slash-divider">/</span>
      <a href="#"><?= $row->userinput_name ?></a><span class="slash-divider">/</span>
      <a href="#"><?= $row->kategori ?></a>
    </div>
  
	<div class="post-prev-text">    
      <?php if( !empty($row->abstrak) ){ ?>
      <blockquote class="mb-40 mt-40">
        <h3>Abstrak</h3>
		<?= $row->abstrak ?>
      </blockquote>
      <hr class="mt-20 mb-20">
      <?php } ?>
      <!-- DIVIDER -->
      <?= $row->isi ?>
      <hr class="mt-20 mb-20">
      <h3>Berkas</h3>
	  <ul style="list-style:none; padding-left:0px;">
	  <?php
      	foreach($attach as $rt){
	  ?>
      	<li>
      	<a href="<?= base_url() ?>upload/produk_hukum/<?= $rt->filename ?>" target="_blank" style="font-weight:bold;"><span class="icon icon-basic-download"></span>&nbsp; <?= $rt->filename ?> (<?= $rt->filesize_kb ?> KB)</a>
      	</li>
	  <?php } ?>
      </ul>
    </div>
</div>

<!-- COMMENTS -->
<div id="comments" class="mt-0">

    <h4 class="blog-page-title mb-15">Komentar<small><span class="slash-divider">/</span> <?= $row->total_komentar ?></small></h4>

    <ul class="media-list text comment-list">
        <?php foreach($komentar as $rk){ ?>
        <!-- Comment Item -->
        <li class="media comment-item">
            <!--<a class="pull-left" href="#"><img class="media-object comment-avatar" src="images/content/avatar-1.png" alt="ava"></a>-->
            
            <div class="media-body">                   
              <div class="comment-item-title">
                <div class="comment-author">
                  <a href="#"><?= $rk->nama ?></a>
                </div>
                <div class="comment-date">
                  <?= TglIndo($rk->dateinput) ?>
                  <!--<span class="slash-divider">-</span>
                  <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">REPLY</a>-->
                </div>
              </div> 
              <p class="pb-30"><?= $rk->komentar ?></p>
            </div>
            
        </li>
        <!-- End Comment Item -->
        <?php } ?>
    </ul>

</div>

<!-- DIVIDER -->
<hr class="mt-0 mb-0">

<!-- LEAVE A COMMENT	-->
<!-- CONTACT FORM -->
<div class="grey-light-bg leave-comment-cont">
<!-- TITLE -->
<h4 class="blog-page-title mt-50 mb-25">Beri Komentar</h4>              
    <div class="contact-form-container">
        <form id="contact-form" action="<?= base_url() ?>Frontend/komentar_proses" method="POST">
        	<input type="hidden" name="id_produk_hukum" id="id_produk_hukum" value="<?= $this->uri->segment(4) ?>" />
            <div class="row">
                <div>
                    <div class="col-md-6 mb-30">
                         <!--<label>NAMA *</label> -->
                        <input type="text" value="" data-msg-required="Masukkan Nama Anda" maxlength="100" class="controled" name="nama" id="nama" placeholder="NAMA">
                    </div>
                    <div class="col-md-6 mb-30">
                         <!--<label>EMAIL *</label> -->
                        <input type="text" value="" data-msg-required="Masukkan Email Anda" data-msg-email="Masukkan Email Anda" maxlength="100" class="controled" name="email" id="email" placeholder="EMAIL">
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="col-md-12 mb-40">
                         <!--<label>KOMENTAR *</label> -->
                        <textarea maxlength="5000" data-msg-required="Masukkan Pesan Anda" rows="3" class="controled" name="komentar" id="komentar" placeholder="Masukkan Pesan Anda"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12 mb-40">
                	<div class="g-recaptcha" data-sitekey="6LcBCjcUAAAAAMy89RYCxrusq2Om-eHVnAF06R41"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="KIRIM PESAN" id="save-btn" class="button medium gray" data-loading-text="Loading...">
                </div>
            </div>
        </form>	
        <div class="alert alert-success hidden animated fadeIn" id="contactSuccess" >
            <strong>Berhasil!</strong> Pesan anda terkirim.
        </div>

        <div class="alert alert-danger hidden animated shake" id="contactError">
            <strong>Gagal!</strong> Pesan anda gagal terkirim.
        </div>
    </div>
</div>

<?php } ?>
<?php if(empty($result)){ 
	exit;
} ?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	$("#contact-form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
        var data = $("#contact-form").serialize();
        $.ajax({
            cache: false,
            type: "post",
            url: url,
            data: data,
            success: function (response) {
                $("#save-btn").text("Simpan").removeAttr("disabled");
                var data = JSON.parse(response);
                var status = data.status;
                var message = data.message;
                if (status == '1') {
					$("#contact-form").remove();
					$("#contactError").addClass('hidden');
                    $("#contactSuccess").removeClass('hidden');
                } else {
                    $.each(data.message, function (key, value) {
                        var element = $('#contact-form  #' + key);
                        element.closest('#contact-form div')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
						
                    });
                    $("#save-btn").text('KIRIM PESAN').removeAttr("disabled");
					
					$("#contactSuccess").addClass('hidden');
					$("#contactError").removeClass('hidden');
                }
            },
            beforeSend: function () {
                $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
            },
            error: function () {
                $("#save-btn").text('KIRIM PESAN').removeAttr("disabled");
            }
        });

    });
</script>