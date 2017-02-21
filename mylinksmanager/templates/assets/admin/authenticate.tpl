<!DOCTYPE html>
<html>
<head>
<title>${AUTORIZATION}</title>
<meta name="ROBOTS" content="noindex">
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<!-- BOOTSTRAP STYLES-->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- MORRIS CHART STYLES-->
<link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
<!-- CUSTOM STYLES-->
<link href="assets/css/custom.css" rel="stylesheet" />
<!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div class="container">
  <div class="row ">
    <div class="row text-center ">
      <div class="col-md-12"> <br>
        <br>
        <h2>${TITLE_ADMIN_AREA}</h2>
        <br>
      </div>
    </div>
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"> <strong>${STR_LOGIN}</strong> </div>
        <div class="panel-body">
          <form role="form" action="${ACTION}" method="post">
            <input type="hidden" name="admin" value="ok">
            <br />
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" name="password" class="form-control"  placeholder="${STR_YOUR_PASSWORD}" />
            </div>
            <button class="btn btn-primary" type="submit">${BUTTON_LOGIN}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>