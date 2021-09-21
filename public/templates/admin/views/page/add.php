<?php
if (isset($data['error']) && isset($data['errorMsg'])) {
	if ($data['error'] == 0) {
		echo "<h4><span class=\"label label-success\">" . $data['errorMsg'] . "</span></h4>";
	} else {
		echo "<h4><span class=\"label label-danger\">" . $data['errorMsg'] . "</span></h4>";
	}
}
?>
<form class="form-horizontal" method="post" action="<?=SITE_URL?>admin/page/add" enctype="multipart/form-data">
	<legend>Добавить новость</legend>
	<div class="form-group">
		<label for="inputName" class="col-lg-2 control-label">Имя</label>
		<div class="col-lg-10">
			<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Имя">
		</div>
	</div>
	<div class="form-group">
		<label for="inputTitle" class="col-lg-2 control-label">Заголовок</label>
		<div class="col-lg-10">
			<input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Заголовок">
		</div>
	</div>
	<div class="form-group">
		<label for="inputText" class="col-lg-2 control-label">Текст</label>
		<div class="col-lg-10">
			<textarea type="text" class="form-control" rows="8" id="inputText" name="inputText" placeholder="Текст"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="inputTitle" class="col-lg-2 control-label"></label>
		<div class="col-lg-3">
			<button type="submit" class="btn btn-primary">Добавить</button>
		</div>
	</div>
</form>
