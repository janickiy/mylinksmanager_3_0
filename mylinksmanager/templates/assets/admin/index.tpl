<!-- INCLUDE header.tpl -->
<!-- IF '${MSG_ALERT}' != '' -->
<div class="alert alert-success">
    <button class="close" data-dismiss="alert">×</button>
    ${MSG_ALERT} </div>
<!-- END IF -->
<!-- BEGIN show_errors -->
<div class="alert alert-error">
    <a class="close" href="#" data-dismiss="alert">×</a>
    <h4 class="alert-heading">Выявлены следующие ошибки:</h4>
    <ul>
        <!-- BEGIN row -->
        <li> ${ERROR}</li>
        <!-- END row -->
    </ul>
</div>
<!-- END show_errors -->

<form class="form-inline" id="searchform" method="GET" name="searchform" action="">
    <div class="control-group">
        <input type="hidden" name="a" value="admin">
        <input type="text" name="search" value="${SEARCH}" placeholder="найти ключ">
        <input class="btn btn-info" type="submit" value="найти" id="searchsubmit">
    </div>
</form>

<table class="table-hover table table-bordered" border="0" cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr>
        <th>Лицензия</th>
        <th>Тип</th>
        <th>Действия</th>
    </tr>
    </thead>
<!-- BEGIN row_licenses -->
    <tbody>
        <td>${LICENSEKEY}</td>
        <td>${TYPE}</td>
        <td><a class="btn btn-default" href="./?t=edit_license&id=${ID}&a=admin">редактировать</a> <a class="btn btn-danger" href="./?action=remove&id=${ID}&a=admin">удалить</a></td>
    </tbody>
<!-- END row_licenses -->
</table>

<!-- BEGIN pagination -->
<div class="form-inline">
    <div class="control-group"> ${STR_PNUMBER}:
        <select onchange="PnumberChange(this);" class="span1 form-control" id="pnumber" name="pnumber">
            <option value="10" <!-- IF '${PNUMBER}' == 10 -->selected="selected"<!-- END IF -->> 10 </option>
            <option value="20" <!-- IF '${PNUMBER}' == 20 -->selected="selected"<!-- END IF -->> 20 </option>
            <option value="30" <!-- IF '${PNUMBER}' == 30 -->selected="selected"<!-- END IF -->> 30 </option>
            <option value="50" <!-- IF '${PNUMBER}' == 50 -->selected="selected"<!-- END IF -->> 50 </option>
            <option value="100" <!-- IF '${PNUMBER}' == 100 -->selected="selected"<!-- END IF -->> 100 </option>
        </select>
    <span class="help-inline">
    <div class="pagination">
        <ul>
            <!-- IF '${PERVPAGE}' != '' -->
            <li>${PERVPAGE}</li>
            <!-- END IF -->
            <!-- IF '${PERV}' != '' -->
            <li>${PERV}</li>
            <!-- END IF -->
            <!-- IF '${PAGE2LEFT}' != '' -->
            <li>${PAGE2LEFT}</li>
            <!-- END IF -->
            <!-- IF '${PAGE1LEFT}' != '' -->
            <li>${PAGE1LEFT}</li>
            <!-- END IF -->
            <!-- IF '${CURRENT_PAGE}' != '' -->
            <li class="prev disabled">${CURRENT_PAGE}</li>
            <!-- END IF -->
            <!-- IF '${PAGE1RIGHT}' != '' -->
            <li>${PAGE1RIGHT}</li>
            <!-- END IF -->
            <!-- IF '${PAGE2RIGHT}' != '' -->
            <li>${PAGE2RIGHT}</li>
            <!-- END IF -->
            <!-- IF '${NEXTPAGE}' != '' -->
            <li>${NEXTPAGE}</li>
            <!-- END IF -->
            <!-- IF '${NEXT}' != '' -->
            <li>${NEXT}</li>
            <!-- END IF -->
        </ul>
    </div>
    </span> </div>
</div>

<!-- IF '${EMPTY_LIST}' != '' -->
<div class="warning_msg">${EMPTY_LIST}</div>
<!-- END IF -->

<!-- IF '${NOT_FOUND}' != '' -->
<div class="warning_msg">${NOT_FOUND}</div>
<!-- END IF -->

<!-- END pagination -->
<script>

    function PnumberChange()
    {
        var pnumber = document.getElementById("pnumber").value;
        document.cookie = "pnumber_license=" + pnumber;
        location.reload();
    }

</script>


<a class="btn btn-success" href="./?t=add_license&a=admin">+ Добавить</a>
<!-- INCLUDE footer.tpl -->