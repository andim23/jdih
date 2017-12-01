<div class="col-md-10 col-md-offset-1">
    <h3>Pengajuan Permohonan Terakhir</h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
      <tr class="heading">
        <th>No Pengajuan</th>
        <th>Tanggal</th>
        <th>Judul</th>
        <th>Status</th>
      </tr>
      <?php foreach($permohonan as $row){ ?>
      <tr>
        <td><?= $row->no_permohonan ?></td>
        <td><?= TglIndo($row->tanggal) ?></td>
        <td><?= $row->judul ?></td>
        <td>
            <strong>
                <a title="Klik disini untuk melihat detail" href="<?= base_url() ?>permohonan/status_detail/<?= $row->id_permohonan ?>?x=5&y=7">
                    <?= $row->status ?>
                </a>
            </strong>
        </td>
      <?php } ?>  
      </tr>
    </table>
    
    <?php 
		if( empty($permohonan) ) 
		echo "Data permohonan tidak tersedia";
	?>
</div>