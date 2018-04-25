<form class="form-horizontal">
<div class="form-group">
	<label class="control-label col-md-2">Jenis Produk Hukum</label>
    <div class="col-md-8">
        <select class="form-control" name="id_kategori" id="id_kategori">
            <option value="">Semua</option>
            <?php foreach( $kategori as $row ){ ?>
            <option value="<?= $row->id_kategori ?>"><?= $row->kategori ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
    	<button type="button" name="btn-filter" id="btn-filter" class="btn green btn-block"><i class="fa fa-filter"></i> Tampilkan</button>
    </div>
</div>
</form>
<div class="table-group-actions pull-right">  
    <button class="btn btn-sm yellow filter-submit margin-bottom" title="Cari"><i class="fa fa-search"></i> Cari</button>
    <button class="btn btn-sm red filter-cancel" title="Reset"><i class="fa fa-times"></i> Reset</button>
</div>
<table class="table table-striped table-bordered table-hover" id="datatable">
    <thead>
        <tr role="row" class="heading">
            <th width="50">No</th>
            <th>Tahun</th>
            <th>Jenis</th>
            <th>Judul</th>
            <th>Subjudul</th>
            <th width="50">&nbsp;</th>
        </tr>
        <tr role="row" class="filter">
            <td>&nbsp;</td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="tahun"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="kategori"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="judul"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="subjudul"></td>
            <td align="center">&nbsp;</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>