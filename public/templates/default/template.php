<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Bonch.Docs - Конспекты лекций, лабораторные, курсовые</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_URL?>public/assets/img/favicon.ico">

		<link href="<?=SITE_URL?>public/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?=SITE_URL?>public/assets/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		<style type="text/css">
			body {
				padding-top: 60px;
			}
		</style>

		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-19652245-4']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>
	</head>

	<body>
		<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=SITE_URL?>" id="top-home" data-target="content">Bonch.Docs</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-top">
				<ul class="nav navbar-nav" id="top-menu">
<?php

$menu_data = $this->widgetController()->getContent('PageMenu');

foreach ($menu_data as $row) {
	$active = $row['Active'] == 1 ? ' class="active"' : null;
	echo '<li' . $active . '><a href="' . SITE_URL . 'page/show/' . $row['Name'] . '" data-target="content">' . $row['Title'] . '</a></li>';
}
?>
				</ul>
				<ul class="nav navbar-nav navbar-right hidden-xs">
					<li>
						<div id="loading" class="pull-right hidden-xs" style="visibility: hidden; line-height: 50px; padding-right: 20px;">
							<img src="<?=SITE_URL?>public/assets/img/loading.gif" alt="loading">
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-3">
					<div class="navbar navbar-default visible-xs">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-item">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Предметы</a>
						</div>
						<div class="collapse navbar-collapse navbar-item">
							<ul class="nav nav-pills nav-stacked" id="item-menu">
<?php

$menu_data = $this->widgetController()->getContent('ItemMenu');

foreach ($menu_data as $row) {
	$active = $row['Active'] == 1 ? ' class="active"' : null;
	echo '<li' . $active . '><a href="' . SITE_URL . 'item/show/' . $row['Name'] . '/' . $row['Type'] . '/' . $row['Sem'] . '" data-target="content">' . $row['Label'] . '</a></li>';
}
?>
							</ul>
						</div>
					</div>

					<ul class="nav nav-pills nav-stacked hidden-xs" id="item-menu">
<?php

$menu_data = $this->widgetController()->getContent('ItemMenu');

foreach ($menu_data as $row) {
	$active = $row['Active'] == 1 ? ' class="active"' : null;
	echo '<li' . $active . '><a href="' . SITE_URL . 'item/show/' . $row['Name'] . '/' . $row['Type'] . '/' . $row['Sem'] . '" data-target="content">' . $row['Label'] . '</a></li>';
}
?>
					</ul>
				</div>
				<div class="col-lg-9 col-sm-9">
					<div id="content">
				<?php include 'views/'.$content_view; ?>
					</div>
				</div>
			</div>
		</div>

		<hr>

		<footer>
			<p class="text-center"><a href="https://ziggi.org/" target="_blank">Sergei Marochkin (ziggi)</a> &copy; 2012-<?=date('Y')?></p>
		</footer>

		<!-- Le javascript -->
		<script src="<?=SITE_URL?>public/assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?=SITE_URL?>public/assets/js/bootstrap.min.js"></script>
		<script src="<?=SITE_URL?>public/assets/js/scripts.js"></script>
	</body>
</html>
