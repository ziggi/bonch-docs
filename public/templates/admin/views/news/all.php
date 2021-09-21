<?php
if (isset($data['errorMsg'])) {
	echo "<p>" . $data['errorMsg'] . "</p>";
	return;
}
?>
<?php foreach ($data as $value): ?>
<div class="news">
	<h4><?=$value['Title']?>
		<small class="pull-right" style="font-size: 10px">
			<?=$value['Date']?>
			<a class="edit" href="#news_<?=$value['ID']?>" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span></a>
			<a href="<?=SITE_URL?>admin/news/delete/<?=$value['ID']?>"><span class="glyphicon glyphicon-trash"></span></a>
		</small>
	</h4>
	<p class="text" data-type="textarea" data-pk="<?=$value['ID']?>" data-toggle="manual" data-placement="bottom"><?=$value['Text']?></p>
	<hr>
</div>

<div id="news_<?=$value['ID']?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?=SITE_URL?>admin/news/edit/<?=$value['ID']?>" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Редактирование</h3>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="form-group">
							<label for="inputTitle">Заголовок</label>
							<input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Заголовок" value="<?=$value['Title']?>">
						</div>
						<div class="form-group">
							<label for="inputDate">Дата</label>
							<input type="text" class="form-control" id="inputDate" name="inputDate" placeholder="Дата" value="<?=$value['Date']?>">
						</div>
						<div class="form-group">
							<label for="inputText">Текст</label>
							<textarea type="text" class="form-control" rows="8" id="inputText" name="inputText" placeholder="Текст"><?=$value['Text']?></textarea>
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
