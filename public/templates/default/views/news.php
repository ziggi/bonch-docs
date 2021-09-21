<?php
if (isset($data['errorMsg'])) {
	echo "<p>" . $data['errorMsg'] . "</p>";
	return;
}
?>
<?php foreach ($data as $value): ?>
	<h4><strong><?=$value['Title']?></strong> <small class="pull-right" style="font-size: 10px"><?=$value['Date']?></small></h4>
	<p><?=$value['Text']?></p>
	<hr>
<?php endforeach ?>
