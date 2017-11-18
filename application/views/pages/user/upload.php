<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Konten_statis/proses" id="admin_konten_statis_form">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <div class="dropzone" id="upload_file"></div>
                <input type="hidden" name="gambar" id="gambar" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <p>
                    <span class="label label-danger">NOTE: </span>
                    &nbsp; This plugins works only on Latest Chrome, Firefox, Safari, Opera &amp; Internet Explorer 10.
                </p>
            </div>
            <div class="col-md-4 col-md-offset-2 dropzone-previews" id="image_content"></div>
            <div class="col-md-6"></div>
        </div>
        </form>
    </div>
</div>