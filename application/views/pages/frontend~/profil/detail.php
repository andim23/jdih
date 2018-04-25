<style>
	#gmap_geocoding{
		height:500px;
	}
</style>
<h2 class="section-title mb-50">KONTAK KAMI</h2>

<?php
	$filename = isset($result[0]->filename)?$result[0]->filename:"";
?>
<?php
	if( !empty($filename) ){
?>
    <div class="post-prev-img">
      <a href="blog-single-sidebar-right.html"><img src="<?= base_url() ?>upload/konten_statis/<?= $filename ?>" alt="img"></a>
    </div>
<?php } ?>

<div id="gmap_geocoding" class="gmaps mb-50"></div>

<?= isset($result[0]->isi)?$result[0]->isi:""; ?>


<!-- LEAVE A COMMENT	-->
<!-- CONTACT FORM -->
<div class="grey-light-bg leave-comment-cont mt-50">
<!-- TITLE -->
<h4 class="blog-page-title mt-50 mb-25">FORM KONTAK KAMI</h4>              
    <div class="contact-form-container">
        <form id="contact-form" action="<?= base_url() ?>Frontend/kontak_proses" method="POST">
        	<input type="hidden" name="id_produk_hukum" id="id_produk_hukum" value="<?= $this->uri->segment(4) ?>" />
            <div class="row">
                <div>
                    <div class="col-md-6 mb-30">
                        <label>NAMA *</label> 
                        <input type="text" value="" maxlength="100" class="controled" name="nama" id="nama">
                    </div>
                    <div class="col-md-6 mb-30">
                        <label>EMAIL *</label> 
                        <input type="text" value="" class="controled" name="email" id="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="col-md-12 mb-40">
                        <label>SUBJEK *</label> 
                        <input type="text" value="" class="controled" name="subjek" id="subjek">
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="col-md-12 mb-40">
                        <label>PESAN *</label> 
                        <textarea rows="3" class="controled" name="pesan" id="pesan"></textarea>
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

<script src="http://maps.google.com/maps/api/js?key=AIzaSyBHatAf0FiABgQeJa0TUsffRBUmohRCGv0" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	$(document).ready(function(e) {
        var lat = <?= LAT ?>;
		var lng = <?= LNG ?>;
		
		var map = new GMaps({
			div: '#gmap_geocoding',
			lat: lat,
			lng: lng
		});
		
		map.zoomIn(3);
		map.removeMarkers();
		map.setCenter(lat, lng);
		map.addMarker({
			lat: lat,
			lng: lng
		});
    });
	
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