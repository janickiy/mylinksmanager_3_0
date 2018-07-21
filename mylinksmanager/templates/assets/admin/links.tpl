<!-- INCLUDE header.tpl -->

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th width="10px"><input type="checkbox" title="TABLECOLMN_CHECK_ALLBOX" id="check_all"></th>
        <th>ID</th>
        <th>${STR_NAME}</th>
        <th>${STR_DESCRIPTION}</th>
        <th>${STR_EMAIL}</th>
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
    <td></td>
    </tr>
    <!-- END column -->
    <!-- END row -->
    </tbody>
</table>



<!-- INCLUDE footer.tpl -->