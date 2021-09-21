<div class="tabbable">
	<ul class="nav nav-tabs nav-justified">
<?php

$sem_num = null;

foreach ($data[0]['Sems'] as $key=>$value) {
	if ($value['Active']) {
		$sem_num = $key;
		break;
	}
}

$item_type_data = $this->widgetController()->getContent('ItemTypeMenu', $sem_num);

foreach ($item_type_data as $row) {
	$active = $row['Active'] == 1 ? ' class="active"' : null;
	echo '<li' . $active . '><a href="' . SITE_URL . 'item/show/' . $data[0]['Name'] . '/' . $row['Name'] . '/' . $sem_num . '" data-target="sem-content" data-toggle="tab">' . $row['Title'] . '</a></li>';
}

?>
	</ul>
</div>

<div class="tab-content" id="sem-content">
<?php

if (isset($data['error']) && isset($data['errorMsg'])) {
	if ($data['error'] == 0) {
		echo "<h4><span class=\"label label-success\">" . $data['errorMsg'] . "</span></h4>";
	} else {
		echo "<h4><span class=\"label label-danger\">" . $data['errorMsg'] . "</span></h4>";
	}
} else {
	include $data[0]['Type'] . ".php";
}
?>
</div>
