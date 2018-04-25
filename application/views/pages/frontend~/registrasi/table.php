<div class="col-md-12">
	<h2 class="section-title mb-50">FORM REGISTRASI</h2>
    
    <form id="contact-form" action="php/contact-form.php" method="POST" novalidate="novalidate">
    
    <div class="row">
        <div class="col-md-12 mb-30">
            <label>PENGUSUL *</label> 
            <input type="text" value="" class="controled" name="pengusul" id="pengusul" >
        </div>
    </div>
    
    <div class="row">    
        <div class="col-md-12 mb-30">
        <p>
        	<label>JENIS PRODUK HUKUM *</label>
        </p>
        <select class="" name="id_kategori" id="id_kategori" class="controled" style="width:100%;">
        	<?php foreach($dkategori as $rk){ ?>
            <option value="<?= $rk->id_kategori ?>"><?= $rk->kategori ?></option>
            <?php } ?>
        </select>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-30">
            <label>JUDUL RANCANGAN PRODUK HUKUM *</label> 
            <input type="text" value="" class="controled" name="judul" id="judul" >
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-30">
            <label>KELENGKAPAN DOKUMEN</label> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-11 col-md-offset-1  mb-30">
            <label>1. NOTA DINAS</label> 
        </div>
        
        <div class="col-md-2 col-md-offset-2  mb-30">
        	<label>NOMOR</label>
        </div>
        
        <div class="col-md-8  mb-30">
        	<input type="text" value="" class="controled" name="no_nota_dinas" id="no_nota_dinas" >
        </div>
        
        <div class="col-md-2 col-md-offset-2 mb-30">
        	<label>TANGGAL</label>
        </div>
        
        <div class="col-md-8  mb-30">
        	<input type="text" value="" class="controled" name="tanggal_nota_dinas" id="tanggal_nota_dinas" >
        </div>
        
        <div class="col-md-2 col-md-offset-2  mb-30">
        	<label>DOKUMEN</label>
        </div>
        <div class="col-md-8  mb-30">
        	<a class="button medium teal" href="#">Unggah</a>
            <span class="help-block">Format pdf, doc, docx, jpg, png</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-11 col-md-offset-1  mb-30">
            <label>2. POSITION PAPER</label> 
        </div>
        
        <div class="col-md-2 col-md-offset-2  mb-30">
        	<label>DOKUMEN</label>
        </div>
        
        <div class="col-md-8">
        	<a class="button medium teal" href="#">Unggah</a>
            <span class="help-block">Format pdf, doc, docx, jpg, png</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-11 col-md-offset-1  mb-30">
            <label>3. DRAFT RANCANGAN</label> 
        </div>
        
        <div class="col-md-2 col-md-offset-2  mb-30">
        	<label>DOKUMEN</label>
        </div>
        
        <div class="col-md-8">
        	<a class="button medium teal" href="#">Unggah</a>
            <span class="help-block">Format pdf, doc, docx, jpg, png</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-30">
            <label>TAHAPAN PEMBAHASAN</label> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-2 col-md-offset-2  mb-30">
        	<label>DOKUMEN</label>
        </div>
        
        <div class="col-md-8">
        	<a class="button medium teal" href="#">Unggah</a>
            <span class="help-block">Format pdf, doc, docx, jpg, png</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-40 mt-100">
         <label>PESAN TAMBAHAN</label> 
        <textarea rows="3" class="controled" name="message" id="message"></textarea>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-40">
            <div class="g-recaptcha" data-sitekey="6LcBCjcUAAAAAMy89RYCxrusq2Om-eHVnAF06R41"></div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 text-center-xxs">
        <input type="submit" value="REGISTRASI" class="button medium gray" data-loading-text="Loading...">
        </div>
    </div>
    
    </form>	
    <div class="alert alert-success hidden animated fadeIn" id="contactSuccess">
    	Thanks, your message has been sent to us.
    </div>
    
    <div class="alert alert-danger hidden animated shake" id="contactError">
    	<strong>Error!</strong> There was an error sending your message.
    </div>
</div>


<script src='https://www.google.com/recaptcha/api.js'></script>