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

    function PnumberChange()
    {
        var pnumber = document.getElementById("pnumber").value;
        document.cookie = "pnumber_links=" + pnumber;
        location.reload();
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
            <input type="hidden" name="a" value="admin">
            <input type="hidden" name="t" value="links">
            <div class="form-group">
                <input class="form-control form-warning input-sm" type="text" name="search" value="${FORM_SEARCH}">
            </div>
            <input class="btn btn-info" type="submit" value="${BUTTON_FIND}">
        </form>
    </div>
</div>
<!-- BEGIN row -->
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th width="10px"><input type="checkbox" title="TABLECOLMN_CHECK_ALLBOX" onSubmit="if(this.action.value == 0){window.alert('${ALERT_SELECT_ACTION}');return false;}if(this.action.value == 3){return confirm('${ALERT_CONFIRM_REMOVE}');}" id="check_all"></th>
        <th><a href="./?a=admin&t=links&id=<!-- IF '${GET_ID}' != '' -->${GET_ID}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">ID</a> <span class="<!-- IF '${GET_ID}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_ID}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th><a href="./?a=admin&t=links&name=<!-- IF '${GET_NAME}' != '' -->${GET_NAME}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_NAME}</a> <span class="<!-- IF '${GET_NAME}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_NAME}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th>${STR_DESCRIPTION}</th>
        <th><a href="./?a=admin&t=links&email=<!-- IF '${GET_EMAIL}' != '' -->${GET_EMAIL}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_EMAIL}</a> <span class="<!-- IF '${GET_EMAIL}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_EMAIL}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th><a href="./?a=admin&t=links&url=<!-- IF '${GET_URL}' != '' -->${GET_URL}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_URL}</a> <span class="<!-- IF '${GET_URL}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_URL}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th><a href="./?a=admin&t=links&category=<!-- IF '${GET_CATEGORY}' != '' -->${GET_CATEGORY}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_CATEGORY}</a> <span class="<!-- IF '${GET_CATEGORY}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_CATEGORY}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th><a href="./?a=admin&t=links&views=<!-- IF '${GET_VIEWS}' != '' -->${GET_VIEWS}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_VIEWS}</a> <span class="<!-- IF '${GET_VIEWS}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_VIEWS}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th><a href="./?a=admin&t=links&created=<!-- IF '${GET_CREATED}' != '' -->${GET_CREATED}<!-- ELSE -->up<!-- END IF --><!-- IF '${SEARCH}' != '' -->&search=${SEARCH}<!-- END IF -->${PAGENAV}">${STR_CREATED}</a> <span class="<!-- IF '${GET_CREATED}' == 'up' -->fa fa-sort-desc<!-- ELSE IF '${GET_CREATED}' == 'down' -->fa fa-sort-asc<!-- ELSE -->fa fa-sort<!-- END IF -->"</span></th>
        <th>${STR_ACTION}</th>
    </tr>
    </thead>

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
    </tbody>
</table>

<div class="row">
    <div class="col-md-4">
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
    <div class="col-md-4 col-md-offset-2">
        <div class="dataTables_paginate paging_simple_numbers" >
            <!-- BEGIN pagination -->
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
            <!-- END pagination -->
        </div>
    </div>
</div>


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
<!-- END row -->
<!-- IF '${EMPTY_LIST}' != '' -->
<p class="text-center text-danger">${EMPTY_LIST}</p>
<!-- END IF -->
<!-- BEGIN notfound -->
<div class="alert">
    <button class="close" data-dismiss="alert">×</button>
    ${MSG_NOTFOUND}
</div>
<!-- END notfound -->


<!-- INCLUDE footer.tpl -->