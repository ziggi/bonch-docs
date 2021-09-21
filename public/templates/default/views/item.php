<?php

$sem_array = $data[0]['Sems'];
$sem_active = null;
$sems = null;

foreach ($sem_array as $key => $value) {
	$active = null;
	if ($value['Active'] == 1) {
		$active = ' class="active"';
		$sem_active = $key.' семестр';
	}

	$sems .= '<li'.$active.'><a href="' . SITE_URL . 'item/show/' . $data[0]['Name'] . '/' . $data[0]['Type'] . '/' . $key . '" data-target="tab-content" class="change_sem" id="chsem_' . $key . '">'.$key.' семестр</a></li>';
}

?>
<div class="row">

	<div class="col-xs-10 col-sm-9">
		<h4><?=$data[0]['Label']?></h4>
	</div>

	<div class="col-xs-2 col-sm-3">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				<span id="dropdown_active_sem"><?php echo $sem_active; ?></span> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu pull-right" id="sem-menu">
				<?php echo $sems; ?>
			</ul>
		</div>
	</div>

</div>

<div id="tab-content">
	<?php include "item/layout.php" ?>
</div>
