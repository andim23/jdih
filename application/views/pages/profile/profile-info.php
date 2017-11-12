<h1> <?= $this->auth_username; ?></h1>

<h4>Informasi Umum</h4>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
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
    <td><?= isset($profile[0]->useremail)?$profile[0]->useremail:''; ?></td>
  </tr>
</table>