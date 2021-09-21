<?php

if (isset($data['errorMsg'])) {
	echo "<p>" . $data['errorMsg'] . "</p>";
	return;
}
$last_position = $data['lastPosition'];
$first_position = $data['firstPosition'];

unset($data['lastPosition']);
unset($data['firstPosition']);

?>
<?php foreach ($data as $value): ?>
	<h4><?=$value['Title']?>
		<small class="pull-right" style="font-size: 10px">
<?php
$up_pos = $value['Position'] - 1;
if ($up_pos >= $first_position) {
	echo '<a href="' . SITE_URL . 'admin/page/update/' . $value['Name'] . '/position/up"><span class="glyphicon glyphicon-arrow-up"></span></a>';
}

$down_pos = $value['Position'] + 1;
if ($down_pos <= $last_position) {
	echo ' <a href="' . SITE_URL . 'admin/page/update/' . $value['Name'] . '/position/down"><span class="glyphicon glyphicon-arrow-down"></span></a>';
}
?>
			<a href="#page_<?=$value['Name']?>" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span></a>
			<a href="<?=SITE_URL?>admin/page/delete/<?=$value['Name']?>"><span class="glyphicon glyphicon-trash"></span></a>
		</small>
	</h4>


<div id="page_<?=$value['Name']?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?=SITE_URL?>admin/page/edit" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Редактирование</h3>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="form-group">
							<label for="inputName">Имя</label>
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Имя" value="<?php echo $value['Name']?>">
						</div>
						<div class="form-group">
							<label for="inputTitle">Заголовок</label>
							<input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Заголовок" value="<?php echo $value['Title']?>">
						</div>
						<div class="form-group">
							<label for="inputText">Текст</label>
							<textarea type="text" class="form-control" rows="8" id="inputText" name="inputText" placeholder="Текст"><?php echo $value['Text']?></textarea>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Отправить</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach ?>
