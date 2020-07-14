<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=$title.xls");
// header("Pragma: no-cache");
// header("Expires: 0");
?>
<h1 align="center"><?= $title ?></h1>
<?php if (!empty($tgl)): ?>
    <h5 align="center"><?= $tgl ?></h5>
<?php endif ?>
<table border="1" width="100%">
  <thead>
   <tr>
    <th>No.</th>
    <th>Nama Wakif</th>
    <th>Nominal Wakaf</th>
    <th>Biaya Admin Platform</th>
    <th>Biaya Admin Bank</th>
    <th>Total Wakaf</th>
    <th>Tanggal Wakaf</th>
  </tr>
</thead>
<tbody>
  <?php 
  $no=0; 
  foreach($dataWakif as $value) { 
    $no++;
    ?>
    <tr>
      <td><?php echo $no; ?>.</td>
      <td><?php echo $value->on_behalf; ?></td>
      <td><?php echo number_format($value->total); ?></td>
      <td><?php echo "-"; ?></td>
      <td><?php echo "-"; ?></td>
      <td><?php echo number_format($value->total); ?></td>
      <td><?php echo $value->created_date; ?></td>
    </tr>
  <?php } ?>
</tbody>
</table>