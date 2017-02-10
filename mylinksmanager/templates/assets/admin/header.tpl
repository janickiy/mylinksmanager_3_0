<!DOCTYPE html>
<html>
<head>
	<title>${TITLE}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="ROBOTS" content="noindex">
	<base href="http://${BASE_URL}">
	<link href="templates/styles/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="templates/styles/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="templates/styles/styles.css" rel="stylesheet" media="screen">
	<link href="templates/styles/DT_bootstrap.css" rel="stylesheet" media="screen">
	<link type="text/css" href="templates/styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
	<link href="templates/styles/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="templates/js/jquery.min.js"></script>
	<script type="text/javascript" src="templates/js/jquery.hide_alertblock.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3" id="sidebar"></span>
			<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
				<li <!-- IF '${ACTIVE_MENU}' == '' -->class="active" <!-- END IF -->><a href="./?a=admin" title="Список лицензионных ключей"><i class="fa fa-list-ul"></i> Список лицензионных ключей</a></li>
				<li <!-- IF '${ACTIVE_MENU}' == 'domains' -->class="active"<!-- END IF -->><a href="./?t=domains&a=admin" title="Список доменов"><i class="fa fa-list-ul "></i> Список доменов</a><span class="menu-create-tmpl-icon"></span></li>
				<li <!-- IF '${ACTIVE_MENU}' == 'info' -->class="active"<!-- END IF -->><a href="./?t=info&a=admin" title="Инфо"><i class="fa fa-list-ul "></i> Инфо</a><span class="menu-create-tmpl-icon"></span></li>
				<li <!-- IF '${ACTIVE_MENU}' == 'log' -->class="active"<!-- END IF -->><a href="./?t=log&a=admin" title="Стастика"><i class="fa fa-bar-chart-o"></i> Стастика</a></li>
				<li <!-- IF '${ACTIVE_MENU}' == 'change_password' -->class="active"<!-- END IF -->><a href="./?t=change_password&a=admin" title="Сменить пароль"><i class="fa fa-key"></i> Сменить пароль</a></li>
			</ul>
		</div>
		<div class="span9" id="content">
			<div class="row-fluid">
				<!-- block -->
				<div class="block">
					<div class="navbar navbar-inner block-header">
						<div class="muted pull-left"><strong><h3>${TITLE_PAGE}</h3></strong></div>
					</div>
					<div class="block-content collapse in">
						<div class="span12">