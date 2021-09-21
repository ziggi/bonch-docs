<?php
if (isset($data['error']) && isset($data['errorMsg'])) {
	if ($data['error'] == 0) {
		echo "<h4><span class=\"label label-success\">" . $data['errorMsg'] . "</span></h4>";
	} else {
		echo "<h4><span class=\"label label-danger\">" . $data['errorMsg'] . "</span></h4>";
	}
}
?>
<form class="form-horizontal" method="post" action="<?=SITE_URL?>admin/item/add" enctype="multipart/form-data">
	<legend>Добавить контент</legend>
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
foreach ($data['categories'] as $row) {
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

	<div class="form-group">
		<label for="inputTitle" class="col-lg-2 control-label"></label>
		<div class="col-lg-2">
			<button type="submit" class="btn btn-primary">Добавить</button>
		</div>
	</div>
</form>
