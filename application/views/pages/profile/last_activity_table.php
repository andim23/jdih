<table class="table table-striped table-bordered table-advance table-hover">
<thead>
<tr>
    <th>
        <i class="fa fa-calendar"></i> Tanggal
    </th>
    <th>
        <i class="fa fa-edit"></i> Tipe Aktifitas
    </th>
    <th>
        <i class="fa fa-bookmark"></i> Ketarangan
    </th>
    <th>
    	<i class="fa fa-money"></i>
    	Poin
    </th>
</tr>
</thead>
<tbody>
<?php
	foreach($last_act as $row){
?>
<tr>
    <td>
        <?= TglIndo($row->logdate) ?>
    </td>
    <td class="hidden-xs">
         <?= $row->action ?>
    </td>
    <td>
         <?= $row->logname ?>
    </td>
    <td align="right">
        <?= $row->used_user_rating_weight ?>
    </td>
</tr>
<?php } ?>
</tbody>
</table>
<?php if( empty($last_act) ){ ?>
<div class="alert alert-warning">
	Data tidak ditemukan.
</div>
<?php } ?>