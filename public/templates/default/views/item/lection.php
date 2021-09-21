<table class="table">
	<thead>
		<tr>
			<th>№</th>
			<th>Дата лекции</th>
			<th>Дата изменения</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
if (isset($data[0])) {
	unset($data[0]);
}
$pack_file_hash = null;

$k = 0;
foreach ($data as $row) {
	if (isset($row['PackFileHash']) && $row['PackFileHash'] != 0) {
		$pack_file_hash = $row['FileHash'];
		continue;
	}
	echo "
<tr>
	<td>".(++$k)."</td>
	<td>".$row['CreationDate']."</td>
	<td>".$row['EditionDate']."</td>
	<td><a href=\"".SITE_URL."item/download/".$row['FileHash']."\" class=\"btn btn-default btn-sm pull-right\">Скачать</a></td>
</tr>
	";
}
?>
	</tbody>
</table>
<?php if ($pack_file_hash != null): ?>
	<p class="text-center"><a href="<?=SITE_URL?>item/download/<?=$pack_file_hash?>" class="btn btn-default">Скачать все лекции за семестр</a></p>
<?php endif; ?>
