<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>${TITLE}</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="./templates/admin/assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="./templates/admin/assets/css/font-awesome.css" rel="stylesheet" />
	<!-- MORRIS CHART STYLES-->
	<link href="./templates/admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="./templates/admin/assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<script src="./js/jquery.min.js"></script>

	<script src="./js/jquery.hide_alertblock.js"></script>
	<script src="./js/jquery.cookie.js"></script>

	<script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                cache: false,
                url: './?t=ajax&action=alert_update',
                dataType: "json",
                success: function(data){
                    if (data.msg != '' && $.cookie('alertshow') != 'no'){
                        $('#alert_msg_block').fadeIn('700');
                        $("#alert_warning_msg").append(data.msg);
                    }
                }
            });

            $('.close').on('click', function(){
                var deleted_block = $(this).parent(),
                    bl_h = deleted_block.outerHeight(),
                    bk_index = deleted_block.index(),
                    next_bl = deleted_block.siblings(':eq('+bk_index+')'),
                    marg = parseInt(deleted_block.css('margin-bottom'));

                deleted_block.fadeOut(500);

                setTimeout(function(){
                    $(next_bl).css('margin-top', bl_h+marg);
                    $(next_bl).animate({
                        marginTop: 0
                    },400);
                }, 505);

                setTimeout(function(){
                    deleted_block.remove();
                }, 700);
                return false;
            });

            setTimeout(function(){
                setTimeout(function(){$('.alert-success').fadeOut('700')},5000);
            });
        });

	</script>
</head>
<body>
<div id="wrapper">
	<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand" href="./?a=admin"></a>
		</div>
		<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> <a href="./?a=admin&t=logout" class="btn btn-danger square-btn-adjust">${STR_LOGOUT}</a> </div>
	</nav>
	<!-- /. NAV TOP  -->
	<nav class="navbar-default navbar-side" role="navigation">
		<div class="sidebar-collapse">
			<ul class="nav" id="main-menu">
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == '' -->class="active-menu"<!-- END IF --> title="${INDEXTITLE}" href="./?a=admin"><i class="fa fa-flag"></i> ${MENU_INDEX}</a>
				</li>
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == 'addlink' -->class="active-menu"<!-- END IF --> title="${MENU_ADDURL_TITLE}" href="<!-- URL 'Helper::url("./?a=admin&t=addlink")' -->"><i class="fa fa-plus"></i> ${MENU_ADDURL}</a>
				</li>
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == 'category' -->class="active-menu"<!-- END IF --> title="${MENU_CATEGORIES_TITLE}" href="./?a=admin&t=categories"><i class="fa fa-folder-open "></i> ${MENU_CATEGORIES}</a>
				</li>
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == 'links' -->class="active-menu"<!-- END IF --> title="${MENU_LINKS_TITLE}" href="./?a=admin&t=links"><i class="fa fa-list"></i> ${MENU_LINKS}</a></li>
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == 'settings' -->class="active-menu"<!-- END IF --> title="${MENU_SETTINGS_TITLE}" href="./?a=admin&t=settings"><i class="fa fa-gear"></i> ${MENU_SETTINGS}</a>
				</li>
				<li>
					<a	<!-- IF '${ACTIVE_MENU}' == 'update' -->class="active-menu"<!-- END IF --> title="${MENU_UPDATE_TITLE}" href="./?a=admin&t=update"><i class="fa fa-refresh"></i> ${MENU_UPDATE}</a>
				</li>
				<li>
					<a <!-- IF '${ACTIVE_MENU}' == 'password' -->class="active-menu"<!-- END IF --> title="${MENU_PASSWORD_TITLE}" href="./?a=admin&t=password"><i class="fa fa-key "></i> ${MENU_PASSWORD}</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		<div id="page-inner">
			<div class="row">
				<div class="col-md-12">
					<h1>${TITLEPAGE}</h1>
					<!-- IF '${HELP}' != '' -->
					<div class="alert alert-info">${HELP}</div>
					<!-- END IF -->
				</div>
			</div>
			<!-- BEGIN show_errors -->
			<div class="alert alert-danger">
				<button class="close" data-dismiss="alert">×</button>
				<h4 class="alert-heading">${STR_IDENTIFIED_FOLLOWING_ERRORS}:</h4>
				<ul>
					<!-- BEGIN row -->
					<li> ${ERROR}</li>
					<!-- END row -->
				</ul>
			</div>
			<!-- END show_errors -->
			<!-- IF '${INFO_ALERT}' != '' -->
			<div class="alert alert-info"> ${INFO_ALERT} </div>
			<!-- END IF -->
			<div class="alert alert-warning" style="display:none">
				<button class="close" onClick="$.cookie('alertshow', 'no');" data-dismiss="alert">×</button>
				<h4 class="alert-heading">${STR_WARNING}!</h4>
				<span id="alert_warning_msg">${PAGE_ALERT_WARNING_MSG}</span>
			</div>

			<!-- IF '${ERROR_ALERT}' != '' -->
			<div class="alert alert-danger">
				<button class="close" data-dismiss="alert">×</button>
				<strong>${STR_ERROR}!</strong> ${ERROR_ALERT}
			</div>
			<!-- END IF -->
			<!-- IF '${MSG_ALERT}' != '' -->
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				${MSG_ALERT}
			</div>
			<!-- END IF -->