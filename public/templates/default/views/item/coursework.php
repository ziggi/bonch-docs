<table class="table">
	<thead>
		<tr>
			<th>Имя</th>
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

foreach ($data as $row) {
	if (isset($row['PackFileHash']) && $row['PackFileHash'] != 0) {
		$pack_file_hash = $row['FileHash'];
		continue;
	}
	$desc = null;
	if (!empty($row['Description'])) {
		$desc = "<a href=\"#about_".$row['FileHash']."\" role=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\">Описание</a>";
	}
	echo "
<tr>
	<td>".$row['Name']."</td>
	<td>".$row['EditionDate']."</td>
	<td><span class=\"pull-right\">".$desc." <a href=\"".SITE_URL."item/download/".$row['FileHash']."\" class=\"btn btn-default btn-sm\">Скачать</a></span></td>
</tr>";
}
?>
	</tbody>
</table>
<?php if ($pack_file_hash != null): ?>
	<p class="text-center"><a href="<?=SITE_URL?>item/download/<?=$pack_file_hash?>" class="btn">Скачать все курсовые за семестр</a></p>
<?php endif; ?>

<?php foreach ($data as $row):
	if (empty($row['Description'])) {
		continue;
	}
?>
<div id="about_<?=$row['FileHash']?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Описание курсовой работы</h3>
			</div>
			<div class="modal-body">
				<p><?=$row['Description']?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>
