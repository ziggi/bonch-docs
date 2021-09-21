<?php
if (isset($data['errorMsg'])) {
	echo "<p>" . $data['errorMsg'] . "</p>";
	return;
}
?>
<h3><?=$data['Title']?></h3>
<?=$data['Text']?>