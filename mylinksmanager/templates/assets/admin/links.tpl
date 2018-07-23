<!-- INCLUDE header.tpl -->
<script type="text/javascript">

    $(document).ready(function() {
        var checkbox = $(".checkbox"),
            boxCnt = checkbox.length,
            allcheckbox = $("#check_all");
        allcheckbox.on('change',function () {
            checkbox.prop("checked", $(this).is(":checked"));
            countChecked()
        });
        checkbox.on('change', function(){
            allcheckbox.prop("checked", $('.checkbox:checked').length == boxCnt);
            countChecked()
        });
    });

    function countChecked(form)
    {
        if ($('.checkbox').is(':checked'))
            $('#apply').attr('disabled',false);
        else
            $('#apply').attr('disabled',true);
    }

</script>
<div class="row">
    <div class="col-lg-12">
        <div class="BtnPanelIcon">
            <a class="btn btn-outline btn-default btn-lg" title="${STR_IMPORT_LINKS}" href="./?a=admin&t=import"> <span class="fa fa-download fa-2x"></span> <span class="IconText">${STR_IMPORT_LINKS}</span> </a>
            <a class="btn btn-outline btn-default btn-lg" title="${STR_EXPORT_LINKS}" href="./?a=admin&t=export"> <span class="fa fa-upload fa-2x"></span> <span class="IconText">${STR_EXPORT_LINKS}</span> </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" style="margin-bottom: 20px; margin-top: 20px;" method="GET" name="searchform" action="${ACTION}">
            <input type="hidden" name="t" value="subscribers">
            <div class="form-group">
                <input class="form-control form-warning input-sm" type="text" name="search" value="${SEARCH}">
            </div>
            <input class="btn btn-info" type="submit" value="${BUTTON_FIND}">
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th width="10px"><input type="checkbox" title="TABLECOLMN_CHECK_ALLBOX" onSubmit="if(this.action.value == 0){window.alert('${ALERT_SELECT_ACTION}');return false;}if(this.action.value == 3){return confirm('${ALERT_CONFIRM_REMOVE}');}" id="check_all"></th>
        <th>ID</th>
        <th>${STR_NAME}</th>
        <th>${STR_DESCRIPTION}</th>
        <th>${STR_EMAIL}</th>
        <th>${STR_URL}</th>
        <th>${STR_CATEGORY}</th>
        <th>${STR_VIEWS}</th>
        <th>${STR_CREATED}</th>
        <th>${STR_ACTION}</th>
    </tr>
    </thead>
    <!-- BEGIN row -->
    <tbody>
    <!-- BEGIN column -->
    <tr <!-- IF '${CLASS_NOACTIVE}' == 'no' -->class="danger"<!-- END IF -->>
    <td style="vertical-align: middle;"><input type="checkbox" class="checkbox" title="${TABLECOLMN_CHECKBOX}" value="${ROW_ID_TEMPLATE}" name=activate[]></td>
    <td>${ID}</td>
    <td>${NAME}</td>
    <td>${DESCRIPTION}</td>
    <td>${EMAIL}</td>
    <td>${URL}</td>
    <td>${CATEGORY}</td>
    <td>${VIEWS}</td>
    <td>${CREATED}</td>
    <td>
        <a class="btn btn-outline btn-default" href="./?a=admin&t=edit_link&id_user=${ID}" title="${STR_EDIT}"> <i class="fa fa-pencil"></i></a>
        <a class="btn btn-outline btn-danger" href="./?a=admin&t=linkss&remove=${ID}" title="${STR_REMOVE}"> <i class="fa fa-trash-o"></i></a>
    </td>
    </tr>
    <!-- END column -->
    <!-- END row -->
    </tbody>
</table>
<!-- BEGIN pagination -->
<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_length">
            <label>
                ${STR_PNUMBER}: <select onchange="PnumberChange(this);" class="span1 form-control" id="pnumber" name="pnumber">
                    <option value="5"<!-- IF '${PNUMBER}' == 5 --> selected="selected"<!-- END IF -->> 5 </option>
                    <option value="10"<!-- IF '${PNUMBER}' == 10 --> selected="selected"<!-- END IF -->> 10 </option>
                    <option value="15"<!-- IF '${PNUMBER}' == 15 --> selected="selected"<!-- END IF -->> 15 </option>
                    <option value="20"<!-- IF '${PNUMBER}' == 20 --> selected="selected"<!-- END IF -->> 20 </option>
                    <option value="50"<!-- IF '${PNUMBER}' == 50 --> selected="selected"<!-- END IF -->> 50 </option>
                    <option value="100"<!-- IF '${PNUMBER}' == 100 --> selected="selected"<!-- END IF -->> 100 </option>
                </select>
            </label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <!-- IF '${PERVPAGE}' != '' -->
                <li class="paginate_button previous">${PERVPAGE}</li>
                <!-- END IF -->
                <!-- IF '${PERV}' != '' -->
                <li class="paginate_button previous">${PERV}</li>
                <!-- END IF -->
                <!-- IF '${PAGE2LEFT}' != '' -->
                <li class="paginate_button ">${PAGE2LEFT}</li>
                <!-- END IF -->
                <!-- IF '${PAGE1LEFT}' != '' -->
                <li class="paginate_button ">${PAGE1LEFT}</li>
                <!-- END IF -->
                <!-- IF '${CURRENT_PAGE}' != '' -->
                <li class="paginate_button active">${CURRENT_PAGE}</li>
                <!-- END IF -->
                <!-- IF '${PAGE1RIGHT}' != '' -->
                <li class="paginate_button ">${PAGE1RIGHT}</li>
                <!-- END IF -->
                <!-- IF '${PAGE2RIGHT}' != '' -->
                <li class="paginate_button ">${PAGE2RIGHT}</li>
                <!-- END IF -->
                <!-- IF '${NEXTPAGE}' != '' -->
                <li class="paginate_button next">${NEXTPAGE}</li>
                <!-- END IF -->
                <!-- IF '${NEXT}' != '' -->
                <li class="paginate_button next">${NEXT}</li>
                <!-- END IF -->
            </ul>
        </div>
    </div>
</div>
<!-- END pagination -->
<div class="row">
    <div class="col-sm-12">
        <div class="form-inline">
            <div class="control-group">
                <select id="select_action" class="span3 form-control" name="action">
                    <option value="0">--${STR_ACTION}--</option>
                    <option value="1">${STR_CHECK}</option>
                    <option value="2">${STR_REMOVE}</option>
                </select>
                <span class="help-inline">
      <input type="submit" id="apply" value="${STR_APPLY}" class="btn btn-success" disabled="" name="">
      </span> </div>
        </div>
    </div>
</div>


<!-- INCLUDE footer.tpl -->