<h1> <?= $this->auth_username; ?></h1>

<h4>Informasi Umum</h4>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td width="200">Biro</td>
    <td id="biro_txt"><?= isset($profile[0]->biro)?$profile[0]->biro:''; ?></td>
  </tr>
  <tr>
    <td width="200">Nama Lengkap/Panggilan</td>
    <td><?= isset($profile[0]->fullname)?$profile[0]->fullname:''; ?> / <?= isset($profile[0]->nickname)?$profile[0]->nickname:''; ?></td>
  </tr>
  <tr>
    <td>Telp</td>
    <td><?= isset($profile[0]->usertelpno)?$profile[0]->usertelpno:''; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?= isset($profile[0]->email)?$profile[0]->email:''; ?></td>
  </tr>
</table>