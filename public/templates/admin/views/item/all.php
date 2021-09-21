<?php

if (isset($data['errorMsg'])) {
	echo "<p>" . $data['errorMsg'] . "</p>";
	return;
}

$categories = $data['categories'];
unset($data['categories']);

?>
<table class="table">
	<thead>
		<tr><th>#</th><th>Имя</th><th>Категория</th><th>Загрузок</th><th></th><th></th></tr>
	</thead>
	<tbody>
<?php foreach ($data as $value): ?>

		<tr>
			<td><?=$value['Id']?></td>
			<td><?=$value['Name']?></td>
			<td><?=$value['Category']?></td>
			<td><?=$value['Downloads']?></td>
			<td>
				<a href="#page_<?=$value['Id']?>" data-toggle="modal" data-target="#edit_<?=$value['Id']?>"><span class="glyphicon glyphicon-edit"></span></a>

<div class="modal fade" id="edit_<?=$value['Id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Изменить контент</h4>
			</div>
			<form class="form-horizontal" method="post" action="<?=SITE_URL?>admin/item/edit" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="inputFile" class="col-lg-2 control-label">Файл</label>
						<div class="col-lg-10">
							<input type="file" id="inputFile" name="inputFile">
						</div>
					</div>
					<div class="form-group">
						<label for="inputCategory" class="col-lg-2 control-label">Категория</label>
						<div class="col-lg-3">
							<select class="form-control" id="inputCategory" name="inputCategory">
								<?php
								foreach ($categories as $row) {
									echo "<option>" . $row['Label'] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputType" class="col-lg-2 control-label">Тип</label>
						<div class="col-lg-3">
							<select class="form-control" id="inputType" name="inputType">
								<option>Лекции</option>
								<option>Лабораторные</option>
								<option>Курсовые работы</option>
								<option>Разное</option>
								<option>Практика</option>
							</select>
					</div>
					</div>
					<div class="form-group">
						<label for="inputName" class="col-lg-2 control-label">Имя</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Имя">
						</div>
					</div>
					<div class="form-group">
						<label for="inputAbout" class="col-lg-2 control-label">Метки</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="inputAbout" name="inputAbout" placeholder="Метки">
						</div>
					</div>
					<div class="form-group">
						<label for="CreationDate" class="col-lg-2 control-label">Дата создания</label>
						<div class="col-lg-3">
							<input type="text" class="form-control" id="CreationDate" name="CreationDate" value="<?=date("Y-m-d")?>" placeholder="Дата создания">
						</div>
					</div>
					<div class="form-group">
						<label for="EditionDate" class="col-lg-2 control-label">Дата изменения</label>
						<div class="col-lg-3">
							<input type="text" class="form-control" id="EditionDate" name="EditionDate" value="<?=date("Y-m-d")?>" placeholder="Дата изменения">
						</div>
					</div>
					<div class="form-group">
						<label for="inputDescription" class="col-lg-2 control-label">Описание</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" rows="8" id="inputDescription" name="inputDescription" placeholder="Описание"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Отправить</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			</form>
		</div>
	</div>
</div>

			</td>
			<td><a href="<?=SITE_URL?>admin/item/delete/<?=$value['Id']?>"><span class="glyphicon glyphicon-trash"></span></a></td>
		</tr>

<?php endforeach ?>

	</tbody>
</table>
